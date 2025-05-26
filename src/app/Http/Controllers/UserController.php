<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = $request->only(['name', 'email', 'password']);
        User::create($user);
        return view('register');
    }

    public function login(UserRequest $request)
    {
        $request->only(['email', 'password']);
        return view('login');
    }

    public function admin(Request $request)
    {
        $categories = Category::all();
        $contacts = Contact::all();
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building',  'detail']);
        // $contacts = Contact::Paginate(7);
        // return view('admin', ['contacts' => $contacts]);
        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return view('/admin');

    }

}
