<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['source_id', 'destination_id', 'description', 'amount', 'status'];

    public function destinationUser()
    {
        return $this->belongsTo(User::class,'destination_id');
    }

    public function sourceUser()
    {
        return $this->belongsTo(User::class,'source_id');
    }
}
