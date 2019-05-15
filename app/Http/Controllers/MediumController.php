<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediumRequest;
use App\Medium;

class MediumController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MediumRequest  $request
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Medium $medium, MediumRequest $request)
    {
        $medium->fill($request->all())->save();

        return redirect()->back();
    }
}
