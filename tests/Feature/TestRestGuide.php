<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Tests\Feature;

use KoenHoeijmakers\QuestDB\Tests\TestCase;

final class TestRestGuide extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test()
    {
        $tripsQuery = <<<QUERY
query=CREATE TABLE trips(pickupDatetime timestamp,
dropoffDatetime timestamp, passengerCount int, tripDistance double,
fareAmount double, tipAmount double, taxesAndTolls double, totalAmount double)
timestamp(pickupDatetime);
QUERY;

        $this->connection->exec($tripsQuery);

        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->connection->exec("query=DROP TABLE trips;");
    }
}
