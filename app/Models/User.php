<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'api_token', 'account_number', 'shaba_number'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public static function findDestinationUser( $request)
    {
        $destinationQuery = User::query()->where('first_name', $request->get('first_name'));
        return $request->get('type') == 'account'
            ? $destinationQuery->where('account_number', $request->get('account_number'))->first()
            : $destinationQuery->where('shaba_number', $request->get('shaba_number'))->first();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function generateToken()
    {
        $token = Str::random(60);
        $this->update(['api_token' => $token]);

        return $token;
    }


    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class,'destination_id');
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class,'source_id');
    }

}
