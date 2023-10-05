<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker  $faker)
    {
        $user=User::first();
        for ($i = 0; $i < 15; $i++) {
            $newTask = new Task();
            $newTask->user_id=$user->id;
            $newTask->title = $faker->word();
            $newTask->description = $faker->sentence();
            $newTask->date = $faker->dateTimeInInterval('now', '+1 week');
            $newTask->completed = $faker->numberBetween(0,1);
            $newTask->save();
        }
    }
}
