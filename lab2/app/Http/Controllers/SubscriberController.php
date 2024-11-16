<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $subscribers = Subscriber::paginate(10);

        return response()->json($subscribers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'required|string',
        ]);

        $subscriber = Subscriber::create($validated);

        return response()->json($subscriber, 201);
    }

    public function show($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return response()->json($subscriber);
    }

    public function update(Request $request, $id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        $subscriber->update($validated);

        return response()->json($subscriber);
    }

    public function destroy($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        $subscriber->delete();

        return response()->json(null, 204);
    }
}
