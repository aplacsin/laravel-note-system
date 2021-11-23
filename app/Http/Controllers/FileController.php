<?php

namespace App\Http\Controllers;

use App;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function destroy(int $id): JsonResponse
    {
        $this->fileService->deleteById($id);

        return response()->json([], 200);
    }
}
