<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Keys that store image paths
     */
    public const IMAGE_KEYS = [
        'hero_image',
        'about_image',
        'cta_image',
    ];

    /**
     * Keys that store multilingual translations (JSON encoded)
     */
    public const TRANSLATABLE_KEYS = [
        'hero_title',
        'hero_subtitle',
        'about_text',
        'meta_title',
        'meta_description',
    ];

    /**
     * Get a setting value by key (cached).
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            return static::where('key', $key)->value('value') ?? $default;
        });
    }

    /**
     * Set a setting value by key (flush cache).
     */
    public static function set(string $key, mixed $value): void
    {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting.{$key}");
    }

    /**
     * Resolve a translated value for the current locale with fallback to 'id'
     */
    public static function resolveLocalizedValue(mixed $value, ?string $locale = null): mixed
    {
        if (!$value) {
            return $value;
        }

        $locale = $locale ?: app()->getLocale();

        if (is_string($value) && str_starts_with(trim($value), '{')) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded[$locale] ?? $decoded['id'] ?? reset($decoded) ?? $value;
            }
        } elseif (is_array($value)) {
            return $value[$locale] ?? $value['id'] ?? reset($value) ?? '';
        }

        return $value;
    }

    /**
     * Get all settings with image paths resolved to full URLs and texts localized.
     */
    public static function getAllWithUrls(?string $locale = null): array
    {
        $settings = static::all()->pluck('value', 'key')->toArray();
        $locale = $locale ?: app()->getLocale();

        // Resolve images
        foreach (self::IMAGE_KEYS as $imageKey) {
            if (!empty($settings[$imageKey])) {
                $val = $settings[$imageKey];
                if (!str_starts_with($val, 'http://') && !str_starts_with($val, 'https://')) {
                    $settings[$imageKey] = Storage::disk('public')->url($val);
                }
            }
        }

        // Resolve localized texts
        foreach (self::TRANSLATABLE_KEYS as $tKey) {
            if (isset($settings[$tKey])) {
                $settings[$tKey] = self::resolveLocalizedValue($settings[$tKey], $locale);
            }
        }

        return $settings;
    }

    /**
     * Get all raw settings (preserving JSON arrays for admin editing)
     */
    public static function getAllRaw(): array
    {
        $settings = static::all()->pluck('value', 'key')->toArray();

        foreach (self::IMAGE_KEYS as $imageKey) {
            if (!empty($settings[$imageKey])) {
                $val = $settings[$imageKey];
                if (!str_starts_with($val, 'http://') && !str_starts_with($val, 'https://')) {
                    $settings[$imageKey] = Storage::disk('public')->url($val);
                }
            }
        }

        foreach (self::TRANSLATABLE_KEYS as $tKey) {
            if (isset($settings[$tKey])) {
                $val = $settings[$tKey];
                if (is_string($val) && str_starts_with(trim($val), '{')) {
                    $decoded = json_decode($val, true);
                    if (is_array($decoded)) {
                        $settings[$tKey] = $decoded;
                    }
                }
            }
        }

        return $settings;
    }
}
