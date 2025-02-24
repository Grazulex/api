<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property User $resource */
final class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => [
                'address' => $this->resource->email,
                'verified' => $this->resource->hasVerifiedEmail(),

            ],
            'created' => new DateResource($this->resource->created_at),
            'workspace' =>  new WorkspaceResource($this->whenLoaded('workspace'))
        ];
    }
}
