# [Steward](https://github.com/lmc-eu/steward) example project
[![GitHub Actions Build Status](https://img.shields.io/github/workflow/status/lmc-eu/steward-example/Tests%20and%20linting?style=flat-square&label=GitHub%20Actions%20build)](https://github.com/lmc-eu/steward-example/actions)

This is an example project showing usage and extensibility of [Steward](https://github.com/lmc-eu/steward), a PHP tool for Selenium WebDriver functional testing.

As an example, the tests are run in Firefox and Chrome browsers in Docker images running on GitHub Actions, but also in Microsoft Edge using
[Sauce Labs](https://saucelabs.com/) cloud service (see [Sauce Labs build status](https://saucelabs.com/u/OndraM).

## What is shown in this example project
- Custom [`AbstractTestCase`](https://github.com/lmc-eu/steward-example/blob/main/tests/AbstractTestCase.php) class as a common ancestor of all custom tests (defining eg. default browser size)
- [Overloading](https://github.com/lmc-eu/steward-example/blob/master/tests/MobileTitlePageTest.php#L17-L20) of the default browser size in one test (which tests responsive mobile version of a site)
- Component [`TitlePage`](https://github.com/lmc-eu/steward-example/blob/master/tests/Pages/TitlePage.php) (extending `AbstractComponent`) as an implementation of [page object pattern](https://martinfowler.com/bliki/PageObject.html)
- Usage of Steward's syntax sugar methods (`findByCss()`, `waitForCss()` etc.)
- Defining [time delay and dependency](https://github.com/lmc-eu/steward-example/blob/master/tests/DelayedExampleTest.php#L17-L18) between tests
- [Storing](https://github.com/lmc-eu/steward-example/blob/master/tests/SeedDataTest.php##L52-L53) data in one test-case and [loading](https://github.com/lmc-eu/steward-example/blob/master/tests/DelayedExampleTest.php#L30-L32) them in other using the `Legacy` component
- `Log()`, `warn()` and `debug()` methods
- The [`@noBrowser`](https://github.com/lmc-eu/steward-example/blob/master/tests/SeedDataTest.php#L21) annotation used when you don't need the browser interaction at all
- [How to run tests in headless mode](https://github.com/lmc-eu/steward-example/blob/main/src/CustomCapabilitiesResolver.php#L45-L60) (in both Firefox and Chrome)
- [Configuring GitHub Actions](https://github.com/lmc-eu/steward-example/blob/main/.github/workflows/tests.yaml#L24-L58) to run Selenium hub with Chrome and Firefox nodes.
- Specifying [custom capabilities](https://github.com/lmc-eu/steward-example/blob/main/.github/workflows/tests.yaml#L137) using `--capability` option
- [Custom capability resolver](https://github.com/lmc-eu/steward-example/blob/master/src/CustomCapabilitiesResolver.php) for more complex capability definitions
- Applying conditions based on current configuration (eg. environment name) [retrieved from ConfigProvider](https://github.com/lmc-eu/steward-example/blob/master/tests/AbstractTestCase.php#L25)

## What is missing so far
- See [open issues](https://github.com/lmc-eu/steward-example/labels/enhancement) for some other Steward features not yet shown in this example project.
