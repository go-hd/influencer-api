@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Instagramアカウント一覧</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-{{ session('status') }}" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <a class="btn btn-primary btn-sm d-block mb-2 mb-lg-0 d-lg-inline-block"
                           title="新しいInstagramアカウントを追加します"
                           href="{{ route('instagram_account.create') }}"
                        >
                            <i class="fab fa-instagram mr-1"></i>アカウントを追加
                        </a>
                        @if (!$instagramAccounts->count())
                            <div class="mt-3">
                                登録されているInstagramアカウントはありません。
                            </div>
                        @endif
                    </div>
                    @if ($instagramAccounts->count())
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>アカウント名</th>
                                    <th>ラベル</th>
                                    <th>InstagramビジネスID</th>
                                    <th>投稿数</th>
                                    <th>最終取得日時</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($instagramAccounts as $instagramAccount)
                                    <tr>
                                        <td>{{ $instagramAccount->id }}</td>
                                        <td>{{ $instagramAccount->name }}</td>
                                        <td>{{ $instagramAccount->label }}</td>
                                        <td>{{ $instagramAccount->ig_business_id }}</td>
                                        <td>{{ $instagramAccount->media()->count() }}</td>
                                        <td>{{ $instagramAccount->media()->count() ? $instagramAccount->media()->first()->created_at : '' }}</td>
                                        <td>
                                            <a
                                                href="{{ route('instagram_account.edit', ['instagram_account' => $instagramAccount->id]) }}"
                                                class="btn btn-sm btn-secondary"
                                                title="編集">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="d-inline-block" method="post"
                                                  action="{{ route('instagram_account.update_media', ['instagram_account' => $instagramAccount->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="最新の投稿と同期">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </form>
                                            <button class="btn btn-sm btn-danger"
                                                    data-toggle="modal"
                                                    data-target="#deleteConfirmModal_{{ $instagramAccount->id }}"
                                                    title="削除">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <div class="modal fade" id="deleteConfirmModal_{{ $instagramAccount->id }}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="deleteConfirmModal_{{ $instagramAccount->id }}">
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
                                                            <p>{{ $instagramAccount->name }}を削除してもよろしいですか？</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                  action="{{ route('instagram_account.destroy', ['instagram_account' => $instagramAccount->id]) }}">
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
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
