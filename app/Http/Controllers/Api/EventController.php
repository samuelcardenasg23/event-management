<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        // Start a query builder for the Event model
        $query = Event::query();

        // Define an array of relationships to conditionally load
        $relations = [
            'user',
            'attendees',
            'attendees.user',
        ];

        // Iterate over each relationship defined in the $relations array
        foreach ($relations as $relation) {
            // Conditionally include the relationship in the query if it should be included
            $query->when(
                $this->shouldIncludeRelation($relation),
                fn($q) => $q->with($relation) // Callback to include the relationship
            );
        }

        // Return a paginated collection of EventResource instances
        return EventResource::collection(
            $query->latest()->paginate()
        );
    }

    protected function shouldIncludeRelation(string $relation): bool
    {
        $include = request()->query('include');

        if (!$include) {
            return false;
        }

        $relations = array_map('trim', explode(',', $include));

        return in_array($relation, $relations);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return EventResource
     */
    public function store(Request $request)
    {
        // Create Event and Validation
        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time'
            ]),
            'user_id' => 1
        ]);

        // Return the newly created Event
        return new EventResource($event);
    }

    /**
     * Display the specified resource.Summary of show
     * @param \App\Models\Event $event
     * @return EventResource
     */
    public function show(Event $event)
    {
        $event->load('user', 'attendees');
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return EventResource
     */
    public function update(Request $request, Event $event)
    {
        // Update Event and Validate
        $event->update(
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        );

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response(status: 204);
    }
}
