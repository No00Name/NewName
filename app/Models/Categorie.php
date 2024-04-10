<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Advertisement;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['CategoryName'];

    public function Advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

}
