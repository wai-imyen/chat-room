<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository
{
    public function getMessages(): Collection
    {
        return Message::with('user')->get();
    }

    public function createMessage(User $user, $message): Message
    {
        return $user->messages()->create([
            'message' => $message,
        ]);
    }
}
