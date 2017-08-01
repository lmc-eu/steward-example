<?php

namespace My;

use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\WebDriverDimension;
use Lmc\Steward\ConfigProvider;
use My\Pages\TitlePage;

/**
 * Example and simple tests of w3.org title page in mobile mode.
 * @group responsive
 */
class MobileTitlePageTest extends MyAbstractTestCase
{
    /** @var int Width of browser window */
    public static $browserWidth = 320;
    /** @var int Height of browser window */
    public static $browserHeight = 480;

    /** @var TitlePage The title-page Page Object */
    protected $titlePage;

    /**
     * @before
     */
    public function init()
    {
        if (ConfigProvider::getInstance()->browserName == WebDriverBrowserType::CHROME) {
            // https://bugs.chromium.org/p/chromium/issues/detail?id=604324#c46
            $this->markTestSkipped('Window size cannot be changed run-time in headless Chrome 60');
        }

        $this->titlePage = new TitlePage($this);
        $this->wd->get(self::$baseUrl);
    }

    public function testShouldNotDisplayLeftSidebarInMobileView()
    {
        /** @var WebDriverDimension $size */
        $size = $this->wd->manage()->window()->getSize();
        $this->log('Current screen size is %dx%d px', $size->getWidth(), $size->getHeight());

        $this->assertFalse($this->titlePage->isLeftSidebarVisible());
    }

    public function testShouldContainSearchFormLeadingToDuckDuckGo()
    {
        $this->titlePage->fillAndSubmitSearch('responsive images');

        // The search form should lead us to DuckDuckGo search
        $this->assertContains('duckduckgo.com', $this->wd->getCurrentURL());
        $this->assertContains('site:w3.org', $this->wd->getTitle());
    }
}
