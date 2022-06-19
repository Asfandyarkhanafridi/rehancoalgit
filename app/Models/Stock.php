<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
    public function quality()
    {
        return $this->belongsTo(Quality::class , 'quality_id');
    }

    static function stockMaintenance()
    {
          return  DB::select('
									select
									       companies.company_name,
										   qualities.quality,
										SUM(temp.totalWeight) as stock
									from
										(
										select
											purchases.company_id,
											purchases.quality_id,
											SUM(purchases.weight) as totalWeight
										from
											purchases
										group by
											purchases.company_id,
											purchases.quality_id
									union
										select
											sales.company_id,
											sales.quality_id,
											SUM(sales.weight * -1) as totalWeight
										from
											sales
										group by
											sales.company_id,
											sales.quality_id
									) as temp
									inner join companies on companies.id = temp.company_id
									inner join qualities on qualities.id = temp.quality_id
									group by
										company_name,
										quality
');
    }
}
