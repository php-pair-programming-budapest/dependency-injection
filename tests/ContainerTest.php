<?php
/**
 * @author David Namenyi <dnamenyi@gmail.com>
 * Date: 2016.03.16.
 */

namespace DI\Test;

use DI\Container;
use DI\Definition;

class ContainerTest extends \PHPUnit_Framework_TestCase {

    public function testSet() {
        $container = new Container();
        $this->assertEmpty($this->readAttribute($container, '_services'));
        $container->set('test_service', new Definition('\ArrayObject'));
        $this->assertNotEmpty($this->readAttribute($container, '_services'));
    }

    public function testGet() {
        $container = new Container();
        $container->set('test_service', new Definition('\ArrayObject'));
        $this->assertInstanceOf('\ArrayObject', $container->get('test_service'));
    }

    public function testHas() {
        $container = new Container();
        $this->assertFalse($container->has('foo'));
        $container->set('foo', new Definition('\ArrayObject'));
        $this->assertTrue($container->has('foo'));
    }

}
