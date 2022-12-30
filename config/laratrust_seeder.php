<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super-administrateur' => [
            'utilisateur' => 'c,r,u',
            'classeur' => 'c,r,u,d',
            'document' => 'c,r,u,d',
            'etagere' => 'c,r,u,d',
            'local' => 'c,r,u,d',
            'niveau' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'config' => 'r,u',
            'log' => 'r',
            'profil' => 'r,u'
        ],
        'administrateur' => [
            'utilisateur' => 'c,r,u',
            'role' => 'c,r,u',
            'profile' => 'r,u'
        ],
    ],

    'permissions_map' => [
        'c' => 'créer',
        'r' => 'lire',
        'u' => 'modifier',
        'd' => 'supprimer'
    ]
];
