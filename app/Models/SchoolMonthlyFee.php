<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolMonthlyFee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get the school that owns the SchoolMonthlyFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the class that owns the SchoolMonthlyFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function admission_fee_students()
    {
        return $this->belongsToMany(Student::class, 'class_wise_admission_fee_student', 'admission_fee_id', 'student_id')
            ->withPivot('id', 'due_amount', 'paid_amount', 'status')
            ->withTimestamps();
    }

    public function monthly_fee_students()
    {
        return $this->belongsToMany(SchoolMonthlyFee::class, 'school_monthly_fee_student', 'fee_id', 'student_id')
            ->withPivot('id', 'due_amount', 'paid_amount', 'status', 'month')
            ->withTimestamps();
    }
}
