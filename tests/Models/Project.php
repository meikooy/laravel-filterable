<?php

namespace Meiko\Filterable\Tests\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Meiko\Filterable\Filterable;

class Project extends EloquentModel
{
    use Filterable;

    protected $fillable = [
        'title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
