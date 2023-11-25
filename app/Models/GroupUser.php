<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'group_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, date>
     */
    protected $fillable = [
        'user_id',
        'group_id',
        'expires_at',
    ];

    protected $observers = [
        GroupUser::class => [GroupUserObserver::class],
    ];
}
