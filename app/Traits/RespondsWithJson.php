<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait RespondsWithJson
{
    /**
     * Send a successful response.
     *
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function successResponse($message, $data = null, $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Send an error response.
     *
     * @param string $message
     * @param int $statusCode
     * @param array|null $errors
     * @return JsonResponse
     */
    public function errorResponse($message, $statusCode = 400, array $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    /**
     * Send a response for a resource not found.
     *
     * @param string $resourceName
     * @return JsonResponse
     */
    public function notFoundResponse($resourceName = 'Resource'): JsonResponse
    {
        return $this->errorResponse("{$resourceName} not found", 404);
    }

    /**
     * Send a response for a validation error.
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function validationErrorResponse(array $errors): JsonResponse
    {
        return $this->errorResponse('Validation errors', 422, $errors);
    }

    /**
     * Send a response for created resource.
     *
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    public function createdResponse($data, $message = 'Resource created successfully'): JsonResponse
    {
        return $this->successResponse($message, $data, 201);
    }
}