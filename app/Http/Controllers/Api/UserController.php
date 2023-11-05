<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\GenerateEntityException;
use App\Facade\UserFacade;
use App\Http\Requests\User\InsertUserRequest;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use \Illuminate\Http\Response;

class UserController extends BaseController
{
    public function __construct(
        private readonly UserFacade $userFacade
    )
    {
    }

    /**
     * @throws Exception
     * @throws ClassNotFoundException
     * @throws GenerateEntityException
     */
    public function create(InsertUserRequest $request): Response
    {
        try {
            $user = $this->userFacade->create($request->all());

            return response([
                'message' => 'User Created Successfully',
                'data' => [
                    'id' => $user->getUuid()
                ]
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function find($uuid) {
    }
}
