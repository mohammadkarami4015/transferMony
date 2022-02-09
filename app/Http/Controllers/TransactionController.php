<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\ReceivedTransactionResponse;
use App\Http\Resources\SentTransactionResponse;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function transactions()
    {
        /** @var User $user */
        $user = auth()->user();
        $transactions = $user->load('sentTransactions', 'receivedTransactions');

        return Response::success([
            'sent_transactions' => SentTransactionResponse::collection($transactions->sentTransactions),
            'received_transactions' => ReceivedTransactionResponse::collection($transactions->receivedTransactions),
        ]);
    }

    public function create(TransactionRequest $request)
    {
        /** @var User $sourceUser */
        $sourceUser = auth()->user();
        $destinationUser = User::findDestinationUser($request);

        if (is_null($destinationUser) or $sourceUser == $destinationUser)
            return Response::error(Status::getMessage(404));

        $response = Transaction::transfer($sourceUser, $destinationUser, $request);

        Transaction::add($sourceUser, $destinationUser, $response, $request);

        return $response['status'] == 'DONE'
            ? Response::success(Status::getMessage(200))
            : Response::error($response["error"]["code"]);

    }
}
