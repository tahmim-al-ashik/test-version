<?php
use App\Http\Controllers\Invoice\DraftInvoicesController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Payment\PaymentGatewayController;
use App\Http\Controllers\Payment\PaymentSettingsController;
use App\Http\Controllers\Invoice\InvoiceCategoryController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\SubcategoryController;
use App\Http\Controllers\Invoice\InvoiceSettingController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\User\Service\UserServiceController;
use App\Http\Controllers\PagesController\LandingPageController;
use App\Http\Controllers\PagesController\ProfileController;
use App\Http\Controllers\Api\User\AuthController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing page route
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// General user login routes
Route::get('/login', function () {
    return Inertia::render('Auth/Login'); // This will render a Vue component for user login
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');

// General user dashboard route
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

// General user profile routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/services', [UserServiceController::class, 'userIndex'])->name('services.index');
    Route::get('/services/{service}', [UserServiceController::class, 'show'])->name('services.show');

    Route::get('services/{service}/register/personal', [UserServiceController::class, 'registerPersonal'])->name('services.register.personal');
    Route::post('services/{service}/register/personal', [UserServiceController::class, 'storePersonal'])->name('services.store.personal');

    Route::get('services/{service}/register/corporate', [UserServiceController::class, 'registerCorporate'])->name('services.register.corporate');
    Route::post('services/{service}/register/corporate', [UserServiceController::class, 'storeCorporate'])->name('services.store.corporate');

    Route::get('/user/registered-services', [UserServiceController::class, 'registeredServices'])->name('user.registered.services');
    Route::get('/package/{package}', [UserServiceController::class, 'showPackage'])->name('package.show');
    Route::get('/invoice/{service}/{package}', [UserServiceController::class, 'showInvoice'])->name('package.invoice');
    Route::get('/package/details/{service}/{package}', [UserServiceController::class, 'showPackageDetails'])->name('package.details');

    Route::get('/api/packages', [CustomerController::class, 'getPackagesByService']);

    ############# Customer #################
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit'); // Edit route
    Route::post('/customers/{customer}/update', [CustomerController::class, 'update'])->name('customers.update'); // Update route

    ############# Product #################
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products',[ProductController::class, 'store'])->name('products.store');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/subcategories', [SubcategoryController::class, 'index']);
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/manage-categories', function () {
        return Inertia::render('Products/ManageCategories');
    })->name('manage.categories');

    Route::get('/user/categories', [CategoryController::class, 'userCategories']);
    Route::get('/user/subcategories', [SubcategoryController::class, 'userSubcategories']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::put('/subcategories/{id}', [SubcategoryController::class, 'update']);
    Route::get('/manage-categories', [CategoryController::class, 'manage'])->name('manage.categories');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/subcategories/{id}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/subcategories/{id}', [SubcategoryController::class, 'update'])->name('subcategories.update');

    ############# Invoice #################
    Route::get('/invoice-settings/edit', [InvoiceSettingController::class, 'edit'])->name('invoice.settings.edit');
    Route::post('/invoice-settings/update', [InvoiceSettingController::class, 'update'])->name('invoice.settings.update');
    Route::get('/api/invoice-settings', [InvoiceSettingController::class, 'getInvoiceSettings']);
    Route::get('/invoice-settings', [InvoiceSettingController::class, 'getInvoiceSettings']);

    Route::get('/invoice-categories', [InvoiceCategoryController::class, 'index'])->name('invoice-categories.index');
    Route::post('/invoice-categories', [InvoiceCategoryController::class, 'store'])->name('invoice-categories.store');
    Route::put('/invoice-categories/{id}', [InvoiceCategoryController::class, 'update'])->name('invoice-categories.update');
    Route::delete('/invoice-categories/{id}', [InvoiceCategoryController::class, 'destroy'])->name('invoice-categories.destroy');
    Route::get('/api/invoice-categories', [InvoiceCategoryController::class, 'index'])->name('invoice-categories.index');
    Route::get('/api/invoice-categories', [InvoiceCategoryController::class, 'getCategories'])->name('api.invoice-categories');


//    Route::get('/invoice-categories', [InvoiceCategoryController::class, 'index'])->name('invoice-categories.index');
//    Route::post('/invoice-categories', [InvoiceCategoryController::class, 'store'])->name('invoice-categories.store');
//    Route::put('/invoice-categories/{id}', [InvoiceCategoryController::class, 'update'])->name('invoice-categories.update');
//    Route::delete('/invoice-categories/{id}', [InvoiceCategoryController::class, 'destroy'])->name('invoice-categories.destroy');




    Route::get('/payment-settings', [PaymentSettingsController::class, 'index'])->name('payment-settings.index');
    Route::post('/payment-settings', [PaymentSettingsController::class, 'store'])->name('payment-settings.store');
    Route::put('/payment-settings/{id}', [PaymentSettingsController::class, 'update'])->name('payment-settings.update');
    Route::delete('/payment-settings/{id}', [PaymentSettingsController::class, 'destroy'])->name('payment-settings.destroy');
    Route::put('/payment-settings/{id}', [PaymentSettingsController::class, 'update'])->name('payment-settings.update');

    Route::get('/payment-gateways', [PaymentGatewayController::class, 'index']);
    Route::get('/api/payment-gateways', [PaymentGatewayController::class, 'index']);
    Route::post('/api/payment-gateways', [PaymentGatewayController::class, 'store'])->name('payment-gateways.store');
    Route::put('/api/payment-gateways/{id}', [PaymentGatewayController::class, 'update'])->name('payment-gateways.update');

 ######################### invoice pdf ###############
    // Routes for invoice functionalities
    Route::post('/generate-invoice-id', [InvoiceController::class, 'generateInvoiceId'])->name('generate-invoice-id');
    Route::post('/generate-invoice-pdf', [InvoiceController::class, 'generateInvoicePdf'])->name('generate-invoice-pdf');

    // Store invoice
    Route::post('/api/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('/api/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');

//     // Draft invoices routes
//     Route::get('/invoices/drafts', [InvoiceController::class, 'showDraftInvoices'])->name('invoices.drafts');
//     Route::post('/invoices/resend', [InvoiceController::class, 'resendInvoice'])->name('invoices.resend');
//     Route::get('/api/invoices/drafts', [InvoiceController::class, 'getDraftInvoices'])->name('api.invoices.drafts');
//     Route::post('/api/invoices/resend', [InvoiceController::class, 'resendInvoice'])->name('api.invoices.resend');

//     // Save invoice PDF
//     // Route::post('/api/invoices/save-pdf', [InvoiceController::class, 'saveInvoicePdf'])->name('invoices.save-pdf');
//     Route::post('/api/invoices/save-pdf', [InvoiceController::class, 'saveInvoicePdf']);

//     // View draft invoices page
// Route::get('/draft-invoices', function () {
//     return Inertia::render('Invoices/DraftInvoices');
// })->name('invoices.drafts.view');

// Route::get('/api/invoices/generate-id', [InvoiceController::class, 'generateInvoiceId']);
// Route::post('/api/invoices', [InvoiceController::class, 'store']);
// Route::post('/api/invoices/generate-pdf', [InvoiceController::class, 'generateInvoicePdf']);


  // Route to get draft invoices (to be used in the Vue component)
  Route::get('/draft-invoices', function () {
    return Inertia::render('Invoice/DraftInvoices');
})->name('invoices.drafts.view');

Route::get('/invoices/edit/{id}', function ($id) {
    return Inertia::render('Services/Invoice', ['id' => $id]);
})->name('invoices.edit');

Route::get('/invoices/drafts', [InvoiceController::class, 'showDraftInvoices'])->name('invoices.drafts');
Route::post('/invoices/resend', [InvoiceController::class, 'resendInvoice'])->name('invoices.resend');
Route::post('/invoices/generate-pdf', [InvoiceController::class, 'generateInvoicePdf']);
Route::delete('/invoices/{id}', [InvoiceController::class, 'deleteDraftInvoice']);

Route::get('/api/invoices/drafts', [InvoiceController::class, 'getDraftInvoices'])->name('api.invoices.drafts');
Route::get('/api/invoices/drafts/{id}', [InvoiceController::class, 'getDraftInvoiceById'])->name('api.invoices.draft');
Route::post('/api/invoices/resend', [InvoiceController::class, 'resendInvoice'])->name('api.invoices.resend');
Route::delete('/api/invoices/{id}', [InvoiceController::class, 'deleteDraftInvoice'])->name('api.invoices.delete');
Route::post('/api/invoices/save-pdf', [InvoiceController::class, 'saveInvoicePdf']);
Route::get('/api/invoices/generate-id', [InvoiceController::class, 'generateInvoiceId']);
Route::post('/api/invoices', [InvoiceController::class, 'store']);
Route::post('/api/invoices/generate-pdf', [InvoiceController::class, 'generateInvoicePdf']);
Route::get('/api/invoices/all', [InvoiceController::class, 'getAllInvoices'])->name('api.invoices.all');
    Route::post('/api/invoices/reject/{id}', [InvoiceController::class, 'rejectInvoice']);
    Route::post('/api/invoices/complete/{id}', [InvoiceController::class, 'completeInvoice']);

});




// Admin login routes
Route::get('/admin/login', function () {
    return view('admin.auth.adminlogin'); // This will render a Blade template for admin login
})->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])->middleware('guest')->name('admin.login.post');

// Admin module routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.auth.admindashboard');
    })->name('admin.dashboard');

    Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/admin/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');

    // New route for user management Blade view
    Route::get('/admin/user-management', [UserController::class, 'adminuser'])->name('admin.user-management');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'adminedit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Admin Profile Route
    Route::get('/admin/profile', [UserController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/update-profile', [UserController::class, 'profileUpdate'])->name('admin.update.profile');
});

// Admin logout route
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// General user logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Existing auth routes
require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
