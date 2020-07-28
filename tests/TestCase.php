<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Tests;

use KoenHoeijmakers\QuestDB\Connection;
use KoenHoeijmakers\QuestDB\Factory;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Connection $connection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = Factory::connection($_SERVER['QUEST_DB_URI']);
    }
}
