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

Auth::routes();

Route::group(['prefix' => 'partner'], function(){
	//login   
	Route::get('login', 'Partners\Auth\LoginController@showLoginForm')->name('partner.login');
	Route::post('login', 'Partners\Auth\LoginController@login')->name('partner.login');
	
	//register
	Route::get('register/{company_id}/{email}', 'Partners\Auth\RegisterController@showRegisterForm')->name('partner.register');
	Route::post('register/{company_id}', 'Partners\Auth\RegisterController@register')->name('partner.register');

	// preRegister - 仮登録後に表示させるページ
	Route::get('register/preRegistered', 'Partners\Registration\PreRegisterController@index')->name('company.register.preRegisterd.index');

	// invite
	Route::get('invite/register/reset/password', 'Partners\InitialRegisterController@resetPassword')->name('partner.invite.register.reset.password');

	// emailverify - Eメール認証
	Route::middleware('throttle:6,1')->get('email/resend','Partners\Auth\VerificationController@resend')->name('partner.verification.resend');
	Route::middleware('throttle:6,1')->get('email/verify','Partners\Auth\VerificationController@show')->name('partner.verification.notice');
	Route::middleware('signed')->get('email/verify/id/{id}/company_id/{company_id}','Partners\Auth\VerificationController@verify')->name('partner.verification.verify');
	
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
		Route::get('/project/{project_id}', 'Partners\ProjectController@show')->name('partner.project.show');

		// task
		Route::get('/task/{id}', 'Partners\TaskController@show')->name('partner.task.show');
		
		// task status change
		Route::post('/task/status', 'Partners\TaskStatusController@change')->name('task.status.change');
		
		// profile
		Route::get('profile', 'Partners\ProfileController@create')->name('partner.profile.create');
		Route::post('profile', 'Partners\ProfileController@store')->name('partner.profile.store');
		
		//  invoice setting
		Route::get('setting/invoice', 'Partners\Setting\InvoiceController@create')->name('partner.setting.invoice.create');
		Route::post('setting/invoice', 'Partners\Setting\InvoiceController@store')->name('partner.setting.invoice.store');
		
		// notification setting
		Route::get('setting/notification', 'Partners\Setting\NotificationController@create')->name('partner.setting.notification.create');
		Route::post('setting/notification', 'Partners\Setting\NotificationController@store')->name('partner.setting.notification.store');
		
		// purchase-order
		Route::get('order/{id}', 'Partners\PurchaseOrderController@show')->name('partner.purchaseOrder.show');
		
		// invoice
		Route::get('invoice/create/{id}', 'Partners\InvoiceController@create')->name('partner.invoice.create');
		Route::post('invoice', 'Partners\InvoiceController@store')->name('partner.invoice.store');
		Route::get('invoice/{id}', 'Partners\InvoiceController@show')->name('partner.invoice.show');
		Route::post('invoice/send', 'Partners\InvoiceController@send')->name('partner.invoice.send');

		// logout
    	Route::post('logout', 'Partners\Auth\LoginController@logout')->name('partner.logout');
	});
});



