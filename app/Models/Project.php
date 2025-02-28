<?php

namespace App\Models;

final class Project extends AbstractTenant
{
    protected $fillable = [
        'name',
        'description',
        'workspace_id',
    ];
}
