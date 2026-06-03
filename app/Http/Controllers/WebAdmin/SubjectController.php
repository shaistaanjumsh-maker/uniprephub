<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->paginate(20);
        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:subjects,name']);
        Subject::create([
            'name' => $request->input('name'),
            'organization_id' => app()->bound('currentOrganization') ? app('currentOrganization')->id : null,
        ]);

        return redirect()->route('admin.subject.index')->withSuccess(__('Subject created'));
    }

    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate(['name' => 'required|string|max:255|unique:subjects,name,' . $subject->id]);
        $subject->update(['name' => $request->input('name')]);
        return redirect()->route('admin.subject.index')->withSuccess(__('Subject updated'));
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subject.index')->withSuccess(__('Subject deleted'));
    }
}
