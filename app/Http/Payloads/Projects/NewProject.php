<?php

declare(strict_types=1);

namespace App\Http\Payloads\Projects;

final class NewProject
{
    public function __construct(
        public string $name,
        public string $description
    )
    {
        
    }
}
