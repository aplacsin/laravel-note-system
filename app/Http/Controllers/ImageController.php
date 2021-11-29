<?php

namespace App\Http\Controllers;

use App;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function destroy(int $id): JsonResponse
    {
        $this->imageService->deleteById($id);

        return response()->json([], 200);
    }
}
