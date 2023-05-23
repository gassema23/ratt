<?php

use Illuminate\Support\Str;

return [
    'App_programmeur_name' => 'Mathieu Gasse',
    'App_programmeur_email' => 'mathieu.gasse@telus.com',
    'App_phase' => 'Alpha',
    'App_password_temp' => Str::password(),
    'App_priority' => [
        'en' => [
            [
                'id' => 1,
                'name' => 'Critical',
                'color' => 'red'
            ],
            [
                'id' => 2,
                'name' => 'Major',
                'color' => 'amber'
            ],
            [
                'id' => 3,
                'name' => 'Moderate',
                'color' => 'sky'
            ],
            [
                'id' => 4,
                'name' => 'Low',
                'color' => 'teal'
            ],
            [
                'id' => 2,
                'name' => 'Major',
                'color' => 'yellow'
            ]
        ],
        'fr' => [
            [
                'id' => 1,
                'name' => 'Critique',
                'color' => 'red'
            ],
            [
                'id' => 2,
                'name' => 'Majeur',
                'color' => 'amber'
            ],
            [
                'id' => 3,
                'name' => 'Modéré',
                'color' => 'sky'
            ],
            [
                'id' => 4,
                'name' => 'Bas',
                'color' => 'teal'
            ],
            [
                'id' => 5,
                'name' => 'Majeur',
                'color' => 'yellow'
            ],
        ]
    ],
    'App_statuses' => [
        'en' => [
            [
                'id' => 1,
                'name' => 'Cancel',
                'color' => 'red'
            ],
            [
                'id' => 2,
                'name' => 'In progress',
                'color' => 'amber'
            ],
            [
                'id' => 3,
                'name' => 'To do',
                'color' => 'sky'
            ],
            [
                'id' => 4,
                'name' => 'Done',
                'color' => 'teal'
            ],
            [
                'id' => 5,
                'name' => 'Pending',
                'color' => 'violet'
            ],
        ],
        'fr' => [
            [
                'id' => 1,
                'name' => 'Annulé',
                'color' => 'red'
            ],
            [
                'id' => 2,
                'name' => 'En cours',
                'color' => 'yellow'
            ],
            [
                'id' => 3,
                'name' => 'À faire',
                'color' => 'sky'
            ],
            [
                'id' => 4,
                'name' => 'Terminé',
                'color' => 'teal'
            ],
            [
                'id' => 5,
                'name' => 'En att.',
                'color' => 'violet'
            ],
        ]
    ]
];
