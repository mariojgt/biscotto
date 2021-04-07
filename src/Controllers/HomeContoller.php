<?php

namespace Mariojgt\Biscotto\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeContoller extends Controller
{
    public function index()
    {
        return view('biscotto::content.index');
    }
}
