<?php declare(strict_types=1);

namespace My;

use My\Pages\TitlePage;

/**
 * Example and simple tests of w3.org title page.
 */
class TitlePageTest extends AbstractTestCase
{
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

    public function testShouldContainMainElements()
    {
        // Check title contents
        $this->assertContains('W3C', $this->wd->getTitle());
        // Check recent news are present (their total count varies over time, so we cannot just use assertCount here)
        $this->assertGreaterThanOrEqual(4, count($this->titlePage->getRecentNews()));
        // Check left sidebar is visible
        $this->assertTrue($this->titlePage->isLeftSidebarVisible(), 'Left sidebar is not visible!');
    }

    public function testShouldContainSearchFormLeadingToDuckDuckGo(): void
    {
        $this->titlePage->fillAndSubmitSearch('HTML 5');

        // The search form should lead us to DuckDuckGo search
        $this->assertContains('duckduckgo.com', $this->wd->getCurrentURL());
        $this->assertContains('site:w3.org', $this->wd->getTitle());
    }
}
