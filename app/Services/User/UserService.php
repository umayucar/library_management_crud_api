<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data): array
    {
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

    public function login(Request $request): array
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success = [
                'token' => $authUser->createToken('MyApp')->plainTextToken,
                'user' => [
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
