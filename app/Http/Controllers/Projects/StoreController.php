<?php

namespace App\Http\Controllers\Projects;

use App\Http\Requests\Projects\StoreRequest;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\Request;
use Sprout\Attributes\CurrentTenant;

class StoreController
{
    public function __construct(
        #[CurrentUser] private readonly User $user,
        #[CurrentTenant] private readonly Workspace $workspace,
    ) {}

    public function __invoke(StoreRequest $request)
    {
        //
    }
}
