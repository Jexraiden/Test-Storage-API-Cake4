<?php

namespace App\View\Helper;

use Cake\View\Helper;

class FormatHelper extends Helper
{
    public function active($status)
    {
        if ($status == true) {
            $active = __("Yes");
        }

        if ($status == false) {
            $active = __("No");
        }

        return $active;
    }
}