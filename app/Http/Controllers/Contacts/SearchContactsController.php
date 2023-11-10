<?php

namespace App\Http\Controllers\Contacts;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ContactService;

class SearchContactsController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $search = $request->search;
        $contacts = $user->contacts()
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
            ->latest()
            ->paginate(10);

        $totalCount = $contacts->total();
        $tagCounts = $this->contactService->getTagCounts($user);

        $tags = Tag::all();

        foreach ($tags as $tag) {
            $tag->count = $tagCounts[$tag->id] ?? 0;
        }

        return view('dashboard', compact('contacts', 'tags', 'totalCount'));
    }
}
