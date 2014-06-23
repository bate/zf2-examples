<?php

namespace ApplicationTest;

use Application\Entity\User;
use ApplicationTest\Bootstrap;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;


class HydratorTest extends \PHPUnit_Framework_TestCase
{
    public function testHydratorExamples()
    {
        $hydrator = new ObjectProperty();
        $hydrator->addFilter('strtoupper', function($p) {
            if (in_array($p, ['something', 'password'])) {
                return false;
            }
            return true;
        });

        $testObject = new User();
        $addData = array(
            'id' => 1,
            'name' => 'Foo',
            'password' => '!*MD5...',
            'email' => 'hello@world.com',
            'something' => 'stupid',
        );

        $data = $hydrator->hydrate($addData, $testObject);
        var_dump($data);

        $data = $hydrator->extract($data);
        var_dump($data);

        die();
    }
}
