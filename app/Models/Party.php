<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    protected $fillable = ['party_name', 'contact_person', 'address', 'phone'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function party_payments()
    {
        return $this->hasMany(Party_payment::class);
    }
}
