<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $result = \Auth::user()->update($request->all());

        $this->flashResult(
            $result,
            "アカウント情報を更新しました。",
            "アカウント情報の更新に失敗しました。"
        );

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        \Auth::logout();
        $result = \Auth::user()->delete();

        if (!$result) {
            abort(500, 'ユーザーの削除中にエラーが発生しました。');
        };

        return redirect()->route('welcome');
    }
}
