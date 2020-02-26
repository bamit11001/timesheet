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
    return view('frontend.home');
});

//temp data for some time
    

//end

Auth::routes();
/*  login after redarect custom home page or dashboard */
Route::middleware(['auth'])->group(function () {

    Route::get ( 'admin/department/',function(){ return view('admin.review'); })->name('department_categories');    
    Route::get ( 'admin/review/',function(){ return view('admin.review'); })->name('review');    
    Route::get ( 'admin/job/show/', function () { $data = DB::table('jobs')->get(); return view ( 'admin.pages.job.show' )->withData ( $data ); } )->name('show');
    Route::get ( 'admin/job/edit/', function () { $data = DB::table('jobs')->get(); return view ( 'admin.pages.job.edit' )->withData ( $data ); } )->name('edit');
    Route::get ( 'admin/job/preview/', function () { $data = DB::table('jobs')->get(); return view ( 'admin.pages.job.preview' )->withData ( $data ); } )->name('jobpreview');
    Route::get ( 'admin/resume/', function () { return view ( 'admin.pages.recieve_resume' ); } )->name('resume');
    Route::get ( 'admin/signup/', function () { return view ( 'admin.pages.register' ); } )->name('signup');
    Route::POST('admin/job/getUserData','JobController@getUserData')->name('userData');
    Route::get('/admin/message','HomeController@MessageInbox'); 
    Route::get('/admin/profilees','HomeController@AdminProfile'); 

    Route::group( ['namespace' => 'Admin'], function()
    {
            Route::resource('admin/home','AdminController');
            Route::resource('admin/job','JobController');
    });

});

Route::POST('user/job/getUserData','JobController@UserProfile')->name('userprofile');



Route::get('/registeru', 'HomeController@registeru')->name('registeru');
Route::post('/registeruser', 'HomeController@registerUser')->name('registeruser');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/insertbuy_us','HomeController@insertbuy_us');
Route::get('/part3','HomeController@part3');
Route::get('/part4','Homecontroller@part4');

Route::get('logout','HomeController@logout');
Route::get('/job','HomeController@find_job')->name('job');
Route::get('/salrayyy','Homecontroller@salrayyy');

Route::get('/user_sign_up','HomeController@user_sign_up');  
Route::post('/employer_signup','HomeController@employer_signup'); 

Route::get('/employe_sign_up','HomeController@employe_sign_up');
Route::post('/candidate','HomeController@candidate');

Route::get('/employee/userprofile', 'HomeController@UserProfile')->name('userprofile');
Route::post('/employee/profile', 'HomeController@User_Profile_data');

Route::post('/homeuser','HomeController@homeuser');
Route::get('/contact_us','HomeController@contact_us');
Route::post('/contact_u','HomeController@contact_u');
Route::get('/salary','HomeController@salary_page');
Route::get('/resume','HomeController@resume'); 

Route::post('/buy_us_data','HomeController@buy_us_data');
Route::get('/buy_us','HomeController@buy_us');
Route::get('/jobs','HomeController@jobs');
Route::get('/employer','HomeController@employer');
Route::get('/', function () {
    return view('admin.review');
});
//Route::get('/review','Admin/LoginController@review');

Route::get('/review','HomeController@company_review');

Route::get('admin/department','CategoriesController@department');
Route::post('admin/inset','CategoriesController@inset');

Route::group( ['namespace' => 'Admin'], function()
{
        Route::resource('admin/home','CategoriesController');
        Route::resource('admin/department','CategoriesController');
});

//Route::get('login','HomeController@user_login');

Route::get('/admin/insertdata','DepartmentController@insertdata');
Route::post('/admin/inserted','DepartmentController@inserted');
//Route::get('/admin/registeradd','DepartmentController@showdata');
Route::get('/admin/showdata','DepartmentController@showdata');
//Route::post('admin/showdata','DepartmentController@shown');
Route::get('/admin/showdataem','DepartmentController@showdataem');


Route::get('/usercontroller/path',[
    'middleware' => 'First',
    'uses' => 'UserController@showPath'
 ]);


Route::prefix('employee')
 ->as('employee.')
 ->group(function() {

    Route::get('home', 'Home\EmployeeHomeController@index')->name('home');
    Route::namespace('Auth\Login')
   ->group(function(){
        Route::get('login', 'EmployeeController@showLoginForm')->name('login');
        Route::post('login', 'EmployeeController@login')->name('login');
        Route::post('logout', 'EmployeeController@logout')->name('logout');
    });
});