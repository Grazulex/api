<?php

namespace App\Http\Requests\Projects;

use App\Http\Payloads\Projects\NewProject;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255']
        ];
    }

    public function payload(): NewProject
    {
        return new NewProject(
            $this->string('name')->toString(),
            $this->string('description')->toString(),
        );
    }
}
