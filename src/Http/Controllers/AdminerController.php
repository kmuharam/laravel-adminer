<?php

namespace Moharrum\LaravelAdminer\Http\Controllers;

use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Moharrum\LaravelAdminer\Http\Responses\EmptyResponse;

/**
 * Handle adminer route operations.
 *
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class AdminerController extends Controller
{
    /**
     * Display adminer manager.
     *
     * @return \Illuminate\Http\RedirectResponse|\Moharrum\LaravelAdminer\Http\Responses\EmptyResponse
     */
    public function manager(Request $request)
    {
        if (! $request->hasCookie(config('session.cookie'))) {
            return redirect()->to($request->path())->withCookie('laravel_adminer_manager', 'init');
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'adminer' . DIRECTORY_SEPARATOR . 'bootstrap-manager.php';

        return new EmptyResponse();
    }

    /**
     * Display adminer editor.
     *
     * @return \Illuminate\Http\RedirectResponse|\Moharrum\LaravelAdminer\Http\Responses\EmptyResponse
     */
    public function editor(Request $request)
    {
        if (! $request->hasCookie(config('session.cookie'))) {
            return redirect()->to($request->path())->withCookie('laravel_adminer_editor', 'init');
        }

        try {
            require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'adminer' . DIRECTORY_SEPARATOR . 'bootstrap-editor.php';
        } catch (ErrorException $e) {
            // TODO: Fix this shit.
        }

        return new EmptyResponse();
    }
}
