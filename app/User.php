<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'guid', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $codes;

    public function functionCodes(){
      if(isset($this->codes)) return $this->codes;

      $this->codes = collect();

      if($this->isSystemManager){
        $this->codes = collect(['*']);
        return $this->codes; 
      }

      if($this->isAuditor){
        $this->codes = $this->codes->merge(['forum','tv','radio']); 
      }

      if($this->isEditor){
        $this->codes = $this->codes->merge(['tv','radio']); 
      }

      // if($this->isADManager){
      //   $codes = $codes->merge(['ad']); 
      // }

      return $this->codes;
    }

    public function canUseFunction(string $functionCode){
      return $this->functionCodes()->contains('*') || 
        $this->functionCodes()->contains($functionCode);
    }

    
}
