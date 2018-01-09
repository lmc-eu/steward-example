<?php

namespace My\Steward;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Lmc\Steward\ConfigProvider;
use Lmc\Steward\Selenium\CustomCapabilitiesResolverInterface;
use Lmc\Steward\Test\AbstractTestCase;
use OndraM\CiDetector\CiDetector;

/**
 * You can define capabilities for one test run using the `--capability` option of `steward run` command. However,
 * if you need some custom logic logic or when you need some global capabilities which don't differ between runs,
 * you can implement the CustomCapabilitiesResolverInterface.
 *
 * Then you must specify the Resolver in steward.yml configuration file like this:
 * `capabilities_resolver: My\Steward\CapabilitiesResolver`
 *
 * @see https://github.com/lmc-eu/steward/wiki/Set-custom-capabilities
 */
class CustomCapabilitiesResolver implements CustomCapabilitiesResolverInterface
{
    /** @var ConfigProvider */
    private $config;

    public function __construct(ConfigProvider $config)
    {
        $this->config = $config;
    }

    public function resolveDesiredCapabilities(AbstractTestCase $test, DesiredCapabilities $capabilities)
    {
        // Capability defined for all test runs
        $capabilities->setCapability('pageLoadStrategy', 'normal');

        // Capability only for specific browser
        if ($this->config->browserName === WebDriverBrowserType::IE) {
            $capabilities->setCapability('ms:someEdgeCapability', 'true');
        }

        // When on CI, run Chrome in headless mode
        if ((new CiDetector())->isCiDetected() && $this->config->browserName === WebDriverBrowserType::CHROME) {
            $chromeOptions = new ChromeOptions();
            // In headless Chrome 60, window size cannot be changed run-time:
            // https://bugs.chromium.org/p/chromium/issues/detail?id=604324#c46
            // --no-sandbox is workaround for Chrome crashing: https://github.com/SeleniumHQ/selenium/issues/4961
            $chromeOptions->addArguments(['--headless', 'window-size=1024,768', '--no-sandbox']);
            $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);
        }

        return $capabilities;
    }


    public function resolveRequiredCapabilities(AbstractTestCase $test, DesiredCapabilities $capabilities)
    {
        return $capabilities;
    }
}
