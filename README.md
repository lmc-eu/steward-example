[![Build Status](https://travis-ci.org/OndraM/steward-example.svg)](https://travis-ci.org/OndraM/steward-example)

# [Steward](https://github.com/lmc-eu/steward) example project

This is an example project showing usage and extensibility of [Steward](https://github.com/lmc-eu/steward).
It is also run periodically on Travis CI as an integration test of both Steward's master branch and latest tagged version.

## What is shown in this example project
- Custom [`MyAbstractTestCase`](https://github.com/OndraM/steward-example/blob/master/selenium-tests/tests/MyAbstractTestCase.php) class as a common ancestor of all tests defining eg. default browser size
- [Overloading](https://github.com/OndraM/steward-example/blob/master/selenium-tests/tests/MobileTitlePageTest.php#L13-L16) of the default browser size in one test (which tests responsive mobile version of a site)
- Component [`TitlePage`](https://github.com/OndraM/steward-example/blob/master/selenium-tests/tests/Pages/TitlePage.php) (extending `AbstractComponent`) as an implementation of [page object pattern](http://martinfowler.com/bliki/PageObject.html)
- Usage of Steward's syntax sugar methods (`findByCss()`, `waitForCss()` etc.)
- `Log()`, `warn()` and `debug()` methods
- [How](https://github.com/OndraM/steward-example/blob/master/.travis.yml) to run tests Travis CI
- Applying conditions based on current configuration (eg. environment name) [retrieved from ConfigProvider](https://github.com/OndraM/steward-example/blob/master/selenium-tests/tests/MyAbstractTestCase.php#L24-L26)

## What is missing so far
- Delays and dependencies between test-cases
- Test with file upload and `getFixturePath()` usage
- `Legacy` component usage
- Custom EventDispatcher which adds some custom option to the Steward run-tests command
- Custom publisher that reports the results somewhere
- `@noBrowser` annotation usage for tests that don't need the browser window
- Specifying custom browser capabilities
