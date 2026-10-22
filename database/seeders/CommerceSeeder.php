<?php

namespace Database\Seeders;

use App\Models\Commerce\Conversation;
use App\Models\Commerce\ConversationParticipant;
use App\Models\Commerce\Inquiry;
use App\Models\Commerce\Message;
use App\Models\Commerce\Order;
use App\Models\Commerce\OrderItem;
use App\Models\Commerce\OrderStatusHistory;
use App\Models\Commerce\Quotation;
use App\Models\Commerce\QuotationItem;
use App\Models\Commerce\Review;
use App\Models\Products\ProductListing;
use App\Models\Products\UnitOfMeasure;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommerceSeeder extends Seeder
{
    public function run(): void
    {
        $buyer = User::query()->where('email', 'buyer.test@farmerlink.local')->firstOrFail();
        $businessBuyer = User::query()->where('email', 'business.test@farmerlink.local')->firstOrFail();
        $farmer = User::query()->where('email', 'farmer.test@farmerlink.local')->firstOrFail();
        $listing = ProductListing::query()->where('title', 'Demo Cavendish bananas')->firstOrFail();
        $cacaoListing = ProductListing::query()->where('title', 'Demo dried cacao beans')->firstOrFail();
        $unit = UnitOfMeasure::query()->where('symbol', 'kg')->firstOrFail();

        $inquiry = Inquiry::updateOrCreate(
            ['buyer_user_id' => $buyer->id, 'product_listing_id' => $listing->id],
            [
                'requested_quantity' => 100,
                'unit_id' => $unit->id,
                'message' => 'Fictional test inquiry: please confirm availability for a 100 kg order.',
                'status' => 'quoted',
            ]
        );

        $businessInquiry = Inquiry::updateOrCreate(
            ['buyer_user_id' => $businessBuyer->id, 'product_listing_id' => $cacaoListing->id],
            [
                'requested_quantity' => 100,
                'unit_id' => $unit->id,
                'message' => 'Fictional test inquiry for dried cacao beans.',
                'status' => 'pending',
            ]
        );

        $quotation = Quotation::updateOrCreate(
            ['inquiry_id' => $inquiry->id, 'farmer_user_id' => $farmer->id],
            [
                'unit_price' => 32,
                'quantity_offered' => 100,
                'unit_id' => $unit->id,
                'valid_until' => '2026-12-31 23:59:59',
                'terms' => 'Fictional test quotation. Buyer pickup in Tagum City.',
                'status' => 'accepted',
            ]
        );

        QuotationItem::updateOrCreate(
            ['quotation_id' => $quotation->id, 'description' => 'Cavendish bananas, Grade A'],
            [
                'quantity' => 100,
                'unit_id' => $unit->id,
                'unit_price' => 32,
                'line_total' => 3200,
            ]
        );

        Quotation::updateOrCreate(
            ['inquiry_id' => $businessInquiry->id, 'farmer_user_id' => $farmer->id],
            [
                'unit_price' => 175,
                'quantity_offered' => 100,
                'unit_id' => $unit->id,
                'valid_until' => '2026-12-31 23:59:59',
                'terms' => 'Fictional test quotation pending buyer review.',
                'status' => 'pending',
            ]
        );

        $order = Order::updateOrCreate(
            ['order_number' => 'DEMO-ORD-2026-001'],
            [
                'buyer_user_id' => $buyer->id,
                'farmer_user_id' => $farmer->id,
                'quotation_id' => $quotation->id,
                'delivery_method' => 'pickup',
                'delivery_address_snapshot' => [
                    'label' => 'Demo pickup point',
                    'address_line' => 'Demo address, Tagum City',
                    'barangay' => 'Mankilam',
                    'postal_code' => '8100',
                ],
                'subtotal' => 3200,
                'delivery_fee' => 0,
                'total_amount' => 3200,
                'currency' => 'PHP',
                'status' => 'delivered',
                'placed_at' => '2026-10-17 10:00:00',
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order->id, 'product_listing_id' => $listing->id],
            [
                'product_name_snapshot' => $listing->title,
                'quantity' => 100,
                'unit_id' => $unit->id,
                'unit_price' => 32,
                'line_total' => 3200,
            ]
        );

        foreach ([
            ['previous_status' => 'pending', 'new_status' => 'confirmed', 'changed_by' => $farmer->id, 'notes' => 'Fictional demo order confirmed.'],
            ['previous_status' => 'confirmed', 'new_status' => 'delivered', 'changed_by' => $farmer->id, 'notes' => 'Fictional demo pickup completed.'],
        ] as $history) {
            OrderStatusHistory::updateOrCreate(
                ['order_id' => $order->id, 'new_status' => $history['new_status']],
                [...$history, 'created_at' => '2026-10-18 10:00:00']
            );
        }

        Review::updateOrCreate(
            ['order_id' => $order->id, 'reviewer_user_id' => $buyer->id],
            [
                'reviewed_user_id' => $farmer->id,
                'rating' => 5,
                'comment' => 'Fictional test review for a completed demo order.',
                'moderation_status' => 'approved',
            ]
        );

        $conversation = Conversation::updateOrCreate(
            ['created_by' => $buyer->id, 'subject' => 'Demo banana order discussion'],
            ['conversation_type' => 'inquiry', 'status' => 'active']
        );

        foreach ([$buyer, $farmer] as $participant) {
            ConversationParticipant::updateOrCreate(
                ['conversation_id' => $conversation->id, 'user_id' => $participant->id],
                ['joined_at' => '2026-10-17 09:30:00', 'last_read_at' => null]
            );
        }

        foreach ([
            [$buyer, 'Fictional test message: can you confirm the harvest date?'],
            [$farmer, 'Fictional test reply: the demo listing is available for pickup.'],
        ] as [$sender, $body]) {
            Message::updateOrCreate(
                ['conversation_id' => $conversation->id, 'sender_user_id' => $sender->id, 'message_body' => $body],
                ['attachment_path' => null, 'read_at' => '2026-10-17 10:00:00']
            );
        }
    }
}
