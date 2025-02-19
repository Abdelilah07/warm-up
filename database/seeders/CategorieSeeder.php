<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nom' => 'Technology',
                'description' => 'Everything related to tech and innovation',
            ],
            [
                'nom' => 'Art',
                'description' => 'Visual arts, music, and creative content',
            ],
            [
                'nom' => 'Sports',
                'description' => 'Sports news and athletic content',
            ],
            [
                'nom' => 'Business',
                'description' => 'Business and financial topics',
            ]
        ];

        foreach ($categories as $category) {
            Categorie::create($category);
        }
    }
}
