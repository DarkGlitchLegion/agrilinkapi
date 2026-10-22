<?php

namespace Database\Seeders;

use App\Models\Buyers\BusinessMember;
use App\Models\Buyers\BusinessProfile;
use App\Models\Buyers\BuyerProductRequirement;
use App\Models\Buyers\BuyerProfile;
use App\Models\Geography\Barangay;
use App\Models\Products\Commodity;
use App\Models\Products\UnitOfMeasure;
use App\Models\User;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    public function run(): void
    {
        $tagumBarangay = Barangay::query()->where('code', 'TAGUM-01')->firstOrFail();
        $panaboBarangay = Barangay::query()->where('code', 'PANABO-01')->firstOrFail();

        $individualBuyer = User::query()->where('email', 'buyer.test@farmerlink.local')->firstOrFail();
        $businessBuyer = User::query()->where('email', 'business.test@farmerlink.local')->firstOrFail();

        $individualProfile = BuyerProfile::updateOrCreate(
            ['user_id' => $individualBuyer->id],
            [
                'buyer_type' => 'individual',
                'display_name' => 'Test Buyer Mina',
                'contact_person' => 'Mina Test Buyer',
                'preferred_barangay_id' => $tagumBarangay->id,
                'verification_status' => 'verified',
            ]
        );

        $businessProfileOwner = BuyerProfile::updateOrCreate(
            ['user_id' => $businessBuyer->id],
            [
                'buyer_type' => 'business',
                'display_name' => 'Test Business Buyer',
                'contact_person' => 'Alex Test Buyer',
                'preferred_barangay_id' => $panaboBarangay->id,
                'verification_status' => 'verified',
            ]
        );

        $businessProfile = BusinessProfile::updateOrCreate(
            ['buyer_profile_id' => $businessProfileOwner->id],
            [
                'business_name' => 'DavNor Demo Produce Trading',
                'business_type' => 'Agricultural trading',
                'business_address' => 'Demo business address, Panabo City',
                'business_email' => 'contact@demo-business.farmerlink.local',
                'business_phone' => '0000000000',
                'registration_reference' => 'DEMO-BUSINESS-001',
                'verification_status' => 'verified',
            ]
        );

        BusinessMember::updateOrCreate(
            ['business_profile_id' => $businessProfile->id, 'user_id' => $businessBuyer->id],
            ['business_role' => 'owner', 'status' => 'active']
        );

        $requirements = [
            [$individualProfile, 'cavendish-banana', 'kg', 100, 30],
            [$individualProfile, 'rice', 'kg', 250, 48],
            [$businessProfileOwner, 'cacao-beans', 'kg', 1000, 160],
            [$businessProfileOwner, 'yellow-corn', 'kg', 500, 22],
        ];

        foreach ($requirements as [$profile, $commoditySlug, $unitSymbol, $quantity, $targetPrice]) {
            $commodity = Commodity::query()->where('slug', $commoditySlug)->firstOrFail();
            $unit = UnitOfMeasure::query()->where('symbol', $unitSymbol)->firstOrFail();

            BuyerProductRequirement::updateOrCreate(
                ['buyer_profile_id' => $profile->id, 'commodity_id' => $commodity->id],
                [
                    'quantity_required' => $quantity,
                    'unit_id' => $unit->id,
                    'target_price' => $targetPrice,
                    'needed_by' => '2026-12-15',
                    'delivery_barangay_id' => $profile->is($individualProfile) ? $tagumBarangay->id : $panaboBarangay->id,
                    'status' => 'open',
                ]
            );
        }
    }
}
