<?php
/**
 * @package    Rules
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Rules;

class GroupRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'name' => 'nullable|min:2|max:255',
        'kind' => 'required|integer',
        'users_count' => 'required|integer',
        'view_users' => 'required',
        'view_groups' => 'required',
        'view_links' => 'required',
        'view_daily_hours' => 'required',
        'view_adverts' => 'required',
        'view_clients' => 'required',
        'view_projects' => 'required',
        'view_invoices' => 'required',
        'view_daily_activities' => 'required',
        'view_quotes' => 'required',
        'view_tasks' => 'required',
        'view_business_dev' => 'required',
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
            'kind' => self::$rules['kind'],
            'users_count' => self::$rules['users_count'],
            'view_users' => self::$rules['view_users'],
            'view_groups' => self::$rules['view_groups'],
            'view_links' => self::$rules['view_links'],
            'view_daily_hours' => self::$rules['view_daily_hours'],
            'view_adverts' => self::$rules['view_adverts'],
            'view_clients' => self::$rules['view_clients'],
            'view_projects' => self::$rules['view_projects'],
            'view_invoices' => self::$rules['view_invoices'],
            'view_daily_activities' => self::$rules['view_daily_activities'],
            'view_quotes' => self::$rules['view_quotes'],
            'view_tasks' => self::$rules['view_tasks'],
            'view_business_dev' => self::$rules['view_business_dev'],
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
