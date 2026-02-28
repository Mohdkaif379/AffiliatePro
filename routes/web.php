<?php

use App\Http\Controllers\Accountant\AccountantController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Advertiser\AdvertiserController;
use App\Http\Controllers\AdvertiserAssignedOffer\AdvertiserAssignedOfferController;
use App\Http\Controllers\AdvertiserReport\AdvertiserReportController;
use App\Http\Controllers\Analytics\AnalyticsController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Offers\OfferController;
use App\Http\Controllers\Roles\RolesController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\State\StateController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\Language\LanguageController;
use App\Http\Controllers\AssignedOffer\AssignedOfferController;
use App\Http\Controllers\Attendence\AttendenceController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\EmployeeAssignedOffer\EmployeeAssignedOfferController;
use App\Http\Controllers\EmployeeReport\EmployeeReportController;
use App\Http\Controllers\HR\HRController;
use App\Http\Controllers\HrAssignedOffer\HrAssignedOfferController;
use App\Http\Controllers\HrReport\HrReportController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\ManagerAssignedOffer\ManagerAssignedOfferController;
use App\Http\Controllers\ManagerReport\ManagerReportController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\SendEmail\SendEmailController;
use App\Http\Controllers\Tracking\TrackingController;
use App\Http\Controllers\UpdateProfile\UpdateProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{user}/update', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{user}/delete', [AdminController::class, 'destroy'])->name('admin.destroy');


Route::get('offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('offers/create', [OfferController::class, 'create'])->name('offers.create');
Route::post('offers', [OfferController::class, 'store'])->name('offers.store');
Route::get('offers/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
Route::post('offers/{offer}update', [OfferController::class, 'update'])->name('offers.update');
Route::delete('offers/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
Route::get('offers/{randomUrl}', [OfferController::class, 'show'])->name('offers.show');
Route::get('offers/{randomUrl}/click', [OfferController::class, 'click'])->name('offers.click');

Route::post('assigned-offers', [AssignedOfferController::class, 'store'])->name('assigned_offers.store');
Route::get('assigned/offers/index', [AssignedOfferController::class, 'index'])->name('assigned_offers.index');


Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RolesController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RolesController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}/update', [RolesController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}/delete', [RolesController::class, 'destroy'])->name('roles.destroy');

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');
Route::get('/cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
Route::put('/cities/{city}/update', [CityController::class, 'update'])->name('cities.update');
Route::delete('/cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');


Route::get('/states', [StateController::class, 'index'])->name('states.index');
Route::get('/states/create', [StateController::class, 'create'])->name('states.create');
Route::post('/states/store', [StateController::class, 'store'])->name('states.store');
Route::get('/states/{state}/edit', [StateController::class, 'edit'])->name('states.edit');
Route::put('/states/{state}/update', [StateController::class, 'update'])->name('states.update');
Route::delete('/states/{state}/delete', [StateController::class, 'destroy'])->name('states.destroy');



Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
Route::post('/countries/store', [CountryController::class, 'store'])->name('countries.store');
Route::get('/countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
Route::put('/countries/{country}/update', [CountryController::class, 'update'])->name('countries.update');
Route::delete('/countries/{country}/delete', [CountryController::class, 'destroy'])->name('countries.destroy');


Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');        // List all languages
Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create'); // Show add form
Route::post('/languages', [LanguageController::class, 'store'])->name('languages.store');        // Save new language
Route::get('/languages/{language}/edit', [LanguageController::class, 'edit'])->name('languages.edit'); // Show edit form
Route::put('/languages/{language}', [LanguageController::class, 'update'])->name('languages.update'); // Update language
Route::delete('/languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy'); // Delete language

Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');

Route::get('/send-email/{offer}', [SendEmailController::class, 'send'])->name('send.email.send');
Route::post('/send-email/{offer}', [SendEmailController::class, 'sendEmail'])->name('send.email.send.post');


Route::get('/advertiser/index', [AdvertiserController::class, 'index'])->name('advertiser.index');

Route::get('/manager/index', [ManagerController::class, 'index'])->name('manager.index');

Route::get('/hr/index', [HRController::class, 'index'])->name('hr.index');

Route::get('/employees/index', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('/accountant/index', [AccountantController::class, 'index'])->name('accountant.index');
Route::get('/accountant/billing', [AccountantController::class, 'billingForm'])->name('accountant.billing');
Route::post('/accountant/invoice/generate', [AccountantController::class, 'generateInvoiceFromForm'])->name('accountant.invoice.generate');
Route::get('/accountant/invoice/{user}', [AccountantController::class, 'generateInvoice'])->name('accountant.invoice');
Route::get('/accountant/invoice/{user}/pdf-browser', [AccountantController::class, 'generateInvoiceBrowsershot'])->name('accountant.invoice.browsershot');

Route::get('/advertiser/report', [AdvertiserReportController::class, 'getClickCount'])
     ->name('advertiser.report');

Route::get('/manager/report', [ManagerReportController::class, 'getClickCount'])
     ->name('manager.report');

Route::get('/hr/report', [HrReportController::class, 'getClickCount'])
     ->name('hr.report');

Route::get('/employee/report', [EmployeeReportController::class, 'getClickCount'])
     ->name('employee.report');

Route::get('/all/report', [ReportController::class, 'getAllReports'])
     ->name('all.report');


Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');


Route::get('/advertiser/assigned/offers', [AdvertiserAssignedOfferController::class, 'advertiserOffers'])->name('advertiser.offers');
Route::get('/manager/assigned/offers', [ManagerAssignedOfferController::class, 'managerOffers'])->name('manager.offers');
Route::get('/hr/assigned/offers', [HrAssignedOfferController::class, 'hrOffers'])->name('hr.offers');
Route::get('/employee/assigned/offers', [EmployeeAssignedOfferController::class, 'employeeOffer'])->name('employee.offers');



Route::get('/attendance', [AttendenceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/mark-in', [AttendenceController::class, 'markIn'])->name('attendance.markin');
Route::get('/attendance/mark-out/{id}', [AttendenceController::class, 'markOut'])->name('attendance.markout');
Route::delete('/attendance/{id}', [AttendenceController::class, 'destroy'])->name('attendance.destroy');


Route::get('/profile', [UpdateProfileController::class, 'get_profile'])->name('profile');
Route::post('/update/profile', [UpdateProfileController::class, 'update_profile'])->name('update.profile');
