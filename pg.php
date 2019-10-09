<?php
require __DIR__ . '/vendor/autoload.php';
use App\Test\Connection;
use App\Test\PostgreSQLCreateTable;


try {

    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();

    //
    $tableCreator = new PostgreSQLCreateTable($pdo);

    // create tables and query the table from the
    // database
    $tables = $tableCreator->createTables()
        ->getTables();

    foreach ($tables as $table) {
        echo $table . '<br>';
    }

} catch (\PDOException $e) {
    echo $e->getMessage();
}