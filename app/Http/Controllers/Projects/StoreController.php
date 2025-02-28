<?php

namespace App\Http\Controllers\Projects;

use App\Http\Requests\Projects\StoreRequest;
use App\Http\Responses\MessageResponse;
use App\Jobs\Projects\CreateNewProject;
use App\Models\Workspace;
use Illuminate\Contracts\Bus\Dispatcher;
use Sprout\Attributes\CurrentTenant;
use Symfony\Component\HttpFoundation\Response;

use function Illuminate\Support\defer;

class StoreController
{
    public function __construct(
        private Dispatcher $bus,
        #[CurrentTenant] private readonly Workspace $workspace,
    ) {}

    public function __invoke(StoreRequest $request): MessageResponse
    {
        defer(
            callback: fn () => $this->bus->dispatch(
                command: new CreateNewProject(
                    payload: $request->payload(),
                    workspace: $this->workspace->id,
                ),
            ),
            name: 'create-new-project',
        );

        return new MessageResponse(
            message: 'We have accepted your project request.',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
