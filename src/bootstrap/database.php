<?php
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
 'driver'    => 'mysql',
 'host'      => getenv('PHP_DB_HOST') ?: 'mysql',
 'database'  => getenv('PHP_DB_DATABASE') ?: 'webpack-php-template',
 'username'  => getenv('PHP_DB_USERNAME') ?: 'root',
 'password'  => getenv('PHP_DB_PASSWORD') ?: 'devine4life',
 'charset'   => 'utf8mb4',
 'collation' => 'utf8mb4_unicode_ci',
 'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
