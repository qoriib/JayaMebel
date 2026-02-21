<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'gambar',
        'stok',
        'stok_status',
        'harga',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'stok' => 'integer',
        ];
    }

    /**
     * URL publik gambar produk — menghormati disk yang dikonfigurasi (public / r2).
     */
    public function getGambarUrlAttribute(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        return Storage::disk(config('filesystems.product_disk'))->url($this->gambar);
    }

    /**
     * Detail penjualan tempat produk muncul.
     */
    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    /**
     * Penjualan yang melibatkan produk.
     */
    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, 'sale_details')
            ->withPivot(['jumlah', 'subtotal'])
            ->withTimestamps();
    }
}
