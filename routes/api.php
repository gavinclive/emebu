<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

Route::resource('event-type', 'EventTypeController');
Route::resource('event-category', 'EventCategoryController');
Route::resource('event', 'EventController');
Route::resource('coupon', 'CouponController');
Route::post('hide-event', 'EventController@hideEvent');
Route::resource('transaction', 'TransactionController');
Route::resource('ticket', 'TicketController');
Route::post('coupon-check', 'CouponController@checkCoupon');
Route::get('payment-info', 'UserController@paymentInfo');
Route::resource('quill', 'QuillController');
Route::resource('users', 'UserController');
Route::post('history', 'TransactionController@history');
Route::resource('featured', 'FeaturedEventController');
Route::post('investigate', 'EventController@investigateEvent');
Route::post('reactivate', 'EventController@reactivateEvent');
Route::resource('analytics', 'EventViewsController');
Route::resource('report', 'ReportController');
Route::resource('rating', 'RatingController');
Route::post('check-rating', 'RatingController@checkExist');
Route::get('eo-score', 'RatingController@getEoRating');