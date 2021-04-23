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
        $vote->img=$request->img;
        $vote->positive = 0;
        $vote->negative = 0;
        $vote->save();
        if(!empty($_FILES['newfile'])) {
            if(move_uploaded_file($_FILES['newfile']['tmp_name'],'uploads/'.$_FILES['newfile']['name'])){
            echo 'OK';
            }
            else {
            echo 'ERROR';
            }
        }
   
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
public function upload(Request $request){
    $file = $request->file('image');
 
    // отображаем имя файла
    echo 'File Name: '.$file->getClientOriginalName();
    echo '<br>';
 
    //отображаем расширение файла
    echo 'File Extension: '.$file->getClientOriginalExtension();
    echo '<br>';
 
    //отображаем фактический путь к файлу
    echo 'File Real Path: '.$file->getRealPath();
    echo '<br>';
 
    //отображаем размер файла
    echo 'File Size: '.$file->getSize();
    echo '<br>';
 
    //отображаем Mime-тип файла
    echo 'File Mime Type: '.$file->getMimeType();
 
    //перемещаем загруженный файл
    $destinationPath = 'uploads';
    $file->move($destinationPath,$file->getClientOriginalName());
 }
}
