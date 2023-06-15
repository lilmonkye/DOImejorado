<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Casts\CleanHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'users';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'=>'espera',
        'aval',
        'dependencia',
        'correoaval'

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
        'aval'          =>  CleanHtml::class,
        'dependencia'   =>  CleanHtml::class,
        'password'      =>  CleanHtml::class,
        'correoaval'    =>  CleanHtml::class,
    ];

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }

    public function revistas(){
        return $this->hasMany(Revista::class);
    }

    public function hasRole($role)
    {
        return $this->role == $role;
    }
}
