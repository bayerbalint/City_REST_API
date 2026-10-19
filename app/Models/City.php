<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class City extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'zip_code',
        'city',
        'population',
        'county_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getCities(){
        return $this->hasMany(City::class, 'id_county');
    }

    public function getPopulation(){
        return City::all()->where('county_id', '=', $this->getKey())->sum('population');
    }
}
