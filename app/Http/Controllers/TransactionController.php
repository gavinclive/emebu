<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Ticket;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class TransactionController extends Controller
{
    private $transaction;
    private $ticket;
    private $coupon;

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->ticket = new Ticket();
        $this->coupon = new Coupon();
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
        $this->coupon->useCoupon([
            'qty' => $request->input('qty'),
            'id' => $request->input('coupon_id')
        ]);
        $newSold = $this->ticket->getTicketById($request->input('ticketId'));

        $this->ticket->updateTicket([
            'sold' => $newSold->sold+$request->input('qty'),
        ], $request->input('ticketId'));

        $arrTransaction = [
            'id' => Uuid::generate(),
            'ticket_id' => $request->input('ticketId'),
            'qty' => $request->input('qty'),
            'created_at' => Carbon::now(),
            'member_id' => Auth::id(),
            'coupon_id' => $request->input('coupon_id')
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

    public function update(Request $request)
    {
        $this->transaction->settleTransactionById($request->input('id'));

        return response()->json(['success' => true], 200);
    }

    public function history(Request $request)
    {
        return response()->json(['success' => true, $this->transaction->getTransactionByMemberId($request->input('member_id'), 'past')], 200);
    }
}
