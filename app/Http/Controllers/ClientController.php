<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $clients = $query->paginate(10)->withQueryString();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $client = new Client;
        $client->name = $request->name;
        $client->phone = $request->phone;

        if ($request->hasFile('photo')) {
            $fileName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photos'), $fileName);
            $client->photo = $fileName;
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client successfully added');

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
    public function edit(string $id)
    {
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $client = Client::find($id);

        $client->name = $request->name;
        $client->phone = $request->phone;

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($client->photo) {
                unlink(public_path('photos/'.$client->photo));
            }

            $fileName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photos'), $fileName);
            $client->photo = $fileName;
        }

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
