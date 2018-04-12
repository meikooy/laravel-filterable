<?php

namespace Meiko\Filterable\Groups;

use Meiko\Filterable\Field;

/**
 * Abstract base group
 */
abstract class Group
{
    /**
     * Group fields
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Add new field to group
     *
     * @param \Meiko\Filterable\Field $field
     * @return void
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }
}
