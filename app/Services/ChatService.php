<?php

namespace App\Services;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;

class ChatService
{
    public function __construct(protected MessageRepository $messageRepository)
    {
    }

    public function getMessages(): ?Collection
    {
        if (!auth()->check()) {
            return null;
        }

        return $this->messageRepository->getMessages();
    }

    public function sendMessage(array $validated): ?Message
    {
        if (!auth()->check()) {
            return null;
        }

        $user = auth()->user();
        $message = $this->messageRepository->createMessage($user, $validated['message']);

        // 廣播聊天訊息
        broadcast(new MessageSentEvent($user, $message))->toOthers();

        return $message;
    }
}
