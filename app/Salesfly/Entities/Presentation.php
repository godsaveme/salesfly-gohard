<?php
namespace Salesfly\Salesfly\Entities;

class Presentation extends \Eloquent {

    protected $table = 'presentation';

    protected $fillable = ['nombre','shortname','descripcion'];
 public function detPre(){
        return $this->hasMany('Salesfly\Salesfly\Entities\DetPres');
    }
    public function equiv(){
        return $this->hasMany('Salesfly\Salesfly\Entities\Equiv');
    }
}