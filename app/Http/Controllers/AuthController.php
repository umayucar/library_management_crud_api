<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\User\UserService;
use App\Traits\RespondsWithJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    use RespondsWithJson;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
    * Register api
    *
    * @param RegisterRequest $request
    * @return JsonResponse
    */
    public function register(RegisterRequest $request)
    {
        $result = $this->userService->register($request->validated());    

        // Check if there are errors in the result
        if (isset($result['errors'])) {
            // Return validation error response
            return $this->validationErrorResponse($result);
        }

        // If no errors, return success response
        return $this->createdResponse($result, __('app.register_success'));
    }

    /**
    * Login api
    *
    * @param LoginRequest $request
    * @return JsonResponse
    */
    public function login(LoginRequest $request): JsonResponse
    {
        // Delegate login logic to the UserService
        $result = $this->userService->login($request);
    
        if (isset($result['error']) && $result['error']) {
            return $this->errorResponse($result['message'], 422);
        }
    
        return $this->successResponse(__('app.login_success'), $result);
    }
}
