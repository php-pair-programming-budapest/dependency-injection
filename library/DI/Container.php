<?php
/**
 * @author David Namenyi <dnamenyi@gmail.com>
 * Date: 2016.03.16.
 */

namespace DI;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Interop\Container\Exception\NotFoundException;

class Container implements ContainerInterface {

    /**
     * @var Definition[]
     */
    protected $_services = [];

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

        if (!isset($this->_services[$id])) {
            return null;
        }

        $definition = $this->_services[$id];
        if (!class_exists($definition->getClass())) {
            throw new \InvalidArgumentException(sprintf('Class with id: %s does not exist!', $id));
        }

        $class = $definition->getClass();
        return new $class();
    }

    public function set($id, Definition $value) {
        $this->_services[$id] = $value;
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