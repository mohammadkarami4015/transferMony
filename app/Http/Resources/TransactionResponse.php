<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResponse extends JsonResource
{

    public function toArray($request)
    {
        /** @var Transaction $this */
        return [
            'destination_first_name' => $this->destinationUser()->first_number,
            'destination_last_name' => $this->destinationUser()->last_number,
            'destination_number' => $this->destination_number,
            'amount'=>$this->amount,
            'date'=>$this->created_at->format('Y:m:d H:i'),
            'status'=>$this->status
        ];
    }
}
