<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstagramAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return is_null($this->route('instagram_account')) || \Auth::user()->id === $this->route('instagram_account')->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $instagramAccount = $this->route('instagram_account');
        $id = $instagramAccount ? $instagramAccount->id : '';

        return [
            'name' => 'required|string',
            'label' => [
                'required',
                'regex:/^[a-z0-9_-]+$/',
                Rule::unique('instagram_accounts')
                    ->ignore($id)
                    ->where(function(Builder $query) {
                        $query->where('user_id', \Auth::user()->id);
                    })],
            'ig_business_id' => 'required|regex:/^[0-9]{17}$/',
            'page_access_token' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。',
            'string' => ':attributeには文字列を入力してください。',
            'label.regex' => ':attributeはアルファベットの小文字、数値、アンダーバー（_）、ハイフン（-）の組み合わせで入力してください。',
            'ig_business_id.regex' => ':attributeは17桁の数値です。',
            'unique' => ':attribute":input"はすでに使用されています。'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'アカウント名',
            'label' => 'ラベル',
            'ig_business_id' => 'InstagramビジネスID',
            'page_access_token' => 'ページアクセストークン'
        ];
    }
}
