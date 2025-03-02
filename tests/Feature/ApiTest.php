<?php

use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\postJson;

test('test auth', function () {
    $response = postJson(
        '/auth/login',
        ['email' => 'jms@grazulex.be', 'password' => 'password'],
        ['Workspaces-Identifier' => 'jnkconsult', 'X-Integration-Name' => 'test']
    );

    $response->assertStatus(Response::HTTP_OK);
});
