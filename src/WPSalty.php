<?php
/**
 * WP Random Secure Salt Generator
 * 
 * @category WPSalty
 * @package  WPSalty
 * @author   Raju Shrestha <raju@lunover.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.lunover.com
 */
namespace WPSalty;

use WPSalty\Generator;
use RandomLib\Factory;

class WPSalty
{
    /**
     * Generate and return WordPress salts as an array.
     *
     * @return array
     */
    public function getSalts(): array
    {
        $generator = new Generator(new Factory);
        $salts['AUTH_KEY'] = $generator->salt();
        $salts['SECURE_AUTH_KEY'] = $generator->salt();
        $salts['LOGGED_IN_KEY'] = $generator->salt();
        $salts['NONCE_KEY'] = $generator->salt();
        $salts['AUTH_SALT'] = $generator->salt();
        $salts['SECURE_AUTH_SALT'] = $generator->salt();
        $salts['LOGGED_IN_SALT'] = $generator->salt();
        $salts['NONCE_SALT'] = $generator->salt();
        return $salts;
    }

    /**
     * Gets an array of WordPress salts and then reduces them to a string.
     * Returns them in the DotEnv format used in .env files.
     *
     * @return string
     */
    public function toEnv(): string
    {
        $salts = $this->getSalts();
        return array_reduce(
            array_keys($salts), function ($saltsString, $key) use ($salts) {
                $saltsString .= "{$key}='{$salts[$key]}'" . PHP_EOL;
                return $saltsString;
            }, ''
        );
    }
}
