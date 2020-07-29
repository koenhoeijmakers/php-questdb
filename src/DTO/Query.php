<?php

declare(strict_types=1);

namespace KoenHoeijmakers\QuestDB\DTO;

final class Query
{
    private string $query;

    private ?string $limit = null;

    private bool $count = false;

    private ?bool $nm = false;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    public function withCount(): Query
    {
        $this->count = true;

        return $this;
    }

    public function withoutMeta(): Query
    {
        $this->nm = true;

        return $this;
    }

    public function limit(string $limit): Query
    {
        $this->limit = $limit;

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
     * @return string|null
     */
    public function getLimit(): ?string
    {
        return $this->limit;
    }

    /**
     * @return bool
     */
    public function getCount(): bool
    {
        return $this->count;
    }

    /**
     * @return bool|null
     */
    public function getNm(): ?bool
    {
        return $this->nm;
    }
}
