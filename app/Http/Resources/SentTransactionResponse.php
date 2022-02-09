<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

class SentTransactionResponse extends JsonResource
{

    public function toArray($request)
    {
        /** @var Transaction $this */
        return [
            'destination_first_name' => $this->destinationUser->first_name,
            'destination_last_name' => $this->destinationUser->last_name,
            'destination_number' => $this->destinationUser->account_number,
            'amount' => $this->amount,
            'date' => $this->created_at->format('Y:m:d H:i'),
            'status' => $this->status
        ];
    }
}
