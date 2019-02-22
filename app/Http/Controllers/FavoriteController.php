<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = Favorite::get();

        return response()->success(compact('favorites'));
    }
}
