<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

final class ExecutionFailure extends Exception
{
    private string $query;

    private string $error;

    private int $position;

    public static function make(string $query, string $error, int $position): ExecutionFailure
    {
        return (new ExecutionFailure())->setQuery($query)->setError($error)->setPosition($position);
    }

    public static function fromResponse(ResponseInterface $response): ExecutionFailure
    {
        $json = json_decode($response->getBody()->getContents());

        return self::make($json->query, $json->error, $json->position);
    }

    private function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    private function setQuery(string $query): ExecutionFailure
    {
        $this->query = $query;

        return $this;
    }

    private function setError(string $error): ExecutionFailure
    {
        $this->error = $error;

        return $this;
    }

    private function setPosition(int $position): ExecutionFailure
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
