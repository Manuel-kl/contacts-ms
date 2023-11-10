<?php

namespace App\Http\Controllers\Contacts;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ContactService;

class FilterContactsController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function filterContacts(Tag $tag_id)
    {
        $user = auth()->user();
        $contacts = $tag_id->contacts()
            ->latest()
            ->paginate(10);

        $totalCount = $user->contacts()->count();
        $tagCounts = $this->contactService->getTagCounts($user);

        $tags = Tag::all();

        foreach ($tags as $tag) {
            $tag->count = $tagCounts[$tag->id] ?? 0;
        }

        return view('dashboard', compact('contacts', 'tags', 'totalCount'));
    }
}
