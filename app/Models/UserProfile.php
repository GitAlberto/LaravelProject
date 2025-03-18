<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class UserProfile extends Model
{
    use HasFactory;
 
    protected $fillable = ['user_id', 'fist_name', 'postale_code','city','age','sex'];
 
    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
