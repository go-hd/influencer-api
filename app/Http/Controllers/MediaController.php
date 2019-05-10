<?php

namespace App\Http\Controllers;

use App\User;

class MediaController extends Controller
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
}
