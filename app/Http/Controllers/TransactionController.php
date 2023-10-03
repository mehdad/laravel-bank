<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMoneyRequest;
use App\Services\TransactionService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function moveBalance(SendMoneyRequest $request, TransactionService $transactionService, NotificationService $notificationService)
    {
        DB::beginTransaction();
        try {
            $transaction = $transactionService->moveBalance($request->source_card_number, $request->destination_card_number, $request->amount);

            $notificationService->sendTransactionNotification($transaction);

            DB::commit();

            return response()->json(['success' => 'Balance moved successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
