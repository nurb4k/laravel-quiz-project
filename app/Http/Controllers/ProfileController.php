<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $usercomptdQuiz = Auth::user()->competitedQuizzies()->get();
        $count = array();
        if ($usercomptdQuiz != null) {
            for ($i = 0; $i < count($usercomptdQuiz); $i++) {
                $count[$i] = Question::all()->where('quiz_id', $usercomptdQuiz[$i]->id)->count();
            }
        }


        return view("users.profile", ['awards' => $usercomptdQuiz, 'count' => $count]);
    }

    public function edit()
    {
        return view("users.profileEdit", ['user' => Auth::user()]);
    }

    public function update(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|max:250',
            'img' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,max_width=2000,max_height=2000,min_height=100'
        ]);
        $fileName = time() . $req->file('img')->getClientOriginalName();
        $image_path = $req->file('img')->storeAs('users', $fileName, 'public');
        $validated['img'] = '/storage/' . $image_path;
        Auth::user()->update([
            'name' => $validated['name'],
            'img' => $validated['img'],
        ]);
        return redirect()->back()->with('status', __('messages.updated'));
    }

}
