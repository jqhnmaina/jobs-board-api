<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
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
            'introduction' => $this->introduction,
            'cover_letter_path' => $this->cover_letter_path,
            'cv_path' => $this->cv_path,
            'user' => new UserResource($this->whenLoaded('user')),
            'job_posting' => new JobPostingResource($this->whenLoaded('jobPosting')),
            'created_at' => $this->created_at,
        ];
    }
}