Route::group(['prefix' => 'company'], function(){

	// login
	Route::get('login', 'Companies\Auth\LoginController@showLoginForm')->name('company.login');
	Route::post('login', 'Companies\Auth\LoginController@login')->name('company.login');

	//register
	Route::get('register', 'Companies\Auth\RegisterController@showRegisterForm')->name('company.register');
	Route::post('register', 'Companies\Auth\RegisterController@register')->name('company.register');
	
	// preRegister
	Route::get('/register/preRegistered', 'Companies\Registration\PreRegisterController@index')->name('company.register.preRegisterd.index');


	// emailverify
	Route::middleware('throttle:6,1')->get('email/resend','Companies\Auth\VerificationController@resend')->name('company.verification.resend');
	Route::middleware('throttle:6,1')->get('email/verify','Companies\Auth\VerificationController@show')->name('company.verification.notice');
	Route::middleware('signed')->get('email/verify/{id}','Companies\Auth\VerificationController@verify')->name('company.verification.verify');
	
	Route::group(['middleware' => ['verified:company', 'auth:company']], function() {
		
		// register_flow
		Route::get('/register/doneVerify', 'Companies\InitialRegisterController@doneVerify')->name('company.register.doneVerify');
		Route::get('/register/personal', 'Companies\Registration\PersonalController@create')->name('company.register.personal.create');
		Route::post('/register/personal', 'Companies\Registration\PersonalController@store')->name('company.register.personal.store');
		Route::get('/register/preview', 'Companies\Registration\PreviewController@create')->name('company.register.preview.create');
		Route::post('/register/preview', 'Companies\Registration\PreviewController@store')->name('company.register.preview.store');
		
		// dashboard
		Route::get('/dashboard', 'Companies\DashboardController@index')->name('company.dashboard');
		
		// project
		Route::get('/project', 'Companies\ProjectController@index')->name('company.project.index');
		Route::get('/project/done', 'Companies\ProjectController@doneIndex')->name('company.project.done.index');
		Route::get('/project/create', 'Companies\ProjectController@create')->name('company.project.create');
		Route::post('/project', 'Companies\ProjectController@store')->name('company.project.create');
		Route::get('/project/{id}', 'Companies\ProjectController@show')->name('company.project.show');

		// task
		Route::get('/task', 'Companies\TaskController@index')->name('company.task.index');
		Route::get('/task/done', 'Companies\TaskController@doneIndex')->name('company.task.done.index');
		Route::get('/task/create', 'Companies\TaskController@create')->name('company.task.create');
        Route::post('/task/create', 'Companies\TaskController@store')->name('company.task.create');
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
		Route::get('/document/nda/{id}', 'Companies\Document\NdaController@show')->name('company.document.nda.show');
		Route::get('/document/purchaseOrder/create/{id}', 'Companies\Document\PurchaseOrderController@create')->name('company.document.purchaseOrder.edit');
		Route::post('/document/purchaseOrder', 'Companies\Document\PurchaseOrderController@store')->name('company.document.purchaseOrder.store');
		Route::get('/document/purchaseOrder/{id}', 'Companies\Document\PurchaseOrderController@show')->name('company.document.purchaseOrder.show');

		// document	outsourcing_contract
		Route::get('/document/outsourcingContract', 'Companies\Document\OutsourcingContractController@create')->name('company.document.OutsourcingContract.create');
		Route::get('/document/outsourcingContract/{id}', 'Companies\Document\OutsourcingContractController@show')->name('company.document.OutsourcingContract.show');

		//document invoice
		Route::get('/document/invoice/{id}', 'Companies\Document\InvoiceController@show')->name('company.invoice.show');


		// setting
		Route::get('/setting/general', 'Companies\Setting\GeneralController@create')->name('company.setting.general.create');
		Route::post('/setting/general', 'Companies\Setting\GeneralController@update')->name('company.setting.general.update');
		Route::get('/setting/companyElse', 'Companies\Setting\CompanyElseController@create')->name('company.setting.companyElse.create');
		Route::post('/setting/companyElse', 'Companies\Setting\CompanyElseController@store')->name('company.setting.companyElse.store');
		Route::get('/setting/userSetting', 'Companies\Setting\UserSettingController@create');
		Route::get('/setting/account', 'Companies\Setting\AccountController@create');
		Route::get('/setting/personalInfo', 'Companies\Setting\PersonalInfoController@edit')->name('company.setting.personalInfo.edit');
		Route::post('/setting/personalInfo', 'Companies\Setting\PersonalInfoController@update')->name('company.setting.personalInfo.update');
        
		// mail(CompnayUser)
		Route::get('/mail/company-index', 'Companies\CompanyUserMailController@index')->name('company.mail.company-index');
		Route::post('/mail/company-send', 'Companies\CompanyUserMailController@send')->name('company.mail.company-send');

        // mail(CompnayUser)
        Route::get('/companyMail', 'Companies\CompanyUserMailController@index')->name('company.companyMail.index');
        Route::post('/companyMail/send', 'Companies\CompanyUserMailController@send')->name('company.mail.companyMail.send');

		// mail(Partner)
		Route::get('/userMail', 'Companies\PartnerMailController@index')->name('company.userMail.index');
		Route::post('/mail/partner-send', 'Companies\PartnerMailController@send')->name('company.mail.partner-send');

		// invite
		Route::get('invite/partner', 'Companies\Invite\InvitePartnerController@index')->name('company.invite.partner.index');
		Route::post('invite/partner',  'Companies\Invite\InvitePartnerController@send')->name('company.invite.partner.send');
		Route::get('invite/company', 'Companies\InitialRegisterController@invite')->name('company.invite.company.form');

        // logout
		Route::post('logout', 'Companies\Auth\LoginController@logout')->name('company.logout');

	});  
});
