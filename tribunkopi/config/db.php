<?php

$port = 3306;
$host = "localhost:$port";
$username = 'root';
$password = '';
$dbname = 'tribun';

// $port = 3306;
// $host = "192.168.186.97:$port";
// $username = 'owner';
// $password = '123678';
// $dbname = 'tribun_coffe';

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=$host;dbname=$dbname",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
