<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserSurvey;
use Illuminate\Support\Str;

class UserSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSurvey::create([
            'user_id' => '1',
            'occupation' => Str::random(10),
            'employer' => Str::random(10),
            'preferred_strategy' => Str::random(10),
        ]);
    }
}
