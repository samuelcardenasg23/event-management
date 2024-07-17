<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Event $event)
    {
        // Get the attendees
        $attendees = $event->attendees()->latest();

        // Display Attendees with pagination
        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return AttendeeResource
     */
    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1,
        ]);

        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Event $event
     * @param \App\Models\Attendee $attendee
     * @return AttendeeResource
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $event
     * @param \App\Models\Attendee $attendee
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(string $event, Attendee $attendee)
    {
        $attendee->delete();

        return response(status: 204);
    }
}
