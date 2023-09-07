<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/', 'WelcomeController@index');


    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/change-password', 'HomeController@change_password')->name('change-account-password');
    Route::post('/change-profile', 'HomeController@change_profile')->name('change-account-profile');
    Route::post('/change-account', 'HomeController@change_account')->name('change-account-info');
    
    
    // Route::get('/test', function () {
    // return view('test', ['error' => session('error')]);
    // });

    


    Route::group([
        'prefix'     => 'admin',
        'middleware' => [
            'auth',
            'isAdmin',
            'verified',
        ],
    ], function () {
        Route::get('/', 'AdminController@index')->name('admin.view');
        Route::get('/statement_account', 'AdminController@billing')->name('admin.billing');
        //Department
        Route::resource('/departments', 'DepartmentController');
        Route::post('departments-edit', 'DepartmentController@editDepartment')->name('update-department');
        
        //Medicine Delivery
        Route::resource('/medicines', 'MedicineController');
        Route::post('edit-medicine', 'MedicineController@editMedicine')->name('update-medicine');
        Route::delete('destroy-medicine', 'MedicineController@destroymedicine')->name('destroy-medicine');

        //Laboratory Delivery
        Route::resource('/laboratory-deliveries', 'LaboratoryDeliveryController');
        Route::post('edit-lab-delivery', 'LaboratoryDeliveryController@editLabDelivery')->name('update-lab-delivery');
        Route::delete('destroy-lab-delivery', 'LaboratoryDeliveryController@destroyLabDelivery')->name('destroy-lab-delivery');

        //Radiology Delivery
        Route::resource('/radiology-deliveries', 'RadiologyDeliveryController');
        Route::post('edit-radiology-delivery', 'RadiologyDeliveryController@editRadiologyDelivery')->name('update-radiology-delivery');
        Route::delete('destroy-radiology-delivery', 'RadiologyDeliveryController@destroyRadiologyDelivery')->name('destroy-radiology-delivery');


        //Hemodialysis Delivery
        Route::resource('/dialysis-deliveries', 'HemodialysisDeliveryController');
        Route::post('edit-hemodialysis-delivery', 'HemodialysisDeliveryController@editHemodialysisDelivery')->name('update-hemodialysis-delivery');
        Route::delete('destroy-hemodialysis-delivery', 'HemodialysisDeliveryController@destroyHemodialysisDelivery')->name('destroy-hemodialysis-delivery');
    


        //Pharmacy
        Route::resource('/pharmacies', 'PharmacyController');
        Route::post('edit-pharmacy', 'PharmacyController@editPharmacy')->name('update-pharmacy');
        Route::delete('remove-pharmacy', 'PharmacyController@destroypharmacy')->name('destroy-pharmacy');
        //Pharmacy Category
        Route::get('/pharmacy-categories', 'PharmacyController@pharmaciescategory')->name('pharmacy-category');
        Route::post('pharmacy-categories-store', 'PharmacyController@pharmacycategory_store')->name('pharmacy-category-store');
        Route::post('edit-category-pharmacy', 'PharmacyController@editpharmacyCategory')->name('update-pharmacy-category');
        Route::delete('remove-category-pharmacy', 'PharmacyController@destroypharmacyCategory')->name('destroy-pharmacy-category');
        
        //Laboratory
         Route::resource('/laboratories', 'LaboratoryController');
         Route::post('edit-laboratory', 'LaboratoryController@editLaboratory')->name('update-laboratory');
         Route::delete('remove-lab', 'LaboratoryController@destroylab')->name('destroy-lab');
        //Laboratory Category
         Route::get('/laboratories-categories', 'LaboratoryController@labcategory')->name('laboratory-category');
         Route::post('laboratories-categories-store', 'LaboratoryController@labcategory_store')->name('laboratory-category-store');
         Route::post('edit-category-lab', 'LaboratoryController@editlabCategory')->name('update-lab-category');
         Route::delete('remove-category-lab', 'LaboratoryController@destroylabCategory')->name('destroy-lab-category');

         //Radiology
         Route::resource('/radiologies', 'RadiologyController');
         Route::post('edit-radiology', 'RadiologyController@editRadiology')->name('update-radiology');
         Route::delete('remove-radio', 'RadiologyController@destroyradio')->name('destroy-radio');
         //Radiology Category
         Route::get('/radiology-categories', 'RadiologyController@radiologycategory')->name('radiology-category');
         Route::post('radiologies-categories-store', 'RadiologyController@radiologycategory_store')->name('radiology-category-store');
         Route::post('edit-category-radiology', 'RadiologyController@editradiologyCategory')->name('update-radiology-category');
         Route::delete('remove-category-radiology', 'RadiologyController@destroyradioCategory')->name('destroy-radiology-category');


        //Hemodialysis
        Route::resource('/hemodialysis', 'HemodialysisController');
        Route::post('edit-hemodialysis', 'HemodialysisController@editHemodialysis')->name('update-hemodialysis');
        Route::delete('remove-hemodialysis', 'HemodialysisController@destroyhemodialysis')->name('destroy-hemodialysis');
        //Hemodialysis Category
        Route::get('/hemodialysis-categories', 'HemodialysisController@hemodialysiscategory')->name('hemodialysis-category');
        Route::post('hemodialysis-categories-store', 'HemodialysisController@hemodialysiscategory_store')->name('hemodialysis-category-store');
        Route::post('edit-category-hemodialysis', 'HemodialysisController@edithemodialysisCategory')->name('update-hemodialysis-category');
        Route::delete('remove-category-hemodialysis', 'HemodialysisController@destroyradioCategory')->name('destroy-hemodialysis-category');
          
        //Doctor is Department Staff
        Route::resource('/doctors', 'DoctorController');
        Route::post('edit-staff-department', 'DoctorController@updatestaff')->name('update-staff');
        Route::delete('remove-staff-department', 'DoctorController@destroystaff')->name('destroy-staff');
        Route::post('deactivate-department-staff', 'DoctorController@deactivatestaff')->name('deactivate-staff');
        Route::post('activate-department-staff', 'DoctorController@activatestaff')->name('activate-staff');

        //Receptionist is Malasakit Staff
        Route::resource('/receptionists', 'ReceptionistController');
        Route::post('edit-staff-malasakit', 'ReceptionistController@updatestaff')->name('update-malasakit-staff');
        Route::delete('remove-staff-malasakit', 'ReceptionistController@destroystaff')->name('destroy-malasakit-staff');
        Route::post('deactivate-malasakit-staff', 'ReceptionistController@deactivatestaff')->name('deactivate-malasakit-staff');
        Route::post('activate-malasakit-staff', 'ReceptionistController@activatestaff')->name('activate-malasakit-staff');

        //Accountant is PPP Staff
        Route::resource('/accountants', 'AccountantController');
        Route::post('edit-staff-ppp', 'AccountantController@updatestaff')->name('update-ppp-staff');
        Route::delete('remove-staff-ppp', 'AccountantController@destroystaff')->name('destroy-ppp-staff');
        Route::post('deactivate-ppp-staff', 'AccountantController@deactivatestaff')->name('deactivate-ppp-staff');
        Route::post('activate-ppp-staff', 'AccountantController@activatestaff')->name('activate-ppp-staff');


        //Inventory
        Route::get('/pharmacy-inventory', 'InventoryController@pharmacyInventory')->name('pharmacy.inventory');
        Route::get('/laboratory-inventory', 'InventoryController@laboratoryInventory')->name('laboratory.inventory');
        Route::get('/radiology-inventory', 'InventoryController@radiologyInventory')->name('radiology.inventory');

        //Others
        Route::get('/view-approve-patients', 'ReceptionistController@getApprovePatient')->name('get-approve-patients');
        Route::get('/view-complete-patients', 'ReceptionistController@getCompletePatient')->name('get-complete-patients');
        Route::get('/reports', 'AccountantController@getPPPreports')->name('get-ppp-reports');

         
    
        // Route::resource('/patients', 'PatientController');   
        Route::resource('/timeschedules', 'TimeScheduleController');
        Route::resource('/appointments', 'AppointmentController');
        Route::resource('/dayoffschedules', 'DayoffScheduleController');
        Route::get('/timeschedule/{doctor}', 'TimeScheduleController@timeSchedulesForDoctor')->name('doctor-time-schedules');
        Route::get('/timeschedule/{doctor}/create/', 'TimeScheduleController@createtimeScheduleForDoctor')->name('create-time-schedule-for-doctor');
        Route::get('/getdoctorsbydepartment/', 'AppointmentController@getDoctorsByDepartment')->name('get-doctors-by-department');
        Route::get('/gettimeschedulebydoctor/', 'DoctorController@getTimeScheduleByDoctor')->name('get-time-schedule-by-doctor');
        Route::get('/getdayoffschedulebydoctor/', 'DoctorController@getDayoffScheduleByDoctor')->name('get-dayoff-schedule-by-doctor');
        Route::get('/gettimebytimeschedule/', 'TimeScheduleController@getTimeByTimeSchedule')->name('get-time-by-time-schedule');
        Route::get('/getappointmentsbydate/', 'AppointmentController@getAppointmentsByDate')->name('get-appointments-by-date');


        Route::get('/get-all-activitylogs/', 'SettingsController@getActivitylogs')->name('get-activitylogs');
    });


    //DOCTOR ROUTE
    Route::group([
        'prefix'     => 'doctor',
        'middleware' => ['auth', 'verified'],

    ], function () {
        Route::resource('/', 'DoctorController');
        Route::post('generate-ticket', 'DoctorController@generateTicket')->name('ticket-generate');
        Route::get('get-approve-request', 'DoctorController@getApproveRequest')->name('get-approve_procedure');
        Route::get('/print-ticket/{ticket_number}', 'DoctorController@getToprintTicket')->name('get-print_ticket');
        Route::post('/complete-patient-malasakit-request', 'DoctorController@CompletePatientRequest')->name('complete-patient-request');
        Route::get('get-complete-request', 'DoctorController@getCompleteRequest')->name('get-complete_procedure');
    });


    //PATIENT ROUTE
    // Route::group([
    //     'prefix'     => 'patient',
    //     'middleware' => ['auth', 'verified'],

    // ], function () {
    //     Route::resource('/', 'PatientController');
    //     // Route::post('patient-details', 'PatientController@patient_details')->name('patient-classification');
    //     Route::post('patient-request', 'PatientController@patientRequest')->name('patient-request');
    //     Route::get('/doctor_request', 'PatientController@get_doctor_request')->name('get-doctor_request');
    //     Route::get('/patient_requests', 'PatientController@get_patient_request')->name('get-patient_request_status');
    //     Route::get('/charge_ticket', 'PatientController@get_charge_ticket')->name('get-charge_ticket-patient');
    //     Route::get('/view-charge-amount/{id}/{dep_id}', 'PatientController@getChargeTicketAmount')->name('get-patient_amount_ticket');
        
        
        
    // });


    //RECEPTIONIST ROUTE
    Route::group([
        'prefix'     => 'receptionist',
        'middleware' => ['auth', 'verified'],

    ], function () {
        Route::resource('/receptionists', 'ReceptionistController');
        // Route::get('/malasakit-form/{patient_id}', 'ReceptionistController@malasakit_form')->name('get-malasakitform');
        // Route::get('/malasakit-request', 'ReceptionistController@malasakit_patient_request')->name('get-malasakit-request');
        Route::get('/malasakit-template', 'ReceptionistController@malasakit_template')->name('get-malasakit-template');
        Route::get('/print_hospital_number/{pid}', 'ReceptionistController@patient_identification')->name('print_identification_card');
        Route::get('/view-ticket-amount/{ticket_number}', 'ReceptionistController@viewTicketamount')->name('get-ticket_amount');
        Route::get('/print-patient-malasakit/{ticket}/{pid}', 'ReceptionistController@print_malasakit')->name('print_patient_malasakit');
        Route::get('/view-approve-patients', 'ReceptionistController@getApprovePatient')->name('get-approve-patients');
        Route::get('/view-complete-patients', 'ReceptionistController@getCompletePatient')->name('get-complete-patients');
        Route::post('edit-patient-details', 'ReceptionistController@editPatient')->name('edit-patient');
        Route::post('approve-request', 'ReceptionistController@approve_patientrequest')->name('approve_request');


      

        
      
    });


    //HEAD OFFICE ROUTE
    Route::group([
        'prefix'     => 'accountant',
        'middleware' => ['auth', 'verified'],

    ], function () {
        Route::resource('/accountants', 'AccountantController');

        Route::get('/charge-tickets', 'AccountantController@getChargeTickets')->name('get-charge_ticket');
        Route::get('/charge-amount/{id}/{ticket_number}', 'AccountantController@getChargeTicketAmount')->name('get-amount_ticket');
        Route::get('/complete-request', 'AccountantController@getCompleteProcedure')->name('get-complete-procedure');
        Route::get('/reports', 'AccountantController@getPPPreports')->name('get-ppp-reports');
        Route::get('/weekly-reports', 'AccountantController@getweeklyPPPreports')->name('get-pppweekly-reports');
        Route::get('/monthly-reports', 'AccountantController@getmonthlyPPPreports')->name('get-pppmonthly-reports');
      
       
    });
}); // End of preventing going back