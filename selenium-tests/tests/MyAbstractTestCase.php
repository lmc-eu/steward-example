<?php

namespace My;

use Lmc\Steward\ConfigProvider;
use Lmc\Steward\Test\AbstractTestCase;

/**
 * Abstract class for custom tests, could eg. define some properties or instantiate some common components in setUp().
 */
abstract class MyAbstractTestCase extends AbstractTestCase
{
    /** @var int Default width of browser window (Steward's default is 1280) */
    public static $browserWidth = 1024;
    /** @var int Default height of browser window (Steward's default is 1024) */
    public static $browserHeight = 768;
    /** @var string */
    public static $baseUrl = 'http://www.w3.org/';

    public function setUp()
    {
        parent::setUp();

        if (ConfigProvider::getInstance()->env == 'production') {
            $this->warn('The tests are run against production, so be careful!');
        }
    }


}
