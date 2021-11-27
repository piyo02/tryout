<?php

namespace App\Observers;

use App\Models\Collection;
use App\Models\Variation;

class VariationObserver
{
    /**
     * Handle the Variation "deleted" event.
     *
     * @param  \App\Models\Variation  $variation
     * @return void
     */
    public function deleting(Variation $variation)
    {
        Collection::where('variation_id', $variation->id)->delete();
    }
}
