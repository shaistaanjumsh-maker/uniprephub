<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public static function slugify(string $title): string
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = trim($slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);

        return $slug;
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = self::slugify($title);
        $slug = $baseSlug ?: 'note';
        $counter = 2;

        while (
            self::query()
                ->when($ignoreId, fn($query) => $query->where('id', '<>', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_path ? Storage::url($this->pdf_path) : null;
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail_path) {
            return Storage::url($this->thumbnail_path);
        }

        return asset('assets/images/menu/file-text-shield.svg');
    }

    public function getTagsArrayAttribute(): array
    {
        if (! $this->tags) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->tags))));
    }
}
