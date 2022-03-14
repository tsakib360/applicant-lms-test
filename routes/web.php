<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentCourseController;
use App\Http\Controllers\Admin\ManageGatewayController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');

        // START:: Student
        Route::resource('student',StudentController::class);
        Route::get('get-email',[StudentController::class, 'getEmail'])->name('get-email');
        //END

        // START:: Course
        Route::resource('course',CourseController::class);
        Route::get('get-code',[CourseController::class, 'getCode'])->name('get-code');
        //END

        Route::resource('student_course',StudentCourseController::class);

        // START:: Paypal, Stripe
        Route::get('gateway/paypal', [ManageGatewayController::class, 'paypal'])->name('payment.paypal');
        Route::post('gateway/paypal', [ManageGatewayController::class, 'paypalUpdate']);

        Route::get('gateway/stripe', [ManageGatewayController::class, 'stripe'])->name('payment.stripe');
        Route::post('gateway/stripe', [ManageGatewayController::class, 'stripeUpdate']);
        //END
    });
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function() {

    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

    Route::get('gateways/{course_id}', [PaymentController::class, 'gateways'])->name('gateways');

    Route::post('paynow', [PaymentController::class, 'paynow'])->name('paynow');

    Route::get('gateways/{id}/details', [PaymentController::class, 'gatewaysDetails'])->name('gateway.details');

    Route::post('gateways/{id}/details', [PaymentController::class, 'gatewayRedirect']);
});


