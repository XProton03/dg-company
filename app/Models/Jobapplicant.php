<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jobapplication;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobapplicant extends Model
{
    use HasFactory;
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
        'image',
        'cv',
        'status',
    ];

    public function jobapplications(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'jobs_id');
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
