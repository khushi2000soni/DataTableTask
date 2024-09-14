<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    public $timestamps = true; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'status',
        'type',
    ];

    public function scopeSearchByUsername(Builder $query, $username)
    {
        $username = trim($username);
        $username = str_replace('@', '', $username);        
        if (strpos($username, '!') === 0) {
            $excludedTerm = ltrim($username, '!');
            return $query->where('username', 'NOT LIKE', "%$excludedTerm%");
        }        
        $searchTerm = str_replace('*', '%', $username);        
        return $query->where('username', 'LIKE', $searchTerm);        
    }

    
    public function scopeSearchByEmail(Builder $query, $email)
    {
        $email = trim($email);
        if (strpos($email, '!') === 0) {
            $excludedTerm = ltrim($email, '!');
            return $query->where('username', 'NOT LIKE', "%$excludedTerm%");
        }        
        $searchTerm = str_replace('*', '%', $email);        
        return $query->where('email', 'LIKE', $searchTerm);         
    }

    public function scopeSearchByCreatedAt(Builder $query, $created_at)
    {               
        if (strpos($created_at, '[gte]') !== false) {
            $date = str_replace('[gte]', '', $created_at);
            $query->whereDate('created_at', '>=', $date);
        }

        if (strpos($created_at, '[lte]') !== false) {
            $date = str_replace('[lte]', '', $created_at);
            $query->whereDate('created_at', '<=', $date);
        }

        if (strpos($created_at, '[gte]') === false && strpos($created_at, '[lte]') === false) {
            $query->whereDate('created_at', '=', $created_at);
        }

        return $query;
    }


    
}
