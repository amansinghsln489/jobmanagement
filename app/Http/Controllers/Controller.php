<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController; // Rename to avoid conflict

class Controller extends BaseController
{
    // These traits provide the methods like middleware() and authorize()
    use AuthorizesRequests, ValidatesRequests;
}