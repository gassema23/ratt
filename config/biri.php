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
                'color' => 'rose'
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
                'color' => 'rose'
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
                'color' => 'rose'
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
                'color' => 'orange'
            ],
            [
                'id' => 2,
                'name' => 'In progress',
                'color' => 'yellow'
            ],
        ],
        'fr' => [
            [
                'id' => 1,
                'name' => 'Annulé',
                'color' => 'rose'
            ],
            [
                'id' => 2,
                'name' => 'En cours',
                'color' => 'amber'
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
                'color' => 'orange'
            ],
            [
                'id' => 2,
                'name' => 'En cours',
                'color' => 'yellow'
            ],
        ]
    ],
    'App_desn_statuses' => [
        'en' => [
            [
                'id' => 0,
                'name' => 'Completed',
                'color' => 'teal'
            ],
            [
                'id' => 1,
                'name' => 'Canceled',
                'color' => 'rose'
            ],
            [
                'id' => 2,
                'name' => 'On hold',
                'color' => 'orange'
            ],
            [
                'id' => 3,
                'name' => 'Ready tech.',
                'color' => 'teal'
            ],
            [
                'id' => 4,
                'name' => 'Ambush',
                'color' => 'amber'
            ],
            [
                'id' => 5,
                'name' => 'In progress',
                'color' => 'yellow'
            ],
            [
                'id' => 6,
                'name' => 'Analysis',
                'color' => 'purple'
            ],
            [
                'id' => 7,
                'name' => 'Analysis in progress',
                'color' => 'indigo'
            ],
            [
                'id' => 8,
                'name' => 'Reject',
                'color' => 'pink'
            ],
            [
                'id' => 9,
                'name' => 'Go kick off',
                'color' => 'cyan'
            ],
            [
                'id' => 10,
                'name' => 'Unassigned',
                'color' => 'slate'
            ],
            [
                'id' => 11,
                'name' => 'Technician project',
                'color' => 'slate'
            ],
        ]
    ],
    'App_tech_statuses' => [
        'en' => [
            [
                'id' => 0,
                'name' => 'Completed',
                'color' => 'teal'
            ],
            [
                'id' => 1,
                'name' => 'Canceled',
                'color' => 'rose'
            ],
            [
                'id' => 2,
                'name' => 'On hold',
                'color' => 'orange'
            ],
            [
                'id' => 4,
                'name' => 'Ambush',
                'color' => 'amber'
            ],
            [
                'id' => 5,
                'name' => 'In progress',
                'color' => 'yellow'
            ],
            [
                'id' => 5,
                'name' => 'Approbation',
                'color' => 'purple'
            ],
        ]
    ]
];
