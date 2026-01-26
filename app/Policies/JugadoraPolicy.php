<?php

namespace App\Policies;

use App\Models\Jugadora;
use App\Models\User;

class JugadoraPolicy
{
    private function isAdmin(User $user): bool
    {
        return ($user->role ?? null) === 'administrador';
    }

    public function viewAny(?User $user = null): bool 
    { 
        return true; 
    }
    
    public function view(?User $user = null, ?Jugadora $jugadora = null): bool 
    { 
        return true; 
    }

    public function create(User $user): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function update(User $user, Jugadora $jugadora): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function delete(User $user, Jugadora $jugadora): bool 
    { 
        return $this->isAdmin($user); 
    }

    public function restore(User $user, Jugadora $jugadora): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function forceDelete(User $user, Jugadora $jugadora): bool 
    { 
        return $this->isAdmin($user); 
    }
}
