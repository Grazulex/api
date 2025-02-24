<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sprout\Contracts\Tenant;
use Sprout\Contracts\TenantHasResources;
use Sprout\Database\Eloquent\Concerns\HasTenantResources;
use Sprout\Database\Eloquent\Concerns\IsTenant;

class Workspace extends Model implements Tenant, TenantHasResources
{
    /** @use HasFactory<\Database\Factories\WorkspaceFactory> */
    use HasFactory, HasUlids, IsTenant, HasTenantResources;

    protected $fillable = [
        'name',
        'description',
        'identifier',
        'resource_key'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(
            User::class,
            'user_id'
        );
    }

    public function projects(): HasMany
    {
        return $this->hasMany(
            Project::class,
            'workspace_id'
        );
    }
}
