<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'manager' => [
            'users' => 'c,r,u',
            'profile' => 'r,u'
        ],
        'employee' => [
            'profile' => 'r,u'
        ],
        'client' => [
            'profile' => 'r,u'
        ],
        'user' => [
            'profile' => 'r'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
