<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'user_id',
        'description',
        'value',
        'date',
        'competence_month',
        
    ];

    public function Company()
{
    return $this->belongsTo(Company::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}


