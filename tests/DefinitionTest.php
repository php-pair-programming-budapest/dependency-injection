<?php
/**
 * @author David Namenyi <dnamenyi@gmail.com>
 * Date: 2016.03.16.
 */

namespace DI\Test;

use DI\Definition;

class DefinitionTest extends \PHPUnit_Framework_TestCase {

    public function testConstructor() {
        $definition = new Definition('foo', ['a', 'b', 'c']);
        $this->assertEquals('foo', $this->readAttribute($definition, '_class'));
        $this->assertEquals(['a', 'b', 'c'], $this->readAttribute($definition, '_args'));
    }

}
