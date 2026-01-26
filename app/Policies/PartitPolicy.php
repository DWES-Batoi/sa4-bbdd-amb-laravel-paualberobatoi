<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;

class PartitPolicy
{
    private function isAdmin(User $user): bool
    {
        return ($user->role ?? null) === 'administrador';
    }

    // Lectura pública
    public function viewAny(?User $user = null): bool 
    { 
        return true; 
    }
    
    public function view(?User $user = null, ?Partit $partit = null): bool 
    { 
        return true; 
    }

    // Escriptura només admin
    public function create(User $user): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function update(User $user, Partit $partit): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function delete(User $user, Partit $partit): bool 
    { 
        return $this->isAdmin($user); 
    }

    public function restore(User $user, Partit $partit): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function forceDelete(User $user, Partit $partit): bool 
    { 
        return $this->isAdmin($user); 
    }
}
