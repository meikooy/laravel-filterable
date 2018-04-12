<?php

namespace Meiko\Filterable\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('filterable.namespace', 'Meiko\Filterable\Tests\Models');
    }
}
