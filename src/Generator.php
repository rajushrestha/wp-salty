<?php
/**
 * WP Random Secure Salt Generator
 * 
 * @category Generator
 * @package  WPSalty
 * @author   Raju Shrestha <raju@lunover.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.lunover.com
 */
namespace WPSalty;

use RandomLib\Factory;

class Generator
{
    /**
     * @var Factory $_factory
     */
    private $_factory;

    /**
     * List of characters to be used in the salt generation
     *
     * @var string $_chars
     */
    private $_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!"#$%&()*+,-./:;<=>?@[]^_`{|}~';

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->_factory = $factory;
    }

    /**
     * Generates 64 character salt string
     *
     * @return string
     */
    public function salt(): string
    {
        return $this->_factory->getMediumStrengthGenerator()
            ->generateString(64, $this->_chars);
    }
}
