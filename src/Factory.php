<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB;

use GuzzleHttp\Client;

final class Factory
{
    public static function connection(string $uri = 'http://localhost:9000'): Connection
    {
        return new Connection(
            new Client([
                'base_uri' => $uri,
            ])
        );
    }
}
