<?php

namespace My;

use Lmc\Steward\Component\Legacy;
use Faker;

/**
 * This test is an example how to deal with situation when we need to do something before some other test could be run.
 * This could be ie. preparing and creating some test data through an API, triggering some message queue etc.
 *
 * As we use the @noBrowser annotation (it could be used on whole test-case class or on specific test method), the
 * WebDriver and browser won't be initialized, making the test faster. This is handy for the mentioned situation, when
 * we need just to send something using HTTP API and the browser interaction is not needed.
 *
 * We also use the Legacy component to store the data so they could be used in the dependent tests.
 *
 * And as some other test depends on this test, you could note that Steward will optimize order of the tests and run
 * this test first, in order to minimize waiting time of the dependent test.
 *
 * @noBrowser
 */
class SeedDataTest extends MyAbstractTestCase
{
    const SEED_DATA_LEGACY_NAME = 'seed-data';

    /** @var Legacy */
    private $legacy;

    /**
     * @before
     */
    public function init()
    {
        $this->legacy = new Legacy($this);
    }

    public function testSeedSomeData()
    {
        // Prepare some test data
        $faker = Faker\Factory::create();

        $data = [
            'name' => $faker->name,
            'address' => $faker->address,
            'date' => $faker->date(),
        ];

        // In real-world we could eg. now use the data to create some fixture objects on our site, that we will use in
        // out tests. But here we will obviously miss that.

        // Store the data, so they could be accessed by the dependent tests.
        $this->legacy->saveWithName($data, self::SEED_DATA_LEGACY_NAME);
    }
}
