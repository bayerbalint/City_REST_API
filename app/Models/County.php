<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class County extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'badge',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getCounty(){
        return $this->belongsTo(County::class, 'county_id')->get('name')[0]['name'];
    }
}
