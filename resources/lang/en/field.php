<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => 'Enter an easily identifiable name.'
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'The slug will be used when accessing navigation groups with the plugin.'
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => 'Briefly describe the entry and how it might be used.'
    ],
    'target'        => [
        'name'         => 'Target',
        'instructions' => 'How does this link open when clicked?',
        'option'       => [
            'self'  => 'Load in the current window.',
            'blank' => 'Load in a new window.'
        ]
    ],
    'class'         => [
        'name'         => 'Class',
        'instructions' => 'Add any additional classes (separated by spaces).'
    ],
    'allowed_roles' => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Which user roles are allowed to view this link?'
    ]
];
