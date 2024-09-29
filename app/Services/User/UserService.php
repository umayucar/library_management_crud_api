<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function register(array $data): array
    {
        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users,email',
        ]);
    
        if ($validator->fails()) {
            // Handle validation failure (you can customize the response)
            return [
                'errors' => $validator->errors(),
            ];
        }
        else{
            $now = Carbon::now(); // Get the current date and time
            $tokenExpired = $now->addHours(24);

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            return [
                'token' => $user->createToken('MyApp')->plainTextToken,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'token_expired' => $tokenExpired,
            ];
        }
    }

    public function login(Request $request): array
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success = [
                'token' => $authUser->createToken('MyApp')->plainTextToken,
                'user' => [
                    'id' => $authUser->id,
                    'name' => $authUser->name,
                    'surname' => $authUser->surname,
                    'email' => $authUser->email,
                ],
            ];

            return $success; // No error; return user details and token.
        }

        return [
            'error' => true,
            'message' => __('app.invalid_credentials'), // Localized error message
        ];
    }
}
