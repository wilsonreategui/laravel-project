<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyerStoreRequest;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::all();

        return view('buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $buyer = new Buyer();
        return view('buyers.create', compact('buyer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuyerStoreRequest $request)
    {
        $data = $request->all();
        Buyer::create($data);

        return redirect()->route('buyers.index')->with(['status' => 'success', 'message' => 'Buyer creted successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        return view('buyers.create', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(BuyerStoreRequest $request, Buyer $buyer)
    {
        $data = $request->all();

        $buyer->fill($data);
        $buyer->save();

        return redirect()->route('buyers.index')->with(['status' => 'Success', 'message' => 'Buyer updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {   
        try{
            $buyer->delete();
            $result = ['status' => 'Success', 'message' => 'Buyer deleted successfully'];

        }catch(\Exception $error){
            $result = ['status' => 'Error', 'message' => 'Buyer cannot be deleted: Foreign Key Problem'];
        }
        
        return redirect()->route('buyers.index')->with($result);
    }
}
