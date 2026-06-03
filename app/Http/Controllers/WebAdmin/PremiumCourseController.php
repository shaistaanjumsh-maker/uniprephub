<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Models\PremiumCourse;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PremiumCourseController extends Controller
{
    public function index()
    {
        $courses = PremiumCourse::with('subject')->orderByDesc('created_at')->paginate(20);
        return view('premium_course.index', compact('courses'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('premium_course.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'topic_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'video_url' => ['nullable', 'string', 'max:2048'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'thumbnail' => ['nullable', 'file', 'image', 'max:5120'],
            'features' => ['nullable', 'string'],
            'duration_label' => ['nullable', 'string', 'max:255'],
            'syllabus_label' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:visible,hidden'],
        ]);

        $data = $request->only(['subject_id', 'topic_name', 'description', 'price', 'video_url', 'status', 'duration_label', 'syllabus_label']);

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('public/premium_courses');
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnailPath = Storage::disk('public')->putFile('premium_course_thumbnails', $request->file('thumbnail'));
            if ($thumbnailPath) {
                $data['thumbnail'] = $thumbnailPath;
            }
        }

        if ($request->filled('features')) {
            $data['features'] = array_filter(
                array_map('trim', explode("\n", $request->features)),
                fn($item) => !empty($item)
            );
        }

        PremiumCourse::create($data);

        return redirect()->route('admin.premium-courses.index')->withSuccess(__('Premium course created successfully.'));
    }

    public function edit(PremiumCourse $premiumCourse)
    {
        $subjects = Subject::orderBy('name')->get();
        return view('premium_course.edit', compact('premiumCourse', 'subjects'));
    }

    public function update(Request $request, PremiumCourse $premiumCourse)
    {
        $request->validate([
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'topic_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'video_url' => ['nullable', 'string', 'max:2048'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'thumbnail' => ['nullable', 'file', 'image', 'max:5120'],
            'features' => ['nullable', 'string'],
            'duration_label' => ['nullable', 'string', 'max:255'],
            'syllabus_label' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:visible,hidden'],
        ]);

        $premiumCourse->fill($request->only(['subject_id', 'topic_name', 'description', 'price', 'video_url', 'status', 'duration_label', 'syllabus_label']));

        if ($request->hasFile('pdf_file')) {
            if ($premiumCourse->pdf_file) {
                Storage::delete($premiumCourse->pdf_file);
            }
            $premiumCourse->pdf_file = $request->file('pdf_file')->store('public/premium_courses');
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $newThumbnailPath = Storage::disk('public')->putFile('premium_course_thumbnails', $request->file('thumbnail'));
            if ($newThumbnailPath) {
                if ($premiumCourse->thumbnail) {
                    $this->deleteOldThumbnail($premiumCourse->thumbnail);
                }
                $premiumCourse->thumbnail = $newThumbnailPath;
            }
        }

        if ($request->filled('features')) {
            $premiumCourse->features = array_filter(
                array_map('trim', explode("\n", $request->features)),
                fn($item) => !empty($item)
            );
        }

        $premiumCourse->save();

        return redirect()->route('admin.premium-courses.index')->withSuccess(__('Premium course updated successfully.'));
    }

    public function destroy(PremiumCourse $premiumCourse)
    {
        if ($premiumCourse->pdf_file) {
            Storage::delete($premiumCourse->pdf_file);
        }

        if ($premiumCourse->thumbnail) {
            $this->deleteOldThumbnail($premiumCourse->thumbnail);
        }

        $premiumCourse->delete();

        return redirect()->route('admin.premium-courses.index')->withSuccess(__('Premium course deleted successfully.'));
    }

    protected function deleteOldThumbnail(string $thumbnailPath): void
    {
        if (!$thumbnailPath) {
            return;
        }

        if (str_starts_with($thumbnailPath, 'public/')) {
            Storage::delete($thumbnailPath);
            Storage::disk('public')->delete(Str::after($thumbnailPath, 'public/'));
            return;
        }

        Storage::disk('public')->delete($thumbnailPath);
        Storage::delete('public/' . $thumbnailPath);
    }

    public function toggle(PremiumCourse $premiumCourse)
    {
        $premiumCourse->status = $premiumCourse->status === 'visible' ? 'hidden' : 'visible';
        $premiumCourse->save();

        return response()->json(['status' => $premiumCourse->status, 'message' => __('Premium course status updated successfully.')]);
    }
}
