<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:publish user|edit user|delete user|add user|phanquyen user',['only' => ['index','show']]);
        $this->middleware('permission:add user', ['only' => ['create','store']]);
        $this->middleware('permission:edit user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
        $this->middleware('permission:phanquyen user', ['only' => ['phanquyen','insert_roles']]);
    }
    public function index()
    {
        //Tạo vai trò và quyền
        // Role::create(['name'=>'master']);
        // Permission::create(['name'=>'add user']);

        // $role = Role::find(3);
        // $permission = Permission::find(26);

        //Gán quyền cho vai trò
        // $role->givePermissionTo($permission);
        //Xóa quyền khỏi vai trò
        // $role->revokePermissionTo($permission);

        //Gán vai trò cho quyền
        // $permission->assignRole($role);
        //Xóa vai trò khỏi quyền
        // $permission->removeRole($role);

        //Gán vai trò vào user
        // $user = User::find(2);
        // $user->assignRole('user');

        //Gán vai trò vào user đang đăng nhập
        // auth()->user()->assignRole('user');
        //Xóa vai trò khỏi user
        // auth()->user()->removeRole('admin');

        //Gán quyền vào user
        // auth()->user()->givePermissionTo('add story');

        //Kiểm tra xem có cái gì
        // $user = User::find(1);
        // if($user->hasRole('admin')){
        //     echo 'có';
        // }else{
        //     echo 'ko';
        // }
        // echo auth()->user()->id;
        $user = User::with('roles','permissions')->get();

        return view('admincp.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request-> all();
        $user = new User();
        $user->password = Hash::make($data['password']);
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->save();

        return redirect()->route('user.index')->with('status','Thêm user thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admincp.user.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request-> all();
        $user = User::find($id);
        $user->password = Hash::make($data['password']);
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->save();

        return redirect()->route('user.index')->with('status','Cập nhật user thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('status','Xóa user thành công');
    }

    public function phanvaitro($id){
        $user = User::find($id);
        $role = Role::orderBy('id','DESC')->get();
        $permission = Permission::orderBy('id','DESC')->get();
        $all_column_roles = $user->roles->first();

        return view('admincp.user.phanvaitro',compact('user','role','all_column_roles','permission'));
    }
    public function phanquyen($id){
        $user = User::find($id);
        $permission = Permission::orderBy('id','DESC')->get();
        $name_roles = $user->roles->first()->name;
        //lấy quyền
        $get_permission_via_role = $user->getPermissionsViaRoles();

        return view('admincp.user.phanquyen',compact('user','name_roles','permission','get_permission_via_role'));
    }
    public function insert_roles(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        $role_id = $user->roles->first()->id;

        return redirect()->route('user.index')->with('status','Thêm vai trò thành công');
    }
    public function insert_permission(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        //cấp quyền
        $role = Role::find($role_id);
        $role->syncPermissions($data['permission']);
       
        return redirect()->back()->with('status','Cấp quyền cho user thành công');
    }
    public function insert_per_permission(Request $request){
        $data = $request->all();
        $permission = new Permission();
        $permission->name = $data['permission'];
        $permission->save();

        return redirect()->back()->with('status','Thêm quyền thành công');
    }
}
