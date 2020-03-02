<?php
/**
 * @package    Rules
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Rules;

class TicketRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'client_id' => 'nullable',
        'user_client_id' => 'nullable',
        'cto_id' => 'nullable',
        'dev_id' => 'nullable',
        'ticket_status_id' => 'nullable',
        'subject' => 'nullable|min:2|max:255',
        'content' => 'required',
        'priority' => 'nullable|in:low,medium,high',
	];

    /**
     * Return default rules
     *
     * @return array
     */
    public static function rules()
    {

        return [
            'client_id' => self::$rules['client_id'],
            'user_client_id' => self::$rules['user_client_id'],
            'cto_id' => self::$rules['cto_id'],
            'dev_id' => self::$rules['dev_id'],
            'ticket_status_id' => self::$rules['ticket_status_id'],
            'subject' => self::$rules['subject'],
            'content' => self::$rules['content'],
            'priority' => self::$rules['priority'],
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
