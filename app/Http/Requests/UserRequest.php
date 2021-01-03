<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                  'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
                  'email' => 'required|email',
                  'introduction' => 'max:100',
                  'avatar' => 'mimes:jpg,bmp,png,gif|dimensions:min_width=208,min_height=208'
        ];
    }

    public function messages()
    {
        return [
                 'name.required' => '用户名不能为空',
                 'name.between' => '用户名在3-25位',
                 'name.regex' => '用户名只支持英文、数字、横杠和下划线。',
                 'name.unique' => '用户名已经存在',
                 'introduction.max' => '个人简介最多100个字符',
                 'avatar.mimes' => '图片类型必须是jpg,bmp,png,gif',
                 'avatar.dimensions' => '图片清晰度不够，宽和高度必须在208px以上',
        ];
    }
}
