<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, boolean>
     */
    protected $fillable = [
        'name',
        'email',
        'active',
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
