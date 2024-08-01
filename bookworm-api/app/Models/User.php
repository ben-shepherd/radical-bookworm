<?php

namespace App\Models;

use App\Domains\Books\Models\BookFavourite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Relations\HasMany;

/**
 * @property string $_id
 * @property string $name
 * @property string $email
 * @property ?string $password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favouriteBooks(): HasMany
    {
        return $this->hasMany(BookFavourite::class, 'userId', '_id');
    }
}
