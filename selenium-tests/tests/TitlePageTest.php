<?php

namespace My;

use My\Pages\TitlePage;

/**
 * Example and simple tests of w3.org title page.
 */
class TitlePageTest extends MyAbstractTestCase
{
    /** @var TitlePage The title-page Page Object */
    protected $titlePage;

    public function setUp()
    {
        parent::setUp();

        $this->titlePage = new TitlePage($this);
        $this->wd->get(self::$baseUrl);
    }

    public function testShouldContainMainElements()
    {
        // Check title contents
        $this->assertContains('World Wide Web Consortium', $this->wd->getTitle());
        // Check recent news are present
        $this->assertCount(6, $this->titlePage->getRecentNews());
        // Check left sidebar is visible
        $this->assertTrue($this->titlePage->isLeftSidebarVisible(), 'Left sidebar is not visible!');
    }

    public function testShouldNotDisplayLeftSidebarInMobileView()
    {
        $this->assertTrue($this->titlePage->isLeftSidebarVisible());
        $this->titlePage->setMobileView();
        $this->assertFalse($this->titlePage->isLeftSidebarVisible());
    }

    public function testShouldContainGoogleSearchLeadingToGoogleCom()
    {
        $this->titlePage->fillAndSubmitSearch('HTML 5');

        // The google custom search form should lead us to google search
        $this->assertContains('www.google', $this->wd->getCurrentURL());
        $this->assertContains('site:w3.org', $this->wd->getTitle());
    }
}
