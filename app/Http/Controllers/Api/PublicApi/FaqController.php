<?php

namespace App\Http\Controllers\Api\PublicApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        return FaqResource::collection($faqs);
    }
}
