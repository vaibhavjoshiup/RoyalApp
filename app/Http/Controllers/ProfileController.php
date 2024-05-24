<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function show()
    {   
        $response = $this->apiClient->get('/api/v2/me');
        $user = json_decode($response->getBody(), true);
        return view('profile', compact('user'));
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
