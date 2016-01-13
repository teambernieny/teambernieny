<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::group(['middleware' => 'auth'], function () {
  # Landing page
  Route::get('/', 'DataController@gethome');


  # Search Home
  Route::get('/search', 'SearchController@getSearch');
  Route::post('/search', 'SearchController@postSearch');

  # View volunteers
  Route::get('/volSearchZip', 'VolunteerController@getSearchZip');
  Route::post('/volSearchZip', 'VolunteerController@postSearchZip');
  Route::get('/volSearchName', 'VolunteerController@getSearchName');
  Route::post('/volSearchName', 'VolunteerController@postSearchName');
  Route::get('/volSearchEvent', 'VolunteerController@getSearchEvent');
  Route::post('/volSearchEvent', 'VolunteerController@postSearchEvent');
  Route::get('/volAll', 'VolunteerController@getAll');


  # View Events
  Route::get('/eventSearchNeighborhood', 'EventController@getSearchNeighborhood');
  Route::post('/eventSearchNeighborhood', 'EventController@postSearchNeighborhood');
  Route::get('/eventSearchDate', 'EventController@getSearchDate');
  Route::post('/eventSearchDate', 'EventController@postSearchDate');
  Route::get('/eventAll', 'EventController@getAll');


  # Add/edit volunteers
  Route::get('/checkVolunteer', 'VolunteerController@getCheck');
  Route::post('/checkVolunteer', 'VolunteerController@postCheck');
  Route::get('/addVolunteer', 'VolunteerController@getAdd');
  Route::post('addVolunteer', 'VolunteerController@postAdd');
  Route::post('/editVolunteer', 'VolunteerController@postEdit');

  # Add/edit attendees from specific events
  Route::get('/checkAttendee', 'AttendeeController@getCheckAttendee');
  Route::post('/checkAttendee', 'AttendeeController@postCheckAttendee');
  Route::post('/addAttendee', 'AttendeeController@postAddAttendee');
  Route::post('/addAttendance', 'AttendeeController@postAddAttendance');
  Route::get('/editAttendance', 'AttendeeController@getEditAttendance');
  Route::post('/editAttendance', 'AttendeeController@postEditAttendance');





  #Add/edit events
  Route::get('/addEvent', 'EventController@getAdd');
  Route::post('/addEvent', 'EventController@postAdd');
  Route::get('/editEvent', 'EventController@getEdit');
  Route::post('/editEvent', 'EventController@postEdit');

  #Add/edit files
  Route::get('/addFile', 'FileController@getAdd');
  Route::post('/addFile', 'FileController@postAdd');

  #Add/edit users
  Route::get('/addUser', 'UserController@getAdd');
  Route::post('/addUser','UserController@postAdd');

  # DataCleanUP
  Route::get('/datahome', 'DataController@getdatahome');

});

# Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

# Process logout
Route::get('/logout', 'Auth\AuthController@getLogout');

# Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');

# Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {
  Route::group(['middleware' => 'auth'], function () {
    # Landing page
    Route::get('/', 'DataController@gethome');


    # Search Home
    Route::get('/search', 'SearchController@getSearch');
    Route::post('/search', 'SearchController@postSearch');

    # View volunteers
    Route::get('/volSearchZip', 'VolunteerController@getSearchZip');
    Route::post('/volSearchZip', 'VolunteerController@postSearchZip');
    Route::get('/volSearchName', 'VolunteerController@getSearchName');
    Route::post('/volSearchName', 'VolunteerController@postSearchName');
    Route::get('/volSearchEvent', 'VolunteerController@getSearchEvent');
    Route::post('/volSearchEvent', 'VolunteerController@postSearchEvent');
    Route::get('/volAll', 'VolunteerController@getAll');


    # View Events
    Route::get('/eventSearchNeighborhood', 'EventController@getSearchNeighborhood');
    Route::post('/eventSearchNeighborhood', 'EventController@postSearchNeighborhood');
    Route::get('/eventSearchDate', 'EventController@getSearchDate');
    Route::post('/eventSearchDate', 'EventController@postSearchDate');
    Route::get('/eventAll', 'EventController@getAll');


    # Add/edit volunteers
    Route::get('/checkVolunteer', 'VolunteerController@getCheck');
    Route::post('/checkVolunteer', 'VolunteerController@postCheck');
    Route::get('/addVolunteer', 'VolunteerController@getAdd');
    Route::post('addVolunteer', 'VolunteerController@postAdd');
    Route::post('/editVolunteer', 'VolunteerController@postEdit');

    # Add/edit attendees from specific events
    Route::get('/checkAttendee', 'AttendeeController@getCheckAttendee');
    Route::post('/checkAttendee', 'AttendeeController@postCheckAttendee');
    Route::post('/addAttendee', 'AttendeeController@postAddAttendee');
    Route::post('/addAttendance', 'AttendeeController@postAddAttendance');
    Route::get('/editAttendance', 'AttendeeController@getEditAttendance');
    Route::post('/editAttendance', 'AttendeeController@postEditAttendance');

    #Add/edit events
    Route::get('/addEvent', 'EventController@getAdd');
    Route::post('/addEvent', 'EventController@postAdd');
    Route::get('/editEvent', 'EventController@getEdit');
    Route::post('/editEvent', 'EventController@postEdit');

    #Add/edit files
    Route::get('/addFile', 'FileController@getAdd');
    Route::post('/addFile', 'FileController@postAdd');
    Route::post('/completeFile', 'FileController@postComplete');
    Route::post('/completeFileReg', 'FileController@postCompleteReg');
    Route::get('/editFile', 'FileController@getEdit');
    Route::post('/editFile', 'FileController@postEdit');

    #Add/edit users
    Route::get('/addUser', 'UserController@getAdd');
    Route::post('/addUser','UserController@postAdd');

    #AdminDashboard
    Route::get('/adminHome', 'HomeController@getAdminHome');

  });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');
});
