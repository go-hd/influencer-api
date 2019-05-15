<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Medium;
use Illuminate\Http\Request;

class MediumApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $label, Request $request)
    {
        $user = \Auth::user();

        /** @var \App\InstagramAccount $instagramAccount */
        $instagramAccount = $user->instagramAccounts()->where('label', $label)->first();

        if (!$instagramAccount) {
            abort(404);
        }

        $query = Medium::query()
            ->where('instagram_account_id', $instagramAccount->id)
            ->where('omit', 0);

        if ($request->has('contains')) {
            $query->where('caption', 'like', '%' . $request->get('contains') . '%');
        }

        if ($request->has('omit')) {
            $query->where('caption', 'not like', '%' . $request->get('omit') . '%');
        }

        $media = $query->get()->map(function (Medium $medium) {
            $medium = $medium->toArray();
            $medium['id'] = $medium['media_id'];
            unset($medium['media_id']);

            return $medium;
        });

        $result = [
            'ig_business_id' => $instagramAccount->ig_business_id,
            'account_name' => $instagramAccount->name,
            'count' => $media->count(),
            'media' => $media,
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }
}
