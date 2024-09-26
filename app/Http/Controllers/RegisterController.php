<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
        /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'exists:users,id',
            'name' => 'required',
            'surname' => 'nullable|string',
            'username' => 'required|unique:users,username',
            'email' => 'nullable|email',
            'password' => 'required',
            'c_password' => 'same:password',
            'user_type' => 'required|in:admin,customer,subcustomer,sales_manager,cargo,sales_representative',
            'phone' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'erp_name' => 'nullable|string',
            'erp_code' => 'nullable|string',
            'address' => 'nullable|string',
            'risk_limit' => 'nullable|numeric',
            'zip_code' => 'nullable|string',
            'tax_office' => 'nullable|string',
            'tax_no' => 'nullable|string',
            'identity_no' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $now = Carbon::now(); // Get the current date and time
        $tokenExpired = $now->addHours(24);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // if the user is not admin, set the status to 1
        if ($input['user_type'] == 'admin') {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['parent_id'] =  $user->parent_id;
        $success['name'] =  $user->name;
        $success['surname'] = $user->surname;
        $success['username'] = $user->username;
        $success['email'] = $user->email;
        $success['user_type'] = $user->user_type;
        $success['phone'] = $user->phone;
        $success['birth_date'] = $user->birth_date;
        $success['erp_name'] = $user->erp_name;
        $success['erp_code'] = $user->erp_code;
        $success['address'] = $user->address;
        $success['risk_limit'] = $user->risk_limit;
        $success['zip_code'] = $user->zip_code;
        $success['tax_office'] = $user->tax_office;
        $success['tax_no'] = $user->tax_no;
        $success['language_id'] = $user->language_id;
        $success['currency_id'] = $user->currency_id;
        $success['is_check_balance'] = $user->is_check_balance;
        $success['identity_no'] = $user->identity_no;
        $success['token_expired'] = $tokenExpired;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        $now = Carbon::now(); // Get the current date and time
        $tokenExpired = $now->addHours(24);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->status == 1) {
                $success['id'] =  $user->id;
                $success['token'] =  $user->createToken('MyApp')->plainTextToken;
                $success['name'] =  $user->name;
                $success['surname'] =  $user->surname;
                $success['username'] =  $user->username;
                $success['email'] = $user->email;
                $success['user_type'] = $user->user_type;
                $success['phone'] = $user->phone;
                $success['birth_date'] = $user->birth_date;
                $success['address'] = $user->address;
                $success['tax_no'] = $user->tax_no;
                $success['status'] = $user->status;
                $success['identity_no'] = $user->identity_no;
                $success['is_check_balance'] = $user->is_check_balance;
                $success['token_expired'] = $tokenExpired;

                return $this->sendResponse($success, 'User login successfully.');
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
            }
        }
    }
}
