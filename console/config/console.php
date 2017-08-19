<?php
return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'command-bus' => [
            'class' => 'trntv\bus\console\BackgroundBusController',
        ],
        'message' => [
            'class' => 'console\controllers\ExtendedMessageController'
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@common/migrations/db',
            'migrationTable' => '{{%system_db_migration}}'
        ],
        'rbac-migrate' => [
            'class' => 'console\controllers\RbacMigrateController',
            'migrationPath' => '@common/migrations/rbac/',
            'migrationTable' => '{{%system_rbac_migration}}',
            'templateFile' => '@common/rbac/views/migration.php'
        ],
    ],
    'bootstrap' => ['log', 'podium'],
    'modules' => [
        'podium' => 'bizley\podium\Podium',
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=host_address;dbname=database_name',
            'username' => 'username',
            'password' => 'password',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [ // TODO Set smtp configuration
                'class' => 'Swift_SmtpTransport',
                'host' => 'SMTP host',
                'username' => 'SMTP username',
                'password' => 'SMTP password',
                'port' => 'SMTP port', // optional
                'encryption' => 'SMTP encryption', // optional
            ],
        ],
    ],
];
