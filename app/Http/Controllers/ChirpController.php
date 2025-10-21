<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){





        $chirps = Chirp::with('user')
        ->latest()
        ->take(10)
        ->get();

        return view('home', compact('chirps'));
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
        $request->validate([
            'message' => 'string|max:255|required|min:5'
        ],[
        'message.required' => 'Please write something to chirp!',
        'message.max' => 'Chirps must be 255 characters or less.',
        ]);
        Chirp::create([
            'message' => $request->message
        ]);

        return redirect('/')->with('success', 'Chirp created');
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
    public function edit(Chirp $chirp)
    {
        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $request->validate([
            'message' => 'string|max:255|required|min:5'
        ],[
        'message.required' => 'Please write something to chirp!',
        'message.max' => 'Chirps must be 255 characters or less.',
        ]);
        $chirp->update([
            'message' => $request->message
        ]);

        return redirect('/')->with('success', 'Chirp updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();
        return redirect('/')->with('success', 'Chirp deleted');
    }
}
