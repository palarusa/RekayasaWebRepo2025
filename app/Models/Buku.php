<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Buku extends Model
{
    protected $table = 'table_buku';
    protected $fillable = ['nama_buku', 'harga', 'deskripsi'];
    public $timestamps = true;
}