<?php

namespace Meiko\Filterable\Groups;

use Illuminate\Database\Eloquent\Builder;

/**
 * AND Group
 */
class AndGroup extends Group
{
    /**
     * Apply fields to query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query)
    {
        foreach ($this->fields as $field) {
            $query = $field->apply($query);
        }

        return $query;
    }
}
