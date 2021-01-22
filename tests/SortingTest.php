<?php

namespace Meiko\Filterable\Tests;

use Meiko\Filterable\Tests\Models\User;
use Meiko\Filterable\Filterer;
use Laracasts\TestDummy\Factory;

class SortingTest extends TestCase
{
    public function testSortByNameAscending()
    {
        Factory::create(User::class, [
            'name' => 'John Doe',
        ]);
        Factory::create(User::class, [
            'name' => 'Jane Doe',
        ]);

        $this->get('/users?sort=+name');

        $users = User::filters()->get();

        $this->assertEquals('Jane Doe', $users->first()->name);
    }

    public function testSortByNameDescending()
    {
        Factory::create(User::class, [
            'name' => 'John Doe',
        ]);
        Factory::create(User::class, [
            'name' => 'Jane Doe',
        ]);

        $this->get('/users?sort=-name');

        $users = User::filters()->get();

        $this->assertEquals('John Doe', $users->first()->name);
    }

    public function testSortByCustomAscending()
    {
        Factory::create(User::class, [
            'name' => 'Mike Doe',
        ]);
        Factory::create(User::class, [
            'name' => 'John Doe',
        ]);
        Factory::create(User::class, [
            'name' => 'Jane Doe',
        ]);

        $this->get('/users?sort=-name');

        $users = User::filters(function ($filterer) {
            $filterer->addSortColumn('name', function ($query, $direction) {
                return $query->orderByRaw("CASE name WHEN 'John Doe' THEN 1 ELSE 0 END " . $direction);
            });
        })->get();

        $this->assertEquals('John Doe', $users->first()->name);
    }
}
