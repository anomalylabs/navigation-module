<?php

return [
    'name' => [
        'name' => 'Vardas',
        'instructions' => [
            'menus' => 'Užvadinkit meniu trumpai ir aiškiai',
        ],
    ],
    'slug' => [
        'name' => 'Slug',
        'instructions' => 'Slug naudojamas atvaizduojant meniu.',
    ],
    'description' => [
        'name' => 'Aprašymas',
        'instructions' => 'Aprašykite navigacijos meniu plačiau.',
    ],
    'target' => [
        'name' => 'Target',
        'instructions' => 'Kaip šis linkas turėtų atsidaryti?',
        'option' => [
            'self' => 'Atidaryti dabartiniame lange.',
            'blank' => 'Atidaryti naujame lange.',
        ],
    ],
    'class' => [
        'name' => 'Class',
        'instructions' => 'Nurodykite papildomas class, kurias nurodė programuotojas',
    ],
    'allowed_roles' => [
        'name' => 'Leidžiamos rolės',
        'instructions' => 'Nurodykite kurie vartotojai gali matyti šį linką.',
        'warning' => 'Jei vartotojų rolės nenurodytos, tai tuomet šį linką matyts visi.',
    ],
];
