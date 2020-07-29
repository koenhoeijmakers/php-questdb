<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Tests\Feature;

use Exception;
use KoenHoeijmakers\QuestDB\DTO\Query;
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
CREATE TABLE measurements(loggedAt timestamp, energyUsage int, randomFloat double, totalAmount double) timestamp(loggedAt);
QUERY;

        $query = (new Query($query));

        $this->connection->exec($query);

        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        try {
            $this->connection->exec(new Query("DROP TABLE measurements;"));
        } catch (Exception $exception) {
            //
        }
    }
}
