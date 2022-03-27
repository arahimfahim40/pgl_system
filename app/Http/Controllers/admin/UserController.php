<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\permission_user;
use DB;
use Image;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->middleware('auth:admin');
        $this->user = $user;
    }

    public function user()
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','user-management']))
            return view('admin.error.403');

        $users=DB::table('users')->select('users.*','user_types.type','user_types.id as type_id')
        ->join('user_types','user_types.id','=','users.user_type_id')
        ->orderBy('users.id','desc')
        ->paginate(100);
         return view('admin.user.user',['users'=>$users,'paginate'=>20]);
    }

    public function search_user(Request $request)
    {
        $pagination=20;
        $searchQuery = trim($request['searchValue']);
        $requestData = ['users.username'];
        if($request->ajax()){
       $user=DB::table('users')->select('users.*','user_types.type','user_types.id as type_id')
        ->join('user_types','user_types.id','=','users.user_type_id');  
        if($request['searchValue']!=''){
         $pagination=20000;
        $user->where(function($q) use($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                       $q->orWhere($field, 'like', "%{$searchQuery}%");
            });
        }
       $users=$user->orderBy('id','desc')->paginate($pagination); 
        return view('admin.user.user_data',compact('users'))->render();
      }
    }

    public function paginate_user(Request $request)
    {
        $paginate=20;
        if($request['paginate']){
          $paginate= $request['paginate'];
        }
        if($request->ajax()){
       $users=DB::table('users')
       ->orderBy('id','desc')
       ->paginate($paginate); 
        return view('admin.customer.user_data',compact('users','paginate'))->render();
      }

    }

    function delete_user($id='')
    {
        if(!auth()->guard('admin')->user()->hasPermissions(['Admin','delete-user']))
            return view('admin.error.403');

       if(DB::table('users')->where('id',$id)->delete()){
        return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('Error','Sorry,did not  delete');
        }
    }

    public function add_user(Request $request)
    {
         if(!auth()->guard('admin')->user()->hasPermissions(['Admin','add-user']))
            return view('admin.error.403');

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'usert' => 'required',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024'
        ]);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imagename = time() . '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('images/user');
            $thumb_img = Image::make($photo->getRealPath())->resize(267, 286);
            $thumb_img->save($destinationPath . '/' . $imagename, 80);
            $photo->move($destinationPath, $imagename);
            $data['photo'] = $imagename;
        }
        $add_user = new User();
        $add_user->email = $request['email'];
        $add_user->user_type_id = $request['usert'];
        $add_user->password = bcrypt($request['password']);
        $add_user->username = $request['username'];
       if(isset($imagename)){
        $add_user->photo = $imagename;
        }
        if ($add_user->save()) {


            if ($request['usert'] == 1) {
                $permissionuser = new permission_user();
                $permissionuser->user_id = $add_user->id;
                $permissionuser->permission_id = 1;
                $permissionuser->save();
            } elseif ($request['usert'] == 3) {
                $permissionuser = new permission_user();
                $permissionuser->user_id = $add_user->id;
                $permissionuser->permission_id = 76;
                $permissionuser->save();
            } else {
                foreach ($request['access'] as $access) {
                    $permissionuser = new permission_user();
                    $permissionuser->user_id = $add_user->id;
                    $permissionuser->permission_id = $access;
                    $permissionuser->save();
                }
            }
            // flog('User','Add New User',$request['username']);
            return redirect()->back()->with('success', 'Successfully Updated!');
        } else {
            return redirect()->back()->withErrors("Failed To Update Your Form!");
        }
    }

    public function edit_user(Request $request)
    {
         if(!auth()->guard('admin')->user()->hasPermissions(['Admin','edit-user']))
            return view('admin.error.403');

        $this->validate($request, [
            'email' => 'required'  
        ]);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imagename = time() . '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('images/user');
            $thumb_img = Image::make($photo->getRealPath())->resize(267, 286);
            $thumb_img->save($destinationPath . '/' . $imagename, 80);
            $photo->move($destinationPath, $imagename);
            $data['photo'] = $imagename;
        }
        $update_user = User::find($request['id']);
        $update_user->username = $request['username'];
        $update_user->email = $request['email'];
        // $update_user->user_type_id = $request['usert'];
        if($request['password'] !=''){
        $update_user->password = bcrypt($request['password']);
        }
        if ($request->hasFile('photo')) {
            $update_user->photo = $imagename;
        } else {
            $update_user->photo = $request['pname'];
        }
        $oldPhoto = $update_user->photo;
        if ($oldPhoto !== $update_user->photo) {
            $this->removeUsersphoto($oldPhoto);
        }
        $update_user->update();
        if(!empty($request['access'])){
          $data=DB::table('permission_user')->where('user_id','=',$request['id'])->delete();
        foreach ($request['access'] as $access) {
                    // echo "<pre>"; print_r($request['access']);exit;
                    $permissionuser = new permission_user();
                    $permissionuser->user_id = $request['id'];
                    $permissionuser->permission_id = $access;
                    $permissionuser->save();
                }

          }
          // flog('User','Update User',$request['username']);
        return redirect()->back()->with('success', 'saved!');
    }

    private function removeUsersphoto($photo)
    {
        if (!empty($photo)) {
            $file_path = public_path('/images/user') . '/' . $photo;

            if (file_exists($file_path)) unlink($file_path);
        }
    }


}
