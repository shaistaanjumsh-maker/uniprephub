<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class PremiumCourse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(PremiumEnrollment::class, 'course_id');
    }

    protected function pdfUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->pdf_file ? Storage::url($this->pdf_file) : null,
        );
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->thumbnail ? Storage::url($this->thumbnail) : null,
        );
    }
}
