<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightEntry;
use App\Models\User;
use Carbon\Carbon;

class WeightEntriesTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            WeightEntry::create([
                'user_id' => $user->id,
                'date' => Carbon::now()->subDays(rand(1, 30)), // Random date within the last 30 days
                'weight' => rand(1300, 1500) / 100, // Random weight between 13.00 and 15.00
            ]);
        }
    }
}
