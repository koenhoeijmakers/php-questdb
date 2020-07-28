<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Tests\Feature;

use Exception;
use KoenHoeijmakers\QuestDB\Tests\TestCase;

final class TestRestGuide extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test()
    {
        $query = <<<QUERY
query=CREATE TABLE measurements(loggedAt timestamp, energyUsage int, randomFloat double, totalAmount double) timestamp(loggedAt);
QUERY;

        $this->connection->exec($query);

        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        try {
            $this->connection->exec("query=DROP TABLE measurements;");
        } catch (Exception $exception) {
            //
        }
    }
}
