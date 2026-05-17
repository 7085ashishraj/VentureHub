<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Skill;
use App\Models\VentureStage;
use Carbon\Carbon;

class ProfessionalDemoSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Skills (for the Skill / Need Matrix) ────────────────────────
        $skillNames = [
            'Product Management',
            'React.js',
            'Python / Django',
            'UI/UX Design',
            'Go-to-Market Strategy',
            'Fundraising (Series A)',
            'Financial Modeling',
            'Machine Learning',
            'Business Development',
            'Operations & Scaling',
            'Digital Marketing',
            'Legal (Startup)',
        ];

        foreach ($skillNames as $name) {
            Skill::firstOrCreate(['name' => $name]);
        }

        $allSkillIds = Skill::pluck('id')->toArray();

        // ── 2. Venture Stages ───────────────────────────────────────────────
        $stages = [
            ['name' => 'Ideation',          'order_index' => 1],
            ['name' => 'MVP Development',   'order_index' => 2],
            ['name' => 'Beta Testing',      'order_index' => 3],
            ['name' => 'Seed Fundraising',  'order_index' => 4],
            ['name' => 'Scaling',           'order_index' => 5],
        ];

        foreach ($stages as $stage) {
            VentureStage::firstOrCreate(
                ['name' => $stage['name']],
                ['order_index' => $stage['order_index']]
            );
        }

        // ── 3. Demo Users ───────────────────────────────────────────────────
        // Only uses columns that actually exist in the `users` table:
        //   name, email, password, bio, email_verified_at
        $usersData = [
            [
                'name'  => 'Aarav Mehta',
                'email' => 'aarav@example.com',
                'bio'   => '2x founder. Building AI for Climate Tech. Passionate about sustainability and scalable solutions.',
            ],
            [
                'name'  => 'Priya Sharma',
                'email' => 'priya@example.com',
                'bio'   => 'Partner at Nexus Ventures. Investing in pre-seed to Series A startups in fintech and SaaS.',
            ],
            [
                'name'  => 'Rohan Gupta',
                'email' => 'rohan@example.com',
                'bio'   => 'Full-stack developer & UI architect with 10+ years experience. Open to exciting co-founder roles.',
            ],
            [
                'name'  => 'Ananya Iyer',
                'email' => 'ananya@example.com',
                'bio'   => 'Former teacher on a mission to personalise learning with AI. EdTech disruptor.',
            ],
            [
                'name'  => 'Vikram Singh',
                'email' => 'vikram@example.com',
                'bio'   => 'Growth marketer for startups. Helped 3 ventures go from 0 to 1M users. Let\'s scale yours.',
            ],
            [
                'name'  => 'Sneha Kapoor',
                'email' => 'sneha@example.com',
                'bio'   => 'Angel investor & startup advisor. Focused on women-led ventures and D2C brands.',
            ],
        ];

        $createdUsers = [];

        foreach ($usersData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make('password123'),
                    'bio'               => $data['bio'],
                    'email_verified_at' => Carbon::now(),
                ]
            );

            // Attach 3 random skills (what they offer)
            $skillSubset  = array_rand(array_flip($allSkillIds), min(3, count($allSkillIds)));
            $skillSubset  = is_array($skillSubset) ? $skillSubset : [$skillSubset];
            $skillPivot   = array_combine($skillSubset, array_fill(0, count($skillSubset), ['proficiency' => 'intermediate']));
            $user->skills()->syncWithoutDetaching($skillPivot);

            // Attach 2 random needs (what they're looking for)
            $needSubset = array_rand(array_flip(array_diff($allSkillIds, $skillSubset)), min(2, count($allSkillIds)));
            $needSubset = is_array($needSubset) ? $needSubset : [$needSubset];
            $needPivot  = array_combine($needSubset, array_fill(0, count($needSubset), ['description' => 'Looking for expertise in this area']));
            $user->needs()->syncWithoutDetaching($needPivot);

            $createdUsers[$data['email']] = $user;
        }

        // ── 4. Sample Projects & Venture Rooms ─────────────────────────────
        $betaStage = VentureStage::where('name', 'Beta Testing')->first();
        $ideaStage = VentureStage::where('name', 'Ideation')->first();
        $mvpStage  = VentureStage::where('name', 'MVP Development')->first();

        $aarav  = $createdUsers['aarav@example.com']  ?? null;
        $ananya = $createdUsers['ananya@example.com'] ?? null;
        $rohan  = $createdUsers['rohan@example.com']  ?? null;

        if ($aarav) {
            $projectId = DB::table('projects')->insertGetId([
                'user_id'           => $aarav->id,
                'title'             => 'EcoTrace AI',
                'description'       => 'An AI-powered carbon footprint tracking platform for SMEs. Currently in beta with 50+ businesses onboarded.',
                'required_skills'   => 'Machine Learning, Go-to-Market Strategy',
                'status'            => 'open',
                'venture_stage_id'  => $betaStage?->id,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);

            DB::table('venture_rooms')->insertOrIgnore([
                'name'              => 'EcoTrace Core Team',
                'description'       => 'Private workspace for the EcoTrace founding team.',
                'creator_id'        => $aarav->id,
                'project_id'        => $projectId,
                'venture_stage_id'  => $betaStage?->id,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }

        if ($ananya) {
            $projectId = DB::table('projects')->insertGetId([
                'user_id'           => $ananya->id,
                'title'             => 'Learnly',
                'description'       => 'Personalised AI tutor for K-12 students. Seeking a technical co-founder and seed funding.',
                'required_skills'   => 'React.js, UI/UX Design, Fundraising (Series A)',
                'status'            => 'open',
                'venture_stage_id'  => $ideaStage?->id,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);

            DB::table('venture_rooms')->insertOrIgnore([
                'name'              => 'Learnly Build Sprint',
                'description'       => 'Brainstorming and MVP planning room.',
                'creator_id'        => $ananya->id,
                'project_id'        => $projectId,
                'venture_stage_id'  => $ideaStage?->id,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }

        if ($rohan) {
            DB::table('projects')->insert([
                'user_id'           => $rohan->id,
                'title'             => 'DevMatch Platform',
                'description'       => 'A marketplace connecting skilled developers with early-stage startups for sweat-equity roles.',
                'required_skills'   => 'Business Development, Digital Marketing',
                'status'            => 'open',
                'venture_stage_id'  => $mvpStage?->id,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }

        $this->command->info('✅ ProfessionalDemoSeeder completed successfully.');
        $this->command->info('   → 12 skills, 5 venture stages, 6 users, 3 projects, 2 venture rooms seeded.');
        $this->command->info('   → Demo login: aarav@example.com / password123');
    }
}
