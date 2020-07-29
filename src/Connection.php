<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use KoenHoeijmakers\QuestDB\Exceptions\ExecutionFailure;
use stdClass;
use function json_decode;
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
        try {
            $this->client->post('/imp', [
                'body' => $command,
            ]);
        } catch (ClientException $exception) {
        }
    }

    public function exec(Query $query): stdClass
    {
        try {
            $response = $this->client->get('/exec', [
                'query' => [
                    'query' => $query->getQuery(),
                    'limit' => $query->getLimit(),
                    'count' => $query->getCount(),
                    'nm'    => $query->getNm(),
                ],
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            throw ExecutionFailure::fromResponse($exception->getResponse());
        }
    }

    public function exp(string $command)
    {
        $this->client->get('exp', [
            'query' => urlencode($command),
        ]);
    }
}
