<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $rooms = Room::all();
        return RoomResource::collection($rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoomRequest $request
     * @return RoomResource
     */
    public function store(StoreRoomRequest $request): RoomResource
    {
        $room = Room::create($request->all());
        return new RoomResource($room);
    }

    /**
     * Display the specified resource.
     * @param Room $room
     * @return RoomResource
     */
    public function show(Room $room): RoomResource
    {
        return new RoomResource($room);
    }

}
