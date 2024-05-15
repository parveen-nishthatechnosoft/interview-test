<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel;
use App\Models\StockModel;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    public function getCategoryInfo()
    {
        return $this->hasOne(CategoryModel::class, 'id', 'category_id');
    }
    public function getStockInfo()
    {
        return $this->hasOne(StockModel::class, 'id', 'stock_id');
    }
}