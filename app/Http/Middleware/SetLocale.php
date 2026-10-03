<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('Accept-Language');

        // Normalize locale (e.g. zh, zh-TW, zh_TW -> zh-TW)
        if ($locale) {
            $primaryLocale = explode(',', $locale)[0];
            $primaryLocale = trim(explode(';', $primaryLocale)[0]);

            if (in_array(strtolower($primaryLocale), ['zh', 'zh-tw', 'zh_tw', 'tw'])) {
                $locale = 'zh-TW';
            } elseif (in_array(strtolower($primaryLocale), ['en', 'en-us', 'en_us', 'en-gb'])) {
                $locale = 'en';
            } elseif (in_array(strtolower($primaryLocale), ['vi', 'vi-vn'])) {
                $locale = 'vi';
            } elseif (in_array(strtolower($primaryLocale), ['th', 'th-th'])) {
                $locale = 'th';
            } else {
                $locale = 'id';
            }
        } else {
            $locale = $request->query('lang', 'id');
        }

        if (!in_array($locale, ['id', 'zh-TW', 'en', 'vi', 'th'])) {
            $locale = 'id';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
