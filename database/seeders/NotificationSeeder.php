<?php

namespace Database\Seeders;

use App\Models\Commerce\Order;
use App\Models\Notifications\NotificationDelivery;
use App\Models\Notifications\UserNotificationPreference;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->each(function (User $user): void {
            UserNotificationPreference::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'email_enabled' => true,
                    'sms_enabled' => false,
                    'weather_alerts_enabled' => true,
                    'price_alerts_enabled' => true,
                    'program_alerts_enabled' => true,
                ]
            );
        });

        $order = Order::query()->where('order_number', 'DEMO-ORD-2026-001')->firstOrFail();

        foreach ([$order->buyer_user_id, $order->farmer_user_id] as $userId) {
            NotificationDelivery::updateOrCreate(
                ['notification_reference' => 'demo-order-delivered-'.$order->order_number.'-'.$userId],
                [
                    'user_id' => $userId,
                    'channel' => 'email',
                    'provider_reference' => null,
                    'status' => 'sent',
                    'attempt_count' => 1,
                    'sent_at' => '2026-10-18 10:05:00',
                    'error_message' => null,
                ]
            );
        }
    }
}
