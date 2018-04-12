<?php

namespace Meiko\Filterable;

use Illuminate\Database\Eloquent\Builder;

/**
 * Filterable trait class
 */
trait Filterable
{
    /**
     * Apply filterer to query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param callable|null $callback
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilters(Builder $query, callable $callback = null)
    {
        $filterer = new Filterer;
        $filterer->setBaseClassname(get_class($this));

        if ($callback) {
            $callback($filterer);
        }

        if ($this->searchable) {
            $filterer->setSearchableColumns($this->searchable);
        }

        $filterer->parseRequest();

        foreach ($filterer->getGroups() as $group) {
            $query = $group->apply($query);
        }

        if ($filterer->getSortables()) {
            $filterer->setSortableColumns($this->sortable ?? $this->fillable);
        }

        foreach ($filterer->getSortables() as $sortable) {
            $query = $sortable->apply($query);
        }

        return $query;
    }
}
