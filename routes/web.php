<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAdmin\LoginController;
use App\Http\Controllers\WebAdmin\DashboardController;
use App\Http\Controllers\WebAdmin\CategoryController;
use App\Http\Controllers\WebAdmin\CourseController;
use App\Http\Controllers\WebAdmin\ChapterController;
use App\Http\Controllers\WebAdmin\InstructorController;
use App\Http\Controllers\WebAdmin\UserController as WebUserController;
use App\Http\Controllers\WebAdmin\EnrollmentController;
use App\Http\Controllers\WebAdmin\ExamController;
use App\Http\Controllers\WebAdmin\QuizController;
use App\Http\Controllers\WebAdmin\ReviewController;
use App\Http\Controllers\WebAdmin\BannerController;
use App\Http\Controllers\WebAdmin\BlogController;
use App\Http\Controllers\WebAdmin\CouponController;
use App\Http\Controllers\WebAdmin\ContactController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\WebAdmin\PageController;
use App\Http\Controllers\WebAdmin\ManageCertificateController;
use App\Http\Controllers\WebAdmin\UserRoleController;
use App\Http\Controllers\WebAdmin\PaymentGatewayController;
use App\Http\Controllers\WebAdmin\NoteController as AdminNoteController;
use App\Http\Controllers\WebAdmin\SubjectController;
use App\Http\Controllers\WebAdmin\CustomNotificationController;
use App\Http\Controllers\WebAdmin\NotificationController;
use App\Http\Controllers\WebAdmin\PlanController;
use App\Http\Controllers\WebAdmin\ProfileController;
use App\Http\Controllers\WebAdmin\SettingController;
use App\Http\Controllers\WebAdmin\ReportController;
use App\Http\Controllers\WebAdmin\ServerConfigurationController;
use App\Http\Controllers\WebAdmin\StorageLinkController;
use App\Http\Controllers\WebAdmin\TestimonialController;
use App\Http\Controllers\WebAdmin\TransactionController;
use App\Http\Controllers\WebAdmin\SubscribersController;
use App\Http\Controllers\WebAdmin\NewslatterController;
use App\Http\Controllers\WebAdmin\AdminOrgManagementController;
use App\Http\Controllers\WebAdmin\PremiumCourseController;
use App\Http\Controllers\PremiumCourseApiController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\UserController;
use App\Models\Setting;

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

// Root/Home Route
Route::get('/', function(){
    if (!file_exists(base_path('storage/installed'))) {
        return redirect()->route('installer.welcome.index');
    }
    $setting = Setting::first();
    $app_setting = [
        'name' => $setting->app_name ?? config('app.name'),
        'favicon' => $setting->faviconPath ?? '',
    ];
    return view('website', compact('app_setting'));
})->name('home');

// Frontend Authentication API Routes
Route::post('/login', [UserController::class, 'login'])->name('frontend.login');
Route::post('/register', [UserController::class, 'register'])->name('frontend.register');
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('socialite.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('socialite.google.callback');

// Admin Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/admin/login', 'index')->name('admin.login');
    Route::post('/admin/authenticate', 'authenticate')->name('admin.authenticate');
    Route::post('/admin/logout', 'logout')->name('admin.logout');
    Route::get('/admin/logout', 'logout')->name('admin.logout.get');
});

