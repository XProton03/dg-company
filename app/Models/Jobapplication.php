<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobapplication extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'jobapplications';
    protected $fillable = [
        'image',
        'title',
        'description',
        'location',
        'age_level',
        'education_level',
        'gender',
        'employment_type',
        'hour_type',
        'experience_year',
        'salary_min',
        'salary_max',
        'status',
    ];


    public function jobapplicants(): HasMany
    {
        return $this->hasMany(Jobapplicant::class, 'jobs_id');
    }

    protected static $logUnguarded = true;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
}
