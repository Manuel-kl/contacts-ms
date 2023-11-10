<?php

namespace App\Http\Services;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function getContactData($user)
    {
        $contacts = $user->contacts()
            ->latest()
            ->paginate(10);

        $totalCount = $user->contacts()->count();

        $tagCounts = $this->getTagCounts($user);

        $tags = Tag::all();

        foreach ($tags as $tag) {
            $tag->count = $tagCounts[$tag->id] ?? 0;
        }

        return compact('contacts', 'tags', 'totalCount');
    }

    public function getTagCounts($user)
    {
        return $user->contacts()
            ->select('tag_id', DB::raw('count(*) as count'))
            ->groupBy('tag_id')
            ->pluck('count', 'tag_id')
            ->toArray();
    }

    public function createContact($user, $data)
    {
        if (array_key_exists('photo', $data) && $data['photo']->isValid()) {
            $data['profile_photo_path'] = $data['photo']->store('contacts/photos', 'public');
        }

        $tag_id = Tag::where('name', $data['category'])->first()->id;
        $data['tag_id'] = $tag_id;

        $user->contacts()->create($data);
    }

    public function updateContact($contact, $data)
    {
        if (array_key_exists('photo', $data) && $data['photo']->isValid()) {
            $data['profile_photo_path'] = $data['photo']->store('contacts/photos', 'public');
        }

        $tag_id = Tag::where('name', $data['category'])->first()->id;
        $data['tag_id'] = $tag_id;

        $contact->update($data);
    }
}
