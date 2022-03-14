<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClientCase;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'phone',
        'email',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function client(){
        return $this->hasMany(ClientCase::class);
    }

    public function cases()
    {
        return $this->hasMany(ClientCase::class);
    }


}
