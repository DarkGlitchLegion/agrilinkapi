<?php

namespace Database\Seeders;

use App\Models\Geography\Barangay;
use App\Models\Geography\Farm;
use App\Models\Geography\FarmCrop;
use App\Models\Geography\FarmMember;
use App\Models\Products\Commodity;
use App\Models\Products\ListingPriceHistory;
use App\Models\Products\ListingReport;
use App\Models\Products\ProductCategory;
use App\Models\Products\ProductImage;
use App\Models\Products\ProductListing;
use App\Models\Products\SavedListing;
use App\Models\Products\UnitOfMeasure;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $units = [];

        foreach ([
            ['name' => 'Kilogram', 'symbol' => 'kg', 'unit_type' => 'weight'],
            ['name' => 'Metric ton', 'symbol' => 'mt', 'unit_type' => 'weight'],
            ['name' => 'Piece', 'symbol' => 'pc', 'unit_type' => 'count'],
            ['name' => 'Sack', 'symbol' => 'sack', 'unit_type' => 'count'],
        ] as $unitData) {
            $units[$unitData['symbol']] = UnitOfMeasure::updateOrCreate(
                ['symbol' => $unitData['symbol']],
                [...$unitData, 'is_active' => true]
            );
        }

        $categories = [];

        foreach ([
            ['name' => 'Fruits', 'slug' => 'fruits', 'description' => 'Tropical and local fruits.'],
            ['name' => 'Grains', 'slug' => 'grains', 'description' => 'Rice and corn crops.'],
            ['name' => 'Vegetables', 'slug' => 'vegetables', 'description' => 'Locally grown vegetables.'],
            ['name' => 'Tree crops', 'slug' => 'tree-crops', 'description' => 'Cacao and other perennial crops.'],
        ] as $categoryData) {
            $categories[$categoryData['slug']] = ProductCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [...$categoryData, 'is_active' => true]
            );
        }

        $commodities = [];
        $commodityData = [
            ['name' => 'Cavendish banana', 'slug' => 'cavendish-banana', 'category' => 'fruits', 'unit' => 'kg'],
            ['name' => 'Coconut', 'slug' => 'coconut', 'category' => 'fruits', 'unit' => 'pc'],
            ['name' => 'Rice', 'slug' => 'rice', 'category' => 'grains', 'unit' => 'kg'],
            ['name' => 'Yellow corn', 'slug' => 'yellow-corn', 'category' => 'grains', 'unit' => 'kg'],
            ['name' => 'Cacao beans', 'slug' => 'cacao-beans', 'category' => 'tree-crops', 'unit' => 'kg'],
            ['name' => 'Ampalaya', 'slug' => 'ampalaya', 'category' => 'vegetables', 'unit' => 'kg'],
        ];

        foreach ($commodityData as $item) {
            $commodities[$item['slug']] = Commodity::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $categories[$item['category']]->id,
                    'name' => $item['name'],
                    'description' => "Fictional development data for {$item['name']} grown in Davao del Norte.",
                    'default_unit_id' => $units[$item['unit']]->id,
                    'is_active' => true,
                ]
            );
        }

        $farmer = User::query()->where('email', 'farmer.test@farmerlink.local')->firstOrFail();
        $admin = User::query()->where('email', 'admin.test@farmerlink.local')->firstOrFail();
        $farmBarangay = Barangay::query()->where('code', 'TAGUM-01')->firstOrFail();
        $farm = Farm::updateOrCreate(
            ['owner_user_id' => $farmer->id, 'name' => 'Test Farmer Demonstration Farm'],
            [
                'description' => 'Fictional mixed-crop farm for local API development.',
                'barangay_id' => $farmBarangay->id,
                'latitude' => 7.4478,
                'longitude' => 125.8078,
                'area_hectares' => 8.5,
                'verification_status' => 'verified',
                'is_public' => true,
            ]
        );

        FarmMember::updateOrCreate(
            ['farm_id' => $farm->id, 'user_id' => $farmer->id],
            ['membership_role' => 'owner', 'status' => 'active', 'invited_by' => $admin->id]
        );

        $cropAreas = [
            'cavendish-banana' => 2.5,
            'coconut' => 1.8,
            'rice' => 1.5,
            'yellow-corn' => 1.2,
            'cacao-beans' => 1.0,
            'ampalaya' => 0.5,
        ];

        foreach ($cropAreas as $commoditySlug => $area) {
            FarmCrop::updateOrCreate(
                ['farm_id' => $farm->id, 'commodity_id' => $commodities[$commoditySlug]->id],
                [
                    'cultivated_area_hectares' => $area,
                    'planting_date' => '2026-07-01',
                    'expected_harvest_date' => '2026-12-01',
                    'status' => 'growing',
                ]
            );
        }

        $listings = [];
        $listingData = [
            ['title' => 'Demo Cavendish bananas', 'commodity' => 'cavendish-banana', 'qty' => 1200, 'unit' => 'kg', 'price' => 32, 'minimum' => 25, 'variety' => 'Cavendish', 'quality' => 'Grade A'],
            ['title' => 'Demo mature coconuts', 'commodity' => 'coconut', 'qty' => 800, 'unit' => 'pc', 'price' => 18, 'minimum' => 50, 'variety' => 'Mature', 'quality' => 'Farm fresh'],
            ['title' => 'Demo milled rice', 'commodity' => 'rice', 'qty' => 900, 'unit' => 'kg', 'price' => 52, 'minimum' => 25, 'variety' => 'Dinorado', 'quality' => 'Well-milled'],
            ['title' => 'Demo yellow corn', 'commodity' => 'yellow-corn', 'qty' => 700, 'unit' => 'kg', 'price' => 24, 'minimum' => 25, 'variety' => 'Yellow dent', 'quality' => 'Grade 1'],
            ['title' => 'Demo dried cacao beans', 'commodity' => 'cacao-beans', 'qty' => 300, 'unit' => 'kg', 'price' => 175, 'minimum' => 10, 'variety' => 'UF18', 'quality' => 'Fermented and dried'],
            ['title' => 'Demo fresh ampalaya', 'commodity' => 'ampalaya', 'qty' => 250, 'unit' => 'kg', 'price' => 38, 'minimum' => 10, 'variety' => 'Native', 'quality' => 'Fresh harvest'],
        ];

        foreach ($listingData as $item) {
            $listing = ProductListing::updateOrCreate(
                ['title' => $item['title']],
                [
                    'farm_id' => $farm->id,
                    'commodity_id' => $commodities[$item['commodity']]->id,
                    'description' => "Fictional test listing for {$item['title']} from a demonstration farm in Davao del Norte.",
                    'variety' => $item['variety'],
                    'quality_grade' => $item['quality'],
                    'quantity_available' => $item['qty'],
                    'unit_id' => $units[$item['unit']]->id,
                    'minimum_order_quantity' => $item['minimum'],
                    'price_per_unit' => $item['price'],
                    'pricing_type' => 'fixed',
                    'harvest_date' => '2026-10-15',
                    'available_until' => '2026-12-31',
                    'status' => 'published',
                    'published_at' => '2026-10-15 08:00:00',
                ]
            );
            $listings[$item['commodity']] = $listing;

            ProductImage::updateOrCreate(
                ['product_listing_id' => $listing->id, 'sort_order' => 0],
                [
                    'storage_path' => 'https://placehold.co/640x480/png?text='.rawurlencode($item['commodity']),
                    'alt_text' => "Placeholder image for {$item['title']}",
                    'uploaded_by' => $farmer->id,
                ]
            );

            ListingPriceHistory::updateOrCreate(
                ['product_listing_id' => $listing->id, 'changed_at' => '2026-10-15 08:00:00'],
                [
                    'old_price' => max(0, $item['price'] - 2),
                    'new_price' => $item['price'],
                    'changed_by' => $farmer->id,
                ]
            );
        }

        $businessBuyer = User::query()->where('email', 'business.test@farmerlink.local')->firstOrFail();
        SavedListing::updateOrCreate(
            ['user_id' => $businessBuyer->id, 'product_listing_id' => $listings['cavendish-banana']->id],
            ['created_at' => '2026-10-16 09:00:00']
        );

        ListingReport::updateOrCreate(
            ['product_listing_id' => $listings['ampalaya']->id, 'reporter_user_id' => $businessBuyer->id],
            [
                'reason' => 'demo_quality_question',
                'details' => 'Fictional seed record to exercise the listing review flow.',
                'status' => 'pending',
                'reviewed_by' => null,
                'reviewed_at' => null,
            ]
        );
    }
}
