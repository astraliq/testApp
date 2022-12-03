<?php
return [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=testapp',
    'username' => 'admin',
    'password' => 'admin',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];