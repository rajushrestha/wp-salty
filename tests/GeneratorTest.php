<?php
/**
 * Generator Tests
 */
namespace Tests;

use PHPUnit\Framework\TestCase;
use WPSalty\Generator;
use RandomLib\Factory;

class GeneratorTest extends TestCase
{
    /** test generator class */
    public function testGenerator()
    {
        $generator = new Generator(new Factory);
        $this->assertInstanceOf(Generator::class, $generator);
    }

    /** test salt */
    public function testSalt()
    {
        $generator = new Generator(new Factory);
        $salt = $generator->salt();
        $this->assertEquals(64, strlen($salt));
    }
}
