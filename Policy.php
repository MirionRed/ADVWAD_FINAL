<?php

namespace App\Policies;

use App\User;
use App\Division;
use Bouncer;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view (User $user){
      //BOUNCER
      return $user->can('view-division');
    }

    public function create(User $user){
      //BOUNCER
      return $user->can('create-division');
    }

    public function manage(User $user, Division $division){
      //BOUNCER
      return $user->can('manage-division');
    }

    //LARAVEL
    public function laravel(User $user, Post $post){
      return $user->id === $post->user_id;
    }
    public function noModel(User $user){

    }
    public function before($user, $ability){
      if($user->isSuperAdmin()){
        return true;
      }
    }

    //IMPLEMENT POLICY IN CONTROLLER METHOD
    //MIGHT BE IN POLICY CLASS
    public function create(){
      if($user->can('update', $post)){

      }
      if($user->can('create', Post::class)){

      }
    }
}
