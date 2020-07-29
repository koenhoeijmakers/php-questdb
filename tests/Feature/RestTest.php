<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Tests\Feature;

use Exception;
use KoenHoeijmakers\QuestDB\Query;
use KoenHoeijmakers\QuestDB\Tests\TestCase;

final class RestTest extends TestCase
{
    public function test()
    {
        $query = Query::make("CREATE TABLE measurements(loggedAt timestamp, energyUsage int) timestamp(loggedAt);");

        $this->connection->exec($query);

        $query = Query::make("INSERT INTO measurements(loggedAt,energyUsage) values(systimestamp(),45);");

        $this->connection->exec($query);

        $query = Query::make("SELECT loggedAt, energyUsage FROM measurements")
            ->limit('1')
            ->withoutMeta()
            ->withCount();

        $result = $this->connection->exec($query);

        $this->assertSame(45, $result->dataset[0][1]);
        $this->assertSame(1, $result->count);
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
