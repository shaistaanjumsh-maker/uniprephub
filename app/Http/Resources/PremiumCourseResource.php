<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class PremiumCourseResource extends JsonResource
{
    public function toArray($request)
    {
        $settings = Setting::first();

        return [
            // Course specific fields
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'subject_name' => $this->subject?->name,
            'topic_name' => $this->topic_name,
            'description' => $this->description,
            'price' => $this->price,
            'video_url' => $this->video_url,
            'pdf_file' => $this->pdf_file,
            'pdf_url' => $this->pdf_file ? Storage::url($this->pdf_file) : null,
            'thumbnail' => $this->thumbnail,
            'thumbnail_url' => $this->thumbnail ? Storage::url($this->thumbnail) : null,
            'features' => $this->features ?? [],
            'duration_label' => $this->duration_label ?? 'Till exam',
            'syllabus_label' => $this->syllabus_label ?? 'Complete JMI Entrance Exam',
            'status' => $this->status,

            // Global/Settings fields
            'upi_id' => $settings?->payment_upi_id,
            'whatsapp_number' => $settings?->payment_whatsapp,
            'support_phone' => $settings?->footer_contact_number,
            'support_email' => $settings?->footer_support_mail,
            'qr_code_url' => $settings?->paymentQRPath,

            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
