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

//Dashboard Section from Here
Route::get('/', 'dashboardController@index');
Route::get('dashboard', 'dashboardController@index');

//User Section
Route::get('setup_user', 'UserController@index');
Route::post('user/store', 'UserController@store');
Route::post('user/delete/', 'UserController@destroy');
Route::post('user/change_status/', 'UserController@changeStatus');
Route::post('user/lock/', 'UserController@lock');
Route::post('user/unlock/', 'UserController@lock');
Route::post('user/edit/', 'UserController@edit');
Route::post('user/update/', 'UserController@update');

//User profile sections
Route::get('profile', 'UserController@profile');


//Location Section
Route::get('setup_location', 'LocationController@index');
Route::post('division/store', 'LocationController@divisionStore');
Route::post('zone/store', 'LocationController@zoneStore');
Route::post('region/store', 'LocationController@regionStore');
Route::post('area/store', 'LocationController@areaStore');
Route::post('territory/store', 'LocationController@territoryStore');
Route::post('data/edit', 'LocationController@getEditData');
Route::post('division/update', 'LocationController@divisionUpdate');
Route::post('zone/update', 'LocationController@zoneUpdate');
Route::post('region/update', 'LocationController@regionUpdate');
Route::post('area/update', 'LocationController@areaUpdate');
Route::post('territory/update', 'LocationController@territoryUpdate');
Route::post('change_location_status', 'LocationController@changeLocationStatus');
Route::post('data/delete', 'LocationController@dataDelete');

Route::post('district_by_division', 'LocationController@getDistrictByDivision');
Route::post('thana_by_district', 'LocationController@getThanaByDistrict');
Route::post('zip_by_thana', 'LocationController@getZipByThana');

Route::post('zone_by_division', 'LocationController@getZoneByDivision');
Route::post('region_by_zone', 'LocationController@getRegionByZone');
Route::post('area_by_region', 'LocationController@getAreaByRegion');
Route::post('territory_by_area', 'LocationController@getTerritoryByArea');



Route::get('login', 'HomeController@login');
Route::post('login', 'HomeController@postLogin');
Route::get('logout', 'HomeController@logout');
Route::get('doctor_details', 'HomeController@doctorDetails');

Route::get('prescription', 'PrescriptionController@index');
Route::get('filter_prescription', 'PrescriptionController@filterPrescription');
Route::post('prescription/get_images', 'PrescriptionController@getImages');
Route::post('prescription/change_status', 'PrescriptionController@changeStatus');
Route::post('search_prescription', 'PrescriptionController@searchPrescription');

Route::get('chemist_dcr', 'HomeController@chemistDcr');

//Settings
Route::get('user_role_permission', 'PermissionController@index');
Route::post('update_role_permission', 'PermissionController@updateRolePermission');
Route::post('get_sub_features', 'PermissionController@getSubfeatures');
Route::post('get_feature_actions', 'PermissionController@getFeatureActions');
Route::get('location_maping', 'HomeController@locationMaping');

Route::get('doctor_sp_day_type', 'HomeController@doctorSpDayType');
Route::get('general_sp_day_type', 'HomeController@generalSpDayType');

//Reports
//Route::get('doctor_report', 'HomeController@doctorReport');
Route::get('top_products', 'HomeController@topProducts');
Route::get('notifications', 'HomeController@notifications');
Route::get('massage_template', 'HomeController@massageTemplate');

//Report sections
Route::get('am_list','ReportController@amList');
Route::get('am_report/{id}', 'ReportController@amReport');
Route::post('am_report/{id}', 'ReportController@amReport');
Route::post('report/getChemisDcr', 'ReportController@getChemisDcr');
Route::get('mpo_report/{id}','ReportController@mpoReport');
Route::post('mpo_report/{id}','ReportController@mpoReport');
Route::get('mpo_list','ReportController@mpoList');
Route::post('report/getDoctorDcr', 'ReportController@getDoctorDcr');
Route::post('get_doctor_detail_ajax', 'ReportController@getDoctorDetailAjax');
Route::post('get_chemist_detail_ajax', 'ReportController@getChemistDetailAjax');

Route::get('prescription_report', 'ReportController@prescriptionReport');
Route::post('/report/MpoPrescription', 'ReportController@MpoPrescription');
Route::post('/report/MpoPrescriptionFilter', 'ReportController@MpoPrescriptionFilter');

Route::get('zone_report', 'ReportController@zoneReport');
Route::post('zone_report', 'ReportController@zoneReport');
Route::get('report_activity', 'ReportController@reportActivity');
Route::post('report_activity', 'ReportController@reportActivity');
Route::post('report_activity_detail_ajax', 'ReportController@reportActivityDetailAjax');
Route::get('report_order', 'ReportController@reportOrder');
Route::post('report_order', 'ReportController@reportOrder');
//Class Section
Route::get('create_doctor_class', 'ClassController@DoctorClass');
Route::get('create_chemist_class', 'ClassController@chemistClass');
Route::post('/chemist/getChemistClass', 'ClassController@getChemistClass');
Route::post('/chemist/ChemistClassStore', 'ClassController@ChemistClassStore');
Route::post('/chemistClass/getEditVal', 'ClassController@ChemistGetEditVal');
Route::post('/chemist/ChemistClassUpdate', 'ClassController@ChemistClassUpdate');
Route::post('/chemist/delChemistClass', 'ClassController@delChemistClass');

Route::post('/Doctor/getDoctorClass', 'ClassController@getDoctorClass');
Route::post('/Doctor/DoctorClassStore', 'ClassController@DoctorClassStore');
Route::post('/DoctorClass/getEditVal', 'ClassController@DoctorGetEditVal');
Route::post('/Doctor/DoctorClassUpdate', 'ClassController@DoctorClassUpdate');
Route::post('/Doctor/delDoctorClass', 'ClassController@delDoctorClass');

