<?php

namespace App\Http\Controllers\API;

use App\Events\ConversationEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conversations = Conversation::all();
        return response()->json(["status" => "success", "data" => $conversations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "message" => "required|string",
            "attachment" => "nullable|string",
            "user_id" => "required|integer"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => $validator->errors()->all(),
            ], 422);
        }

        $validatedData = $validator->validated();

        $conversation = Conversation::create($validatedData);

        event(new ConversationEvent('Total Count at: ' . now('Asia/Kolkata') . ' count: ' . Conversation::all()->count()));

        return response()->json([
            "status" => 1,
            "message" => "Conversation stored!",
            "data" => $conversation
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
