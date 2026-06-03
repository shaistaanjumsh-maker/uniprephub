<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = Note::orderByDesc('created_at')->paginate(20);

        return view('note.index', compact('notes'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->pluck('name')->toArray();
        return view('note.create', compact('subjects'));
    }

    public function store(NoteRequest $request)
    {
        $validated = $request->validated();
        $validated['tags'] = isset($validated['tags'])
            ? implode(',', array_filter(array_map('trim', explode(',', $validated['tags']))))
            : null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['organization_id'] = app()->bound('currentOrganization') ? app('currentOrganization')->id : null;
        $validated['pdf_path'] = $request->file('pdf')->store('public/notes/pdfs');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('public/notes/thumbnails');
        }

        Note::create($validated);

        return redirect()->route('admin.note.index')->withSuccess(__('Note created successfully.'));
    }

    public function edit(Note $note)
    {
        $subjects = Subject::orderBy('name')->pluck('name')->toArray();
        return view('note.edit', compact('note', 'subjects'));
    }

    public function update(NoteRequest $request, Note $note)
    {
        $validated = $request->validated();
        $validated['tags'] = isset($validated['tags'])
            ? implode(',', array_filter(array_map('trim', explode(',', $validated['tags']))))
            : null;
        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('pdf')) {
            if ($note->pdf_path) {
                Storage::delete($note->pdf_path);
            }
            $validated['pdf_path'] = $request->file('pdf')->store('public/notes/pdfs');
        }

        if ($request->hasFile('thumbnail')) {
            if ($note->thumbnail_path) {
                Storage::delete($note->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('public/notes/thumbnails');
        }

        $note->update($validated);

        return redirect()->route('admin.note.index')->withSuccess(__('Note updated successfully.'));
    }

    public function destroy(Note $note)
    {
        Storage::delete(array_filter([$note->pdf_path, $note->thumbnail_path]));
        $note->delete();

        return redirect()->route('admin.note.index')->withSuccess(__('Note deleted successfully.'));
    }
}
