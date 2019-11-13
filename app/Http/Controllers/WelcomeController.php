<?php

namespace App\Http\Controllers;

use App\User;
use App\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $users = User::all();
        $messages = Announcement::all();
        $currentUser = Auth::user();

        return view('welcome', ["users" => $users, "messages" => $messages, "currentUser" => $currentUser]);
    }

    public function append() {
    	$message = new Announcement;
        $message->name = $_POST["title"];
        $message->text = $_POST["message"];
        $message->phone = $_POST["phone"];
        $message->userID = Auth::user()->id;
        $message->save();

        return redirect()->route('welcome');
    }
}