//Doctor Speciality Section
Route::get('/create_doctor_speciality', 'SpecialityController@DoctorSpeciality');
Route::post('/Doctor/getDoctorSpeciality', 'SpecialityController@getDoctorSpeciality');
Route::post('/Doctor/DoctorSpecialityStore', 'SpecialityController@DoctorSpecialityStore');
Route::post('/DoctorSpeciality/getEditVal', 'SpecialityController@DoctorGetEditVal');
Route::post('/Doctor/DoctorSpecialityUpdate', 'SpecialityController@DoctorSpecialityUpdate');
Route::post('/Doctor/delDoctorSpeciality', 'SpecialityController@delDoctorSpeciality');

Route::get('create_dspDay', 'SpecialityController@specialDay');
Route::post('getDoctorSpecialDay', 'SpecialityController@getDoctorSpecialDay');
Route::post('SpecialDayStore', 'SpecialityController@SpecialDayStore');
Route::post('getSpecialDayVal', 'SpecialityController@getSpecialDayVal');
Route::post('SpecialDayUpdate', 'SpecialityController@SpecialDayUpdate');
Route::post('delSpecialDay', 'SpecialityController@delSpecialDay');

//Chemist Categories Section
Route::get('chemist_category', 'ChemistController@chemistCategory');
Route::post('/chemist/getChemistCategory', 'ChemistController@getChemistCategory');
Route::post('/chemist/ChemistCategoryStore', 'ChemistController@ChemistCategoryStore');
Route::post('/chemistCategory/getEditVal', 'ChemistController@ChemistGetEditVal');
Route::post('/chemist/ChemistCategoryUpdate', 'ChemistController@ChemistCategoryUpdate');
Route::post('/chemist/delChemistCategory', 'ChemistController@delChemistCategory');

//Chemist special date type section
Route::get('chemist_sp_day_type', 'ChemistController@chemistSpDayType');
Route::post('getChemistSpecialDayType', 'ChemistController@getChemistSpecialDayType');
Route::post('ChemistSpecialDayStore', 'ChemistController@ChemistSpecialDayStore');
Route::post('getChemistSpDayEditVal', 'ChemistController@getChemistSpDayEditVal');
Route::post('ChemistSpecialDayTypeUpdate', 'ChemistController@ChemistSpecialDayTypeUpdate');
Route::post('delChemistSpecialDayType', 'ChemistController@delChemistSpecialDayType');

//Doctor special date type section
Route::get('doctor_sp_day_type', 'DoctorController@doctorSpDayType');
Route::post('getdoctorSpecialDayType', 'DoctorController@getdoctorSpecialDayType');
Route::post('doctorSpecialDayStore', 'DoctorController@doctorSpecialDayStore');
Route::post('getdoctorSpDayEditVal', 'DoctorController@getdoctorSpDayEditVal');
Route::post('doctorSpecialDayTypeUpdate', 'DoctorController@doctorSpecialDayTypeUpdate');
Route::post('deldoctorSpecialDayType', 'DoctorController@deldoctorSpecialDayType');

//Chemist Section
Route::get('chemist_list', 'ChemistController@chemistList');
Route::get('/chemist/getChemist', 'ChemistController@getChemist');
Route::post('/chemist/chemistStore', 'ChemistController@chemistStore');
Route::get('chemist_details/{id}', 'ChemistController@chemistDetails');
Route::post('/chemist_details_ajax', 'ChemistController@chemistDetailAjax');
Route::post('/chemist/chemistUpdate', 'ChemistController@chemistUpdate');
Route::post('/chemist/change_chemist_status', 'ChemistController@changeChemistStatus');
Route::post('chemistReviewData', 'ChemistController@chemistReviewData');
Route::post('/reject_edit_request', 'ChemistController@rejectEditRequest');


//Product Management Sections
Route::get('product_list', 'ProductController@index');
Route::get('/product/getProducts', 'ProductController@getProducts');
Route::post('/product/ProductStore', 'ProductController@ProductStore');
Route::post('/product/ProductDelete', 'ProductController@ProductDelete');
Route::post('/product/getEditVal', 'ProductController@getEditVal');
Route::post('/product/ProductUpdate', 'ProductController@ProductUpdate');

//Doctor Management Sections
Route::get('doctor_list', 'DoctorController@index');
Route::get('/doctor/getDoctor', 'DoctorController@getDoctor');
Route::post('/doctor/doctorStore', 'DoctorController@doctorStore');
Route::get('/doctor_details/{id}', 'DoctorController@doctorDetails');
Route::post('doctor_details_ajax', 'DoctorController@doctorDetailAjax');
Route::post('/doctor/doctorUpdate', 'DoctorController@doctorUpdate');
Route::post('/doctor/doctorDelete', 'DoctorController@doctorDelete');
Route::post('/doctor/accept_reject', 'DoctorController@doctorAcceptReject');
Route::post('/doctor/decline_doctor_changes', 'DoctorController@declineDoctorChanges');

Route::get('doctor_events', 'DoctorController@getDoctorEvents');

Route::get('doctor_dcr', 'DoctorController@doctorDcr');

// Terget setup section
Route::get('setup_target', 'TergetController@viewTerget');
Route::post('/terget/getTergetList', 'TergetController@getTergetList');
Route::post('/target/storeTerget', 'TergetController@storeTerget');
Route::post('/target/getEditVal', 'TergetController@getEditVal');
Route::post('/target/updateTerget', 'TergetController@updateTerget');


Route::get('404_page', 'HomeController@page_404');


