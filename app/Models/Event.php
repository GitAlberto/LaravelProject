<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Event extends Model
{
    use HasFactory;
 
    protected $fillable = ['title', 'slug', 'description', 'location', 'date', 'category', 'max_participants'];
 
    // Relation avec le modèle UserProfile (inscriptions des profils d'utilisateur)
    public function userProfiles()
    {
        return $this->belongsToMany(UserProfile::class, 'event_user')->withTimestamps();
    }
 
    // Relation avec le modèle Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
