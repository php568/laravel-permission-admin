<?php

use Illuminate\Database\Seeder;

class IconTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Icon::truncate();
        $iconsFileName = '\public\icons.json';
        $iconsFileName = str_replace('\\', DIRECTORY_SEPARATOR,  $iconsFileName);
        $file = file_get_contents(storage_path('app').$iconsFileName);
        //$file = file_get_contents(storage_path('app').'\public\icons.json');
        $icons = json_decode($file,true);
        foreach ($icons as $icon){
            \App\Models\Icon::create($icon);
        }
    }
}
