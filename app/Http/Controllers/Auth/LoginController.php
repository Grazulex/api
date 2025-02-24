<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\TokenResponse;
use App\Models\Workspace;
use Illuminate\Database\DatabaseManager;
use Sprout\Attributes\CurrentTenant;

use function PHPUnit\Framework\callback;

final class LoginController
{
    public function __construct(
        #[CurrentTenant] 
        private Workspace $workspace,
        private DatabaseManager $database
    )
    {
        
    }

    public function __invoke(LoginRequest $request): TokenResponse
    {
        $request->authenticate(
            $this->workspace->id
        );

        /** @var NewAccessToken $token */
        $token = $this->database->transaction(
            callback: fn () => $request->user()?->createToken(
                name: $request->header('X-Integration-Name'),
                abilities: [$this->workspace->indentifier . ':*'],
            ),
            attempts: 3,
        );

        return new TokenResponse(
            token: $token->plainTextToken
        );
    }

}
