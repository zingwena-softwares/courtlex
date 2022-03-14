<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
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
    public function notecase(){
        return $this->belongsTo(ClientCase::class);
    }

    public function noteclient()
    {
        return $this->belongsTo(Client::class);
    }

}
