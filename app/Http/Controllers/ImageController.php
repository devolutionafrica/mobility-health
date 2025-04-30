<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\Filesystem\FileNotFoundException;
use League\Glide\Filesystem\FilesystemException;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexUrl(Request $request, string $path)
    {
        return $this->getServer()
            ->getImageResponse(path: $path, params: $request->toArray());
    }

    /**
     * @param Request $request
     * @param string $path
     * @return string
     * @throws FilesystemException|FileNotFoundException
     */
    public function indexBase64(Request $request, string $path): string
    {
        return $this->getServer()
            ->getImageAsBase64(path: $path, params: $request->toArray());
    }

}
