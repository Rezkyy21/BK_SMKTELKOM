<?php

namespace App\Policies;

use App\Models\Materi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MateriPolicy
{
    public function viewAny(User $user): bool
    {
        // Admin can view all; guru_bk can view all (they manage their own in list)
        return $user->role === 'admin' || $user->role === 'guru_bk';
    }

    public function view(User $user, Materi $materi): bool
    {
        // Admin can view all; guru_bk can only view their own
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'guru_bk') {
            return $materi->guru_id === optional($user->guruBk)->id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        // Only admin and guru_bk can create
        return $user->role === 'admin' || $user->role === 'guru_bk';
    }

    public function update(User $user, Materi $materi): bool
    {
        // Admin can update all; guru_bk can only update their own
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'guru_bk') {
            return $materi->guru_id === optional($user->guruBk)->id;
        }
        return false;
    }

    public function delete(User $user, Materi $materi): bool
    {
        // Admin can delete all; guru_bk can only delete their own
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'guru_bk') {
            return $materi->guru_id === optional($user->guruBk)->id;
        }
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, Materi $materi): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Materi $materi): bool
    {
        return $user->role === 'admin';
    }
}
