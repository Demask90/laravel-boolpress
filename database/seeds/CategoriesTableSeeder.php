<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML','CSS', 'JS', 'PHP', 'LARAVEL', 'Vue Cli'];

        for ($i = 0; $i < count($categories); $i++) {

            $new_category = new Category();
            // nella colonna $new_category->name mi salvo tutte le stringhe dell'array $categories
            $new_category->name = $categories[$i];
             // nella colonna $new_category->slug richiamo la classe Str, prendo $categories[$i] e lo inserisco nel metodo slug, definendo il delimitatore che voglio utilizzare
            $new_category->slug = Str::slug($categories[$i], '-');
            // mi salvo il record
            $new_category->save();
        }
    }
}
