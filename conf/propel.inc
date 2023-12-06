<?php
# For a complete references see: http://propelorm.org/documentation/reference/configuration-file.html

$db = parse_url(getenv('DATABASE_URL'));

// perhaps path should be trimmed by one symbol '/' from the left
$dsn = 'pgsql:host=' . $db['host'] . ';port=' . $db['port'] . ';dbname=' . ltrim($db['path'], "/");

return [
    'propel'  => [
        # Main information about the project
        'general' => [
            'project' => 'Kvartirkin',
            'version' => '2.0.0-alpha8'
        ],
        # Database info (should be reviewed as .env configuration)
        'database' => [
            'connections' => [
                'default' => [
                    'adapter'   => 'pgsql',
                    'dsn'       => $dsn,
                    'user'      => $db['user'],
                    'password'  => $db['pass'],
                    'settings'  => [ 'charset' => 'utf8' ]
                ]
            ]
        ],
        # Useful directory mappings
        'paths' => [
            # Directory where the project files (`schema.xml`, etc.) are located. Default value is current path
            'projectDir'    => '.',
            # Directory in which your composer.json resides
            'composerDir'   => '.',
            # The directory where Propel should output the compiled runtime configuration.
            'phpConfDir'    => './src',
            # The directory where Propel should output generated object model classes.
            'phpDir'        => './src',
            # The directory where Propel should output classes, sql, config, etc. Default value is current path
            'outputDir'     => './conf/propel',
            # The directory where Propel expects to find your `schema.xml` file.
            'schemaDir'     => './conf/propel/schemas',
            # The directory where Propel should output the generated migrations.
            'migrationDir'  => './conf/propel/migrations',
            # The directory where Propel should output the generated DDL (or data insert statements, etc.)
            'sqlDir'        => './conf/propel/sql'
        ]
    ]
];
