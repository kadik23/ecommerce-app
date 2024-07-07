<?php

return [
    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        // other roles...
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ],
    'create_users' => true,
    'truncate_tables' => true,
];
