<?php

namespace App\Helpers;

class Toastr
{
    public function create($message,  $level, $key = 'flash_message')
    {
        return session()->flash($key, [

            'message' => $message,
            'level' => $level,

        ]);
    }
    public function info($message)
    {
        return $this->create($message, 'info');
    }
    public function success($message)
    {
        return $this->create($message, 'success');
    }
    public function error($message)
    {
        return $this->create($message, 'error');
    }
    public function warning($message)
    {
        return $this->create($message, 'warning');
    }
}
