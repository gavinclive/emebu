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

    public function paymentInfo (Request $request) {
        if (!$this->user->getPaymentInfo($request->input('id'))) {
            return response()->json(['success' => false], 500);
        }
        return response()->json(['success' => true, 'result' => $this->user->getPaymentInfo($request->input('id'))], 200);
    }

    public function banUser (Request $request)
    {
        $this->user->banUserById($request->input('id'));
    }

    public function restoreUser (Request $request)
    {
        $this->user->restoreUserById($request->input('id'));
    }

    public function deleteUser (Request $request)
    {
        $this->user->deleteUserById($request->input('id'));
    }
}
