<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:publish banner|edit banner|delete banner|add banner',['only' => ['index','show']]);
        $this->middleware('permission:add banner', ['only' => ['create','store']]);
        $this->middleware('permission:edit banner', ['only' => ['edit','update']]);
        $this->middleware('permission:delete banner', ['only' => ['destroy']]);
    }
    public function index()
    {
        $banner = Banner::orderBy('updated_at','DESC')->get();
        return view('admincp.banner.index')->with(compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tenbanner' => 'required|unique:banner|max:255',
                'slug_banner' => 'required|unique:banner|max:255'
            ],
            [
                'tenbanner.unique' => 'Tên banner đã có, điền tên khác!',
                'slug_banner.unique' => 'slug banner đã có, điền tên khác!',
                'tenbanner.required' => 'Chưa nhập tên banner!'
            ]
        );
        $data = $request->all();
        $banner = new banner();
        $banner->tenbanner = $data['tenbanner'];
        $banner->slug_banner = $data['slug_banner'];
        $banner->banner_tomtat = $data['banner_tomtat'];
        $banner->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->banner_image;
        if($get_image){
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);

            $banner->banner_image = $new_image;
        }
        $banner->save();
        return redirect()->route('banner.index')->with('status','Thêm banner thành công');
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
        $banner = Banner::find($id);
        return view('admincp.banner.edit')->with(compact('banner'));
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
        $data = $request->validate(
            [
                'tenbanner' => 'required|max:255',
                'slug_banner' => 'required|max:255'
            ],
            [
                'tenbanner.required' => 'Chưa nhập tên banner!',
                'slug_banner.required' => 'Chưa nhập slug banner!'
            ]
        );
        $data = $request->all();
        $banner = Banner::find($id);
        $banner->tenbanner = $data['tenbanner'];
        $banner->slug_banner = $data['slug_banner'];
        $banner->banner_tomtat = $data['banner_tomtat'];
        $banner->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->banner_image;
        if($get_image){
            $path = 'public/uploads/truyen/'.$banner->banner_image;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);

            $banner->banner_image = $new_image;
        }
        $banner->save();
        return redirect()->route('banner.index')->with('status','Cập nhật banner thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();
        return redirect()->back()->with('status','Xóa banner thành công!');
    }
}
