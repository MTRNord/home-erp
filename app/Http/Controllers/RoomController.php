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
     * @urlParam room_id string required The UUID of the room. Example: 9a6c8f8c-df24-4958-86e1-2fe4bb3a7f28
     * @group Rooms
     */
    public function get_room(string $room_id): Room
    {
        $room = Room::find($room_id);
        return $room;
    }

    /**
     * @group Rooms
     */
    public function get_rooms(): Collection
    {
        $rooms = Room::all();
        return $rooms;
    }
}
