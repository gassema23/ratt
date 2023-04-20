<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => [
                    'en' => 'Access / IP / Optical Planning',
                    'fr' => 'Accès / IP / Planification Optique'
                ],
            ],
            [
                'name' => [
                    'en' => 'Engineering Outside plan',
                    'fr' => 'Ingénierie du réseau extérieur'
                ],
            ],
            [
                'name' => [
                    'en' => 'Engineering Inside Plan',
                    'fr' => 'Ingénierie du réseau intérieur'
                ],
            ],
            [
                'name' => [
                    'en' => 'Project manager',
                    'fr' => 'Gestionnaire de projet'
                ],
            ],
            [
                'name' => [
                    'en' => 'Planner',
                    'fr' => 'Plannificateur'
                ],
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
