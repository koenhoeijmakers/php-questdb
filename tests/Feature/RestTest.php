<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Tests\Feature;

use Exception;
use KoenHoeijmakers\QuestDB\Exceptions\ExecutionFailure;
use KoenHoeijmakers\QuestDB\Query;
use KoenHoeijmakers\QuestDB\Tests\TestCase;

final class RestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $query = Query::make("CREATE TABLE measurements(loggedAt timestamp, energyUsage int) timestamp(loggedAt);");

        $this->connection->exec($query);
    }

    public function testInsertion()
    {
        $query = Query::make("INSERT INTO measurements(loggedAt,energyUsage) values(systimestamp(),45);");

        $this->connection->exec($query);

        $query = Query::make("SELECT loggedAt, energyUsage FROM measurements");

        $result = $this->connection->exec($query);

        $this->assertSame(45, $result->dataset[0][1]);
        $this->assertSame(1, $result->count);
    }

    public function testImport()
    {
        $this->markTestSkipped('Imp seems broken, max cpu usage somehow.');

        try {
            $this->connection->imp(__DIR__ . '/../fixtures/measurements.csv');
        } catch (ExecutionFailure $exception) {
            var_dump($exception->getQuery(), $exception->getError());
        }

        $query = Query::make("SELECT loggedAt, energyUsage FROM measurements");

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
