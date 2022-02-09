<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceivedTransactionResponse extends JsonResource
{

    public function toArray($request)
    {
        /** @var Transaction $this */
        return [
            'source_first_name' => $this->sourceUser->first_name,
            'source_last_name' => $this->sourceUser->last_name,
            'source_number' => $this->sourceUser->account_number,
            'amount'=>$this->amount,
            'date'=>$this->created_at->format('Y:m:d H:i'),
            'status'=>$this->status
        ];
    }
}
