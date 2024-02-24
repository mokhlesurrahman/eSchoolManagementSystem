<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\School\Dashboard;
use App\Livewire\Backend\School\ExamManagement;
use App\Livewire\Backend\School\ClassManagement;
use App\Livewire\Backend\School\StaffManagement;
use App\Livewire\Backend\School\ExamFeeManagement;
use App\Livewire\Backend\School\GeneralInformation;
use App\Livewire\Backend\School\AdmissionManagement;
use App\Livewire\Backend\School\AdmissionFormPreview;
use App\Livewire\Backend\School\AttendanceReportManagement;
use App\Livewire\Backend\School\ClassGroupManagement;
use App\Livewire\Backend\School\ClassRoutineManagement;
use App\Livewire\Backend\School\ExamResultManagement;
use App\Livewire\Backend\School\ClassSectionManagement;
use App\Livewire\Backend\School\ClassSectionSubjectManagement;
use App\Livewire\Backend\School\ClassSyllabusManagement;
use App\Livewire\Backend\School\ClasswiseAdmissionFeeManagement;
use App\Livewire\Backend\School\CollectionReportManagement;
use App\Livewire\Backend\School\FeeCategoryManagement;
use App\Livewire\Backend\School\FeeCollectionManagement;
use App\Livewire\Backend\School\GradingManagement;
use App\Livewire\Backend\School\GradingRuleManagement;
use App\Livewire\Backend\School\MonthlyFeeManagement;
use App\Livewire\Backend\School\NoticeEdit;
use App\Livewire\Backend\School\NoticeManagement;
use App\Livewire\Backend\School\StaffAttendanceManagement;
use App\Livewire\Backend\School\StaffsAttendanceReportManagement;
use App\Livewire\Backend\School\StudentAttendanceManagement;
use App\Livewire\Backend\School\StudentCollectionManagement;
use App\Livewire\Backend\School\StudentFeeCollectionManagement;
use App\Livewire\Backend\School\StudentIdCardCreateEditForm;
use App\Livewire\Backend\School\StudentIdCardManagement;
use App\Livewire\Backend\School\StudentIdCardSettingsManagement;

Route::middleware(['checkRole:school,demo_school', 'checkSubscription', 'checkActivatedSchool'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('index');
    Route::get('/staffs', StaffManagement::class)->name('staffs');
    Route::get('/staffs-attendance', StaffAttendanceManagement::class)->name('staffs-attendance');
    Route::get('/students-attendance', StudentAttendanceManagement::class)->name('students-attendance');
    Route::get('/classes', ClassManagement::class)->name('classes');
    Route::get('/groups', ClassGroupManagement::class)->name('groups');
    Route::get('/sections', ClassSectionManagement::class)->name('sections');
    Route::get('/subjects', ClassSectionSubjectManagement::class)->name('subjects');
    Route::get('/exams', ExamManagement::class)->name('exams');
    Route::get('/syllabuses', ClassSyllabusManagement::class)->name('syllabuses');
    Route::get('/routines', ClassRoutineManagement::class)->name('routines');
    Route::get('/notices', NoticeManagement::class)->name('notices');
    Route::get('/notice/{slug}', NoticeEdit::class)->name('notice.slug');
    Route::get('/fee-categories', FeeCategoryManagement::class)->name('fee-categories');
    Route::get('/all-fees', ExamFeeManagement::class)->name('all-fees');
    Route::get('/fee-collection', FeeCollectionManagement::class)->name('fee-collection');
    Route::get('/collect-fees', StudentFeeCollectionManagement::class)->name('collect-fees');
    Route::get('/exam-results', ExamResultManagement::class)->name('exam-results');
    Route::get('/admissions', AdmissionManagement::class)->name('admissions');
    Route::get('/grading', GradingManagement::class)->name('grading');
    Route::get('/grading-rule/{id}', GradingRuleManagement::class)->name('grading-rule');
    Route::get('/admissions/{admission_id}', AdmissionFormPreview::class)->name('admissions.show');
    Route::get('/general-information', GeneralInformation::class)->name('general-information');
    Route::get('/monthly-fees', MonthlyFeeManagement::class)->name('monthly-fees');
    Route::get('/admission-fees', ClasswiseAdmissionFeeManagement::class)->name('admission-fees');
    Route::get('/collections', StudentCollectionManagement::class)->name('collections');
    Route::get('/collection-report', CollectionReportManagement::class)->name('collection-report');
    Route::get('/attendance-report', AttendanceReportManagement::class)->name('attendance-report');
    Route::get('/staffs-attendance-report', StaffsAttendanceReportManagement::class)->name('staffs-attendance-report');
    Route::get('/auto-generate/student-id-card', StudentIdCardManagement::class)->name('generate-student-id-card');
    Route::get('/student-id-cards', StudentIdCardSettingsManagement::class)->name('student-id-cards');
    Route::get('/student-id-card/create', StudentIdCardCreateEditForm::class)->name('student-id-card.create');
    Route::get('/student-id-card/{id}/edit', StudentIdCardCreateEditForm::class)->name('student-id-card.edit');
});
