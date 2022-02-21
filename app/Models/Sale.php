<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
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
    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
    public function quality()
    {
        return $this->belongsTo(Quality::class , 'quality_id');
    }
    public function party_payments()
    {
        return $this->hasMany(Party_payment::class);
    }
    public static function getStock($company_id = null, $quality_id = null)
    {
        $whereClause = '';
        if ( is_numeric($company_id)  && $company_id > 0 )
        {
            $whereClause.= 'AND temp.company_id = '. $company_id;
        }
        if ( is_numeric($quality_id)  && $quality_id > 0 )
        {
            $whereClause.= 'AND temp.quality_id = '. $company_id;
        }
         return DB::select('
 select
	company_id,
	quality_id,
	(SUM(totalPurchaseWeight) - SUM(totalSaleWeight)) as netWeightRemaining
from
	(
	select
		sales.company_id,
		sales.quality_id,
		SUM(sales.weight) as totalSaleWeight,
		0 as totalPurchaseWeight
	from
		sales
	group by
		sales.company_id,
		sales.quality_id
union
	select
		purchases.company_id,
		purchases.quality_id,
		0 as totalSaleWeight,
		SUM(purchases.weight) as totalPurchaseWeight
	from
		purchases
	group by
		purchases.company_id,
		purchases.quality_id
) as temp
group by
	company_id,
	quality_id
having netWeightRemaining > 0
         ');
    }
}
