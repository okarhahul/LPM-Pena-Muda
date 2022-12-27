<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Postingan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'LPM Pena Muda',
            'email' => 'penamudaofficially@gmail.com',
            'username' => 'lpm_penamuda',
            'password' => bcrypt('penamuda123')
        ]);

        Category::create([
            'name' => 'Sastra',
            'subcategories' => 'Cerpen',
            'slug' => 'sastra-cerpen',
        ]);

        Category::create([
            'name' => 'Sastra',
            'subcategories' => 'Puisi',
            'slug' => 'sastra-puisi',
        ]);

        Category::create([
            'name' => 'Sastra',
            'subcategories' => 'Quotes',
            'slug' => 'sastra-quotes',
        ]);

        Category::create([
            'name' => 'Jurnalistik',
            'subcategories' => 'Hardnews',
            'slug' => 'sastra-hardnews',
        ]);

        Category::create([
            'name' => 'Jurnalistik',
            'subcategories' => 'Softnews',
            'slug' => 'sastra-Softnews',
        ]);

        Category::create([
            'name' => 'Jurnalistik',
            'subcategories' => 'Opini',
            'slug' => 'sastra-opini',
        ]);

        Category::create([
            'name' => 'Fotografi',
            'subcategories' => 'Galeri',
            'slug' => 'sastra-galeri',
        ]);

        // Postingan::factory(10)->create();
    }
}
