<?php

namespace Database\Seeders;

use App\Models\Geography\Barangay;
use App\Models\Geography\Municipality;
use App\Models\Geography\Province;
use Illuminate\Database\Seeder;

class GeographySeeder extends Seeder
{
    public function run(): void
    {
        $province = Province::updateOrCreate(
            ['code' => 'PH-DAV-N'],
            ['name' => 'Davao del Norte']
        );

        $municipalities = [
            ['name' => 'Tagum City', 'code' => 'TAGUM', 'barangays' => ['Mankilam', 'Magugpo Poblacion', 'Visayan Village']],
            ['name' => 'Panabo City', 'code' => 'PANABO', 'barangays' => ['Gredu', 'Cagangohan', 'San Francisco']],
            ['name' => 'Santo Tomas', 'code' => 'STOTOMAS', 'barangays' => ['Tibal-og', 'San Miguel', 'Lungaog']],
            ['name' => 'Carmen', 'code' => 'CARMEN', 'barangays' => ['Ising', 'Alejal', 'Poblacion']],
            ['name' => 'Asuncion', 'code' => 'ASUNCION', 'barangays' => ['New Bantayan', 'Cambanugoy', 'Buan']],
        ];

        foreach ($municipalities as $muniData) {
            $muni = Municipality::updateOrCreate(
                ['code' => $muniData['code']],
                [
                    'province_id' => $province->id,
                    'name' => $muniData['name'],
                    'is_active' => true,
                ]
            );

            foreach ($muniData['barangays'] as $index => $barangayName) {
                Barangay::updateOrCreate(
                    ['code' => $muniData['code'].'-'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)],
                    [
                        'municipality_id' => $muni->id,
                        'name' => $barangayName,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
