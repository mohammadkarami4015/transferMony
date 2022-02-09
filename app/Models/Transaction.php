<?php

namespace App\Models;

use App\services\Finotech;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['source_id', 'destination_id', 'description', 'amount', 'status'];

    public static function makeTransactionData($sourceUser, $destinationUser, $request)
    {
        return [
            "description" => $request->get('description'),
            "amount" => $request->get('amount'),
            "deposit" => $sourceUser->account_nubmer,
            "sourceFirstName" => $sourceUser->first_name,
            "sourceLastName" => $sourceUser->last_name,
            "destinationFirstname" => $destinationUser->first_name,
            "destinationLastname" => $destinationUser->last_name,
            "destinationNumber" => $request->get('type') == 'account' ? $sourceUser->account_number : $sourceUser->shaba_number,
            "paymentNumber" => "123456",
        ];
    }

    public static function add(User $sourceUser, $destinationUser, $response, $request)
    {
        return $sourceUser->sentTransactions()->create([
            'destination_id' => $destinationUser->id,
            'description' => $request->get('description'),
            'amount' => $request->get('amount'),
            'status' => $response['status'],
            'ref_code' => $response['status'] == 'DONE' ? $response['result']['refCode'] : null
        ]);
    }

    public static function transfer($sourceUser, $destinationUser, $request)
    {
        $transactionData = Transaction::makeTransactionData($sourceUser, $destinationUser, $request);
        $transfer = new Finotech();
        return $transfer->send($transactionData);
    }

    public function destinationUser()
    {
        return $this->belongsTo(User::class, 'destination_id');
    }

    public function sourceUser()
    {
        return $this->belongsTo(User::class, 'source_id');
    }
}
