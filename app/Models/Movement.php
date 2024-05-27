<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'product_id',
        'stock',
        'person',
        'notes'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
