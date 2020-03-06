<?php
/**
 * @package    Rules
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

declare(strict_types=1);

namespace App\Rules;

class ClientRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'user_id' => 'nullable',
        'advert_id' => 'nullable',
        'seller_id' => 'nullable',
        'project_manager_id' => 'nullable',
        'company_name' => 'nullable|min:2|max:255',
        'contact_name' => 'nullable|min:2|max:255',
        'cell_phone' => 'nullable|min:2|max:255',
        'additional_phone' => 'nullable|min:2|max:255',
        'project_scope' => 'nullable',
        'follow_up' => 'nullable|date_format:m/d/Y g:i A',
        'status' => 'required|integer',
        'lead_status' => 'required|integer',
        'priority' => 'required|integer',
        'email' => 'nullable|email',
        'credit_amount' => 'required',
        'text_credit_history' => 'nullable',
        'additional_email' => 'nullable|email',
        'address'=> 'nullable',
        'zip_code'=> 'nullable',
        'state'=> 'required',
	];

    /**
     * Return default rules
     *
     * @return array
     */
    public static function rules()
    {

        return [
            'user_id' => self::$rules['user_id'],
            'company_name' => self::$rules['company_name'],
            'cell_phone' => self::$rules['cell_phone'],
            'additional_phone' => self::$rules['additional_phone'],
            'email' => self::$rules['email'],

            'additional_email' => self::$rules['additional_email'],
            'address' => self::$rules['address'],
            'zip_code' => self::$rules['zip_code'],
            'state' => self::$rules['state'],
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
