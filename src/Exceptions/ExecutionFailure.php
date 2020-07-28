<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\Exceptions;

use Exception;
use GuzzleHttp\Psr7\Response;

final class ExecutionFailure extends Exception
{
    public static function make(Response $response)
    {
    }
}
