<?php

//Authors: Manuela Herrera López

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Liquor;
use App\Models\Comment;
use Illuminate\Http\Request;

class LiquorController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = __('messages.shop.title');
        $viewData["liquors"] = Liquor::all();
        return view('user.liquor.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $liquor = Liquor::where('id', $id)->with('comments')->get()[0];
        $loggedUser = Auth::user();
        $userWishlists = [];
        foreach ($loggedUser->wishlists as $wishlist) {
            array_push($userWishlists, $wishlist);
        }
        $viewData["title"] = $liquor->getLiquorType() . $liquor->getBrand();
        $viewData["liquor"] = $liquor;
        $viewData["wishlists"] = $userWishlists;
        return view('user.liquor.show')->with("viewData", $viewData);
    }

    public function search(Request $request)
    {
        $viewData = [];
        $viewData["title"] = __('messages.shop.title');
        $searchBar = $request->get('searchBar');
        $liquors = Liquor::where('liquor_type', 'LIKE', '%' . $searchBar . '%')->orWhere('brand', 'LIKE', '%' . $searchBar . '%')->get();
        $viewData["liquors"] = $liquors;
        return view('user.liquor.index')->with("viewData", $viewData);
    }

    public function save(Request $request, $id)
    {
        $comment = new Comment();
        $comment->setDescription($request->description);
        $comment->setScore($request->score);
        $comment->setCustomer(Auth::id());
        $comment->setLiquor($id);
        $comment->save();
        return back()->with("alert", __('messages.comment.saveCommentsSuccess'));
    }
}
