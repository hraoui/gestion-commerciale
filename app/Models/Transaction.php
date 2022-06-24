<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'amount', 'paiment_method_id', 'type', 'customer_id',  'sale_id',
    ];

    public function method()
    {
        return $this->belongsTo(PaimentMethod::class, 'paiment_method_id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transfert()
    {
        return $this->belongsTo(Transfert::class);
    }

    public function scopeFindByPaimentMethodId($query, $id)
    {
        return $query->where('paiment_method_id', $id);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }
}
