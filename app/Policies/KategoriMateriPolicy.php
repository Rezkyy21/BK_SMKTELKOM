<?php

namespace App\Policies;

use App\Models\KategoriMateri;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KategoriMateriPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function view(User $user, KategoriMateri $kategoriMateri): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, KategoriMateri $kategoriMateri): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, KategoriMateri $kategoriMateri): bool
    {
        return $user->role === 'admin';
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, KategoriMateri $kategoriMateri): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, KategoriMateri $kategoriMateri): bool
    {
        return $user->role === 'admin';
    }
}
