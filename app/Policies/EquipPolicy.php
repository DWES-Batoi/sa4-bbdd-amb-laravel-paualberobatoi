<?php

namespace App\Policies;

use App\Models\Equip;
use App\Models\User;

class EquipPolicy
{
    private function isAdmin(User $user): bool
    {
        return ($user->role ?? null) === 'administrador';
    }

    public function viewAny(?User $user = null): bool 
    { 
        return true; 
    }
    
    public function view(?User $user = null, ?Equip $equip = null): bool 
    { 
        return true; 
    }

    public function create(User $user): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function update(User $user, Equip $equip): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function delete(User $user, Equip $equip): bool 
    { 
        return $this->isAdmin($user); 
    }

    public function restore(User $user, Equip $equip): bool 
    { 
        return $this->isAdmin($user); 
    }
    
    public function forceDelete(User $user, Equip $equip): bool 
    { 
        return $this->isAdmin($user); 
    }
}
