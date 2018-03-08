<?php

namespace My;

use Lmc\Steward\ConfigProvider;
use Lmc\Steward\Test\AbstractTestCase;

/**
 * Abstract class for custom tests, could eg. define some properties or instantiate some common components
 * using @before annotated methods.
 */
abstract class MyAbstractTestCase extends AbstractTestCase
{
    /** @var int Default width of browser window (Steward's default is 1280) */
    public const BROWSER_WIDTH = 1024;
    /** @var int Default height of browser window (Steward's default is 1024) */
    public const BROWSER_HEIGHT = 768;
    /** @var string */
    public static $baseUrl;

    /**
     * @before
     */
    public function initBaseUrl()
    {
        // Set base url according to environment
        switch (ConfigProvider::getInstance()->env) {
            case 'production':
                self::$baseUrl = 'https://www.w3.org/';
                break;
            case 'staging':
                self::$baseUrl = 'http://some-staging-url/';
                break;
            case 'local':
                self::$baseUrl = 'http://localhost/';
                break;
            default:
                throw new \RuntimeException(sprintf('Unknown environment "%s"', ConfigProvider::getInstance()->env));
        }

        $this->debug('Base URL set to "%s"', self::$baseUrl);

        if (ConfigProvider::getInstance()->env === 'production') {
            $this->warn('The tests are run against production, so be careful!');
        }
    }
}
