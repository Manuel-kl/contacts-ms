<?php

namespace App\Http\Controllers\Contacts;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Services\ContactService;
use App\Http\Requests\NewContactRequest;

class ContactsController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $user = auth()->user();
        $contactData = $this->contactService->getContactData($user);

        return view('dashboard', $contactData);
    }

    public function create()
    {
        return view('new-contact');
    }

    public function store(NewContactRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        $this->contactService->createContact($user, $data);

        return redirect()->route('contacts.index');
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);
        $contact->load('tag', 'user');

        return view('view-contact', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);
        $contact->load('tag', 'user');

        return view('edit-contact', compact('contact'));
    }

    public function update(NewContactRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);
        $data = $request->validated();

        $this->contactService->updateContact($contact, $data);

        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact->delete();

        return redirect()->route('contacts.index');
    }
}
