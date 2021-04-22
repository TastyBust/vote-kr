<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class VoteController extends Controller
{
    public function showAll(){
      
        $votes=Vote::paginate(5);
        return view('index',['votes'=>$votes]);

    }
    public function create(Request $request){
        $vote = new Vote;
        $vote->title=$request->title;
        $vote->text = $request->text;
        $vote->positive = 0;
        $vote->negative = 0;
        $vote->save();

         return redirect('/');
    }
    public function showbyid($id){
        $votes = new Vote;
        $votes = Vote::where('id',$id)->first();
     
        return view('show_vote',['votes'=>$votes]);
    }
public function increasePositive($id){
    $votes = new Vote;
    $vote = Vote::where('id',$id)->first();
    $vote->positive++;
    $vote->save();
    return back();
}
public function increaseNegative($id){
    $votes = new Vote;
    $vote = Vote::where('id',$id)->first();
    $vote->negative++;
    $vote->save();
    return back();
}

}
