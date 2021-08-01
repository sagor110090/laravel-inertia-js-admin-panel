<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($query, $search) {
            $query->where('email', 'LIKE', "%%$search%%");
        })->orderBy('id', 'desc')
            ->paginate(5);
        return Inertia::render('Client/Index', [
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Client/Create');
    }

    public function store(Request $request)
    {
        $valideated = $this->validate($request, [
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['nullable', 'max:50', 'email'],
            'phone' => ['nullable', 'max:50'],
            'address' => ['nullable', 'max:150'],
            'city' => ['nullable', 'max:50'],
            'region' => ['nullable', 'max:50'],
            'country' => ['nullable', 'max:2'],
            'postal_code' => ['nullable', 'max:25'],
        ]);
        Client::create($valideated);

        return Redirect::route('client')->with('success', 'Contact created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }


    public function edit(Client $client)
    {
        return Inertia::render('Client/Edit',[ 'client' => [
            'id' => $client->id,
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'city' => $client->city,
            'region' => $client->region,
            'country' => $client->country,
            'postal_code' => $client->postal_code,
            'deleted_at' => $client->deleted_at,
        ],]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $valideated = $this->validate($request, [
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['nullable', 'max:50', 'email'],
            'phone' => ['nullable', 'max:50'],
            'address' => ['nullable', 'max:150'],
            'city' => ['nullable', 'max:50'],
            'region' => ['nullable', 'max:50'],
            'country' => ['nullable', 'max:2'],
            'postal_code' => ['nullable', 'max:25'],
        ]);
        $client->update($valideated);

        return Redirect::route('client')->with('success', 'Contact created.');
    }


    public function destroy($client)
    {
        Client::find($client)->delete();
        $users = Client::get();
        return Redirect::route('client')->with('success', 'Client deleted.')->with('users',$users);
    }
}
