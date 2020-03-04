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

Route::get('/', function () {
  return view('common_pages/home');
});
Route::get('/privacy', function () {
  return view('common_pages/privacy');
});
Route::get('/terms', function () {
  return view('common_pages/terms');
});
// update notification read_at using ajax
Route::post('notification/mark_as_read', 'Commons\NotificationController@markAsRead');

Route::namespace('Owners')->as('ownser.')->group(function () {
    Auth::routes(['verify' => true]);
});

Route::group(['prefix' => 'owner'], function () {
  //login
  Route::get('login', 'Partners\Auth\LoginController@showLoginForm')->name('partner.login');
  Route::post('login', 'Partners\Auth\LoginController@login')->name('partner.login');

  // register
  Route::get('register', 'Partners\Auth\RegisterController@showRegisterForm')->name('partner.register');
  Route::post('passwordRegister', 'Partners\Auth\RegisterController@passwordRegister')->name(
    'partner.passwordRegister'
  );
  Route::get('verify', 'Partners\Auth\RegisterController@verify')->name('partner.verify');

  // register_flow - 初期登録関連
  Route::get('/register/personal/{partner_id}', 'Partners\InitialRegisterController@createPartner')->name(
    'partner.register.personal.create'
  );
  Route::post('/register/personal', 'Partners\InitialRegisterController@store')->name(
    'partner.register.personal.store'
  );
  Route::get('register/terms/{partner_id}', 'Partners\InitialRegisterController@terms')->name('partner.register.terms');
  Route::post('register/terms', 'Partners\InitialRegisterController@agreeTerms')->name('partner.register.terms.store');
  Route::post('/register/preview/previewStore', 'Partners\InitialRegisterController@previewStore')->name(
    'partner.register.preview.previewStore'
  );
  Route::get('/register/doneRegister', 'Partners\InitialRegisterController@doneRegister')->name(
    'partner.register.doneRegister'
  );

  // password reset
  Route::get('password/reset', 'Partners\Auth\ForgotPasswordController@showLinkRequestForm')->name(
    'partner.password.request'
  );
  Route::post('password/email', 'Partners\Auth\ForgotPasswordController@sendResetLinkEmail')->name(
    'partner.password.email'
  );
  Route::get('password/reset/{token}', 'Partners\Auth\ResetPasswordController@showResetForm')->name(
    'partner.password.reset'
  );
  Route::post('password/reset', 'Partners\Auth\ResetPasswordController@reset')->name('partner.password.update');

  // invite
  Route::get('invite/register/reset/password', 'Partners\InitialRegisterController@resetPassword')->name(
    'partner.invite.register.reset.password'
  );

  // Email変更
  Route::get('setting/profile/email/update', 'Partners\ProfileController@updateEmail')->name(
    'partner.profile.email.updateEmail'
  );

  Route::group(['middleware' => ['partnerVerified:partner', 'auth:partner']], function () {
    // dashboard 契約締結前
    // HACK: statusがcompletedの場合はダッシュボードへリダイレクトするミドルウェアがあっても良き
    Route::get('not-contract', 'Partners\DashboardController@notContract')->name('partner.notContract');

    //document outsource contract(業務委託契約書)
    // HACK: namespaceも付けたい
    Route::prefix('/document/outsource-contracts')
      ->name('partner.document.outsourceContracts.')
      ->group(function () {
        // HACK: outsource用のコントローラにしたいがPartnersディレクトリのリファクタが済むまではいったんDocumentControllerに書く
        Route::get('edit/{outsource_contract_id}', 'Partners\DocumentController@editOutsource')->name('edit');
        Route::post('update-comment', 'Partners\DocumentController@updateOutsourceComment')->name('updateComment');
        Route::post('update-status', 'Partners\DocumentController@updateOutsourceStatus')->name('updateStatus');
      });

    Route::group(['middleware' => ['redirectIfNotOutsourceContracted']], function () {
      // dashboard
      Route::get('dashboard', 'Partners\DashboardController@index')->name('partner.dashboard');
    });

    // logout
    Route::post('logout', 'Partners\Auth\LoginController@logout')->name('partner.logout');
  });
});



Route::namespace('Users')->as('user.')->group(function () {
    Auth::routes(['verify' => true]);
});

Route::group(['prefix' => 'user'], function () {
    // register
    Route::get('register', 'Users\Auth\RegisterController@index')->name('user.register');
    Route::post('register', 'Users\Auth\RegisterController@register')->name('user.register');

    // login
    Route::get('login', 'Users\Auth\LoginController@index')->name('user.login');
    Route::post('login', 'Users\Auth\LoginController@login')->name('user.login');

  Route::group(['middleware' => ['verified:user', 'auth:user']], function () {
    // dashboard
    Route::get('/dashboard', 'Users\DashboardController@index')->name('user.dashboard');

    // logout
    Route::post('logout', 'Companies\Auth\LoginController@logout')->name('user.logout');
  });
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
