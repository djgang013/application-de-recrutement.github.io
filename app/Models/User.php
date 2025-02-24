<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    

  

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class, 'recruiter_id');
    }

    public function appliedJobOffers()
    {
        return $this->hasManyThrough(JobOffer::class, Application::class, 'user_id', 'id', 'id', 'job_offer_id');
    }
   
public function isRecruiter()
{
    return $this->role === 'recruteur';

}
public function isCandidat()
{
    return $this->role === 'candidat';
}
}
