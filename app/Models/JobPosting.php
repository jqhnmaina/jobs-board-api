<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    /** @use HasFactory<\Database\Factories\JobPostingFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cv_required',
        'cover_letter_required',
        'location',
        'min_salary',
        'max_salary',
        'job_type',
        'expires_at',
        'company_id',
    ];

    protected $casts = [
        'cv_required' => 'boolean',
        'cover_letter_required' => 'boolean',
        'expires_at' => 'datetime',
    ];


    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'job_posting_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
