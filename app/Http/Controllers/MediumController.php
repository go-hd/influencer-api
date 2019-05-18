<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediumRequest;
use App\Medium;

class MediumController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Medium $medium
     * @param  \App\Http\Requests\MediumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Medium $medium, MediumRequest $request)
    {
        $medium->update($request->all());

        return redirect()->back();
    }
}
