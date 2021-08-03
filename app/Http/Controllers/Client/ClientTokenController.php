<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Models\ClientToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientToken $clientToken)
    {
        dd($clientToken);
    }
}
