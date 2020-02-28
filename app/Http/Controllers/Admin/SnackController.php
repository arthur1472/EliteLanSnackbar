<?php

namespace App\Http\Controllers\Admin;

use App\Snack;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SnackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $snacks = Snack::all();
        return view('admin.snacks', compact('snacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.snackcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $snack = new Snack();
        $snack->fill($request->all());
        $snack->save();

        return redirect()->route('admin.snack');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Snack  $snack
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($snack_id)
    {
        $snack = Snack::find($snack_id);

        if (!$snack) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.snack', compact('snack'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function edit(Snack $snack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $snack_id)
    {
        $snack = Snack::find($snack_id);

        if (!$snack) {
            return redirect()->route('admin.dashboard');
        }


        $snack->fill($request->all());
        $snack->save();

        return redirect()->route('admin.snack.show', ['id' => $snack->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Snack  $snack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Snack $snack)
    {
        //
    }
}
