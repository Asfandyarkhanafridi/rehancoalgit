<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company_payment extends Model
{
    use HasFactory;
    protected  $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }

	public static function creditDebitRecords(){
    	return DB::select('SELECT
								created_at,
                                company_id,
                                amount,
                                1 as isDebit
                            FROM purchases
                            UNION
                            SELECT
                            	created_at,
                                company_id,
                                amount,
                                0 as isDebit
                            FROM company_payments');
	}

}
