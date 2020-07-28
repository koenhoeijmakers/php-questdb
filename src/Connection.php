<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB;

use GuzzleHttp\Client;
use function urlencode;

final class Connection
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function imp(string $command)
    {
        $this->client->post('/imp', [
            'body' => $command,
        ]);
    }

    public function exec(string $command)
    {
        $this->client->get('/exec', [
            'query' => $command,
        ]);
    }

    public function exp(string $command)
    {
        $this->client->get('exp', [
            'query' => urlencode($command),
        ]);
    }
}
