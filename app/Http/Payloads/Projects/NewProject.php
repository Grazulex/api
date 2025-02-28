<?php

declare(strict_types=1);

namespace App\Http\Payloads\Projects;

final readonly class NewProject
{
    public function __construct(
        public string $name,
        public string $description
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
