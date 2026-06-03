<?php

namespace App\Http\Controllers;

use App\Http\Resources\PremiumCourseResource;
use App\Models\PremiumCourse;
use App\Models\PremiumEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PremiumCourseApiController extends Controller
{
    public function index()
    {
        $courses = PremiumCourse::with('subject')->orderByDesc('created_at')->get();
        return $this->json('Premium courses retrieved', [
            'courses' => PremiumCourseResource::collection($courses),
        ]);
    }

    public function visible()
    {
        $courses = PremiumCourse::with('subject')
            ->where('status', 'visible')
            ->orderByDesc('created_at')
            ->get();

        return $this->json('Visible premium courses retrieved', [
            'courses' => PremiumCourseResource::collection($courses),
        ]);
    }

    public function show($id)
    {
        $course = PremiumCourse::with('subject')->findOrFail($id);
        return $this->json('Premium course retrieved', [
            'course' => new PremiumCourseResource($course),
        ]);
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

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::disk('public')->putFile('premium_course_thumbnails', $request->file('thumbnail'));
        }

        if ($request->filled('features')) {
            $data['features'] = array_filter(
                array_map('trim', explode("\n", $request->features)),
                fn($item) => !empty($item)
            );
        }

        $course = PremiumCourse::create($data);

        return $this->json('Premium course created', ['course' => new PremiumCourseResource($course)] , 201);
    }

    public function update(Request $request, $id)
    {
        $course = PremiumCourse::findOrFail($id);

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

        $course->fill($request->only(['subject_id', 'topic_name', 'description', 'price', 'video_url', 'status', 'duration_label', 'syllabus_label']));

        if ($request->hasFile('pdf_file')) {
            if ($course->pdf_file) {
                Storage::delete($course->pdf_file);
            }
            $course->pdf_file = $request->file('pdf_file')->store('public/premium_courses');
        }

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::delete($course->thumbnail);
            }
            $course->thumbnail = Storage::disk('public')->putFile('premium_course_thumbnails', $request->file('thumbnail'));
        }

        if ($request->filled('features')) {
            $course->features = array_filter(
                array_map('trim', explode("\n", $request->features)),
                fn($item) => !empty($item)
            );
        }

        $course->save();

        return $this->json('Premium course updated', ['course' => new PremiumCourseResource($course)]);
    }

    public function destroy($id)
    {
        $course = PremiumCourse::findOrFail($id);
        if ($course->pdf_file) {
            Storage::delete($course->pdf_file);
        }
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
            Storage::delete('public/' . $course->thumbnail);
        }
        $course->delete();

        return $this->json('Premium course deleted');
    }

    public function toggle($id)
    {
        $course = PremiumCourse::findOrFail($id);
        $course->status = $course->status === 'visible' ? 'hidden' : 'visible';
        $course->save();

        return $this->json('Premium course status updated', ['status' => $course->status]);
    }

    public function enroll(Request $request, $id)
    {
        $user = Auth::guard('api')->user();
        $course = PremiumCourse::findOrFail($id);

        $already = PremiumEnrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($already) {
            return $this->json('Already enrolled', ['enrolled' => true]);
        }

        PremiumEnrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return $this->json('Enrolled successfully', ['enrolled' => true]);
    }

    public function enrolled($id)
    {
        $user = Auth::guard('api')->user();
        $enrolled = PremiumEnrollment::where('user_id', $user->id)
            ->where('course_id', $id)
            ->exists();

        return $this->json('Enrollment status retrieved', ['enrolled' => $enrolled]);
    }
}
