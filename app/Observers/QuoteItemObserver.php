<?php
/**
 * @package    Observers
 ****************************************************
 * @date       02/28/2020 7:40 AM
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\QuoteItem;

class QuoteItemObserver
{

    /**
     * Handle the quoteItem "creating" event.
     *
     * @param  \App\Models\QuoteItem  $quoteItem
     * @return void
     */
    public function creating(QuoteItem $quoteItem)
    {

        $quoteItem->user_creator_id = \Auth::id();
        //$quoteItem->user_updater_id = \Auth::id();
    }


    /**
     * Handle the quoteItem "updating" event.
     *
     * @param  \App\Models\QuoteItem  $quoteItem
     * @return void
     */
    public function updating(QuoteItem $quoteItem)
    {

        $quoteItem->user_updater_id = \Auth::id();
    }


    /**
     * Handle the quoteItem "deleting" event.
     *
     * @param  \App\Models\QuoteItem  $quoteItem
     * @return void
     */
    public function deleting(QuoteItem $quoteItem)
    {

        $quoteItem->user_eraser_id = \Auth::id();
        $quoteItem->timestamps = false;
        $quoteItem->save();
    }
}
