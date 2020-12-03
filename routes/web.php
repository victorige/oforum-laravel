<?php

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

Route::get('/', 'Homepage@index')->name('index');
Route::get('-/{id}', 'Homepage@postview')->name('post');
Route::get('--/{id}', 'Homepage@pageview')->name('page');


Auth::routes();
Route::get('redirector', 'Redirector@index')->name('redirector');
Route::get('/home', 'HomeController@index')->name('home');

/** Login Social */
Route::get('auth/social', 'Auth\SocialAuthController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');

/** Phone Verify */
Route::get('verify/phone', 'PhoneVerifyController@show')->name('verify.phone');
Route::post('phone/enter', 'PhoneVerifyController@enter')->name('enter.phone');

/** Payment */
Route::get('payment/opt', 'Payment@optionview')->name('opt.payment');
Route::post('option/payment', 'Payment@option')->name('option.payment');
Route::get('make/payment', 'Payment@make')->name('make.payment');
Route::get('processing', 'Payment@process')->name('process.payment');
/** Coupon */
Route::get('coupon/enter', 'Coupon@enter')->name('coupon.payment');
Route::post('coupon/verify', 'Coupon@verify')->name('coupon.verify');
Route::get('buy/coupon', 'Coupon@buy')->name('buy.coupon');

/** Referral */
Route::get('refer/enter', 'Referral@enter')->name('refer.enter');
Route::post('refer/verify', 'Referral@verify')->name('refer.verify');
Route::get('refer/skip', 'Referral@skip')->name('refer.skip');
Route::get('r/{id}', 'Link@link')->name('refer.link');

/** Bank */
Route::get('enter/bank', 'Bank@enter')->name('enter.bank');
Route::post('confirm/bank', 'Bank@confirm')->name('confirm.bank');
Route::get('bank/yes', 'Bank@yes')->name('yes.bank');
Route::get('bank/no', 'Bank@no')->name('no.bank');

/** Dashboard */
Route::get('dashboard', 'Dashboard@home')->name('dashboard');

/** Edit Bank */
Route::get('edit/bank', 'Bank@editenter')->name('edit.bank');
Route::get('edit/bank?confirm=1', 'Bank@editenter')->name('edit2.bank');
Route::post('edit/confirm/bank', 'Bank@editconfirm')->name('editconfirm.bank');

/** Refer */
Route::get('refer', 'Referral@refer')->name('refer');

/** Request Payout */
Route::get('request/payout', 'Payout@Request')->name('request.payout');

/** Payout History */
Route::get('history/payout', 'Payout@history')->name('history.payout');

/** Agent Payout */
Route::get('agent/payout', 'Payout@agent')->name('agent.payout');

/** Pages */
Route::get('--/about', 'Homepage@pageview')->name('about');
Route::get('--/buy-coupon', 'Homepage@pageview')->name('buy-coupon');
Route::get('--/faq', 'Homepage@pageview')->name('faq');
Route::get('--/policy', 'Homepage@pageview')->name('policy');
Route::get('--/terms', 'Homepage@pageview')->name('terms');
Route::get('--/disclaimer', 'Homepage@pageview')->name('disclaimer');
Route::get('--/contact', 'Homepage@pageview')->name('contact');
Route::get('--/how', 'Homepage@pageview')->name('how');
Route::get('--/copyright', 'Homepage@pageview')->name('copyright');
Route::get('--/smart-guys', 'Homepage@pageview')->name('smart-guys');
Route::get('payout', 'Homepage@list')->name('payout');

/** Oshare */
Route::get('oshare', 'Dashboard@Oshare')->name('oshare');

/** Giveaway */
Route::get('giveaway', 'Dashboard@giveaway')->name('processgiveaway');

/** Link Banner */
Route::get('banner', 'Link@banner')->name('banner');

/** Webhook */
Route::post('webhook', 'Link@webhook')->name('webhook');

/** Live Score */
Route::get('livescore', 'Link@livescore')->name('livescore');

//Route::get('test', 'Link@test')->name('test.link');

Route::get('cal155', 'Toffs@cal155')->name('cal155');

/**
 * Route::get('dashboard', function () {
 *  return "dashboard";
 * })->name('dashboard');
 */

//Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
//Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

//Route::get('cc', 'Toffs@cc')->name('cc');
Route::get('cq', 'Toffs@cq')->name('cq');

/** Toffs */
/**
* Route::get('toffs', 'Toffs@toffs')->name('toffs');
* Route::get('toffs/sms', 'Toffs@sms')->name('toffs.sms');
* Route::get('toffs/table', 'Toffs@table')->name('toffs.table');
* Route::get('toffs/comment', 'Toffs@comment')->name('toffs.commnet');

*/
