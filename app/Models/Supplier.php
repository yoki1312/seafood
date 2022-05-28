<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supplier extends Authenticatable
{
    use Notifiable;

    protected $guard = 'supplier';

    protected $fillable = [
        'nama_supplier', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}