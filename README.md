# [Steward](https://github.com/lmc-eu/steward) example project
[![Build Status](https://img.shields.io/travis/lmc-eu/steward-example.svg?style=flat-square)](https://travis-ci.org/lmc-eu/steward-example)

This is an example project showing usage and extensibility of [Steward](https://github.com/lmc-eu/steward), a PHP tool for Selenium WebDriver functional testing.

As an example, the tests are run in Firefox and PhantomJS browsers natively on Travis CI, but also in Microsoft Edge using
[Sauce Labs](https://saucelabs.com/) cloud service (see [Sauce Labs build status](https://saucelabs.com/beta/builds/b6c93f43e6e9477580f05c5afdfb27e4)).

## What is shown in this example project
- Custom [`MyAbstractTestCase`](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/MyAbstractTestCase.php) class as a common ancestor of all tests defining eg. default browser size
- [Overloading](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/MobileTitlePageTest.php#L13-L16) of the default browser size in one test (which tests responsive mobile version of a site)
- Component [`TitlePage`](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/Pages/TitlePage.php) (extending `AbstractComponent`) as an implementation of [page object pattern](http://martinfowler.com/bliki/PageObject.html)
- Usage of Steward's syntax sugar methods (`findByCss()`, `waitForCss()` etc.)
- Defining [time delay and dependency](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/DelayedExampleTest.php#L17-L18) between tests
- [Storing](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/SeedDataTest.php#L51) data in one test-case and [loading](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/DelayedExampleTest.php#L28-L29) them in other using the `Legacy` component
- `Log()`, `warn()` and `debug()` methods
- The [`@noBrowser`](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/SeedDataTest.php#L21) annotation used when you don't need the browser interaction at all
- [How](https://github.com/lmc-eu/steward-example/blob/master/.travis.yml) to run tests on Travis CI in both PhantomJS and Firefox browsers
- Specifying [custom capabilities](https://github.com/lmc-eu/steward-example/blob/master/.travis.yml) using `--capability` option
- Applying conditions based on current configuration (eg. environment name) [retrieved from ConfigProvider](https://github.com/lmc-eu/steward-example/blob/master/selenium-tests/tests/MyAbstractTestCase.php#L24-L26)

## What is missing so far
- Test with file upload and `getFixturePath()` usage
- Custom EventDispatcher which adds some custom option to the Steward run-tests command
- Custom publisher that reports the results somewhere
- Specifying custom browser capabilities on per-browser level
