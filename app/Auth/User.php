<?php

namespace ExtrasMe\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use ExtrasMe\ApiClient\Models\User as EMUser;

class User implements Authenticatable
{

   protected $auth_identifier = 'email';
   protected $user;

   public function __construct(EMUser $user)
   {
      $this->user = $user;
   }

   public function getUserAttributes()
   {
      return $this->user->getAttributes();
   }

   public function getAuthIdentifier()
   {
      return $this->user->getAttribute($this->auth_identifier);
   }

   public function getAuthPassword()
   {
      return $this->user->getAttribute('password');
   }

   public function getRememberToken()
   {
      //TODO
   }

   public function setRememberToken($value)
   {
      //TODO
   }

   public function getRememberTokenName()
   {
      //TODO
   }

   public function getUserModel()
   {
      return $this->user;
   }

   public function __get($key)
   {
      return $this->user->getAttribute($key);
   }

   public function __set($key, $value)
   {
      return $this->user->setAttribute($key, $value);
   }
}
