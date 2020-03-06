<?php

namespace App\Http\Requests;

use App\Rules\UserRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PublicUserRegistrationRequest extends FormRequest
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
        $rules = UserRule::publicRegistration();
        return $rules;
    }

    public function rulesModificada()
    {
        $rules = UserRule::publicRegistrationModificada();
        return $rules;
    }

    public function messages()
    {
        return UserRule::messages();
    }
}
