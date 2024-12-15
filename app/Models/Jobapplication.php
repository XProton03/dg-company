<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobapplication extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'jobapplications';


    public function jobapplicants(): HasMany
    {
        return $this->hasMany(Jobapplicant::class, 'jobs_id');
    }
}
