<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('index/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('index/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Pengumuman Controller */
	Route::get('pengumuman', 'PengumumanController@index')->name('pengumuman.index');
	Route::get('pengumuman/index/{filter?}/{filtervalue?}', 'PengumumanController@index')->name('pengumuman.index');	
	Route::get('pengumuman/view/{rec_id}', 'PengumumanController@view')->name('pengumuman.view');	
	Route::get('pengumuman/add', 'PengumumanController@add')->name('pengumuman.add');
	Route::post('pengumuman/add', 'PengumumanController@store')->name('pengumuman.store');
		
	Route::any('pengumuman/edit/{rec_id}', 'PengumumanController@edit')->name('pengumuman.edit');	
	Route::get('pengumuman/delete/{rec_id}', 'PengumumanController@delete');

/* routes for Persembahan Controller */
	Route::get('persembahan', 'PersembahanController@index')->name('persembahan.index');
	Route::get('persembahan/index/{filter?}/{filtervalue?}', 'PersembahanController@index')->name('persembahan.index');	
	Route::get('persembahan/view/{rec_id}', 'PersembahanController@view')->name('persembahan.view');	
	Route::get('persembahan/add', 'PersembahanController@add')->name('persembahan.add');
	Route::post('persembahan/add', 'PersembahanController@store')->name('persembahan.store');
		
	Route::any('persembahan/edit/{rec_id}', 'PersembahanController@edit')->name('persembahan.edit');	
	Route::get('persembahan/delete/{rec_id}', 'PersembahanController@delete');

/* routes for Renungan Controller */
	Route::get('renungan', 'RenunganController@index')->name('renungan.index');
	Route::get('renungan/index/{filter?}/{filtervalue?}', 'RenunganController@index')->name('renungan.index');	
	Route::get('renungan/view/{rec_id}', 'RenunganController@view')->name('renungan.view');	
	Route::get('renungan/add', 'RenunganController@add')->name('renungan.add');
	Route::post('renungan/add', 'RenunganController@store')->name('renungan.store');
		
	Route::any('renungan/edit/{rec_id}', 'RenunganController@edit')->name('renungan.edit');	
	Route::get('renungan/delete/{rec_id}', 'RenunganController@delete');

/* routes for User Controller */
	Route::get('user', 'UserController@index')->name('user.index');
	Route::get('user/index/{filter?}/{filtervalue?}', 'UserController@index')->name('user.index');	
	Route::get('user/view/{rec_id}', 'UserController@view')->name('user.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('user/add', 'UserController@add')->name('user.add');
	Route::post('user/add', 'UserController@store')->name('user.store');
		
	Route::any('user/edit/{rec_id}', 'UserController@edit')->name('user.edit');	
	Route::get('user/delete/{rec_id}', 'UserController@delete');

/* routes for Video Controller */
	Route::get('video', 'VideoController@index')->name('video.index');
	Route::get('video/index/{filter?}/{filtervalue?}', 'VideoController@index')->name('video.index');	
	Route::get('video/view/{rec_id}', 'VideoController@view')->name('video.view');	
	Route::get('video/add', 'VideoController@add')->name('video.add');
	Route::post('video/add', 'VideoController@store')->name('video.store');
		
	Route::any('video/edit/{rec_id}', 'VideoController@edit')->name('video.edit');	
	Route::get('video/delete/{rec_id}', 'VideoController@delete');

/* routes for Warta Controller */
	Route::get('warta', 'WartaController@index')->name('warta.index');
	Route::get('warta/index/{filter?}/{filtervalue?}', 'WartaController@index')->name('warta.index');	
	Route::get('warta/view/{rec_id}', 'WartaController@view')->name('warta.view');	
	Route::get('warta/add', 'WartaController@add')->name('warta.add');
	Route::post('warta/add', 'WartaController@store')->name('warta.store');
		
	Route::any('warta/edit/{rec_id}', 'WartaController@edit')->name('warta.edit');	
	Route::get('warta/delete/{rec_id}', 'WartaController@delete');
});


	
Route::get('componentsdata/user_user_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_user_value_exist($request);
	}
);
	
Route::get('componentsdata/user_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_email_value_exist($request);
	}
);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');