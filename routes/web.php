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

// Route::group(['prefix' => '{lang?}', 'where' => ['lang' => "en|ar"]], function(){
	Route::get('/validate-otp', 'AccountController@validateOtp')->name('validateOtp');
	Route::post('/validate-otp', 'AccountController@validateOtpPost');
	Route::view('/sign-in', 'signIn')->name('signIn');
	Route::post('/sign-in', 'AccountController@postSignIn')->name('signIn');

	Route::group(['middleware' => 'guest'], function (){
		Route::view('/sign-up', 'signUp')->name('signUp');
		Route::post('/sign-up', 'AccountController@postSignUp')->name('signUp');
		Route::get('/user/verify/{token}', 'AccountController@verifyUser');
		Route::get('/verify/resend-verfication', 'AccountController@resendVerfication')->name('resendVerification');
		Route::post('/verify/resend-verfication', 'AccountController@resendVerficationPost');

		Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
		Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
		Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('password.request');
		Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
	});

	Route::group(['middleware' => 'isUser'], function (){

		Route::get('/', 'DashboardController@dashboard')->name('dashboard');
		Route::get('/add-children', 'ChildController@addChildren')->name('addchildren');
		Route::post('/add-children', 'ChildController@addChildrenPost');
		Route::get('/list-children', 'ChildController@listChildren')->name('listChildren');
		Route::get('/edit-children/{id}', 'ChildController@editChild')->name('editChild');
		Route::post('/edit-children/{id}', 'ChildController@editChildPost');
		Route::get('/delete-child/{id}', 'ChildController@deleteChild')->name('deleteChild');
		Route::get('/add-program', 'ProgramController@addProgram')->name('addProgram');
		Route::post('/add-program', 'ProgramController@addProgramPost');
		Route::get('/list-program', 'ProgramController@listPrograms')->name('listProgram');
		Route::get('/subscribe-form/{id}', 'ProgramController@subscribeForm')->name('subscribeForm');
		Route::post('/subscribe-form/{id}', 'ProgramController@subscribeFormPost');
		Route::get('/unsubscribe/{id}', 'ProgramController@unsubscribe')->name('unsubscribe');
		Route::get('/monthly-subscription/{id}', 'ProgramController@monthlySubscription')->name('monthlySubscription');
		Route::get('/profile-update', 'AccountController@profileUpdate')->name('profileUpdate');
		Route::post('/profile-update', 'AccountController@profileUpdatePost');

		Route::view('/password-update', 'updatePassword')->name('updatePassword');
		Route::post('/password-update', 'AccountController@updatePassword')->name('updatePassword');
	});
// });


Route::get('/logout', 'AccountController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
	Route::view('/login', 'admin.login')->name('admin.login');
	Route::group(['middleware' => 'isAdmin'], function (){

		Route::get('/', 'DashboardController@getDashboard')->name('admin.index');
        Route::get('/statistics-data/{year}', 'DashboardController@statisticsData')->name('admin.statisticsData');

		Route::get('/list-user', 'UserController@listUser')->name('admin.listUser');
		Route::get('/view-user/{id}', 'UserController@viewUsers')->name('admin.viewUsers');
		Route::get('/user-active-inactive/{id}', 'UserController@activeInactive')->name('admin.userActiveInactive');

		Route::get('/list-program', 'ProgramController@listProgram')->name('admin.listProgram');
		Route::get('/add-program', 'ProgramController@addProgram')->name('admin.addProgram');
		Route::post('/add-program', 'ProgramController@addProgramPost');
		Route::get('/edit-program/{id}', 'ProgramController@editProgram')->name('admin.editProgram');
		Route::post('/edit-program/{id}', 'ProgramController@editProgramPost');
		Route::get('/delete-program/{id}', 'ProgramController@deleteProgram')->name('admin.deleteProgram');
		Route::get('/program-active-inactive/{id}', 'ProgramController@activeInactive')->name('admin.programActiveInactive');

		Route::get('/list-editor', 'EditorController@listEditor')->name('admin.listEditor');
		Route::get('/add-editor', 'EditorController@addEditor')->name('admin.addEditor');
		Route::post('/add-editor', 'EditorController@addEditorPost');
		Route::get('/edit-editor/{id}', 'EditorController@editEditor')->name('admin.editEditor');
		Route::post('/edit-editor/{id}', 'EditorController@editEditorPost');
		Route::get('/delete-editor/{id}', 'EditorController@deleteEditor')->name('admin.deleteEditor');
		Route::get('/editor-active-inactive/{id}', 'EditorController@activeInactive')->name('admin.editorActiveInactive');
		Route::get('/update-profile', 'AccountController@updateProfile')->name('admin.updateProfile');
		Route::post('/update-profile', 'AccountController@updateProfilePost');

	    Route::get('/change-password', 'AccountController@changePassword')->name('admin.changePassword');
	    Route::post('/change-password', 'AccountController@changePasswordPost');
    });
});


