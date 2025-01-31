<?php

namespace App\Models;

use App\Models\ClassSyllabus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class SchoolClass extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // This function will return all classes by school
    public static function allClasses()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }

    // This function will return class by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }

    /**
     * Get all of the students for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all of the classSections for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classSections(): HasMany
    {
        return $this->hasMany(SchoolClassSection::class, 'school_class_id');
    }

    /**
     * Get all of the groups for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(classGroup::class, 'school_class_id');
    }

    /**
     * Get the school that owns the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public static function allStudents()
    {
        return self::with('students')->get();
    }

    public function notices()
    {
        return $this->belongsToMany(SchoolNotice::class, 'notice_school_class', 'school_class_id', 'notice_id');
    }

    /**
     * Get all of the routines for the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routines(): HasMany
    {
        return $this->hasMany(ClassRoutine::class);
    }

    /**
     * Get all of the syllabuses for the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function syllabuses(): HasMany
    {
        return $this->hasMany(ClassSyllabus::class, 'class_id');
    }

    /**
     * Get the monthly_fee associated with the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function monthly_fee(): HasOne
    {
        return $this->hasOne(SchoolMonthlyFee::class, 'class_id');
    }

    /**
     * Get the admission_fee associated with the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admission_fee(): HasOne
    {
        return $this->hasOne(ClassWiseAdmissionFee::class, 'class_id');
    }

    /**
     * Get all of the exams for the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams(): HasMany
    {
        return $this->hasMany(SchoolExam::class, 'school_class_id');
    }
}
