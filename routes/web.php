<?php

Route::get('/', function () 
{
    return view('auth.login');
});

Auth::routes();
Route::post('/custom/login', 'CustomLoginController@LoginValidation');
//Route::get('/home', 'HomeController@index')->name('home');


//------------------------------------------------------------Admin Module-------------------------------------------------------
//Admin DashBoard
Route::get('/adminDashboard','AdminDashBoardController@index')->name('AdminDashBoard')->middleware('admin','pbh');
//Worker
Route::resource('/adminWorker', 'AdminWorkerController')->middleware('admin','pbh');
Route::post('/adminWorkerView', 'AdminWorkerController@view')->middleware('admin','pbh');

//Contract
Route::get('/adminContract', 'AdminContractController@index')->middleware('admin','pbh');

//Schedule
Route::get('/adminSchedule', 'AdminScheduleController@index')->middleware('admin','pbh');

//Location
Route::resource('/adminLocation', 'LocationController');

//Work
Route::resource('/adminWork', 'WorkController');
Route::put('/UpdateWork','WorkController@updateWork')->middleware('admin','pbh');

//Attendace
Route::get('/adminUploadAttendance', 'AdminAttedanceController@uploadAttendace')->middleware('admin','pbh');
Route::post('/adminSearchDTR','AdminAttedanceController@searhDTR')->middleware('admin','pbh');

//Salary
Route::get('/adminSalaryIndex','AdminSalaryController@index')->middleware('admin','pbh');
Route::post('/adminSalarySearch','AdminSalaryController@salarySearch')->middleware('admin','pbh');
Route::post('/adminSalarEarn','AdminSalaryController@salaryEarn')->middleware('admin','pbh');
    
//Passsword
Route::get('/resetPasswordIndex','PasswordController@index')->middleware('admin','pbh');
Route::put('/resetPassword','PasswordController@ResetPassword')->middleware('admin','pbh');

Route::get('/logs', 'LogsController@index');
Route::post('/searchLogs', 'LogsController@search');



//------------------------------------------------------------HR Module-------------------------------------------------------
//HR DashBoard
Route::get('/HrDashboard','HrDashBoardController@index')->middleware('hr','pbh');
//Worker
Route::resource('/hrWorker', 'HrWorkerController')->middleware('hr','pbh');
Route::post('/HrWorkerView', 'HrWorkerController@view')->middleware('hr','pbh');
//Contract
Route::resource('/hrContract', 'HrContractController')->middleware('hr','pbh');
Route::get('/hrcreate/contract/{workerId}','HrContractController@createContract')->middleware('hr','pbh');
Route::get('/hrstore/contract/{workerId}','HrContractController@storeContract')->middleware('hr','pbh');
Route::get('/hrregister/contract', 'HrContractController@registerContract')->middleware('hr','pbh');
Route::get('/hrexpire/contract', 'HrContractController@expiringContract')->middleware('hr','pbh');
Route::get('/hredit/contract/{workerId}/{contractId}', 'HrContractController@editContract')->middleware('hr','pbh');
Route::post('/hrUpdateContractPhoto','HrContractController@UpdateContractPhoto')->middleware('hr','pbh');
//Schedule
Route::resource('/hrSchedule', 'HrScheduleController')->middleware('hr','pbh');
//Attendace
Route::get('/hrUploadAttendance', 'HrAttendanceController@uploadAttendace')->middleware('hr','pbh');
Route::post('/hrStoreAttedance','HrAttendanceController@storeAttendance')->middleware('hr','pbh');
Route::post('/hrSearchDTR','HrAttendanceController@searhDTR')->middleware('hr','pbh');
//Salary
Route::get('/hrSalaryIndex','HrSalaryController@index')->middleware('hr','pbh');
Route::post('/hrSalarySearch','HrSalaryController@salarySearch')->middleware('hr','pbh');
Route::post('/hrSalarEarn','HrSalaryController@salaryEarn')->middleware('hr','pbh');
//laeve
Route::get('/hrGrantLeave', 'HrLeaveController@grantLeave')->middleware('hr','pbh');
Route::post('/hrStoreLeave', 'HrLeaveController@StoreLeave')->middleware('hr','pbh');
Route::get('/hrIndexLeave', 'HrLeaveController@index')->middleware('hr','pbh');
//Report
Route::get('/adminDtrReport','ReportController@dtrReport')->middleware('hr','pbh');
Route::post('/adminDtrReportSearch','ReportController@dtrReportSearch')->middleware('hr','pbh');
Route::get('/adminContractReport','ReportController@contractReport')->middleware('hr','pbh');
Route::post('/adminContractReportSearch','ReportController@contractReportSearch')->middleware('hr','pbh');
Route::get('/adminSalaryReport','ReportController@salaryReport')->middleware('hr','pbh');
Route::post('/adminSalaryReportSearch','ReportController@salaryReportSearch')->middleware('hr','pbh');

Route::get('/notify','SMSController@notify')->middleware('hr','pbh');



//------------------------------------------------------------Worker Module-------------------------------------------------------
Route::get('/myProfile','WorkerModuleController@profile')->middleware('worker','pbh');
Route::get('/myContract','WorkerModuleController@contract')->middleware('worker','pbh');
Route::get('/mySched','WorkerModuleController@task')->middleware('worker','pbh');
Route::get('/myDTR','WorkerModuleController@dtr')->middleware('worker','pbh');
Route::post('/searchDTR','WorkerModuleController@dtrSearch')->middleware('worker','pbh');
Route::get('/mySalary','WorkerModuleController@salary')->middleware('worker','pbh');
Route::post('/searchSalary','WorkerModuleController@salarySearch')->middleware('worker','pbh');
Route::get('/myLeave','WorkerModuleController@myLeave')->middleware('worker','pbh');

//------------------------------------------------------------MPP Module----------------------------------------------------------
Route::get('/mppProfile','MppModuleController@profile')->middleware('mpp','pbh');
Route::get('/mppTask','MppModuleController@task')->middleware('mpp','pbh');
Route::get('/mppSupervisory','MppModuleController@supervisory')->middleware('mpp','pbh');


//------------------------------------------------------------Change Password----------------------------------------------------------
Route::get('/cpform', 'PasswordController@CPForm');
Route::get('/changePassword', 'PasswordController@changePassword');