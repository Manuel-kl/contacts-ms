<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactPolicy
{

    public function viewAny(User $user): bool
    {
        // Users can view all contacts
        return false;
    }

    public function view(User $user, Contact $contact): bool
    {
        // Users can only view their own contacts
        return $user->id === $contact->user_id;
    }

    public function create(User $user): bool
    {
        // All users can create contacts
        return true;
    }

    public function update(User $user, Contact $contact): bool
    {
        // Users can only update their own contacts
        return $user->id === $contact->user_id;
    }

    public function delete(User $user, Contact $contact): bool
    {
        // Users can only delete their own contacts
        return $user->id === $contact->user_id;
    }
}
