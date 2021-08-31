<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    
    protected $fillable = ['quantity','price', 'total_product', 'invoice_id', 'product_id'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
