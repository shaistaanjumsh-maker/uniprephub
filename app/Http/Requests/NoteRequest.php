<?php

namespace App\Http\Requests;

use App\Models\Note;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $noteId = $this->route('note')?->id;

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'unique:notes,slug' . ($noteId ? ',' . $noteId : ''),
            ],
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'pdf' => $this->isMethod('post')
                ? 'required|file|mimes:pdf|max:10240'
                : 'nullable|file|mimes:pdf|max:10240',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tags' => 'nullable|string|max:500',
            'is_published' => 'sometimes|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
        ]);

        $slug = $this->input('slug');
        $title = $this->input('title');
        $noteId = $this->route('note')?->id;

        if ($slug) {
            $slug = Note::slugify($slug);
        } elseif ($title) {
            $slug = Note::generateUniqueSlug($title, $noteId);
        }

        if ($slug) {
            $this->merge(['slug' => $slug]);
        }
    }
}
