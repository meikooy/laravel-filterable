<?php

namespace Meiko\Filterable\Tests;

use Meiko\Filterable\Tests\Models\User;
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
}
