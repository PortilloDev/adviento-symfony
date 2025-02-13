<?php 

namespace App\Shared\Infrastructure\Grpc\Contract;

use Grpc\ServerContext;
use ivanportillo\User\GetUserRequest;
use ivanportillo\User\GetUserResponse;


interface UserServiceInterface
{
    public function GetUser(GetUserRequest $request, ServerContext $context): GetUserResponse;
}