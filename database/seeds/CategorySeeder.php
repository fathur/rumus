<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $categories = [
        'Matematika',
        'Fisika',
        'Kimia',
        'Astronomi',
        'Teknologi Informasi'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            \App\Models\Taxonomy::create([
                'title' => $category,
                'type' => 'category'
            ]);
        }
    }
}
