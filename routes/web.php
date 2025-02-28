<?php

// use App\Models\Marquee;


use App\Models\Info;
use App\Models\Lapangan;
use App\Models\KategoriBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CartLapanganController;
use App\Http\Controllers\KategoriBankController;
use App\Http\Controllers\TransaksiProdukController;
use App\Http\Controllers\KategoriOlahragaController;
use App\Http\Controllers\KategoriFasilitasController;

// beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
// Route::get('/booking', function () {
//     return view('booking');
// });

Route::get('/belanja', [BelanjaController::class, 'index'])->name('belanja');
Route::get('/belanja/{id}', [BelanjaController::class, 'show'])->name('belanja.show');
// booking
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

// event
Route::resource('/admin/events', EventController::class);

//kontak
Route::get('/kontak', function () {
    return view('kontak');
});

// info
Route::get('/info', [BerandaController::class, 'info'])->name('info');
Route::get('/info/{id}', [BerandaController::class, 'show'])->name('infoo');
Route::resource('admin/info', InfoController::class);
Route::prefix('admin/info')->name('admin.info')->group(function () {
    Route::resource('admin/info', InfoController::class);
});

//faqs
Route::get('/faqs', function () {
    return view('faqs');
});

//auth user
// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('regis');
// });

// Route::get('/admin', function () {
//     return view('admin/login');
// });

//dashbord
Route::get('/admin/dashbord', function () {
    return view('admin/dashbord');
});

// admin slider
Route::resource('admin/slider', SliderController::class);
Route::prefix('admin')->group(function () {
    Route::resource('sliders', SliderController::class);
});
Route::get('/sliders/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
Route::put('/sliders/{id}', [SliderController::class, 'update'])->name('sliders.update');

//admin marquee
Route::resource('admin/marquee', MarqueeController::class);

// lapangan
Route::middleware(['auth'])->group(function () {
    Route::get('admin/lapangan', [LapanganController::class, 'index'])->name('lapangan.index');
    Route::get('admin/lapangan/tambah', [LapanganController::class, 'create'])->name('lapangan.create');
    Route::post('admin/lapangan', [LapanganController::class, 'store'])->name('lapangan.store');
    Route::get('admin/lapangan/{id}/edit', [LapanganController::class, 'edit'])->name('lapangan.edit');
    Route::put('admin/lapangan/{id}', [LapanganController::class, 'update'])->name('lapangan.update');
    Route::delete('admin/lapangan/{id}', [LapanganController::class, 'destroy'])->name('lapangan.destroy');
});
// kategori bank
Route::resource('admin/kategori/banks', KategoriBankController::class);
// Route::get('/bank/tambah', [KategoriBankController::class, 'tambah','store1'])->name('bank.tambah');
// Route::post('/bank/store1', [KategoriBankController::class, 'store1'])->name('bank.store1');
// Route::get('/bank/{id}/edit1', [KategoriBankController::class, 'edit1'])->name('bank.edit1');
// Route::resource('admin/bank', BankController::class);

// bank
Route::resource('admin/bank', BankController::class);
// kategori fasilitas
Route::resource('admin/kategori/fasilitas', KategoriFasilitasController::class);
// kategori Olahraga
Route::resource('admin/kategori/olahraga', KategoriOlahragaController::class);
// kategori lapangan
Route::resource('admin/produk', ProdukController::class);



// jettream
// Route::middleware('auth.redirect')->group(function () {
//     Route::get('/login', function () {
//         return view('auth.login');
//     })->name('login');

//     Route::get('/register', function () {
//         return view('auth.register');
//     })->name('register');
// });

// Middleware untuk proteksi admin & partner
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     });
// });



// Route::middleware(['auth', 'role:partner'])->group(function () {
//     Route::get('/partner/dashboard', function () {
//         return view('admin.dashboard');
//     });
// });

// Logout User partner dan admin
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login');
})->name('logout');

//---------------------------------------------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// user
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('regis');
})->name('register');
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/beranda', [UserController::class, 'index'])->name('user.beranda');
});
Route::post('/login', [UserController::class, 'login'])->name('login.user');
Route::post('/register', [UserController::class, 'register'])->name('register.user');
Route::post('/logout', [UserController::class, 'logout'])->name('logout.user');


// partner
Route::get('/partner/login', function () {
    return view('partner.login');
})->name('login');
Route::get('/partner/register', function () {
    return view('partner.regis');
})->name('register');
Route::middleware(['auth', 'role:partner'])->group(function () {
    Route::get('/partner/dashboard', [PartnerController::class, 'index'])->name('partner.dashboard');
});
Route::post('/partner/login', [PartnerController::class, 'login'])->name('login.partner');
Route::post('/partner/register', [PartnerController::class, 'register'])->name('register.partner');
Route::post('/partner/logout', [PartnerController::class, 'logout'])->name('partner.logout');

///  admin
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('login');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::post('/admin/login', [AdminController::class, 'login'])->name('login.admin');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/transaksi', [TransaksiProdukController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/checkout/{id}', [TransaksiProdukController::class, 'checkout'])->name('transaksi.checkout');
    Route::post('/transaksi/store', [TransaksiProdukController::class, 'store'])->name('transaksi.store');
});

/// masuk keranjang
Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{produk_id}', [KeranjangController::class, 'tambahKeKeranjang']);
    Route::put('/keranjang/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
});

//cart produk
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// cart lapangan
Route::middleware('auth')->group(function () {
    Route::get('/cartlapangan', [CartLapanganController::class, 'index1'])->name('cart.index1');
    Route::post('/cartlapangan/add', [CartLapanganController::class, 'addToCart1'])->name('cart.add1');
    Route::post('/cartlapangan/update/{id}', [CartLapanganController::class, 'updateCart1'])->name('cart.update1');
    Route::delete('/cartlapangan/remove/{id}', [CartLapanganController::class, 'removeCart1'])->name('cart.remove1');
    Route::post('/cartlapangan/checkout', [CartLapanganController::class, 'checkout1'])->name('cart.checkout1');
});

//ongkir
Route::middleware('auth')->group(function () {
    Route::get('/provinces', [ShippingController::class, 'getProvinces']);
    Route::get('/cities/{province_id}', [ShippingController::class, 'getCities']);
    Route::post('/shipping-cost', [ShippingController::class, 'getShippingCost']);
});

//checkout

// Route::middleware('auth')->group(function () {
//     Route::get('/checkout/produk', [CheckoutController::class, 'index'])->name('checkout');
//     Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
//     Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/payment/{orderId}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('payment.callback');
});
