<?php

namespace App\Models;

use App\Models\Jobapplication;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobapplicant extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'jobapplicants';
    protected $fillable = [
        'jobs_id',
        'name',
        'age',
        'gender',
        'email',
        'phone',
        'address',
        'skill',
        'last_year_education',
        'last_level_education',
        'last_education',
        'last_year_position',
        'last_level_position',
        'last_company',
        'experience',
        'salary',
        'on_working',
        'ready_for_work',
        'image',
        'cv',
        'status',
        'note',
    ];

    public function jobapplications(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'jobs_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }

    // public function setSkillsAttribute($value)
    // {
    //     $this->attributes['skill'] = json_encode(array_map('trim', explode(',', $value)));
    // }

    // public function getSkillsAttribute($value)
    // {
    //     return implode(', ', json_decode($value));
    // }
}
