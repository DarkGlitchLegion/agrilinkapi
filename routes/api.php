<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Buyers\BusinessMemberController;
use App\Http\Controllers\Buyers\BusinessProfileController;
use App\Http\Controllers\Buyers\BuyerProductRequirementController;
use App\Http\Controllers\Buyers\BuyerProfileController;
use App\Http\Controllers\Commerce\ConversationController;
use App\Http\Controllers\Commerce\ConversationParticipantController;
use App\Http\Controllers\Commerce\InquiryController;
use App\Http\Controllers\Commerce\MessageController;
use App\Http\Controllers\Commerce\OrderController;
use App\Http\Controllers\Commerce\OrderItemController;
use App\Http\Controllers\Commerce\OrderStatusHistoryController;
use App\Http\Controllers\Commerce\QuotationController;
use App\Http\Controllers\Commerce\QuotationItemController;
use App\Http\Controllers\Commerce\ReviewController;
use App\Http\Controllers\Geography\BarangayController;
use App\Http\Controllers\Geography\FarmController;
use App\Http\Controllers\Geography\FarmCropController;
use App\Http\Controllers\Geography\FarmMemberController;
use App\Http\Controllers\Geography\MunicipalityController;
use App\Http\Controllers\Geography\ProvinceController;
use App\Http\Controllers\Identity\PermissionController;
use App\Http\Controllers\Identity\RoleController;
use App\Http\Controllers\Identity\UserAddressController;
use App\Http\Controllers\Identity\UserPreferenceController;
use App\Http\Controllers\Identity\VerificationDocumentController;
use App\Http\Controllers\Knowledge\AssistanceProgramAttachmentController;
use App\Http\Controllers\Knowledge\AssistanceProgramController;
use App\Http\Controllers\Knowledge\KnowledgeArticleController;
use App\Http\Controllers\Knowledge\KnowledgeCategoryController;
use App\Http\Controllers\MarketIntelligence\DataSourceController;
use App\Http\Controllers\MarketIntelligence\MarketController;
use App\Http\Controllers\MarketIntelligence\MarketPriceObservationController;
use App\Http\Controllers\MarketIntelligence\PriceAlertController;
use App\Http\Controllers\MarketIntelligence\PriceImportBatchController;
use App\Http\Controllers\Notifications\NotificationDeliveryController;
use App\Http\Controllers\Notifications\UserNotificationPreferenceController;
use App\Http\Controllers\Products\CommodityController;
use App\Http\Controllers\Products\ListingPriceHistoryController;
use App\Http\Controllers\Products\ListingReportController;
use App\Http\Controllers\Products\ProductCategoryController;
use App\Http\Controllers\Products\ProductImageController;
use App\Http\Controllers\Products\ProductListingController;
use App\Http\Controllers\Products\SavedListingController;
use App\Http\Controllers\Products\UnitOfMeasureController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function (): void {
    Route::prefix('buyers')->group(function (): void {
        Route::apiResources([
            'buyer-profiles' => BuyerProfileController::class,
            'business-profiles' => BusinessProfileController::class,
            'buyer-product-requirements' => BuyerProductRequirementController::class,
            'business-members' => BusinessMemberController::class,
        ]);
    });

    Route::prefix('commerce')->group(function (): void {
        Route::apiResources([
            'conversation-participants' => ConversationParticipantController::class,
            'conversations' => ConversationController::class,
            'inquiries' => InquiryController::class,
            'messages' => MessageController::class,
            'order-items' => OrderItemController::class,
            'orders' => OrderController::class,
            'order-status-histories' => OrderStatusHistoryController::class,
            'quotation-items' => QuotationItemController::class,
            'quotations' => QuotationController::class,
            'reviews' => ReviewController::class,
        ]);
    });

    Route::prefix('geography')->group(function (): void {
        Route::apiResources([
            'barangays' => BarangayController::class,
            'farm-crops' => FarmCropController::class,
            'farm-members' => FarmMemberController::class,
            'farms' => FarmController::class,
            'municipalities' => MunicipalityController::class,
            'provinces' => ProvinceController::class,
        ]);
    });

    Route::prefix('identity')->group(function (): void {
        Route::apiResources([
            'permissions' => PermissionController::class,
            'roles' => RoleController::class,
            'user-addresses' => UserAddressController::class,
            'user-preferences' => UserPreferenceController::class,
            'verification-documents' => VerificationDocumentController::class,
        ]);
    });

    Route::prefix('knowledge')->group(function (): void {
        Route::apiResources([
            'assistance-program-attachments' => AssistanceProgramAttachmentController::class,
            'assistance-programs' => AssistanceProgramController::class,
            'knowledge-articles' => KnowledgeArticleController::class,
            'knowledge-categories' => KnowledgeCategoryController::class,
        ]);
    });

    Route::prefix('market-intelligence')->group(function (): void {
        Route::apiResources([
            'data-sources' => DataSourceController::class,
            'markets' => MarketController::class,
            'price-alerts' => PriceAlertController::class,
            'price-import-batches' => PriceImportBatchController::class,
            'market-price-observations' => MarketPriceObservationController::class,
        ]);
    });

    Route::prefix('notifications')->group(function (): void {
        Route::apiResources([
            'notification-deliveries' => NotificationDeliveryController::class,
            'user-notification-preferences' => UserNotificationPreferenceController::class,
        ]);
    });

    Route::prefix('products')->group(function (): void {
        Route::apiResources([
            'commodities' => CommodityController::class,
            'listing-price-history' => ListingPriceHistoryController::class,
            'listing-reports' => ListingReportController::class,
            'product-categories' => ProductCategoryController::class,
            'product-images' => ProductImageController::class,
            'product-listings' => ProductListingController::class,
            'saved-listings' => SavedListingController::class,
            'units-of-measure' => UnitOfMeasureController::class,
        ]);
    });
});
