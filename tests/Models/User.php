<?php

namespace Meiko\Filterable\Tests\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Meiko\Filterable\Filterable;

class User extends EloquentModel
{
    use Filterable;

    protected $fillable = [
        'name',
        'email',
    ];
}
