<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'subject' => $this->subject,
            'description' => $this->description,
            'tags' => $this->tags_array,
            'is_published' => $this->is_published,
            'created_at' => $this->created_at?->toDateTimeString(),
            'pdf_url' => $this->pdf_url,
            'pdf_download_url' => route('notes.download', $this->slug),
            'thumbnail_url' => $this->thumbnail_url,
        ];
    }
}
