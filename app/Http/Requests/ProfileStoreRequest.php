<?php
/**
 * @package    Requests
 ****************************************************
 * @date       09/12/2019 10:25:33
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('profile', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $user = \Auth::id();

        $rules = [];
        $rules['type_id'] = ['required', 'unique:user_types,type_id,NULL,id,user_id,' . $user];

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            "type_id.unique" => "Perfil já adicionado para este usuário"
        ]; // UserRule::messages();
    }
}
