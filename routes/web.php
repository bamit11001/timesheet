<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now crc32(str)eate something great!
|
*/
Auth::routes();

Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');


Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/clear-cache', function() {
  $exitCode = Artisan::call('cache:clear');
  // return what you want
});
//================
/*************************************** employer Start **************************************************** */
Route::prefix('employer')->group(function() {

  //Employer Register
  Route::get('/register', 'Auth\EmployerLoginController@showRegisterForm')->name('employer.register');
  Route::post('/register', 'Auth\EmployerLoginController@create')->name('employer.register.submit');
  
  //Employer Profile
  Route::get('/profile', 'EmployerController@editProfile')->name('employer.editprofile');
  Route::post('/edit-profile', 'EmployerController@saveProfile')->name('employer.profile.submit');
  Route::get('/update_user_profile', 'EmployerController@UpdateUserProfile')->name('employer.update');
  Route::post('/update_user', 'EmployerController@UserProfileData')->name('employer.update.submit');


  //Employer
  Route::get('/view_profile', 'EmployerController@profilview')->name('employer.view_profile');
  Route::get('/update_profile', 'EmployerController@Edit_Profile')->name('employer.update_profile');

  Route::post('/update_profile', 'EmployerController@updateProfile')->name('employer.update_profile.submit');

  Route::get('/message','EmployerController@messageInbox')->name('employer.message');
  Route::post('/inbox.message','EmployerController@inboxMessage')->name('employer.inbox.message');
  Route::post('/send.message','EmployerController@sendMessage')->name('employer.send.message');
 
  
  //Emplyer Profile Country
  Route::post('/getstates','EmployerController@getStates');
  Route::post('/getcities','EmployerController@getCities');

  //Job Post
  Route::get('/job-post', 'JobPostController@index')->name('employer.jobpost');
  Route::post('/job-submit', 'JobPostController@create')->name('employer.jobpost.create');
  Route::get('/jobs', 'JobPostController@show')->name('employer.jobs');
  Route::post('/updatejob', 'JobPostController@updatestatus')->name('update.status');
  Route::post('/delete.job', 'JobPostController@deletejob')->name('delete.job');
  Route::get('/filter', 'JobPostController@show')->name('filter.job');

  //Canditate Resume
  Route::get('/canditate', 'JobAppliedController@index')->name('canditate.resume');
  Route::post('/interview-status', 'JobAppliedController@interviewstatus')->name('candidate.interview.status');
  Route::post('/delete.appliedjob', 'JobAppliedController@deletejob')->name('delete.appliedjob');
  Route::get('/candidate-profile', 'JobAppliedController@show')->name('candidate.profile');
  Route::post('/enable.chat', 'JobAppliedController@enableChat')->name('employer.enable.chat');

  //Employer login
  Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employer.login');
  Route::post('/login', 'Auth\EmployerLoginController@login')->name('employer.login.submit');
  Route::get('/logout' , 'Auth\EmployerLoginController@logout')->name('employer.logout');

  //Employer Notification
  Route::post('/notification', 'EmployerController@employer_notification')->name('employer.notification');
  Route::post('/update.notification', 'EmployerController@update_employer_notification')->name('update.employer.notification');

 //Password reset routes
  Route::get('reset', 'Auth\Pass\ForgotPasswordController@showLinkRequestForm')->name('employer.reset');
  Route::post('email', 'Auth\Pass\ForgotPasswordController@sendResetLinkEmail')->name('employer_password.email');
  Route::get('reset/{token}', 'Auth\Pass\ResetPasswordController@showResetForm');
  Route::post('reset', 'Auth\Pass\ResetPasswordController@reset')->name('employer.reset');


  // Route::get('/', 'EmployerController@index')->name('employer.dashboard');
  Route::middleware(['checkprofilecomplete'])->group(function () {
  Route::get('/', 'EmployerController@index')->name('employer.dashboard');
  });
});
/*************************************** employee End**************************************************** */
Route::prefix('employee')->group(function() {


});

Route::get('/admin/profilees','HomeController@AdminProfile'); 
Route::get('/homee', 'HomeController@index')->name('homee');
Route::get('/emplyeehome', 'HomeController@emplyeehome')->name('emplyeehome');
Route::get('/defaulthome', 'HomeController@defaulthome')->name('defaulthome');

//forgot password
Route::get('/reset', 'ResetPasswordController@ResetsPasswords1')->name('reset');
Route::post('/resetpassword', 'HomeController@ResetsPasswords')->name('resetpassword');

//Route::get('/getdata','HomeController@getdata')->name('getdata');

/*************************************** employee Start**************************************************** */
Route::prefix('employee')->group(function() {

  //Emplyer Register
  // Route::get('/register', 'Auth\EmployerLoginController@showRegisterForm')->name('employee.register');
  // Route::post('/register', 'Auth\EmployerLoginController@create')->name('employee.register.submit');
  Route::get('/logout', 'Auth\LoginController@logout'); 

  //Forgot password vinay
  // Route::get('/password/reset', 'Employee\EmployeeController@ResetPassword')->name('resetpassword'); 
  // Route::post('/password/reset1', 'Auth\LoginController@reset')->name('reset.password'); 
  
  //Employer login open comment vinay
  // Route::get('/login', 'Auth\EmployerLoginController@showLoginForm')->name('employee.login');
  // Route::post('/login', 'Auth\EmployerLoginController@login')->name('employee.login.submit');
  // Route::get('/logout' , 'Auth\EmployerLoginController@logout')->name('employee.logout');
  // Route::get('/', 'EmployerController@index')->name('employer.dashboard');
   
  
  Route::group( ['namespace' => 'Employee'], function()
  {
    Route::get('/', 'EmployeeController@index')->name('employee.home');
    // Route::get('/', 'EmployeeController@home')->name('employee.home');
    // Route::post('/joblist', 'EmployeeController@jobList')->name('employee.joblist');
    Route::get('/joblist', 'EmployeeController@jobList')->name('employee.joblist');
    Route::get('/jobdetail', 'EmployeeController@jobDetail')->name('employee.jobdetail');
    Route::post('/postapplyjob', 'EmployeeController@postApplyJob')->name('employee.postapplyjob');
    Route::get('/profile' , 'EmployeeController@ViewProfile')->name('employee.profile');
    Route::get('/editprofile' , 'EmployeeController@editProfile')->name('employee.editprofile');
    Route::post('/saveprofileimage' ,'EmployeeController@saveProfileImage')->name('employee.saveprofileimage');

    Route::post('/posteditprofile' , 'EmployeeController@postEditProfile')->name('employee.posteditprofile');
    Route::post('/saveresume' ,'EmployeeController@saveResume')->name('employee.saveresume');
    //Delete Resume vnk
    Route::post('/deleteresume' , 'EmployeeController@deleteResume')->name('employee.delete.resume');

    //Messages vnk
    Route::get('/message','EmployeeController@messageInbox')->name('employee.message');
    Route::post('/inbox.message','EmployeeController@inboxMessage')->name('employee.inbox.message');
    Route::post('/send.message','EmployeeController@sendMessage')->name('employee.send.message');

    ///sociallink
    
  });

  Route::get('/home', 'HomeController@index')->name('home');
  
});
Route::get ( '/redirect/{service}', 'SocialAuthGoogleController@redirect' );


/*************************************** employee End**************************************************** */