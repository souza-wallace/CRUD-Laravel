<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'cpf', 'date_born'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
