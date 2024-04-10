<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = ['User_id', 'Category_id', 'Title', 'Description', 'AdPhoto', 'Public'];

    public function Users()
    {
        return $this->belongsTo(User::class, 'User_id');
    }
}
