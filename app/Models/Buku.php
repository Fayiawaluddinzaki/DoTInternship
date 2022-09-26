<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class buku extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'buku';
    protected $fillable = ['judul', 'penulis', 'penerbit', 'kategori_id'];
}
