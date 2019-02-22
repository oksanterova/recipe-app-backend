<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
        $favorites = Favorite::get();

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
            $favorite->save();
            return response()->json($favorite);
        }
    }

    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json($favorite);
    }
}
