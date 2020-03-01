<?php

namespace App\Http\Requests;

use App\Rules\UserRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserDevRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
       // return $this->user()->can('profile', Auth::user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = UserRule::profileRules();
        $rules['password'] = 'required|' . $rules['password'];
        $rules['resume'] = 'required|mimes:jpeg,png,jpg,pdf|max:4048';

        return $rules;

    }


    public function messages()
    {
        return UserRule::messages();
    }
}
