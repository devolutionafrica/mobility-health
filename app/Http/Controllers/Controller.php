<?php

namespace App\Http\Controllers;

use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

abstract class Controller
{
    public function getServer(): Server
    {
        return ServerFactory::create([
            'response' => new SymfonyResponseFactory(),
            'source' => storage_path('app/private'),
            'cache' => storage_path('framework/cache'),
            'cache_path_prefix' => '.cache',
            'base_url' => 'mh',
        ]);
    }
}
