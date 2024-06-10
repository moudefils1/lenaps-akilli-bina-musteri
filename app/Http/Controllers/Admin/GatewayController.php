<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GatewayRequest;
use App\Services\GatewayService;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gateways = GatewayService::getAll();
        return view("admin.gateways.index", compact("gateways"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view("admin.gateways.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GatewayRequest $request)
    {
        dd("stored");
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
    public function edit($slug)
    {
        $gateway = GatewayService::getBySlug($slug);

        if (!$gateway){
            abort(404);
        }

        return view("admin.gateways.edit", compact("gateway"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
