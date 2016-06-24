<?php

namespace ExtrasMe\Auth;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Application;

use ExtrasMeApi, Session;

class ApiUserProvider implements UserProvider
{

   public function retrieveById($identifier)
   {
      try {
         return new User(ExtrasMeApi::getUser($identifier));
      } catch (\Exception $e) {
         return null;
      }
   }

   public function retrieveByToken($identifier, $token)
   {

   }

   public function updateRememberToken(Authenticatable $user, $token)
   {

   }

   public function retrieveByCredentials(array $credentials)
   {
      try {
         return $this->retrieveById($credentials['email']);
      } catch (\Exception $e) {
         return null;
      }
   }

   public function validateCredentials(Authenticatable $user, array $credentials)
   {
      try {
         $token = ExtrasMeApi::authenticate($credentials['email'], $credentials['password']);
         Session::set('api_token', $token);
         return true;
      } catch (\Exception $e) {
         return false;
      }
   }

}
