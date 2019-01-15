<?php

use Illuminate\Database\Seeder;

class UsersQuestionAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->delete();
        // \DB::table('answers')->delete();
        // \DB::table('questions')->delete();

        factory(App\User::class, 5)
            ->create()
            ->each(function($user) {
                $user->questions()->saveMany(factory(App\Question::class, rand(1,20))->make())
            ->each(function ($question) {
                $question->answers()->saveMany(factory(App\Answer::class, rand(1,20))->make());
            });
        });
    }
}
