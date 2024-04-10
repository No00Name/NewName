<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Advertisement;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Username',
        'password',
        'Email',
        'UserPhoto',
        'Role',
        'Banet'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function uploadImage(Request $request, $UserPhoto = null)
    // {
    //     if ($request->hasfile('UserPhoto')) {
    //         if ($UserPhoto) {
    //             Storage::delete($UserPhoto);
    //         }
    //         $folder = date('Y-m-d');
    //         return $request->file('UserPhoto')->store("images/{$folder}");
    //     }
    //     return null;
    // }

    // public function getImage()
    // {
    //     if(!$this->UserPhoto){
    //         return asset("no-image.png");
    //     }
    //     return asset("uploads/{$this->UserPhoto}");
    // }

    public function Advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
