<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Flash the message to session.
     *
     * @param  string $status
     * @param  string $message
     * @return void
     */
    protected function flash(string $status, string $message)
    {
        \Session::flash('status', $status);
        \Session::flash('message', $message);
    }

    /**
     * Flash the result and message.
     *
     * @param  bool $result
     * @param  string $successMessage
     * @param  string $failedMessage
     * @return void
     */
    protected function flashResult(bool $result, string $successMessage, string $failedMessage)
    {
        $this->flash(
            $result ? "success" : "danger",
            $result ? $successMessage : $failedMessage
        );
    }
}
