<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::all();

        return view('room.index', compact('rooms'));
    }

    public function create(Request $request)
    {
        return view('room.create');
    }

    public function store(RoomStoreRequest $request)
    {
        $room = Room::create($request->validated());

        $request->session()->flash('room.id', $room->id);

        return redirect()->route('rooms.index');
    }

    public function show(Request $request, Room $room)
    {
        return view('room.show', compact('room'));
    }

    public function edit(Request $request, Room $room)
    {
        return view('room.edit', compact('room'));
    }

    public function update(RoomUpdateRequest $request, Room $room)
    {
        $room->update($request->validated());

        $request->session()->flash('room.id', $room->id);

        return redirect()->route('rooms.index');
    }

    public function destroy(Request $request, Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index');
    }
}
