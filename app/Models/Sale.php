<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $table = 'sales';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'customer_id',
        'sold_by',
        'quantity',
        'total_price',
        'created_at'
    ];

    public $timestamps = false;

    public function getSalesHistory()
    {
        return DB::table('sales')
            ->select(
                'sales.*',
                'products.name as product_name',
                'customers.full_name as customer_name',
                'users.full_name as staff_name'
            )
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->leftJoin('customers', 'customers.id', '=', 'sales.customer_id')
            ->join('users', 'users.id', '=', 'sales.sold_by')
            ->orderBy('sales.created_at', 'DESC')
            ->get();
    }
}