// Admin Dashboard - Protected Routes
Route::middleware(['auth', 'adminauth'])->prefix('admin')->as('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/statistics', [DashboardController::class, 'statistics'])->name('statistics');
    
    // Categories
    Route::resource('category', CategoryController::class);
    Route::post('category/sort', [CategoryController::class, 'sort'])->name('category.sort');
    Route::post('category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    
    // Courses
    Route::resource('course', CourseController::class);
    Route::post('course/{id}/publish', [CourseController::class, 'publish'])->name('course.publish');
    Route::post('course/{id}/restore', [CourseController::class, 'restore'])->name('course.restore');
    Route::get('course/restore/list', [CourseController::class, 'restoreCourse'])->name('course.restore.list');
    Route::post('course/{course}/free', [CourseController::class, 'freeCourse'])->name('course.free');
    
    // Chapters
    Route::get('chapter/select-course', [ChapterController::class, 'selectCourse'])->name('chapter.select_course');
    Route::resource('chapter', ChapterController::class);
    Route::post('chapter/{id}/restore', [ChapterController::class, 'restore'])->name('chapter.restore');
    
    // Instructors
    Route::resource('instructor', InstructorController::class);
    Route::get('instructor/featured', [InstructorController::class, 'featured'])->name('instructor.featured');
    Route::post('instructor/{user}/promote', [InstructorController::class, 'promote'])->name('instructor.promote');
    Route::post('instructor/{user}/migrate', [InstructorController::class, 'migrate'])->name('instructor.migrate');
    Route::post('instructor/{id}/restore', [InstructorController::class, 'restore'])->name('instructor.restore');
    
    // Users
    Route::resource('user', WebUserController::class);
    Route::post('user/{id}/restore', [WebUserController::class, 'restore'])->name('user.restore');
    Route::post('user/{id}/status', [WebUserController::class, 'status'])->name('user.status');
    
    // Enrollments
    Route::resource('enrollment', EnrollmentController::class);
    Route::post('enrollment/{id}/restore', [EnrollmentController::class, 'restore'])->name('enrollment.restore');
    // Suspend enrollment (soft delete)
    Route::get('enrollment/{id}/suspended', [EnrollmentController::class, 'suspended'])->name('enrollment.suspended');
    // Update certificate user name
    Route::post('enrollment/{id}/update-certificate-name', [EnrollmentController::class, 'nameUpdate'])->name('enrollment.update_certificate_name');
    // Enrollment export routes (CSV/PDF)
    Route::get('enrollment/export/csv', [EnrollmentController::class, 'exportCSV'])->name('enrollment.exportCSV');
    Route::get('enrollment/generate/pdf', [EnrollmentController::class, 'generatePdf'])->name('enrollment.generate.pdf');
    
    // Exams
    Route::get('exam/select-course', [ExamController::class, 'selectCourse'])->name('exam.select_course');
    Route::resource('exam', ExamController::class);
    Route::post('exam/{id}/restore', [ExamController::class, 'restore'])->name('exam.restore');
    
    // Quizzes
    Route::get('quiz/select-course', [QuizController::class, 'selectCourse'])->name('quiz.select_course');
    Route::resource('quiz', QuizController::class);
    Route::post('quiz/{id}/restore', [QuizController::class, 'restore'])->name('quiz.restore');
    
    // Reviews
    Route::resource('review', ReviewController::class);
    Route::post('review/{id}/restore', [ReviewController::class, 'restore'])->name('review.restore');
    
    // Banners
    Route::post('banner/publish', [BannerController::class, 'publish'])->name('banner.publish');
    Route::post('banner', [BannerController::class, 'store'])->name('banner.store');
    Route::post('banner/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('banner/{id}', [BannerController::class, 'delete'])->name('banner.delete');
    Route::get('banner', [BannerController::class, 'index'])->name('banner.index');
    
    // Blogs
    Route::resource('blog', BlogController::class);
    
    // Coupons
    Route::resource('coupon', CouponController::class);
    
    // Contacts
    Route::resource('contact', ContactController::class);
    Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    
    // Pages
    Route::resource('page', PageController::class);

    // Notes
    Route::resource('note', AdminNoteController::class);
    // Subjects
    Route::resource('subject', SubjectController::class);

    // Premium Courses
    Route::resource('premium-courses', PremiumCourseController::class)->names([
        'index' => 'premium-courses.index',
        'create' => 'premium-courses.create',
        'store' => 'premium-courses.store',
        'edit' => 'premium-courses.edit',
        'update' => 'premium-courses.update',
        'destroy' => 'premium-courses.destroy',
    ]);
    Route::patch('premium-courses/{premiumCourse}/toggle', [PremiumCourseController::class, 'toggle'])->name('premium-courses.toggle');
    
    // Certificates
    Route::resource('certificate', ManageCertificateController::class);
    
    // Roles
    Route::resource('role', UserRoleController::class);
    
    // Payment Gateways
    Route::resource('payment-gateway', PaymentGatewayController::class);
    
    // Notifications
    Route::resource('notification', NotificationController::class);
    Route::resource('custom-notification', CustomNotificationController::class);
    
    // Plans
    Route::resource('plan', PlanController::class);
    // Extra plan routes
    Route::post('plan/publish', [PlanController::class, 'publish'])->name('plan.publish');
    Route::get('plan/trash', [PlanController::class, 'trash'])->name('plan.trash');
    Route::post('plan/{id}/restore', [PlanController::class, 'restore'])->name('plan.restore');
    
    // Profile
    Route::resource('profile', ProfileController::class);
    // Settings - sirf index aur update chahiye (show/create/destroy nahi)
Route::resource('setting', SettingController::class)->only(['index', 'update']);
 
// Settings - Extra pages
Route::get('/setting/home-page-setup', [SettingController::class, 'homePageSetup'])->name('setting.home.page.setup');
Route::get('/setting/smtp-setup',      [SettingController::class, 'smtpSetup'])->name('setting.smtp.setup');
Route::get('/setting/social-media',    [SettingController::class, 'socialMediaSetup'])->name('setting.social.media.setup');
 
//     // Settings
//     Route::resource('setting', SettingController::class);
//     Route::post('setting/logo-upload', [SettingController::class, 'logoUpload'])->name('setting.logo-upload');
//     Route::post('setting/favicon-upload', [SettingController::class, 'faviconUpload'])->name('setting.favicon-upload');

//     Route::get('/setting/home-page-setup',  [SettingController::class, 'homePageSetup'])->name('setting.home.page.setup');
// Route::get('/setting/smtp-setup',       [SettingController::class, 'smtpSetup'])->name('setting.smtp.setup');
// Route::get('/setting/social-media',     [SettingController::class, 'socialMediaSetup'])->name('setting.social.media.setup');
    
    // Reports
    Route::resource('report', ReportController::class);
    
    // Server Configuration
    Route::resource('server-configuration', ServerConfigurationController::class);
    Route::get('storage-link', [StorageLinkController::class, 'linkStorage'])->name('link.storage');
    Route::resource('testimonial', TestimonialController::class);
    
    // Transactions
    Route::resource('transaction', TransactionController::class);
    
    // Subscribers
    Route::resource('subscriber', SubscribersController::class);
    
    // Newsletters
    Route::resource('newslatter', NewslatterController::class);
    
    // Organization Management
    Route::resource('org-management', AdminOrgManagementController::class);
});

