<?php

namespace App\Repository;

use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $modelMembership;

    public function __construct(User $model){
        $this->model = $model;
    }

    public function login($request)
    {
        try{
            $payload = $request->all();

            $checkUser = $this->getModel()->where('email', $payload['email'])->first();

            if($checkUser)
            {
                $password = $payload['password'];

                if(Hash::check($password, $checkUser['password']))
                {
                    $data = [
                        'user'  => $checkUser,
                        'token' => $checkUser->createToken('users')->accessToken
                    ];
                    
                    return response()->json([
                        'status'   => true,
                        'values'    => $data,
                        'message'   => 'Login Successfully'
                    ], 200);
                }
                else
                {
                    $response['status']     = 401;
                    $response['message']    = 'Password not match!';

                    return response()->json($response, 401);
                }
            }
            else
            {
                $response['status']     = 401;
                $response['message']    = 'Email not match!';

                return response()->json($response, 401);
            }
        }catch(BadResponseException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function register($request)
    {
        try{
            $payload = $request->all();
            $payload['password'] = Hash::make($payload['password']);
            $query = $this->create($payload);
            $query->assignRole('user');
            
            $data = [
                'user'  => $query,
                'token' => $query->createToken('users')->accessToken
            ];
            
            return response()->json([
                'status'   => true,
                'values'    => $data,
                'message'   => 'Register Successfully'
            ], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function logout($request)
    {
        try{
            \Auth::user()->tokens->each(function($token, $key) {
                $token->delete();
            });
            return response()->json([
                'status'   => true,
                'message'   => 'Logout Successfully'
            ], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}