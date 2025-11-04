<?php

namespace App\Models;

use App\Enums\StatutCompte;
use App\Enums\TypeCompte;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    public $incrementing = false; 
    protected $keyType = 'string';


   protected $fillable = [
        'client_id',
        'numero_compte',
        'type_compte',
        'statut_compte',
        'date_debut_blocage',
        'date_fin_blocage'
    ];

    protected $casts= [
        'type_compte' => TypeCompte::class,
        'statut_compte' => StatutCompte::class
    ];


    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }


    public function client(){
        return $this->belongsTo(Client::class);
    }
    
}
