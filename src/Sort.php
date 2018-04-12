<?php

namespace Meiko\Filterable;

use Illuminate\Database\Eloquent\Builder;

/**
 * Sortable column
 */
class Sort
{
    /**
     * Column key
     *
     * @var string
     */
    protected $key;

    /**
     * Sort direction
     *
     * @var integer
     */
    protected $direction;

    /**
     * Create new sortable column instance
     *
     * @param string $key
     * @param integer $direction
     */
    public function __construct(string $key, int $direction)
    {
        $this->key = $key;
        $this->direction = $direction;
    }

    /**
     * Apply sort to query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query)
    {
        return $query->orderBy($this->key, (($this->direction > 0) ? 'asc' : 'desc'));
    }
}
