<?php
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
 'driver'    => 'mysql',
 'host'      => getenv('PHP_DB_HOST') ?: 'ID338777_watcho.db.webhosting.be',
 'database'  => getenv('PHP_DB_DATABASE') ?: 'ID338777_watcho',
 'username'  => getenv('PHP_DB_USERNAME') ?: 'ID338777_watcho',
 'password'  => getenv('PHP_DB_PASSWORD') ?: 'watcho123',
 'charset'   => 'utf8mb4',
 'collation' => 'utf8mb4_unicode_ci',
 'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
