<?php
/**
 * @package    Requests
 ****************************************************
 * @date       09/12/2019 09:48:30
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\TypeRule;
use Illuminate\Foundation\Http\FormRequest;

class TypeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('update', $this->type);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return TypeRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return TypeRule::messages();
    }
}
