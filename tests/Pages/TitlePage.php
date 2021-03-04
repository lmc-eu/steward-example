<?php declare(strict_types=1);

namespace My\Pages;

use Facebook\WebDriver\WebDriverElement;
use Lmc\Steward\Component\AbstractComponent;

/**
 * Title page representation using Page Object pattern
 *
 * @see http://martinfowler.com/bliki/PageObject.html
 */
class TitlePage extends AbstractComponent
{
    public const RECENT_NEWS_SELECTOR = '#w3c_most-recently > .event';
    public const MOBILE_VIEW_LINK_SELECTOR = '.secondary_nav a.mobile';
    public const LEFT_COLUMN_CLASS = 'w3c_leftCol';
    public const SEARCH_INPUT_SELECTOR = '#search-form input[name=q]';

    /**
     * Get listed recent news
     *
     * @return WebDriverElement[]
     */
    public function getRecentNews(): array
    {
        $this->debug('Getting recent news');
        $recentNews = $this->findMultipleByCss(self::RECENT_NEWS_SELECTOR);

        return $recentNews;
    }

    public function isLeftSidebarVisible(): bool
    {
        $this->debug('Checking visibility of left column');

        return $this->findByClass(self::LEFT_COLUMN_CLASS)->isDisplayed();
    }

    /**
     * Fill and submit google custom search form and wait until results page is loaded
     */
    public function fillAndSubmitSearch(string $query)
    {
        $queryInput = $this->waitForCss(self::SEARCH_INPUT_SELECTOR);
        $queryInput->sendKeys($query)
            ->submit();

        // Wait until search is loaded (the query appears in the page title)
        $this->waitForPartialTitle($query);
    }
}
