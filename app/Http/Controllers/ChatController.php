<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(protected ChatService $chatService)
    {
    }

    public function index()
    {
        $messages = $this->chatService->getMessages();

        return view('chat');
    }

    public function getMessages(Request $request): JsonResponse
    {
        $messages = $this->chatService->getMessages();

        return $this->jsonResponse([
            'messages' => (MessageResource::collection($messages))->toArray($request),
        ]);
    }

    public function sendMessage(CreateMessageRequest $request): JsonResponse
    {
        $message = $this->chatService->sendMessage($request->validated());

        return $this->jsonResponse([
            'message' => (new MessageResource($message))->toArray($request),
        ]);
    }
}
