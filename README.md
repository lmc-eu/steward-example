# [Steward](https://github.com/lmc-eu/steward) example project
[![Build Status](https://img.shields.io/travis/lmc-eu/steward-example.svg?style=flat-square)](https://travis-ci.org/lmc-eu/steward-example)

This is an example project showing usage and extensibility of [Steward](https://github.com/lmc-eu/steward), a PHP tool for Selenium WebDriver functional testing.

As an example, the tests are run in Firefox, [headless Chrome](https://developers.google.com/web/updates/2017/04/headless-chrome) and PhantomJS browsers natively on Travis CI, but also in Microsoft Edge using
[Sauce Labs](https://saucelabs.com/) cloud service (see [Sauce Labs build status](https://saucelabs.com/u/php-webdriver) or [results of a single build](https://saucelabs.com/beta/builds/4f1103bede17401d8f5f9f626ce8da26)).

## What is shown in this example project
- Custom [`MyAbstractTestCase`](https://github.com/lmc-eu/steward-example/blob/master/tests/MyAbstractTestCase.php) class as a common ancestor of all tests defining eg. default browser size
- [Overloading](https://github.com/lmc-eu/steward-example/blob/master/tests/MobileTitlePageTest.php#L14-L17) of the default browser size in one test (which tests responsive mobile version of a site)
- Component [`TitlePage`](https://github.com/lmc-eu/steward-example/blob/master/tests/Pages/TitlePage.php) (extending `AbstractComponent`) as an implementation of [page object pattern](https://martinfowler.com/bliki/PageObject.html)
- Usage of Steward's syntax sugar methods (`findByCss()`, `waitForCss()` etc.)
- Defining [time delay and dependency](https://github.com/lmc-eu/steward-example/blob/master/tests/DelayedExampleTest.php#L17-L18) between tests
- [Storing](https://github.com/lmc-eu/steward-example/blob/master/tests/SeedDataTest.php##L52-L53) data in one test-case and [loading](https://github.com/lmc-eu/steward-example/blob/master/tests/DelayedExampleTest.php#L30-L32) them in other using the `Legacy` component
- `Log()`, `warn()` and `debug()` methods
- The [`@noBrowser`](https://github.com/lmc-eu/steward-example/blob/master/tests/SeedDataTest.php#L21) annotation used when you don't need the browser interaction at all
- [How](https://github.com/lmc-eu/steward-example/blob/master/.travis.yml) to run tests on Travis CI in both PhantomJS and Firefox browsers
- Specifying [custom capabilities](https://github.com/lmc-eu/steward-example/blob/master/.travis.yml) using `--capability` option
- [Custom capability resolver](https://github.com/lmc-eu/steward-example/blob/master/src/CustomCapabilitiesResolver.php) for more complex capability definitions
- Applying conditions based on current configuration (eg. environment name) [retrieved from ConfigProvider](https://github.com/lmc-eu/steward-example/blob/master/tests/MyAbstractTestCase.php#L25)

## What is missing so far
- See [open issues](https://github.com/lmc-eu/steward-example/labels/enhancement) for some other Steward features not yet shown in this example project.
