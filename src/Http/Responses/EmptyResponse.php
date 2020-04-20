<?php

namespace Moharrum\LaravelAdminer\Http\Responses;

use Illuminate\Http\Response;

/**
 * Handles adminer http responses.
 *
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class EmptyResponse extends Response
{
    /**
     * Sends HTTP headers and content.
     *
     * @return $this
     */
    public function send()
    {
    }
}
