<?php
/**
 * @author David Namenyi <dnamenyi@gmail.com>
 * Date: 2016.03.16.
 */

namespace DI;


class Definition {

    private $_class;
    private $_args;

    public function __construct($_class, $_args = array()) {
        $this->_class = $_class;
        $this->_args = $_args;
    }

    /**
     * @return mixed
     */
    public function getClass() {
        return $this->_class;
    }

    /**
     * @return array
     */
    public function getArgs() {
        return $this->_args;
    }

    public function hasArgs() {
        return !empty($this->_args);
    }
}