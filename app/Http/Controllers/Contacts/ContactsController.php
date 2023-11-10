<?php

namespace App\Http\Controllers\Contacts;

use App\Models\Tag;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewContactRequest;

class ContactsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $contacts = $user->contacts()
            ->latest()
            ->paginate(10);

        $totalCount = $user->contacts()->count();

        $tagCounts = $user->contacts()
            ->select('tag_id', \DB::raw('count(*) as count'))
            ->groupBy('tag_id')
            ->pluck('count', 'tag_id')
            ->toArray();

        $tags = Tag::all();

        foreach ($tags as $tag) {
            $tag->count = $tagCounts[$tag->id] ?? 0;
        }

        return view('dashboard', compact('contacts', 'tags', 'totalCount'));
    }

    public function create()
    {
        return view('new-contact');
    }

    public function store(NewContactRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['profile_photo_path'] = $request->file('photo')->store('contacts/photos', 'public');
        }

        $tag_id = Tag::where('name', $request->category)->first()->id;

        $data['tag_id'] = $tag_id;

        $user->contacts()->create($data);

        return redirect()->route('contacts.index');
    }

    public function show(Contact $contact)
    {
        try {
            $this->authorize('view', $contact);
            $contact->load('tag', 'user');

            return view('view-contact', compact('contact'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('contacts.index')->with('error', $error);
        }
    }

    public function edit(Contact $contact)
    {
        try {
            $this->authorize('update', $contact);
            $contact->load('tag', 'user');

            return view('edit-contact', compact('contact'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('contacts.index')->with('error', $error);
        }
    }

    public function update(NewContactRequest $request, Contact $contact)
    {
        try {
            $this->authorize('update', $contact);
            $data = $request->validated();

            if ($request->hasFile('photo')) {
                $data['profile_photo_path'] = $request->file('photo')->store('contacts/photos', 'public');
            }

            $tag_id = Tag::where('name', $request->category)->first()->id;

            $data['tag_id'] = $tag_id;

            $contact->update($data);

            return redirect()->route('contacts.index');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('contacts.index')->with('error', $error);
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $this->authorize('delete', $contact);
            $contact->delete();

            return redirect()->route('contacts.index');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('contacts.index')->with('error', $error);
        }
    }

    public function filterContacts(Tag $tag_id)
    {
        $user = auth()->user();
        $contacts = $tag_id->contacts()
            ->latest()
            ->paginate(10);

        $totalCount = $user->contacts()->count();

        $tagCounts = $user->contacts()
            ->select('tag_id', \DB::raw('count(*) as count'))
            ->groupBy('tag_id')
            ->pluck('count', 'tag_id')
            ->toArray();

        $tags = Tag::all();

        foreach ($tags as $tag) {
            $tag->count = $tagCounts[$tag->id] ?? 0;
        }

        return view('dashboard', compact('contacts', 'tags', 'totalCount'));
    }

    public function deletedContacts()
    {
        $user = auth()->user();
        $contacts = $user->contacts()
            ->onlyTrashed()
            ->latest()
            ->paginate(10);


        return view('trash', compact('contacts'));
    }
}
