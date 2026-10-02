<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->orderBy('id')->get();
        return TestimonialResource::collection($testimonials);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_status' => ['required', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'avatar_path' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
            'order' => ['integer'],
        ]);

        $testimonial = Testimonial::create($validated);
        return new TestimonialResource($testimonial);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_status' => ['required', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'avatar_path' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
            'order' => ['integer'],
        ]);

        $testimonial->update($validated);
        return new TestimonialResource($testimonial);
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return response()->json(['message' => 'Testimoni berhasil dihapus.']);
    }
}
