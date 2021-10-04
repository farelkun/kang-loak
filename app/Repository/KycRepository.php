<?php

namespace App\Repository;

use App\Repository\RepositoryInterface;
use GuzzleHttp\Exception\BadResponseException;
use App\Models\Kyc;

class AuthRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Kyc $model){
        $this->model = $model;
    }

    public function verification($request)
    {
        
    }
}