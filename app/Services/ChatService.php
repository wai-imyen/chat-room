<?php

namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;

class ChatService
{
    public function __construct(protected MessageRepository $messageRepository)
    {
    }

    public function getMessages(): Collection
    {
        $user = auth()->user();

        return $this->messageRepository->getMessages($user);
    }

    public function sendMessage(array $validated): Message
    {
        $user = auth()->user();
        $message = $validated['message'];

        return $this->messageRepository->createMessage($user, $message);
    }
}
