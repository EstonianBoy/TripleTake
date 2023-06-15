<?php

namespace app\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropRequest;
use App\Http\Requests\UpdatePropRequest;
use App\Models\Prop;
use App\Http\Resources\v1\PropResource;
use App\Http\Resources\v1\PropCollection;
use App\Services\v1\PropQuery;
use Illuminate\Http\Request;

class PropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PropQuery();
        $queryItems = $filter->transform($request);//[['column', 'operator', 'value']]

        if(count($queryItems)==0){
            return new PropCollection(Prop::all());
        }else{
            return new PropCollection(Prop::where($queryItems)->paginate());
        }
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
    public function store(StorePropRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prop $prop)
    {
        return new PropResource($prop);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prop $prop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropRequest $request, Prop $prop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prop $prop)
    {
        //
    }
}
