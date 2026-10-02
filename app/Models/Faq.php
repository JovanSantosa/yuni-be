<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public static function resolveLocalized(mixed $value, ?string $locale = null): string
    {
        if (!$value) {
            return '';
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

        return (string)$value;
    }

    public function getQuestionLocalizedAttribute(): string
    {
        return self::resolveLocalized($this->question);
    }

    public function getAnswerLocalizedAttribute(): string
    {
        return self::resolveLocalized($this->answer);
    }
}
