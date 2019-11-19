<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function index()
    {
        if(!$this->transaction->getAllTransaction())
        {
            return response()->json(['success' => false, 500]);
        }

        return response()->json(['sucees' => true, 'result' => $this->transaction->getAllTransaction()], 200);
    }

    public function store($value)
    {

    }

    public function edit($id)
    {
        return response()->json(['success' => true, 'result' => $this->transaction->getTransactionById($id)], 200);
    }

    public function update($id)
    {
        $this->transaction->settleTransactionById($id);

        return response()->json(['success' => true], 200);
    }
}
