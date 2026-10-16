<?php

/*
 * Punto de entrada de la demo en Vercel.
 *
 * Vercel no tiene un sistema de archivos persistente: la base de datos SQLite
 * se crea en /tmp y se rellena con los datos de demo en cada arranque en frío.
 * Los cambios que se hagan en la demo se pierden cuando la función se reinicia.
 */

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$database = getenv('DB_DATABASE') ?: '/tmp/database.sqlite';

if (! file_exists($database)) {
    $lock = fopen(sys_get_temp_dir().'/database.lock', 'c');
    flock($lock, LOCK_EX);

    // Otra petición puede haber creado la base de datos mientras esperábamos el bloqueo.
    if (! file_exists($database)) {
        $building = $database.'.building';
        @unlink($building);
        touch($building);

        $migrator = require __DIR__.'/../bootstrap/app.php';
        $console = $migrator->make(Kernel::class);
        $console->bootstrap();
        $migrator['config']->set('database.connections.sqlite.database', $building);
        $console->call('migrate', ['--force' => true, '--seed' => true]);

        rename($building, $database);
    }

    flock($lock, LOCK_UN);
    fclose($lock);
}

$app = require __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
