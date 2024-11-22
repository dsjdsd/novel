<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function dashboard(){
        $data['title'] = "Dashboard";
        $data['total_novel'] =  Novel::where('user_id',Auth::id())->count();
        $data['total_approved_novel'] =Novel::where('check_status',1)->where('user_id',Auth::id())->count();
        $data['total_rejected_novel'] =Novel::where('check_status',2)->where('user_id',Auth::id())->count();
        $data['total_pending_novel'] =Novel::where('check_status',0)->where('user_id',Auth::id())->count();
        return view('users-panel.index',$data);
    }
    public function novelList(){
        $data['novel_list'] = Novel::where('user_id',Auth::id())->orderByDesc('id')->get();
        return view('users-panel.novel-list',$data);
    }
    public function addNovel(){
        return view('users-panel.add-novel');
    }
    public function saveNovel(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'document' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '.' . $document->getClientOriginalExtension();
            $documentPath = public_path('/users-assets/documents');
            $document->move($documentPath, $documentName);
        } else {
            return redirect()->back()->withErrors('Image upload failed. Please try again.');
        }
    
        $novel = new Novel(); // Assuming you have a `Novel` model
        $novel->title = $request->input('title');
        $novel->description = $request->input('description');
        $novel->user_id = Auth::id();
        $novel->document = '/users-assets/documents/' . $documentName;
        $novel->save();
        return  redirect()->back()->with('success', 'Novel added successfully!');
    }
    public function editNovel($id){
        $data['novel']=Novel::find($id);
        return view('users-panel.edit-novel',$data);
    }
    public function updateNovel(Request $request){
        $validation = [
            'title' => 'required|string|max:255',
            'description' => 'required',
        ];
        if ($request->hasFile('document')) {
            $validation['document'] = 'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'; // Allows images and documents like PDF, DOC
        }
        $request->validate($validation);
        $novel = Novel::find($request->id);
        if (!$novel) {
            return redirect()->back()->withErrors('Novel not found.');
        }
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '.' . $document->getClientOriginalExtension();
            $documentPath = public_path('/users-assets/documents'); // Fix typo 'documents' to 'documents'
            $document->move($documentPath, $documentName);
            $novel->document = '/users-assets/documents/' . $documentName;
        }
        $novel->title = $request->input('title');
        $novel->description = $request->input('description');
        $novel->save();
        return redirect()->back()->with('success', 'Novel updated successfully!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
