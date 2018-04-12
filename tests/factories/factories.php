<?php

$factory('Meiko\Filterable\Tests\Models\User', [
    'name' => $faker->name,
    'email' => $faker->email,
]);

$factory('Meiko\Filterable\Tests\Models\Project', [
    'title' => $faker->company,
    'user_id' => 'factory:Meiko\Filterable\Tests\Models\User',
]);
