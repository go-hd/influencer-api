<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstagramAccountRequest;
use App\InstagramAccount;

class InstagramAccountController extends Controller
{
    /**
     * The model instance of Instagram account.
     *
     * @var \App\InstagramAccount
     */
    protected $instagramAccount;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InstagramAccount $instagramAccount)
    {
        $this->instagramAccount = $instagramAccount;

        $this->middleware('auth');
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstagramAccountRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;

        try {
            $result = \DB::transaction(function () use ($data) {
                return $this->instagramAccount->fill($data)->save()
                    && $this->instagramAccount->updateMedia();
            });
        } catch (\Exception $exception) {
            $result = false;
        } catch (\Throwable $e) {
            $result = false;
        }

        if ($result) {
            \Session::flash('status', 'success');
            \Session::flash('message', "{$data['name']}を追加しました。");
        } else {
            \Session::flash('status', 'danger');
            \Session::flash('message', "Instagramアカウントの追加に失敗しました。");
        }

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(InstagramAccount $instagramAccount)
    {
        return view('instagram-account/edit', ['instagramAccount' => $instagramAccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function update(InstagramAccountRequest $request, InstagramAccount $instagramAccount)
    {
        try {
            $result = \DB::transaction(function () use ($request, $instagramAccount) {
                return $instagramAccount->fill($request->all())->save()
                    && $instagramAccount->updateMedia();
            });
        } catch (\Exception $exception) {
            $result = false;
        } catch (\Throwable $e) {
            $result = false;
        }

        if ($result) {
            \Session::flash('status', 'success');
            \Session::flash('message', "{$request->get('name')}の情報を更新しました。");
        } else {
            \Session::flash('status', 'danger');
            \Session::flash('message', "Instagramアカウントの更新に失敗しました。");
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InstagramAccount  $instagramAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstagramAccount $instagramAccount)
    {
        try {
            $result = \DB::transaction(function () use (&$result, $instagramAccount) {
                return $instagramAccount->media()->delete()
                    && $instagramAccount->delete();
            });
        } catch (\Exception $exception) {
            $result = false;
        } catch (\Throwable $e) {
            $result = false;
        }

        if ($result) {
            \Session::flash('status', 'success');
            \Session::flash('message', "{$instagramAccount->name}の削除に成功しました。");
        } else {
            \Session::flash('status', 'danger');
            \Session::flash('message', "{$instagramAccount->name}の削除に失敗しました。");
        }

        return redirect()->route('home');
    }

    /**
     * Update the media of this Instagram account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMedia(InstagramAccount $instagramAccount)
    {
        $result = $instagramAccount->updateMedia();

        if ($result) {
            \Session::flash('status', 'success');
            \Session::flash('message', "最新の{$instagramAccount->name}のポストを取得しました。");
        } else {
            \Session::flash('status', 'danger');
            \Session::flash('message', "最新のポストの取得に失敗しました。");
        }

        return redirect()->route('home');
    }
}
