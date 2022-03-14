<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Notes;
use App\Models\User;

class ClientCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'case_status',
        'case_title',
        'client_name',
        'case_subject',
        'case_number',

        'resplawyer_name',
        'resplawyer_phone',
        'resplawyer_email',
        'resplawyer_lawfirmname',
        'resplawyer_lawfirmcity',
        'resplawyer_lawfirmaddress',

        'court_name',
        'court_city',
        'nextcourt_date',
        'notes',
        'added_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
