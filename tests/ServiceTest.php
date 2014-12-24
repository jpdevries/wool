<?php
/**
 * Tests the Wool class.
 */
class ServiceTest extends PHPUnit_Framework_TestCase {
    /** @var Wool $Wool */
    public $wool;
    public $package;

    public function setUp() {
        global $Wool;
        $this->wool = $Wool;
    }

    public function testIsProperObject() {
        $this->assertInstanceOf('Wool', $this->wool);
        $this->assertInstanceOf('modX', $this->wool->modx);
    }

    public function testHasValidConfigOptions() {
        $this->assertTrue(is_array($this->wool->config), 'config is not an array.');
        $this->assertNotEmpty($this->wool->config['corePath'], 'missing corePath config entry.');
        $this->assertNotEmpty($this->wool->config['assetsUrl'], 'missing assetsPath config entry.');
    }
}
