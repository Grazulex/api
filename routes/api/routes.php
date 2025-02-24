<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::tenanted(function (Router $router) {
    $router->middleware(['identifier'])->as('auth:')->prefix('auth')->group(static function () use ($router): void {
        $router->post('login', LoginController::class);
    });


    $router->middleware(['auth:sanctum'])->group(static function () use ($router): void {
        $router->get('/users', function () {
            return response()->json(UserResource::collection(User::query()->simplePaginate()));
        });
    });
});
