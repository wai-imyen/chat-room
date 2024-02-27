<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Services\ChatService;
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

    public function getMessages(Request $request)
    {
        $messages = $this->chatService->getMessages();

        return [
            'status' => true,
            'data' => [
                'messages' => (MessageResource::collection($messages))->toArray($request),
            ],
        ];
    }

    public function sendMessage(Request $request)
    {
        // TODO: 補 ChatRequest 驗證格式
        $validated = $request->all();

        $message = $this->chatService->sendMessage($request->all());

        return [
            'status' => true,
            'data' => [
                'message' => (new MessageResource($message))->toArray($request),
            ],
        ];
    }
}
