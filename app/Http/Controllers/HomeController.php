<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Announcement;
use App\Adminid;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $messages = Announcement::all();
        $adminids = Adminid::all();

        if($this->isHaveID(Auth::user()->id, $adminids)){
            return redirect()->route('welcome');
        }
        return view('home', ["users" => $users, "messages" => $messages]);
    }

    private function isHaveID($id, $adminids)
    {
    	foreach ($adminids as $key => $value) {
    		if($value->adminid == $id){
    			return false;
    		}
    	}
    	return true;
    }

    public function blocked(){
        if(Auth::user()->block == null){
            return redirect()->route('welcome');
        }
        return view('auth.blocked');
    }

    public function block()
    {
        $checkBoxes = $_POST;
        array_pop($checkBoxes);
        array_pop($checkBoxes);

        if(isset($_POST["delete"])){
            $this->deleteUser($checkBoxes);
        } elseif (isset($_POST["block"])) {
            $this->blockUser($checkBoxes, "забанен(-ны)", "Забанен");
        } elseif (isset($_POST["unblock"])) {
            $this->blockUser($checkBoxes, "разбанен(-ны)", null);
        }

        return redirect()->route("home");
    }

    private function deleteUser($checkBoxes){
        $status = "";
        Session::flash('type', "удален(-ны)");
        foreach ($checkBoxes as $key => $value) {
            if($user = User::find($key)) {
                $status .= $user->login . ", ";
                User::destroy($user->id);
            }
        }
        if(!empty($status)) {
            Session::flash('status', substr($status,0,-2));
        }
    }

    private function blockUser($checkBoxes, $message, $blockValue){
        $status = $errors = "";
        Session::flash('type', $message);
        foreach ($checkBoxes as $key => $value) {
            if($user = User::find($key)) {
                if($user->block == $blockValue){
                    $errors .= $user->login . ", ";
                } else {
                    $status .= $user->login . ", ";
                    $user->block =  $blockValue;
                    $user->save();
                }
            }
        }
        $this->doFlash($status, $errors);
    }

    private function doFlash($status, $errors){
        if(!empty($errors)) {
            Session::flash('errors', substr($errors,0,-2));
        } 
        if(!empty($status)) {
            Session::flash('status', substr($status,0,-2));
        } 
    }
}
