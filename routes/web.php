<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Teacher\Attendace\AttendacePage;
use App\Livewire\Teacher\Students\AddStudent;
use App\Livewire\Teacher\Students\EditStudent;
use App\Livewire\Teacher\Grades\AddGrade;
use App\Livewire\Teacher\Grades\EditGrade;
use App\Models\Student;
use App\Livewire\Teacher\Students\StudentList;
use App\Livewire\Teacher\Grades\GradeList;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'teacher'])
    ->name('teacher.dashboard');
Route::middleware(['auth'])->group(function(){
    Route::get('student-list', StudentList::class)->name('student.index');
    Route::get('create-student', AddStudent::class)->name('student.create');
    Route::get('edit-student/{id}', EditStudent::class)->name('student.edit');
    //grade
    Route::get('grade-list', GradeList::class)->name('grade.index');
    Route::get('create-grade', AddGrade::class)->name('grade.create');
    Route::get('edit-grade/{id}', EditGrade::class)->name('grade.edit');

    //attendance
    Route::get('attendance', AttendacePage::class)->name('attendance.page');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});

require __DIR__.'/auth.php';
