<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a few users to own the tasks (or reuse existing ones)
        $users = User::factory()->count(5)->create();

        // Create 35 tasks, randomly distributed across those users
        Task::factory()
            ->count(35)
            ->recycle($users)
            ->create();
    }
}
