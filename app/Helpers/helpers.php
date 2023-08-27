<?php

if (!function_exists('flash')) {
    function toastr($level = null, $message = null)
    {
        $toastr = app('App\Helpers\Toastr');
        if (func_num_args() == 0) {
            return $toastr;
        }
        return $toastr->$level($message);
    }
}
