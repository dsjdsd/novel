<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Novel;


class DashboardController extends Controller
{
    public function dashboard(){
        $data['title'] = "Dashboard";
        $data['total_user'] =  User::where('role',2)->count();
        $data['total_novel'] =  Novel::count();
        $data['total_approved_novel'] =Novel::where('check_status',1)->count();
        $data['total_rejected_novel'] =Novel::where('check_status',2)->count();
        $data['total_pending_novel'] =Novel::where('check_status',0)->count();
        
        return view('admin-panel.index',$data);
    }
    public function userList(){
        $data['users'] = DB::table('users')->orderByDesc('id')->where('role',2)->get();
        return view('admin-panel.users-list',$data);
    }
    public function novelList(){
        $data['novel_list'] = Novel::join('users','users.id','=','novels.user_id')->select('novels.id','novels.title','novels.description','novels.document','novels.status','novels.check_status','users.name')->orderByDesc('novels.id')->get();
        return view('admin-panel.novel-list',$data);
    }
    public function novelCheckStatus(Request $request){
        $novel = Novel::find($request->id);
        if ($novel) {
            $novel->check_status = $request->check_status;
            $novel->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Novel not found'], 404);
    }
    public function novelStatus(Request $request){
        $novel = Novel::find($request->id);
        if ($novel) {
            // Update the status value
            $novel->status = $request->status;
            $novel->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Novel not found'], 404);
    }
    public function deleteNovel($id)
    {
        $novel = Novel::find($id);
        if (!$novel) {
            return redirect()->back()->withErrors('Novel not found.');
        }
        if ($novel->document && file_exists(public_path($novel->document))) {
            unlink(public_path($novel->document)); // Delete the document file
        }
        $novel->delete();
        return redirect()->back()->with('success', 'Novel deleted successfully!');
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors('User not found.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
    public function editNovel($id){
        $data['novel']=Novel::find($id);
        return view('admin-panel.edit-novel',$data);
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
    public function userStatus(Request $request){
        $user = User::find($request->id);
        if ($user) {
            $user->status = $request->status;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Novel not found'], 404);
    }    
    public function logout()
    {
        Auth::logout();
        return redirect('admin-login');
    }
}
