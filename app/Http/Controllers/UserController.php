<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index () 
    {
        if (!$this->user->getAllUser()) {
            return response()->json(['success' => false], 500);
        }

        return response()->json(['success' => true, 'result' => $this->user->getAllUser()], 200);
    }

    public function show ($values)
    {
        if (!$this->user->getUserByName($values)) {
            return response()->json(['success' => false], 500);
        }

        return response()->json(['success' => true, 'result' => $this->user->getUserByName($values)], 200);
    }
}
