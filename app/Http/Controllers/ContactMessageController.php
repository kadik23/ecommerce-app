<?php

namespace App\Http\Controllers;

use App\Repositories\ContactMessageRepositoryInterface;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    protected ContactMessageRepositoryInterface $contactMessageRepository;

    public function __construct(ContactMessageRepositoryInterface $contactMessageRepository)
    {
        $this->contactMessageRepository = $contactMessageRepository;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contactMessage = $this->contactMessageRepository->create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Contact message sent successfully.',
            'data' => $contactMessage,
        ], 201);
    }
}
