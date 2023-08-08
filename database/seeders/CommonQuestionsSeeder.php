<?php

namespace Database\Seeders;

use App\Models\Questions\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class CommonQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'ar'                    => [
                'question'          => 'سؤال 1',
                'answer'            => 'سؤال 1',
                'locale'            => 'ar',
                'question_id'       => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'question'          => 'Question 1',
                'answer'            => 'Question 1',
                'locale'            => 'en',
                'question_id'       => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
        Question::create([
            'ar'                        => [
                'question'          => 'سؤال 2',
                'answer'            => 'سؤال 2',
                'locale'            => 'ar',
                'question_id'       => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'en'                        => [
                'question'          => 'Question 2',
                'answer'            => 'Question 2',
                'locale'            => 'en',
                'question_id'       => 2,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            'is_active'             => 1,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);
    }
}
