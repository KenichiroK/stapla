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

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'partner'], function(){
	
	//login   
	Route::get('login', 'Partners\Auth\LoginController@showLoginForm')->name('partner.login');
	Route::post('login', 'Partners\Auth\LoginController@login')->name('partner.login');
	
	// register   
	Route::get('register', 'Partners\Auth\RegisterController@showRegisterForm')->name('partner.register');
	Route::post('register', 'Partners\Auth\RegisterController@register')->name('partner.register');
	

	// preRegister - 仮登録後に表示させるページ
	Route::get('register/preRegistered', 'Partners\Registration\PreRegisterController@index')->name('partner.register.preRegisterd.index');

	// invite
	Route::get('invite/register/reset/password', 'Partners\InitialRegisterController@resetPassword')->name('partner.invite.register.reset.password');

	// emailverify - Eメール認証
	Route::get('email/verify/{id}/{email}/{company_id}','Partners\Auth\VerificationController@verify')->name('partner.verification.verify');
	
	Route::group(['middleware' => ['partnerVerified:partner', 'auth:partner']], function() {
		
		// register_flow - 初期登録関連
		Route::get('/register/doneVerify', 'Partners\InitialRegisterController@doneVerify')->name('partner.register.doneVerify.doneVerify');
		Route::get('/register/initialRegistration', 'Partners\InitialRegisterController@createPartner')->name('partner.register.intialRegistration.createPartner');
		Route::post('/register/initial/personal', 'Partners\InitialRegisterController@preview')->name('partner.register.intialRegistrationPost');
		Route::get('/register/preview/previwShow', 'Partners\InitialRegisterController@previwShow')->name('parnter.register.preview.previwShow');
		Route::post('/register/preview/previewStore', 'Partners\InitialRegisterController@previewStore')->name('partner.register.preview.previewStore');
		
		// dashboard
		Route::get('dashboard', 'Partners\DashboardController@index')->name('partner.dashboard');
		
		// project
		Route::get('/project', 'Partners\ProjectController@index')->name('partner.project.index');
		Route::get('/project/{project_id}', 'Partners\ProjectController@show')->name('partner.project.show');

		// task
		Route::get('/task', 'Partners\TaskController@index')->name('partner.task.index');
		Route::get('/task/{task_id}', 'Partners\TaskController@show')->name('partner.task.show');
		
		// task status change
		Route::post('/task/status', 'Partners\TaskStatusController@change')->name('partner.task.status.change');
		
		// profile
		Route::get('setting/profile', 'Partners\ProfileController@create')->name('partner.setting.profile.create');
		Route::post('setting/profile', 'Partners\ProfileController@store')->name('partner.setting.profile.store');
		
		//  invoice setting
		Route::get('setting/invoice', 'Partners\Setting\InvoiceController@create')->name('partner.setting.invoice.create');
		Route::post('setting/invoice', 'Partners\Setting\InvoiceController@store')->name('partner.setting.invoice.store');
		
		// notification setting
		Route::get('setting/notification', 'Partners\Setting\NotificationController@create')->name('partner.setting.notification.create');
		Route::post('setting/notification', 'Partners\Setting\NotificationController@store')->name('partner.setting.notification.store');
		
		// purchase-order
		Route::get('document/order/{id}', 'Partners\PurchaseOrderController@show')->name('partner.document.purchaseOrder.show');
		
		// invoice
		Route::get('document/invoice/create/{task_id}', 'Partners\InvoiceController@create')->name('partner.document.invoice.create');
		Route::post('invoice', 'Partners\InvoiceController@store')->name('partner.invoice.store');
		Route::get('document/invoice/{id}', 'Partners\InvoiceController@show')->name('partner.document.invoice.show');

		// logout
    	Route::post('logout', 'Partners\Auth\LoginController@logout')->name('partner.logout');
	});
});



