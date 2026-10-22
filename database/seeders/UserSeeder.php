<?php

namespace Database\Seeders;

use App\Models\Geography\Barangay;
use App\Models\Identity\UserAddress;
use App\Models\Identity\UserPreference;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class UserSeeder extends Seeder
{
    private const TEST_PASSWORD = 'TestOnly!2026';

    public function run(): void
    {
        $homeBarangay = Barangay::query()->where('code', 'TAGUM-01')->firstOrFail();
        $accounts = [
            ['email' => 'admin.test@farmerlink.local', 'name' => 'Test Administrator', 'role' => 'admin'],
            ['email' => 'farmer.test@farmerlink.local', 'name' => 'Test Farmer Juan', 'role' => 'farmer'],
            ['email' => 'buyer.test@farmerlink.local', 'name' => 'Test Buyer Mina', 'role' => 'buyer'],
            ['email' => 'business.test@farmerlink.local', 'name' => 'Test Business Buyer', 'role' => 'buyer'],
        ];
        $users = [];

        foreach ($accounts as $account) {
            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'password' => Hash::make(self::TEST_PASSWORD),
                ]
            );
            $users[$account['email']] = $user;

            UserPreference::updateOrCreate(
                ['user_id' => $user->id],
                ['language' => 'en']
            );

            UserAddress::updateOrCreate(
                ['user_id' => $user->id, 'label' => 'Test home'],
                [
                    'address_line' => 'Demo address, Tagum City',
                    'barangay_id' => $homeBarangay->id,
                    'postal_code' => 8100,
                    'latitude' => '7.4478',
                    'longitude' => '125.8078',
                    'is_default' => true,
                ]
            );
        }

        $admin = $users['admin.test@farmerlink.local'];

        foreach ($accounts as $account) {
            $roleId = DB::table('roles')->where('slug', $account['role'])->value('id');

            if ($roleId === null) {
                throw new RuntimeException("The [{$account['role']}] role must exist before test users are seeded.");
            }

            DB::table('role_user')->updateOrInsert(
                ['user_id' => $users[$account['email']]->id, 'role_id' => $roleId],
                [
                    'assigned_by' => $admin->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
