<?php

namespace App\Jobs\Projects;

use App\Http\Payloads\Projects\NewProject;
use App\Models\Project;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

class CreateNewProject implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public NewProject $payload,
        public string $workspace,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn () => Project::query()->create(
                attributes: array_merge(
                    $this->payload->toArray(),
                    ['workspace_id' => $this->workspace],
                )
            ),
            attempts: 3,
        );
    }
}
