<?php
/**
 * @package    Rules
 ****************************************************
 * @date       09/12/2019 09:48:30
 */

declare(strict_types=1);

namespace App\Rules;

class TypeRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
    protected static $rules = [
        'id' => 'required',
        'name' => 'required|min:2|max:255',
    ];

    /**
     * Return default rules
     *
     * @return array
     */
    public static function rules()
    {

        return [
            'name' => self::$rules['name'],
        ];
    }

    /**
     * Return default messages
     *
     * @return array
     */
    public static function messages()
    {

        return [];
    }
}
