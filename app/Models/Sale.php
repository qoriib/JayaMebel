<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'total_harga',
        'tanggal_penjualan',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_harga' => 'decimal:2',
            'tanggal_penjualan' => 'datetime',
        ];
    }

    /**
     * Kasir yang memproses penjualan.
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Rincian barang pada penjualan.
     */
    public function details(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    /**
     * Produk yang terlibat pada penjualan.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'sale_details')
            ->withPivot(['jumlah', 'subtotal'])
            ->withTimestamps();
    }
}
