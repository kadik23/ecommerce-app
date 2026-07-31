<?php

namespace App\Repositories;

use App\Models\ContactMessage;

class ContactMessageRepository implements ContactMessageRepositoryInterface
{
    public function create(array $data): mixed
    {
        return ContactMessage::create($data);
    }

    public function getPaginatedMessages(?string $status = null, int $perPage = 15)
    {
        $query = ContactMessage::query();

        if (!empty($status) && in_array($status, ['resolved', 'unresolved'])) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
    }

    public function getCounts(): array
    {
        return [
            'totalCount' => ContactMessage::count(),
            'unresolvedCount' => ContactMessage::where('status', 'unresolved')->count(),
            'resolvedCount' => ContactMessage::where('status', 'resolved')->count(),
        ];
    }

    public function toggleStatus(int $id): mixed
    {
        $message = ContactMessage::findOrFail($id);
        $message->status = ($message->status === 'resolved') ? 'unresolved' : 'resolved';
        $message->save();

        return $message;
    }
}
