<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasOne; // Importation de la relation HasOne
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,HasFactory, Notifiable;
 
=======
use Laravel\Sanctum\HasApiTokens; // Ajout du trait HasApiTokens
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Inclusion du trait HasApiTokens

>>>>>>> 3094e2fb280ea48425fc26148eb9247f1bb7e03e
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Définition de la relation One-to-One avec UserProfile.
     * Un utilisateur possède un seul profil.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'super_admin'; // Les super-admins sont aussi admins
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Accesseur pour la propriété 'role'
     */
    public function getRoleAttribute()
    {
        return $this->attributes['role'] ?? 'user';;  // Retourne la valeur de la colonne 'role'
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
    }
}
