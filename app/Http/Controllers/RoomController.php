<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function create(Request $request)
    {
        $room = new Room;
        $room->name = $request->name;
        $room->description = $request->description;
        $room->save();
    }

    public function add_cabinet(Request $request, string $room_id)
    {
        $room = Room::find($room_id);
        $room->cabinets()->create([
            "name" => $request->name,
            "description" => $request->description
        ]);
    }

    /**
     * @urlParam room_id string required The UUID of the room. Example: 9a6c7eaa-c73e-46cf-b625-a52eec78c62d
     */
    public function get_room_json(string $room_id): Room
    {
        $room = Room::find($room_id);
        return $room;
    }

    public function get_rooms_json(): Collection
    {
        $rooms = Room::all();
        return $rooms;
    }
}
