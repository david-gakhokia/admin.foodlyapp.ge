<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsReportResource extends JsonResource
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
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'filters' => $this->filters,
            'data' => $this->when($request->get('include_data'), $this->data),
            'generated_at' => $this->generated_at?->toISOString(),
            'generated_by' => $this->generatedBy?->name,
            'file_path' => $this->file_path,
            'file_size' => $this->formatted_file_size,
            'download_url' => $this->download_url,
            'expires_at' => $this->expires_at?->toISOString(),
            'is_expired' => $this->isExpired(),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
