<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var \App\Medium $medium */
        $medium = $this->route('medium');
        return \Auth::user()->id === $medium->instagramAccount->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'omit' => 'boolean',
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
            'boolean' => ':attributeに不正な値が入力されました。',
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
            'omit' => '非表示',
        ];
    }
}
