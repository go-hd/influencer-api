<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediumRequest;
use App\Medium;
use App\User;

class MediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, string $label)
    {
        /** @var \App\InstagramAccount $instagramAccount */
        $instagramAccount = $user->instagramAccounts()->where('label', $label)->first();

        if (!$instagramAccount) {
            abort(404);
        }

        $media = $instagramAccount->media->toArray();

        return response()->json($media, 200, [], JSON_PRETTY_PRINT);
    }

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
