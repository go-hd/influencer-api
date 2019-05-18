<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediumApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $label
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(string $label, Request $request)
    {
        $instagramAccount = Auth::user()->findInstagramAccountByLabel($label);

        if (!$instagramAccount) {
            abort(404);
        }

        $media = $instagramAccount->searchMedia($request->all())->toArray();

        return response()->json($media, 200, [], JSON_PRETTY_PRINT);
    }
}
