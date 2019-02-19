<?php
/**
 * WPSalty Tests
 */
namespace Tests;

use WPSalty\WPSalty;
use PHPUnit\Framework\TestCase;

class WPSaltyTest extends TestCase
{
    /** test Salty Class */
    public function testSalty()
    {
        $salty = new WPSalty();
        $this->assertInstanceOf(WPSalty::class, $salty);
    }

    /** test getSalts method */
    public function testGetSalts()
    {
        $salty = new WPSalty();
        $salts = $salty->getSalts();
        $this->assertTrue(isset($salts['AUTH_KEY']));
        $this->assertTrue(isset($salts['SECURE_AUTH_KEY']));
        $this->assertTrue(isset($salts['LOGGED_IN_KEY']));
        $this->assertTrue(isset($salts['NONCE_KEY']));
        $this->assertTrue(isset($salts['AUTH_SALT']));
        $this->assertTrue(isset($salts['SECURE_AUTH_SALT']));
        $this->assertTrue(isset($salts['LOGGED_IN_SALT']));
        $this->assertTrue(isset($salts['NONCE_SALT']));
    }

    /** test salts length */
    public function testSaltyLength()
    {
        $salty = new WPSalty();
        $salts = $salty->getSalts();
        $this->assertEquals(64, strlen($salts['AUTH_KEY']));
        $this->assertEquals(64, strlen($salts['SECURE_AUTH_KEY']));
    }

    /** test salt for no match */
    public function testSaltyNoMatch()
    {
        $salty = new WPSalty();
        $salts = $salty->getSalts();
        $this->assertNotEquals($salts['LOGGED_IN_KEY'], $salts['NONCE_KEY']);
        $this->assertNotEquals($salts['SECURE_AUTH_SALT'], $salts['AUTH_SALT']);
    }
    
    /** test toEnv method */
    public function testToEnv()
    {
        $salts = new WPSalty();
        $result = $salts->toEnv();
        $this->assertRegExp('/^AUTH_KEY\=\'.*/', $result);
        $this->assertRegExp('/SECURE_AUTH_KEY\=\'.*/', $result);
        $this->assertRegExp('/LOGGED_IN_KEY\=\'.*/', $result);
        $this->assertRegExp('/NONCE_KEY\=\'.*/', $result);
        $this->assertRegExp('/AUTH_SALT\=\'.*/', $result);
        $this->assertRegExp('/SECURE_AUTH_SALT\=\'.*/', $result);
        $this->assertRegExp('/LOGGED_IN_SALT\=\'.*/', $result);
        $this->assertRegExp('/NONCE_SALT\=\'.*/', $result);
    }
}
