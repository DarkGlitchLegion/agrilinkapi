<?php

namespace Database\Seeders;

use App\Models\Knowledge\AssistanceProgram;
use App\Models\Knowledge\AssistanceProgramAttachment;
use App\Models\Knowledge\KnowledgeArticle;
use App\Models\Knowledge\KnowledgeCategory;
use App\Models\Products\Commodity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin.test@farmerlink.local')->firstOrFail();
        $cropCategory = KnowledgeCategory::updateOrCreate(
            ['slug' => 'crop-management'],
            ['name' => 'Crop management', 'description' => 'Fictional crop-care guidance for API testing.']
        );
        $postHarvestCategory = KnowledgeCategory::updateOrCreate(
            ['slug' => 'post-harvest'],
            ['name' => 'Post-harvest handling', 'description' => 'Fictional handling and storage guidance.']
        );

        $bananaArticle = KnowledgeArticle::updateOrCreate(
            ['slug' => 'demo-banana-crop-health'],
            [
                'category_id' => $cropCategory->id,
                'title' => 'Demo guide to banana crop health',
                'summary' => 'Fictional development content about routine banana crop monitoring.',
                'body' => 'This fictional test article covers regular field checks, sanitation, and consulting an agriculture officer when crop problems are found.',
                'language' => 'en',
                'author_user_id' => $admin->id,
                'reviewed_by' => $admin->id,
                'source_url' => null,
                'status' => 'published',
                'published_at' => '2026-10-16 09:00:00',
                'reviewed_at' => '2026-10-16 08:00:00',
            ]
        );
        $cacaoArticle = KnowledgeArticle::updateOrCreate(
            ['slug' => 'demo-cacao-post-harvest'],
            [
                'category_id' => $postHarvestCategory->id,
                'title' => 'Demo cacao post-harvest handling',
                'summary' => 'Fictional development content about drying and storing cacao beans.',
                'body' => 'This fictional test article demonstrates knowledge content linked to a commodity.',
                'language' => 'en',
                'author_user_id' => $admin->id,
                'reviewed_by' => $admin->id,
                'source_url' => null,
                'status' => 'published',
                'published_at' => '2026-10-16 10:00:00',
                'reviewed_at' => '2026-10-16 09:00:00',
            ]
        );

        $banana = Commodity::query()->where('slug', 'cavendish-banana')->firstOrFail();
        $cacao = Commodity::query()->where('slug', 'cacao-beans')->firstOrFail();
        DB::table('article_commodities')->updateOrInsert([
            'knowledge_article_id' => $bananaArticle->id,
            'commodity_id' => $banana->id,
        ]);
        DB::table('article_commodities')->updateOrInsert([
            'knowledge_article_id' => $cacaoArticle->id,
            'commodity_id' => $cacao->id,
        ]);

        $program = AssistanceProgram::updateOrCreate(
            ['title' => 'DavNor Demo Small Farm Support Program'],
            [
                'description' => 'Fictional assistance program record for testing API responses.',
                'provider_name' => 'FarmerLink DavNor demo program',
                'eligibility' => 'Fictional test data; not an open government program.',
                'application_instructions' => 'No application is available. This record is for development testing only.',
                'official_url' => null,
                'opens_at' => '2026-10-01 00:00:00',
                'deadline_at' => '2026-12-31 23:59:59',
                'published_by' => $admin->id,
                'status' => 'published',
            ]
        );

        AssistanceProgramAttachment::updateOrCreate(
            [
                'assistance_program_id' => $program->id,
                'storage_path' => 'seed-data/programs/demo-program-guide.pdf',
            ],
            ['label' => 'Fictional demo program guide']
        );
    }
}
