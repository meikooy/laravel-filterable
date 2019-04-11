<?php

namespace Meiko\Filterable\Groups;

use Illuminate\Database\Eloquent\Builder;

/**
 * OR group
 */
class OrGroup extends Group
{
    /**
     * Apply fields to query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query)
    {
        $query->where(function ($query) {
            foreach ($this->fields as $field) {
                $query->orWhere(function ($query) use ($field) {
                    $query = $field->apply($query);
                });
            }
        });

        return $query;
    }
}
