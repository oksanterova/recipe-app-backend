<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;

class FavoriteController extends Controller
{
    protected $rules =
    [
        'recipe_id' => 'required',
        'recipe_label' => 'required',
        'recipe_image' => 'required',
    ];

    public function index()
    {
        $user_id = Auth::user()->id;
        $favorites = Favorite::where('user_id', '=', $user_id)->get();

        return response()->success(compact('favorites'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $favorite = new Favorite();
            $favorite->recipe_id = $request->recipe_id;
            $favorite->recipe_label = $request->recipe_label;
            $favorite->recipe_image = $request->recipe_image;
            $favorite->user_id = Auth::user()->id;
            $favorite->save();
            return response()->json($favorite);
        }
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $favorite = Favorite::where('user_id', '=', $user_id)->findOrFail($id);
        $favorite->recipe_label = $request->recipe_label;
        $favorite->save();

        return response()->json($favorite);
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $favorite = Favorite::where('user_id', '=', $user_id)->findOrFail($id);
        $favorite->delete();

        return response()->json($favorite);
    }
}
