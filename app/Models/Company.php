<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'website',
        "owner_id",
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class, 'company_id');
    }
}
