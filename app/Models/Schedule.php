<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClientCase;
use App\Models\Client;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'type_subject',
        'title',
        'date',
        'detail',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function schedcase(){
        return $this->belongsTo(ClientCase::class);
    }

    public function schedclient()
    {
        return $this->belongsTo(Client::class);
    }

}
