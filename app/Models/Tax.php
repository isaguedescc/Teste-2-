<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{ 
    use HasFactory;
    protected $fillable = [
        'type',
        'name',
        'value',
        'due_date',
        'competence_month',
        'status',
        'company_id',
        'user_id',
    
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
