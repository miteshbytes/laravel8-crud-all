<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email',
        'password',
        'phone',
        'gender',
        'city',
        'skills',
        'hobbies',
        'about_us',
        'image',
        'created_at',
        'updated_at'
    ];

    public function setSkillsAttribute($value)
    {
        $this->attributes['skills'] = json_encode($value);
    }

    public function getSkillsAttribute($value)
    {
        return $this->attributes['skills'] = json_decode($value);
    }

    /**
     * Set the categories
     *
     */
    public function setHobbiesAttribute($value)
    {
        $this->attributes['hobbies'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getHobbiesAttribute($value)
    {
        return $this->attributes['hobbies'] = json_decode($value);
    }

    // get Full name accesor
    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}
