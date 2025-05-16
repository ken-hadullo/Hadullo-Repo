<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileManagerController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProjectsManagerController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\DocumentsManagementController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\DocumentReviewController;
use App\Http\Controllers\AdminManagerController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\SpecialitiesController;
use App\Http\Controllers\DocumentEvaluationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ReviewResponseController;
use App\Http\Controllers\Auth\RegistrationMailController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard Routes
//Route::get('/dashboard', [DashboardController::class, 'redirect'])->middleware(['auth', 'verified'])->name('dashboard');




// User Verification Route


// Frontend Routes Group
Route::controller(NotificationsController::class)->group(function () {
    
     

    // Notifications Routes
    Route::get('/notifications', 'viewNotifications')->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read',  'markAsRead')->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', 'markAllAsRead')->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}/delete',  'deleteNotification')->name('notifications.delete');
    Route::delete('/notifications/delete-all', 'deleteAllNotifications')->name('notifications.deleteAll');
});



  Route::controller(ReviewResponseController::class)->group(function () {
        
    Route::get('/sdcs-form/{id}', 'showSDCSForm')->name('reviewDocument');
        
    Route::post('/document-reviews/{reviewId}/response',  'submitSDCS')->name('sdcs.submit');
       
   });


       


// Frontend Routes Group
Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'HomePage')->name('home.index');
    Route::get('/students/{student:slug}', 'Singlestudent')->name('singlestudent');
    Route::get('/about', 'AboutPage')->name('about');
    Route::get('/frontnews', 'FrontNews')->name('front.news');
    Route::get('/sidebarstudents', 'SideBarstudentship');
    Route::get('/frontposts/{frontpost:slug}', 'SingleNewsFront')->name('singlenews.front');
    Route::get('/mandate', 'Mandate')->name('mandate');
    Route::get('/officials', 'Officials')->name('officials');
    Route::get('/studentship', 'studentship')->name('studentship');
    Route::get('/civilappeal', 'CivilAppeal')->name('civil');
    Route::get('/frontdownloads', 'FrontDownloads')->name('front.downloads');
    Route::get('/terms', 'Terms')->name('terms');
});



// Admin Routes Group
Route::controller(AdminController::class)->group(function () {    
    Route::get('view/profile', 'ViewProfile')->name('view.profile');
    Route::get('edit/profile', 'EditProfile')->name('edit.profile');
    Route::get('store/profile', 'StoreProfile')->name('store.profile');
});


// Documents Management Routes Group
	Route::controller(DocumentsManagementController::class)->group(function () {
   // Route::get('view/documents', 'viewDocuments')->name('documents.index');
    Route::get('create/documents', 'createDocuments')->name('create.documents');
    Route::post('/documents/upload', 'storeDocuments')->name('store.documents')->middleware('auth');
    Route::get('document/show', 'showDocument')->name('document.show');
    Route::get('edit/documents', 'Edit')->name('edit.documents');

    Route::get('/form1',  'showForm1')->name('form1');
    Route::post('/form1/process',  'processForm1')->name('form1.process');
    Route::get('/form2',  'showForm2')->name('form2');
    Route::post('/form2',  'storeDocuments')->name('store.documents');
});


    Route::middleware(['auth', 'profile.updated'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');
    Route::get('view/documents', [DocumentsManagementController::class, 'viewDocuments'])->name('documents.index');
    // Add more protected routes here
});


    Route::controller(DocumentEvaluationController::class)->group(function () {    
    
        Route::get('/submission-progress',  'submissionProgress')->name('submission.progress'); 
        Route::post('/documents/{id}/reject',  'rejectDocument')->name('reject.documents');         
        Route::post('/approvals/{id}/mark-as-read',  'markAsRead')->name('approvals.markAsRead');
        Route::post('/approvals/mark-all-as-read', 'markAllAsRead')->name('approvals.markAllAsRead');
        Route::get('/documents/{id}/view-requirements', 'viewDocRequirements')->name('view.document.requirements');
		Route::get('/documents/{id}/edit-status', 'editStatus')->name('edit.document.status');
   
        Route::post('/documents/{documentId}/approve', 'approveDocument')
        ->name('approve.documents')->middleware('auth');           

        Route::get('/documents/review-status',  'reviewStatus')
         ->name('review-status');
    });
    


// Admin Users Routes Group
Route::controller(AdminManagerController::class)->group(function () {
    Route::get('view/users', 'ViewUsers')->name('users.index');
    Route::get('create/user', 'createUser')->name('create.user');
    Route::post('admin/store/user', 'adminStore')->name('admin.store');
    //Route::post('/admin/create-user', [AdminUsermanagerController::class, 'adminCreate'])->name('admin.create.user');
   // Route::post('admin/users/user', 'adminCreate')->name('register.user');
    Route::get('users{user}/edit', 'EditUser')->name('edit.user');
    Route::put('/user{user}', 'UpdateUser')->name('update.user');
    Route::delete('/users/{user}', 'DestroyUser')->name('user.destroy');

});



Route::controller(DocumentReviewController::class)->group(function () {
    
Route::get('/documents/{document}/reviewers',  'showPotentialReviewers')
    ->name('documents.reviewers');  

   

    Route::post('/assign-reviewer',  'assignReviewer')->name('assignReviewer');
    

// Show form to assign reviewer
//Route::get('/documents/{document}/assign-reviewer', 'showAssignForm')->name('assign.reviewer');

// Handle the form submission
//Route::post('/documents/assign-reviewer', [DocumentReviewController::class, 'assignReviewer'])->name('documents.assign.reviewer');


//Route::get('/documents/assigned',  'assignedDocuments')->name('assigned.documents');

Route::get('/documents/{documentId}/assigned-reviewers', 'assignedDocuments')->name('assigned.documents');

      
});   
    



// Profiles Manager Routes Group
Route::controller(ProfileManagerController::class)->group(function () {
//Route::put('/ProfilePhoto', 'profilePhoto')->name('profile.photo');
Route::put('/profile/photo/{id}/{field}', 'updatePhoto')->name('profile.photo');

Route::put('/profile/{id}/update/{field}','updateField')->name('profile.updateField');
Route::get('/profile/edit',  'editProfile')->name('profile.index');
Route::put('/updateSchool', 'updateSchool')->name('update.school');
Route::put('/updateDepartment', 'updateDepartment')->name('update.department');
Route::put('/updateSpecialization', 'updateSpecialization')->name('update.specialization');
Route::put('/updateducation', 'updateEducation')->name('update.education');
Route::post('/user/update-research-interests',  'updateResearchInterests')->name('user.updateResearchInterests');

Route::post('/confirm',  'confirmProfileUpdate')->name('confirm.profile.update');

Route::put('/user/{id}/update-staff-std-id', 'updateStaffStdID')
    ->name('update.staff_std_id');
    
});


//To Search Projects for Admin
Route::get('/adminsearch', [App\Http\Controllers\ProjSearchController::class, 'AdminSearchProjects'])->name('adminsearch');
require __DIR__.'/auth.php';
