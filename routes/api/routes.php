<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::tenanted(function (Router $router) {
    $router->get('/users', function() {
        return response()->json(User::all());
    })->middleware(['identifier']);

    $router->post('login', LoginController::class);
});
