<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected  $table = 'tasks';

    protected $casts = [
    	'done' => 'boolean'
    ];

    protected $fillable = ['nome', 'tipo_id'];

    public function tipo()
    {
    	return $this->belongsTo('App\Tipo');
    }
}
