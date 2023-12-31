<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMoneyRequest;
use App\Services\Notification\NotificationService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class TransactionController extends Controller
{
    public function index(Request $request, TransactionService $transactionService)
    {
        return response()->json(['accounts' => $transactionService->getTopTransactions()]);
    }

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
            throw $e;
        }
    }
}
