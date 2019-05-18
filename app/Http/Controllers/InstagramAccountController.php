<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstagramAccountRequest;
use App\InstagramAccount;

class InstagramAccountController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instagram-account/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InstagramAccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstagramAccountRequest $request)
    {
        $name = $request->get('name');
        $result = InstagramAccount::create($request->all());

        $this->flashResult(
            $result,
            "{$name}を追加しました。",
            "Instagramアカウントの追加に失敗しました。"
        );

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstagramAccount $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(InstagramAccount $instagramAccount)
    {
        return view('instagram-account/edit', ['instagramAccount' => $instagramAccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InstagramAccountRequest $request
     * @param  \App\InstagramAccount $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function update(InstagramAccountRequest $request, InstagramAccount $instagramAccount)
    {
        $result = $instagramAccount->update($request->all());
        $name = $instagramAccount->name;

        $this->flashResult(
            $result,
            "{$name}の情報を更新しました。",
            "Instagramアカウントの更新に失敗しました。"
        );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstagramAccount $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstagramAccount $instagramAccount)
    {
        $name = $instagramAccount->name;
        $result = $instagramAccount->delete();

        $this->flashResult(
            $result,
            "{$name}の削除に成功しました。",
            "{$name}の削除に失敗しました。"
        );

        return redirect()->route('home');
    }

    /**
     * Update the media of this Instagram account.
     *
     * @param  \App\InstagramAccount $instagramAccount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMedia(InstagramAccount $instagramAccount)
    {
        $name = $instagramAccount->name;
        $result = $instagramAccount->updateMedia();

        $this->flashResult(
            $result,
            "最新の{$name}のポストを取得しました。",
            "最新のポストの取得に失敗しました。"
        );

        return redirect()->back();
    }
}
