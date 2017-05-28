<?php

namespace My\Pages;

use Facebook\WebDriver\WebDriverElement;
use Lmc\Steward\Component\AbstractComponent;

/**
 * Title page representation using Page Object pattern
 * @see http://martinfowler.com/bliki/PageObject.html
 */
class TitlePage extends AbstractComponent
{
    const RECENT_NEWS_SELECTOR = '#w3c_most-recently > .event';
    const MOBILE_VIEW_LINK_SELECTOR = '.secondary_nav a.mobile';
    const LEFT_COLUMN_CLASS = 'w3c_leftCol';
    const SEARCH_INPUT_SELECTOR = '#search-form input[name=q]';

    /**
     * Get listed recent news
     * @return WebDriverElement[]
     */
    public function getRecentNews()
    {
        $this->debug('Getting recent news');
        $recentNews = $this->findMultipleByCss(self::RECENT_NEWS_SELECTOR);

        return $recentNews;
    }

    /**
     * Click header link to set mobile view of the page
     */
    public function setMobileView()
    {
        $this->debug('Enabling mobile view');
        $this->findByCss(self::MOBILE_VIEW_LINK_SELECTOR)->click();
    }

    /**
     * @return bool
     */
    public function isLeftSidebarVisible()
    {
        $this->debug('Checking visibility of left column');

        return $this->findByClass(self::LEFT_COLUMN_CLASS)->isDisplayed();
    }

    /**
     * Fill and submit google custom search form and wait until results page is loaded
     * @param $query
     */
    public function fillAndSubmitSearch($query)
    {
        $queryInput = $this->waitForCss(self::SEARCH_INPUT_SELECTOR);
        $queryInput->sendKeys($query)
            ->submit();

        // Wait until search is loaded (the query appears in the page title)
        $this->waitForPartialTitle($query);
    }
}
