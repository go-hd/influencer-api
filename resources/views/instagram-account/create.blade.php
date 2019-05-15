@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Instagramアカウントの追加</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('instagram_account.store') }}">
                            @csrf

                            <div class="form-group row justify-content-center">
                                <label for="name" class="col-md-4 col-form-label text-md-right">アカウント名</label>

                                <div class="col-md-8">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="label" class="col-md-4 col-form-label text-md-right">ラベル</label>

                                <div class="col-md-8">
                                    <input id="label" type="text"
                                           class="form-control @error('label') is-invalid @enderror"
                                           name="label"
                                           value="{{ old('label') }}" required autocomplete="label">

                                    @error('label')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="ig_business_id"
                                       class="col-md-4 col-form-label text-md-right">InstagramビジネスID</label>

                                <div class="col-md-8">
                                    <input id="ig_business_id" type="text"
                                           class="form-control @error('ig_business_id') is-invalid @enderror"
                                           name="ig_business_id"
                                           value="{{ old('ig_business_id') }}" required autocomplete="ig_business_id">

                                    @error('ig_business_id')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="page_access_token"
                                       class="col-md-4 col-form-label text-md-right">ページアクセストークン</label>

                                <div class="col-md-8">
                            <textarea id="page_access_token"
                                      class="form-control @error('page_access_token') is-invalid @enderror"
                                      rows="5" name="page_access_token"
                                      required
                                      autocomplete="page_access_token">{{ old('page_access_token') }}</textarea>

                                    @error('page_access_token')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        追加
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
