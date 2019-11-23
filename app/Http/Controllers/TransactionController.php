<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

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

    public function store(Request $request)
    {
        $arrTransaction = [
            'id' => Uuid::generate(),
            'ticket_id' => $request->input('ticketId'),
            'qty' => $request->input('qty'),
            'created_at' => Carbon::now(),
            'member_id' => Auth::id()
        ];
        
        $id = $this->transaction->storeTransaction($arrTransaction);
        
        if (!$id) {
            return response()->json(['success' => false], 500);
        }

        return response()->json(['success' => true, 'result' => $id], 200);
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
