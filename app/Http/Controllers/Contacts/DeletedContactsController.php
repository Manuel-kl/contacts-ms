<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;

class DeletedContactsController extends Controller
{
    public function deletedContacts()
    {
        $user = auth()->user();
        $contacts = $user->contacts()
            ->onlyTrashed()
            ->latest()
            ->paginate(10);

        $totalThrashContacts = $user->contacts()->onlyTrashed()->count();

        return view('trash', compact('contacts', 'totalThrashContacts'));
    }

    public function restoreContact($contact)
    {
        $user = auth()->user();
        $contact = $user->contacts()->onlyTrashed()->where('id', $contact)->first();

        $contact->restore();

        return redirect()->route('contacts.trash');
    }
}
