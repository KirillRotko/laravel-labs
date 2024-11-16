<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscription::paginate(10);

        return response()->json($subscriptions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service' => 'required|string',
            'topic' => 'required|string',
            'payload' => 'nullable|json',
            'expired_at' => 'nullable|date',
            'subscriber_id' => 'required|exists:subscribers,id',
        ]);

        $subscription = Subscription::create($validated);

        return response()->json($subscription, 201);
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return response()->json($subscription);
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $validated = $request->validate([
            'service' => 'required|string',
            'topic' => 'required|string',
            'payload' => 'nullable|json',
            'expired_at' => 'nullable|date',
        ]);

        $subscription->update($validated);

        return response()->json($subscription);
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->delete();

        return response()->json(null, 204);
    }
}
