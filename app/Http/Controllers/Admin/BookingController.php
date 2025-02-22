<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Booking::with(['item.brand' , 'user']);

            return DataTables::of($query)
                ->addColumn('action', function ($booking) {
                    return '
                    <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-yellow-500 border border-yellow-500 rounded-md select-none ease hover:bg-yellow-800 focus:outline-none focus:shadow-outline" 
                        href="' . route('admin.bookings.edit', $booking->id) . '">
                        Edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.bookings.destroy', $booking->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Delete
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $booking->load('item.brand', 'user');
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        $data = $request->all();
        $booking->update($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking has been deleted');
    }
}
