<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature', 'Unit');

beforeAll(function () {
    \Illuminate\Support\Facades\Artisan::call('migrate --seed');
});
