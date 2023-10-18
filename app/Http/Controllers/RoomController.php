<?php

namespace App\Http\Controllers;

use App\Models\Room;
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

    public function get_room_json(string $room_id): Room
    {
        $room = Room::find($room_id);
        return $room;
    }
}
