<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(){
       // $tasks = DB::table('tasks')->get();
        $tasks = Task::orderBy('created_at')->get();
         return view('tasks.index',compact('tasks'));
    }

    public function show($id){
        //$task = DB::table('tasks')->find($id);
        $task = Task::where('id' , $id)->get();
        return view('tasks.show', compact('task'));
    }

    public function store(Request $request){
        // dd($request);
       // DB::table('tasks')->insert([
         //   'name' => $request->name,
         //   'created_at' => now(),
         //   'updated_at' => now(),
       // ]);
       $request->validate([
         'name' =>'required|min:10|max:255',
       ]);
        $task = new Task();
        $task->name = $request->name;
        $task->created_at = now();
        $task->update_at = now();
        $task->save();

         return redirect()->back();

    }
    public function destroy($id){
      //  DB::table('tasks')->where('id','=',$id)->delete();
      $task = Task::find($id);
      $task->delete();
        return redirect()->back();
    }

    public function showupdate($id){
       
        //$tasks =DB::table('tasks')->get(); 
        //$task_edit =DB::table('tasks')->find($id);
        $task=Task::find($id);
        $task->name = 'New ID';
        $task->save();
        return view('tasks.update',compact('task_edit','tasks'));   
    }

    public function Update(Request $request,$id){ 

      //  DB::table('tasks')->where('id', $id)->update(['name' => $request->name,
       //  'created_at' => now(),
       //  'updated_at' =>now()
        // ]);
        $request->validate([
          'name' =>'required|min:10|max:255',
        ]);
        Task::where('id',$id)->update(['name'=> $request->name]);
        return redirect('/'); 

    }
}
