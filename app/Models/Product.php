<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ชื่อตาราง (Laravel จะเดาเป็น "products" โดยอัตโนมัติ ถ้าไม่ตรงค่อยใส่เอง)
    protected $table = 'products';

    // ฟิลด์ที่แก้ไขได้
    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];
}
