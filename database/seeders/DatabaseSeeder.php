<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $user->companies()->saveMany(
                    \App\Models\Company::factory()->count(5)->make([
                        'owner_id' => $user->id,
                    ])
                )->each(function ($company) use ($user) {
                    $company->jobPostings()->saveMany(
                        \App\Models\JobPosting::factory()->count(5)->make([
                            'company_id' => $company->id,
                        ])
                    )->each(function ($jobPosting) {
                        $jobPosting->jobApplications()->saveMany(
                            \App\Models\JobApplication::factory()->count(10)->make([
                                'job_posting_id' => $jobPosting->id,
                                'user_id' =>User::factory()->create()->id,
                            ])
                        );
                    });
                });
            });
    }
}
