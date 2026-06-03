<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function list(Request $request)
    {
        $query = Note::query()->where('is_published', true);

        if ($search = $request->input('search')) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($subject = $request->input('subject')) {
            $query->where('subject', 'like', '%' . $subject . '%');
        }

        $notes = $query->orderByDesc('created_at')->get();

        $noteSubjects = $notes->pluck('subject')->filter()->unique()->values();
        $modelSubjects = Subject::orderBy('name')->pluck('name');

        $subjects = $modelSubjects->merge($noteSubjects)->unique()->values();

        return $this->json('Notes found', [
            'notes' => NoteResource::collection($notes),
            'subjects' => $subjects,
        ]);
    }

    public function show(string $slug)
    {
        $note = Note::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return $this->json('Note found', [
            'note' => new NoteResource($note),
        ]);
    }

    public function download(string $slug)
    {
        $note = Note::where('slug', $slug)->where('is_published', true)->firstOrFail();

        if (! $note->pdf_path || ! Storage::exists($note->pdf_path)) {
            abort(404);
        }

        return Storage::download($note->pdf_path, $note->slug . '.pdf');
    }
}
