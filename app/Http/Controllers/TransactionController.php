<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function moveBalance(Request $request, TransactionService $transactionService, NotificationService $notificationService)
    {
        // Validate the request
        $request->validate([
            'source_card_number' => 'required',
            'destination_card_number' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Use the TransactionService to move the balance
            $transaction = $transactionService->moveBalance($request->source_card_number, $request->destination_card_number, $request->amount);

            // Use the NotificationService to send notifications
            $notificationService->sendTransactionNotification($transaction);

            DB::commit();

            // Return a success response
            return response()->json(['success' => 'Balance moved successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            // Return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
