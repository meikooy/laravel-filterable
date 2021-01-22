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
     * Possible sort callback
     *
     * @var callable
     */
    protected $callback;

    /**
     * Create new sortable column instance
     *
     * @param string $key
     * @param integer $direction
     * @param callable|null $callback
     */
    public function __construct(string $key, int $direction, callable $callback = null)
    {
        $this->key = $key;
        $this->direction = $direction;
        $this->callback = $callback;
    }

    /**
     * Apply sort to query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query)
    {
        $direction = ($this->direction > 0) ? 'asc' : 'desc';

        if ($this->callback) {
            return ($this->callback)($query, $direction);
        }

        return $query->orderBy($this->key, $direction);
    }
}
