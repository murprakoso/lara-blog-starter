<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
     * Load view for particular theme
     *
     * @param string $view view path
     * @param arry   $data data
     *
     * @return void
     */
    protected function loadTheme($view, $data = [])
    {
        return view('themes/' . env('APP_THEME') . '/' . $view, $data);
    }
}
