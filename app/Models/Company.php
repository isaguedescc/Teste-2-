<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'cnpj',
    ];
      //

      public function Accounting()
      {
          return $this->belongsTo(Accounting::class);
      }
  
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
