<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_offer_id',
        'status',
        'cv_path',
        'cover_letter_path',
    ];

  
    

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class,'job_offer_id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // Linking the user to the application
}
}