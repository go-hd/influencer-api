<?php $user = \Auth::user() ?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">アカウント設定</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            <input type="hidden" name="_method" value="put">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="api_token" class="col-md-4 col-form-label text-md-right">APIトークン</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" readonly id="api_token" rows="3">{{ $user->api_token }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        変更
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">アカウントの削除</div>

                    <div class="card-body">
                        アカウントを削除すると、登録した全ての情報が削除されます。
                        <button class="btn btn-danger d-block mt-3"
                                data-toggle="modal"
                                data-target="#deleteConfirmModal"
                                title="削除">
                            <i class="fas fa-trash mr-1"></i>アカウントを削除する
                        </button>
                        <div class="modal fade" id="deleteConfirmModal"
                             tabindex="-1" role="dialog"
                             aria-labelledby="deleteConfirmModal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">削除確認</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="閉じる">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>本当に "{{ $user->name }}" のアカウントを削除してもよろしいですか？</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="{{ route('user.destroy') }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">キャンセル
                                            </button>
                                            <button type="submit" class="btn btn-danger">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
