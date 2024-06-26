<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenareteQRFile extends Model
{
    use HasFactory;




    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($table) {
            // $table->updated_by = auth()->id();
            $table->updated_at = now();
        });

        static::creating(function ($table) {
            // $table->created_by = auth()->id();
            $table->created_at = now();
        });
    }
}
