<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Party_payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function party()
    {
        return $this->belongsTo(Party::class , 'party_id');
    }
    
	public static function creditDebitRecordsParty(){
		return DB::select('SELECT
								created_at,
                                party_id,
                                amount,
                                0 as isDebit
                            FROM sales
                            UNION
                            SELECT
                            	created_at,
                                party_id,
                                amount,
                                1 as isDebit
                            FROM party_payments');
	}
	
}
