<?php

namespace Moharrum\LaravelAdminer\Http\Controllers;

use Illuminate\Routing\Controller;
use Moharrum\LaravelAdminer\Http\Responses\EmptyResponse;

class AdminerController extends Controller
{
    public function manager()
    {
        require(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'adminer' . DIRECTORY_SEPARATOR . 'bootstrap-manager.php');

        return new EmptyResponse;
    }

    public function editor()
    {
        require(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'adminer' . DIRECTORY_SEPARATOR . 'bootstrap-editor.php');

        return new EmptyResponse;
    }
}
