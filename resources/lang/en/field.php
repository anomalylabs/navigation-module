<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => 'Enter an easily identifiable name.',
        'placeholder'  => 'Main Menu'
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'The slug will be used when accessing navigation groups with the plugin.',
        'placeholder'  => 'main-menu'
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => 'Briefly describe the entry and how it might be used.',
        'placeholder'  => 'This is the main menu in the navbar of the website.'
    ],
    'target'        => [
        'name'   => 'Target',
        'option' => [
            'self'  => 'Load in the current window.',
            'blank' => 'Load in a new window.'
        ]
    ],
    'class'         => [
        'name'         => 'Class',
        'instructions' => 'Specify additional style classes.',
        'placeholder'  => 'Enter any additional classes (separated by spaces).'
    ],
    'allowed_roles' => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Specify which user roles are allowed to view this link.'
    ]
];
