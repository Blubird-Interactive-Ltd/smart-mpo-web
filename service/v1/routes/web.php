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

Route::get('/', 'HomeController@index');

/*Authentication*/
Route::post('authenticate_imei','AuthenticationController@authenticateImei');
Route::post('register','AuthenticationController@register');
Route::post('app_login','AuthenticationController@appLogin');
Route::post('app_logout','AuthenticationController@appLogout');
Route::post('force_logout','AuthenticationController@forceLogout');

/*User section*/
Route::post('user/search','UserController@userSearch');

/*Doctor section*/
Route::post('doctor/create','DoctorController@create');
Route::post('doctor/filter','DoctorController@filter');
Route::post('doctor/search','DoctorController@search');
Route::post('doctor/update','DoctorController@update');
Route::post('doctor/details','DoctorController@details');
Route::post('doctor/list','DoctorController@doctorList');
Route::post('doctor/specialities','DoctorController@specialities');
Route::post('doctor/special_day_types','DoctorController@specialDayTypes');
Route::post('doctor/classes','DoctorController@classes');
Route::post('doctor/ppms','DoctorController@ppms');
Route::post('doctor/add_chamber','DoctorController@addChamber');


/*Chemist section*/
Route::post('chemist/create','ChemistController@create');
Route::post('chemist/filter','ChemistController@filter');
Route::post('chemist/search','ChemistController@search');
Route::post('chemist/update','ChemistController@update');
Route::post('chemist/details','ChemistController@details');
Route::post('chemist/special_day_types','ChemistController@specialDayTypes');
Route::post('chemist/categories','ChemistController@categories');
Route::post('chemist/classes','ChemistController@classes');

/*Doctor DCR*/
Route::post('doctor_dcr/create','DoctorDcrController@create');
Route::post('doctor_dcr/update','DoctorDcrController@update');

/*Chemist DCR*/
Route::post('chemist_dcr/create','ChemistDcrController@create');
Route::post('chemist_dcr/update','ChemistDcrController@update');

/*Territory*/
Route::post('territory/list','TerritoryController@territoryList');

/*Product*/
Route::post('product/list','ProductController@productList');
Route::post('product/search','ProductController@productSearch');

/*Prescriptions*/
Route::post('prescription/create','PrescriptionController@create');
Route::post('prescription/update','PrescriptionController@update');

/*Report section*/
Route::post('report/prescription','ReportController@prescription');
Route::post('report/prescription/reject_details','ReportController@prescriptionRejectDetails');
Route::post('calendar/special_day_count','ReportController@specialDayCount');
Route::post('calendar/calendar_day_details','ReportController@calendarDayDetails');
Route::post('target/get','ReportController@getTargets');

/*Address*/
Route::post('address/address_list','AddressController@addressList');
Route::post('address/district_by_divion','AddressController@districtByDivision');
Route::post('address/thana_by_district','AddressController@thanaByDistrict');
Route::post('address/zip_by_thana','AddressController@zipByThana');

/*Templates*/
Route::post('template/sms_template','TemplateController@smsTemplate');

Route::get('push_notification','FCMController@pushNotification');
