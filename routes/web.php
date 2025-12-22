<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestPayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('guest.index');

    // return redirect('/admin/dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// guest routes

// Route::middleware('guest')->group(function () {
//     Route::get('/welcome', function () {
//         return view('welcome');
//     });
// });

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');
Route::get('/solution', [PageController::class, 'solution'])->name('solutions');
Route::get('/product', [PageController::class, 'product'])->name('product');


// regiter route
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check-email');

//login route
Route::post('/login', [LoginController::class, 'store'])->name('login.store');



//logged in
Route::middleware('auth')->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('user.index');

    Route::get('/Product', [UserController::class, 'product'])->name('user.product');

    Route::get('/solutions', [UserController::class, 'solutions'])->name('user.solutions');


    Route::get('/about', [UserController::class, 'about'])->name('user.about');

    Route::get('/contact', [UserController::class, 'contact'])->name('user.contact');

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/checkout', [UserController::class, 'checkout'])->name('user.checkout');

    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');

    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');

    Route::get('/orders', [OrderController::class, 'index'])->name('user.orders');

    Route::get('/orders/{order}', [OrderController::class, 'details'])->name('order.details');

    Route::get('/orders/{order}/failed', [OrderController::class, 'failedOrder'])->name('order.failed');

    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('order.invoice');

    Route::get('/order-confirmed/{id}', [OrderController::class, 'orderConfirmed'])->name('user.orderconfirmedq');

    // Cart routes
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/complete', [PaymentController::class, 'completeCheckout'])->name('checkout.complete');

    // Payment routes
    Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
    Route::post('/payment/mark-failed', [PaymentController::class, 'markTransactionFailed'])->name('payment.mark-failed');
    Route::get('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');

    Route::get('/payment/processing/{reference}', [PaymentController::class, 'processingPage'])
        ->name('payment.processing');


    // Polling API
    Route::get('/api/check-payment-status', [PaymentController::class, 'checkPaymentStatus']);

    // Payment failed redirect
    Route::get('/payment/failed/{order}', function ($orderId) {
        return redirect()->route('user.payment.mark-failed', $orderId);
    });

    // Paystack Webhook
    Route::post('/webhook/paystack', [PaymentController::class, 'paystackWebhook'])
        ->name('webhook.paystack');

});

// Route::get('/index', [UserController::class, 'index'])->name('index');

// logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


// admin
Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

    // Order management routes
    Route::get('/admin/orders', [OrderController::class, 'getAllOrders'])->name('admin.orders');
    Route::patch('/admin/orders/status', [OrderController::class, 'updateOrderStatus'])->name('admin.orders.update-status');

    // Product routes
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // ========== ADMIN API ROUTES FOR SPA ==========
    Route::prefix('admin/api')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'apiDashboard'])->name('admin.api.dashboard');
        Route::get('/products', [AdminController::class, 'apiProducts'])->name('admin.api.products');
        Route::get('/orders', [AdminController::class, 'apiOrders'])->name('admin.api.orders');
        Route::get('/transactions', [AdminController::class, 'apiTransactions'])->name('admin.api.transactions');
        Route::get('/customers', [AdminController::class, 'apiCustomers'])->name('admin.api.customers');
        Route::get('/customers/{customerId}/orders', [AdminController::class, 'apiCustomerOrders'])->name('admin.api.customer.orders');
        Route::get('/inventory', [AdminController::class, 'apiInventory'])->name('admin.api.inventory');
    });
});

Route::get('pay', [TestPayController::class, 'pay']);
Route::post('/payme', [TestPayController::class, 'make_payment'])->name('pay.me');

// Paystack webhook - outside auth middleware
Route::post('/webhooks/paystack', [PaymentController::class, 'handleWebhook'])->name('payment.webhook');
