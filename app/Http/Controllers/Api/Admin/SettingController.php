<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getAllRaw();

        return response()->json(['data' => $settings]);
    }

    public function update(UpdateSettingRequest $request)
    {
        foreach ($request->validated() as $key => $value) {
            Setting::set($key, $value);
        }

        $settings = Setting::getAllRaw();

        return response()->json([
            'message' => 'Pengaturan berhasil disimpan.',
            'data' => $settings,
        ]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'key' => ['required', 'string', 'in:hero_image,about_image,cta_image'],
            'image' => ['required', 'image', 'max:10240'],
        ]);

        $key = $request->key;
        $file = $request->file('image');

        $filename = "{$key}_" . uniqid() . '.webp';
        $directory = 'settings';

        Storage::disk('public')->makeDirectory($directory);
        $fullPath = Storage::disk('public')->path("{$directory}/{$filename}");

        $image = Image::decode($file);
        $image->scaleDown(width: 1600);
        $image->save($fullPath, quality: 85);

        $path = "{$directory}/{$filename}";

        // Delete old file if local
        $oldVal = Setting::where('key', $key)->value('value');
        if ($oldVal && !str_starts_with($oldVal, 'http') && Storage::disk('public')->exists($oldVal)) {
            Storage::disk('public')->delete($oldVal);
        }

        Setting::set($key, $path);

        $url = Storage::disk('public')->url($path);

        return response()->json([
            'message' => 'Gambar berhasil diupload.',
            'key' => $key,
            'url' => $url,
        ]);
    }
}