Route::group(['prefix' => 'company'], function(){

	// login
	Route::get('login', 'Companies\Auth\LoginController@showLoginForm')->name('company.login');
	Route::post('login', 'Companies\Auth\LoginController@login')->name('company.login');

	// register - 1st企業ユーザー仮登録
	Route::get('pre-register', 'Companies\Auth\PreRegisterController@showRegisterForm')->name('company.PreRegister');
	Route::post('pre-register', 'Companies\Auth\PreRegisterController@register')->name('company.PreRegister');

	// preRegister - 1st企業ユーザー仮登録完了ページ
	Route::get('/register/preRegistered', 'Companies\Registration\PreRegisterController@index')->name('company.register.preRegisterd.index');

	// register - 企業ユーザー本登録
	Route::get('register', 'Companies\Auth\RegisterController@showRegisterForm')->name('company.register');
	Route::post('register', 'Companies\Auth\RegisterController@register')->name('company.register');
	
	
	Route::group(['middleware' => ['verified:company', 'auth:company']], function() {

		// invite companyUser - 招待による企業ユーザー仮登録
		Route::get('invite-preRegister', 'Companies\Auth\InvitePreRegisterController@showRegisterForm')->name('company.invitePreRegister');
		Route::post('invite-preRegister', 'Companies\Auth\InvitePreRegisterController@register')->name('company.invitePreRegister');
		
		// register_flow
		Route::get('/register/doneVerify', 'Companies\InitialRegisterController@doneVerify')->name('company.register.doneVerify');
		Route::get('/register/personal', 'Companies\Registration\PersonalController@create')->name('company.register.personal.create');
		Route::post('/register/company-and-personal', 'Companies\Registration\PersonalController@companyStore')->name('company.register.company-and-personal.store');
		Route::post('/register/personal', 'Companies\Registration\PersonalController@store')->name('company.register.personal.store');
		Route::get('/register/preview', 'Companies\Registration\PreviewController@create')->name('company.register.preview.create');
		Route::post('/register/company-preview', 'Companies\Registration\PreviewController@companyStore')->name('company.register.company-preview.store');
		Route::post('/register/preview', 'Companies\Registration\PreviewController@store')->name('company.register.preview.store');
		
		// dashboard
		Route::get('/dashboard', 'Companies\DashboardController@index')->name('company.dashboard');
		
		// project
		Route::get('/project', 'Companies\ProjectController@index')->name('company.project.index');
		Route::get('/project/done', 'Companies\ProjectController@doneIndex')->name('company.project.done.index');
		Route::get('/project/create', 'Companies\ProjectController@create')->name('company.project.create');
		Route::post('/project', 'Companies\ProjectController@store')->name('company.project.store');
		Route::get('/project/{id}', 'Companies\ProjectController@show')->name('company.project.show');

		// task
		Route::get('/task', 'Companies\TaskController@index')->name('company.task.index');
		// task statusIndex
		Route::get('task/status/{task_status}', 'Companies\TaskController@statusIndex')->name('company.task.status.statusIndex');
		Route::get('/task/create', 'Companies\TaskController@create')->name('company.task.create');
        Route::post('/task', 'Companies\TaskController@store')->name('company.task.store');
		Route::get('/task/{id}', 'Companies\TaskController@show')->name('company.task.show');
		
		// task status change
		Route::post('task/status', 'Companies\TaskStatusController@change')->name('company.task.status.change');
		
		// partner
		Route::get('/partner', 'Companies\PartnerController@index')->name('company.partner.index');
		Route::get('/partner/{id}', 'Companies\PartnerController@show')->name('company.partner.show');
		
		// document
		Route::get('/document', 'Companies\DocumentController@index')->name('company.document.index');
		Route::get('/document/nda', 'Companies\Document\NdaController@create')->name('company.document.nda.create');
		Route::post('/document/nda', 'Companies\Document\NdaController@store')->name('company.document.nda.store');
		Route::get('/document/nda/{nda_id}', 'Companies\Document\NdaController@show')->name('company.document.nda.show');
		Route::get('/document/purchaseOrder/create/{task_id}', 'Companies\Document\PurchaseOrderController@create')->name('company.document.purchaseOrder.create');
		Route::post('/document/purchaseOrder', 'Companies\Document\PurchaseOrderController@store')->name('company.document.purchaseOrder.store');
		Route::get('/document/purchaseOrder/{purchaseOrder_id}', 'Companies\Document\PurchaseOrderController@show')->name('company.document.purchaseOrder.show');

		// document	outsourcing_contract
		Route::get('/document/outsourcingContract', 'Companies\Document\OutsourcingContractController@create')->name('company.document.OutsourcingContract.create');
		Route::get('/document/outsourcingContract/{id}', 'Companies\Document\OutsourcingContractController@show')->name('company.document.OutsourcingContract.show');

		//document invoice
		Route::get('/document/invoice/{invoice_id}', 'Companies\Document\InvoiceController@show')->name('company.document.invoice.show');


		// setting
		Route::get('/setting/general', 'Companies\Setting\GeneralController@create')->name('company.setting.general.create');
		Route::post('/setting/general', 'Companies\Setting\GeneralController@update')->name('company.setting.general.update');
		Route::get('/setting/companyElse', 'Companies\Setting\CompanyElseController@create')->name('company.setting.companyElse.create');
		Route::post('/setting/companyElse', 'Companies\Setting\CompanyElseController@store')->name('company.setting.companyElse.store');
		Route::get('/setting/userSetting', 'Companies\Setting\UserSettingController@create')->name('company.setting.userSetting.create');
		Route::get('/setting/account', 'Companies\Setting\AccountController@create')->name('company.setting.account.create');
		Route::get('/setting/personalInfo', 'Companies\Setting\PersonalInfoController@create')->name('company.setting.personalInfo.create');
		Route::post('/setting/personalInfo', 'Companies\Setting\PersonalInfoController@store')->name('company.setting.personalInfo.store');

		// invite partner - 招待によるパートナー仮登録
		Route::get('invite/partner', 'Partners\Auth\InvitePreRegisterController@showRegisterForm')->name('company.invite.partner');
		Route::post('invite/partner', 'Partners\Auth\InvitePreRegisterController@register')->name('company.invite.partner');

        // logout
		Route::post('logout', 'Companies\Auth\LoginController@logout')->name('company.logout');

	});  
});
