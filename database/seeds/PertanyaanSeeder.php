<?php

use App\Pertanyaan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0;$i < 77; $i++) {
            $pertanyaan = Pertanyaan::create([
                'judul' =>  $faker->realText(10),
                'isi' => $faker->paragraph(3, true),
                'user_id' => 1
            ]);
            $tag_id = $faker->randomElements([1,2,3,6,5], 3);
            $pertanyaan->tag()->sync($tag_id);
        }
    }
}
