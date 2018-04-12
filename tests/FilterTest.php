<?php

namespace Meiko\Filterable\Tests;

use Meiko\Filterable\Tests\Models\User;
use Laracasts\TestDummy\Factory;

class FilterTest extends TestCase
{
    public function testFilterByName()
    {
        $users = Factory::times(20)->create(User::class);
        $randomUser = $users->random();

        $this->get('/users?name='.$randomUser->name);

        $users = User::filters()->get();

        $this->assertEquals($randomUser->name, $users->first()->name);
    }
}