// Instructor Routes
Route::middleware(['auth'])->prefix('instructor')->as('instructor.')->group(function () {
    // Route::get('/dashboard', [App\Http\Controllers\InstructorController::class, 'dashboard'])->name('dashboard'); 
    Route::post('/register', [LoginController::class, 'instructorAuthenticate'])->name('register.store');
    Route::get('/register', [LoginController::class, 'instructorRegister'])->name('register');
});

// Organization Routes
Route::prefix('org')->as('org.')->group(function () {
    Route::get('/register', function () {
        return view('auth.org.register');
    })->name('register');
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});

// Student Routes
Route::middleware(['auth'])->prefix('student')->as('student.')->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});

// Notes public API
Route::get('/notes/list', [NoteController::class, 'list']);
Route::get('/notes/slug/{slug}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/{slug}/download', [NoteController::class, 'download'])->name('notes.download')->middleware('auth');

// Premium courses API
Route::get('/api/premium-courses', [PremiumCourseApiController::class, 'index']);
Route::get('/api/premium-courses/visible', [PremiumCourseApiController::class, 'visible']);
Route::get('/api/premium-courses/{id}', [PremiumCourseApiController::class, 'show']);
Route::post('/api/premium-courses', [PremiumCourseApiController::class, 'store']);
Route::put('/api/premium-courses/{id}', [PremiumCourseApiController::class, 'update']);
Route::delete('/api/premium-courses/{id}', [PremiumCourseApiController::class, 'destroy']);
Route::patch('/api/premium-courses/{id}/toggle', [PremiumCourseApiController::class, 'toggle']);
Route::post('/api/premium-courses/{id}/enroll', [PremiumCourseApiController::class, 'enroll'])->middleware('auth:api');
Route::get('/api/premium-courses/{id}/enrolled', [PremiumCourseApiController::class, 'enrolled'])->middleware('auth:api');

// SPA Fallback Route for frontend history mode
Route::get('/{any}', function () {
    if (!file_exists(base_path('storage/installed'))) {
        return redirect()->route('installer.welcome.index');
    }
    $setting = Setting::first();
    $app_setting = [
        'name' => $setting->app_name ?? config('app.name'),
        'favicon' => $setting->faviconPath ?? '',
    ];
    return view('website', compact('app_setting'));
})->where('any', '.*');

// SPA Fallback Route for frontend history mode
Route::get('/{any}', function () {
    if (!file_exists(base_path('storage/installed'))) {
        return redirect()->route('installer.welcome.index');
    }
    $setting = Setting::first();
    $app_setting = [
        'name' => $setting->app_name ?? config('app.name'),
        'favicon' => $setting->faviconPath ?? '',
    ];
    return view('website', compact('app_setting'));
})->where('any', '.*');
