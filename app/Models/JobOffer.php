<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'company',
        'salary',
        'image',
        'user_id', // Add user_id here
        'recruiter_id',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function applications()
{
    return $this->hasMany(Application::class);
}

public function recruiter()
{
    return $this->belongsTo(User::class, 'recruiter_id');
}

}
