<?php

declare(strict_types=1);

namespace App\Rules;

class ConfigurationRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
    protected static $rules = [
        'name' => 'required|min:2|max:255',
        'key' => 'required|min:2|max:255',
        'value' => 'required|min:2|max:255',
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
            'key' => self::$rules['key'],
            'value' => self::$rules['value'],
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
