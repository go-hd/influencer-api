<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $result = \Auth::user()->fill($request->all())->save();

        if ($result) {
            \Session::flash('status', 'success');
            \Session::flash('message', "アカウント情報を更新しました。");
        } else {
            \Session::flash('status', 'danger');
            \Session::flash('message', "アカウント情報の更新に失敗しました。");
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = \Auth::user();
        \Auth::logout();

        try {
            foreach ($user->instagramAccounts as $instagramAccount) {
                $instagramAccount->media()->delete();
            }
            $user->instagramAccounts()->delete();
            $user->delete();
        } catch (\Exception $e) {
            abort(500, 'ユーザーの削除中にエラーが発生しました。');
        }

        return redirect()->route('welcome');
    }
}
