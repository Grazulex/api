<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Projects;
use App\Http\Resources\UserResource;
use App\Http\Responses\PaginatedCollectionResponse;
use App\Models\User;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::tenanted(function (Router $router) {
    $router->middleware(['identifier'])->as('auth:')->prefix('auth')->group(static function () use ($router): void {
        $router->post('login', LoginController::class);
    });


    $router->middleware(['auth:sanctum'])->group(static function () use ($router): void {
        $router->get('/users', fn() => new PaginatedCollectionResponse(UserResource::collection(User::query()->simplePaginate())));
        $router->post('/projects', Projects\StoreController::class)->name('store');
    });
});
