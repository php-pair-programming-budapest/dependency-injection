<?php
/**
 * @author David Namenyi <dnamenyi@gmail.com>
 * Date: 2016.03.16.
 */

namespace DI;

use DI\Exception\CircularReferenceException;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Interop\Container\Exception\NotFoundException;

class Container implements ContainerInterface {

    /**
     * @var Definition[]
     */
    protected $_services = [];

    /**
     * @var array
     */
    protected $_objects = [];

    /**
     * @var array
     */
    protected $_circularReferenceGuard = [];

    function __construct(array $services) {
        $this->_services = $services;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException  No entry was found for this identifier.
     * @throws ContainerException Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id) {

        if (!is_string($id))
            throw new \InvalidArgumentException;

        if (!isset($this->_services[$id])) {
            throw new Exception\NotFoundException;
        }

        if (array_key_exists($id, $this->_circularReferenceGuard))
            throw new CircularReferenceException;

        $this->_circularReferenceGuard[$id] = true;

        $definition = $this->_services[$id];
        if (!class_exists($definition->getClass())) {
            throw new Exception\ContainerException(sprintf('Class with id: %s does not exist!', $id));
        }

        if (array_key_exists($id, $this->_objects))
            return $this->_objects[$id];

        $class = $definition->getClass();
        $args = $definition->getArgs();

        foreach ($args as &$arg) {
            if (is_string($arg) AND $this->has($arg))
                $arg = $this->get($arg);
        }

        $reflection = new \ReflectionClass($class);
        $this->_objects[$id] = $reflection->newInstanceArgs($args);

        unset($this->_circularReferenceGuard[$id]);

        return $this->_objects[$id];
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has($id) {
        return isset($this->_services[$id]);
    }

}