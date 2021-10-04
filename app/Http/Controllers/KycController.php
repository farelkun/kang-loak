<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\KycRequest;
use App\Repository\KycRepository;

class KycController extends Controller
{
    private $kycRepository;

    public function __construct(KycRepository $kycRepository){
        $this->kycRepository = $kycRepository;
    }

    public function verification(KycRequest $request)
    {
        return $this->kycRepository->verification($request);   
    }
}
