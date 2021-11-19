<?php
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
 'driver'    => 'mysql',
 'host'      => getenv('PHP_DB_HOST') ?: 'mysql',
 'database'  => getenv('PHP_DB_DATABASE') ?: 'watchoDB',
 'username'  => getenv('PHP_DB_USERNAME') ?: 'ID338777_watcho',
 'password'  => getenv('PHP_DB_PASSWORD') ?: 'watcho123',
 'charset'   => 'utf8mb4',
 'collation' => 'utf8mb4_unicode_ci',
 'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
