<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\GenerateEntityException;
use App\Facade\UserFacade;
use App\Http\Requests\User\InsertUserRequest;
use App\Http\Requests\User\RecoverPasswordRequest;
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

    public function confirmUser(string $token): Response
    {
        try {
            $this->userFacade->confirmAccount($token);

            return response([
                'message' => 'Account verified successfully.',
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function recoverPassword(RecoverPasswordRequest $request): Response
    {
        try {
            $data = $request->all();
            $this->userFacade->recoverPassword($data['email']);

            return response([
                'message' => 'A password reset email has been sent!',
            ], 201);
        } catch (Exception $e) {
            dd($e->getMessage(), $e->getLine(), $e->getFile());
            return response([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function resetPassword()
    {

    }
}
