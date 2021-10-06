<?php

namespace App\Repository;

use App\Repository\RepositoryInterface;
use GuzzleHttp\Exception\BadResponseException;
use App\Models\Kyc;
use App\Helpers\Helper;

class AuthRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Kyc $model){
        $this->model = $model;
    }

    public function kycStep($request)
    {
        try{
            $payload = $request->all();
            
        }catch(BadResponseException $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}