<?php

namespace Tests\Infrastructure\UI\Laravel;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Config;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require '/app/src/Infrastructure/UI/Laravel/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Config::set('database.connections.mysql', [
            'driver' => 'pdo_sqlite',
            'path' => env('SQLITE_PATH'),
        ]);

        return $app;
    }
}