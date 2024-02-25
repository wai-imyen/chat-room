<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository
{
    public function getMessages(User $user): Collection
    {
        return $user->messages;
    }

    public function createMessage(User $user, $message): Message
    {
        return $user->messages()->create([
            'message' => $message
        ]);
    }
}
