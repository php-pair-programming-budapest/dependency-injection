<?php
/**
 * @author David Namenyi <dnamenyi@gmail.com>
 * Date: 2016.03.16.
 */

namespace DI\Test;

use DI\Container;
use DI\Definition;

class ContainerTest extends \PHPUnit_Framework_TestCase {

    public function testGet() {
        $container = new Container([
            'test_service' => new Definition('\ArrayObject')
        ]);
        $this->assertInstanceOf('\ArrayObject', $container->get('test_service'));
    }

    public function testHas() {
        $container = new Container([]);
        $this->assertFalse($container->has('foo'));
        $container = new Container([
            'foo' => new Definition('\ArrayObject')
        ]);
        $this->assertTrue($container->has('foo'));
    }

    /** @expectedException \DI\Exception\CircularReferenceException */
    public function testLoop() {
        $container = new Container([
            'foo' => new Definition('\ArrayObject', ['bar']),
            'bar' => new Definition('\ArrayObject', ['foo'])
        ]);
        $container->get('foo');
    }

}
