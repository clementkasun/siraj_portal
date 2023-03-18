<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolls = [
            ['id' => 1, 'name' => 'level_one'],
            ['id' => 2, 'name' => 'level_two'],
            ['id' => 3, 'name' => 'level_three'],
        ];
        \DB::table('levels')->insert($rolls);
    }
}
