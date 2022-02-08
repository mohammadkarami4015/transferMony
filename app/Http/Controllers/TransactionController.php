<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function transactions()
    {
        /** @var User $user */
        $user = auth()->user();
        $transactions = $user->transactions()->get();
        return Response::success(TransactionResponse::collection($transactions));
    }

    public function create(TransactionRequest $request)
    {

    }
}
