@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card  mb-3">
                    <div class="card-header">Instagramアカウントの編集</div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('instagram_account.update', ['instagram_account' => $instagramAccount->id]) }}">
                            @csrf

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="name">アカウント名</label>
                                <input id="name"
                                       type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name', $instagramAccount->name) }}"
                                       required
                                       autocomplete="name"
                                       autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="label">ラベル</label>
                                <input id="label"
                                       type="text"
                                       class="form-control @error('label') is-invalid @enderror"
                                       name="label"
                                       value="{{ old('label', $instagramAccount->label) }}"
                                       required
                                       autocomplete="label">

                                @error('label')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ig_business_id">InstagramビジネスID</label>
                                <input id="ig_business_id"
                                       type="text"
                                       class="form-control @error('ig_business_id') is-invalid @enderror"
                                       name="ig_business_id"
                                       value="{{ old('ig_business_id', $instagramAccount->ig_business_id) }}"
                                       required
                                       autocomplete="ig_business_id">

                                @error('ig_business_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="page_access_token">ページアクセストークン</label>
                                <textarea id="page_access_token"
                                          class="form-control @error('page_access_token') is-invalid @enderror"
                                          rows="7"
                                          name="page_access_token"
                                          required
                                          autocomplete="page_access_token"
                                >{{ old('page_access_token', $instagramAccount->page_access_token) }}</textarea>

                                @error('page_access_token')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-secondary">
                                        編集
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if( session('status') )
                    <div class="card mb-3 bg-{{ session('status') }} text-white">
                        <div class="card-body">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">投稿リスト（{{ $instagramAccount->media->count() }}）</div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ route('instagram_account.update_media', ['instagram_account' => $instagramAccount->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success mr-2">
                                <i class="fas fa-sync-alt mr-2"></i>リスト更新
                            </button>
                        </form>
                        <div class="mt-3">
                            @if($instagramAccount->media->count())
                                最終更新日時：<span
                                    class="font-weight-bold">{{ $instagramAccount->media->first()->updated_at }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>イメージ</th>
                                <th>本文</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($instagramAccount->media as $medium)
                                <tr>
                                    <td>
                                        <a href="{{ $medium->permalink  }}">
                                            <img style="width: 80px;" src="{{ $medium->media_url }}"
                                                 alt="{{ $medium->media_id }}">
                                        </a>
                                    </td>
                                    <td title="{{ $medium->caption }}">
                                        {{ mb_substr($medium->caption, 0, 120) }}
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('medium.update', ['medium' => $medium->id]) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <input type="hidden" name="omit" value="{{ !$medium->omit ? '1' : '0' }}">
                                            <button type="submit" class="btn btn-sm btn-dark" title="表示 / 非表示">
                                                <i class="fas @if($medium->omit) fa-eye-slash @else fa-eye @endif"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
