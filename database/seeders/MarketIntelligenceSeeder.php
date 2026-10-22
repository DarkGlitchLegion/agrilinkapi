<?php

namespace Database\Seeders;

use App\Models\Geography\Barangay;
use App\Models\MarketIntelligence\DataSource;
use App\Models\MarketIntelligence\Market;
use App\Models\MarketIntelligence\MarketPriceObservation;
use App\Models\MarketIntelligence\PriceAlert;
use App\Models\MarketIntelligence\PriceImportBatch;
use App\Models\Products\Commodity;
use App\Models\Products\UnitOfMeasure;
use App\Models\User;
use Illuminate\Database\Seeder;

class MarketIntelligenceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin.test@farmerlink.local')->firstOrFail();
        $buyer = User::query()->where('email', 'buyer.test@farmerlink.local')->firstOrFail();
        $dataSource = DataSource::updateOrCreate(
            ['name' => 'DavNor Demo Market Survey'],
            [
                'source_type' => 'development_sample',
                'source_url' => null,
                'publisher' => 'FarmerLink DavNor fictional test data',
                'license_notes' => 'Fictional development records; not an official price quotation.',
                'is_active' => true,
            ]
        );

        $markets = [];
        foreach ([
            ['name' => 'Demo Tagum Market', 'code' => 'TAGUM-01', 'type' => 'retail'],
            ['name' => 'Demo Panabo Market', 'code' => 'PANABO-01', 'type' => 'wholesale'],
            ['name' => 'Demo Santo Tomas Market', 'code' => 'STOTOMAS-01', 'type' => 'retail'],
        ] as $marketData) {
            $barangay = Barangay::query()->where('code', $marketData['code'])->firstOrFail();
            $markets[] = Market::updateOrCreate(
                ['name' => $marketData['name']],
                [
                    'market_type' => $marketData['type'],
                    'barangay_id' => $barangay->id,
                    'address' => 'Fictional demo market location',
                    'is_active' => true,
                ]
            );
        }

        $priceByCommodity = [
            'cavendish-banana' => [32, 34],
            'coconut' => [18, 20],
            'rice' => [52, 55],
            'yellow-corn' => [24, 26],
            'cacao-beans' => [175, 185],
            'ampalaya' => [38, 42],
        ];

        foreach ($priceByCommodity as $commoditySlug => [$basePrice, $marketSpread]) {
            $commodity = Commodity::query()->where('slug', $commoditySlug)->firstOrFail();
            $unit = UnitOfMeasure::query()->findOrFail($commodity->default_unit_id);

            foreach ($markets as $marketIndex => $market) {
                foreach ([
                    ['date' => '2026-10-18', 'offset' => -2],
                    ['date' => '2026-10-19', 'offset' => -1],
                    ['date' => '2026-10-20', 'offset' => 0],
                ] as $day) {
                    $averagePrice = $basePrice + ($marketIndex * $marketSpread) + $day['offset'];

                    MarketPriceObservation::updateOrCreate(
                        [
                            'commodity_id' => $commodity->id,
                            'market_id' => $market->id,
                            'observed_on' => $day['date'],
                        ],
                        [
                            'source_id' => $dataSource->id,
                            'price_type' => $market->market_type,
                            'minimum_price' => $averagePrice - 2,
                            'maximum_price' => $averagePrice + 2,
                            'average_price' => $averagePrice,
                            'unit_id' => $unit->id,
                            'published_at' => $day['date'].' 12:00:00',
                            'verification_status' => 'verified',
                            'submitted_by' => $admin->id,
                        ]
                    );
                }
            }
        }

        PriceImportBatch::updateOrCreate(
            ['source_id' => $dataSource->id, 'file_path' => 'seed-data/imports/dav-nor-demo-prices.csv'],
            [
                'imported_by' => $admin->id,
                'started_at' => '2026-10-18 08:00:00',
                'finished_at' => '2026-10-18 08:05:00',
                'status' => 'completed',
                'records_processed' => count($priceByCommodity) * count($markets) * 3,
                'error_summary' => [],
            ]
        );

        foreach (['cavendish-banana' => 30, 'rice' => 50, 'cacao-beans' => 165] as $commoditySlug => $targetPrice) {
            $commodity = Commodity::query()->where('slug', $commoditySlug)->firstOrFail();

            PriceAlert::updateOrCreate(
                ['user_id' => $buyer->id, 'commodity_id' => $commodity->id],
                [
                    'barangay_id' => Barangay::query()->where('code', 'TAGUM-01')->value('id'),
                    'target_price' => $targetPrice,
                    'comparison_operator' => '<=',
                    'is_active' => true,
                ]
            );
        }
    }
}
