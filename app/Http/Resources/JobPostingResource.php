<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPostingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cv_required' => $this->cv_required,
            'cover_letter_required' => $this->cover_letter_required,
            'location' => $this->location,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'job_type' => $this->job_type,
            'expires_at' => $this->expires_at->toDateTimeString(),
            'company' => [
                'id' => $this->company->id,
                'name' => $this->company->name,
                'description' => $this->company->description,
                'email' => $this->company->email,
                'website' => $this->company->website,
                'created_at' => $this->company->created_at->toDateTimeString(),
                'updated_at' => $this->company->updated_at->toDateTimeString(),
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
