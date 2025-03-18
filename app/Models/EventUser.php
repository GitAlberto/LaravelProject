<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
 
class EventUser extends Model

{

    use HasFactory;
 
    protected $fillable = ['user_profile_id', 'event_id'];
 
    // Relation avec le modèle UserProfile

    public function userProfile()

    {

        return $this->belongsTo(UserProfile::class);

    }
 
    // Relation avec le modèle Event

   // Relation plusieurs-à-plusieurs avec Event
   public function events()
   {
       return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
   }

}

 