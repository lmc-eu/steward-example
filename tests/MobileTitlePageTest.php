<?php declare(strict_types=1);

namespace My;

use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Facebook\WebDriver\WebDriverDimension;
use Lmc\Steward\ConfigProvider;
use My\Pages\TitlePage;

/**
 * Example and simple tests of w3.org title page in mobile mode.
 *
 * @group responsive
 */
class MobileTitlePageTest extends AbstractTestCase
{
    /** @var int Width of browser window */
    public const BROWSER_WIDTH = 320;
    /** @var int Height of browser window */
    public const BROWSER_HEIGHT = 480;

    /** @var TitlePage The title-page Page Object */
    protected $titlePage;

    /**
     * @before
     */
    public function init()
    {
        $this->titlePage = new TitlePage($this);
        $this->wd->get(self::$baseUrl);
    }

    public function testShouldNotDisplayLeftSidebarInMobileView()
    {
        if (ConfigProvider::getInstance()->browserName === WebDriverBrowserType::MICROSOFT_EDGE) {
            // https://bugs.chromium.org/p/chromium/issues/detail?id=604324#c46
            $this->markTestSkipped('Window cannot be resized to <516px in MS Edge on Sauce Labs');
        }

        /** @var WebDriverDimension $size */
        $size = $this->wd->manage()->window()->getSize();
        $this->log('Current screen size is %dx%d px', $size->getWidth(), $size->getHeight());

        $this->assertFalse($this->titlePage->isLeftSidebarVisible());
    }

    public function testShouldContainSearchFormLeadingToDuckDuckGo()
    {
        $this->titlePage->fillAndSubmitSearch('responsive images');

        // The search form should lead us to DuckDuckGo search
        $this->assertStringContainsString('duckduckgo.com', $this->wd->getCurrentURL());
        $this->assertStringContainsString('site:w3.org', $this->wd->getTitle());
    }
}
