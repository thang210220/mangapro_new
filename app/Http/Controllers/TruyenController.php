<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DanhmucTruyen;
use App\Models\Banner;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\ThuocDanh;
use App\Models\Chapter;
use App\Models\Gallery;
use Storage;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:publish story|edit story|delete story|add story',['only' => ['index','show']]);
        $this->middleware('permission:add story', ['only' => ['create','store']]);
        $this->middleware('permission:edit story', ['only' => ['edit','update']]);
        $this->middleware('permission:delete story', ['only' => ['destroy']]);
    }
    public function index()
    {
        $list_truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('updated_at','desc')->get();
        return view('admincp.truyen.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id', 'desc')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'desc')->get();
        $banner = Banner::orderBy('id', 'desc')->get();
        return view('admincp.truyen.create')->with(compact('theloai','danhmuc','banner'));
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
                'tentruyen' => 'required|unique:truyen|max:255',
                'slug_truyen' => 'required|unique:truyen|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=3000',
                'tomtat' => 'required',
                'trangthai' => 'required',
                'truyennoibat' => 'required',
                'topview' => 'required',
                'tacgia' => 'required',
                'danhmuc' => 'required',
                'banner' => 'required',
                'theloai' => 'required',
                
            ],
            [
                'tentruyen.unique' => 'Tên truyện đã có, điền tên khác!',
                'slug_truyen.unique' => 'slug truyện đã có, điền tên khác!',
                'tentruyen.required' => 'Chưa nhập tên truyện!',
                'tomtat.required' => 'Chưa nhập mô tả truyện!',
                'tacgia.required' => 'Chưa nhập tác giả!',
                'slug_truyen.required' => 'Chưa nhập slug truyện!',
                'hinhanh.required' => 'Chưa có hình ảnh!'
            ]
        );
        $data = $request->all();
       
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        // đây là dành cho select
        $truyen->danhmuc_id = $data['danhmuc'];
        $truyen->banner_id = $data['banner'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->trangthai = $data['trangthai'];
        $truyen->tacgia = $data['tacgia'];
       
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->top_view = $data['topview'];
        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['theloai'] as $key => $the){
            $truyen->theloai_id = $the[0];
        }
        // dd($data['danhmuc']);

        //them anh
        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalName();
        $get_image->move($path,$new_image);

        $truyen->hinhanh = $new_image;
        $truyen->save();

        $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);
      
        return redirect()->route('truyen.index')->with('status','Thêm truyện thành công');
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
        $truyen = Truyen::find($id);

        $thuoctheloai = $truyen->thuocnhieutheloaitruyen;

        $theloai = Theloai::orderBy('id', 'desc')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'desc')->get();
        $banner = Banner::orderBy('id', 'desc')->get();
        return view('admincp.truyen.edit')->with(compact('truyen','danhmuc','theloai','thuoctheloai','banner'));
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
                'tentruyen' => 'required|max:255',
                'slug_truyen' => 'required|max:255',
                'tomtat' => 'required',
                'trangthai' => 'required',
                'truyennoibat' => 'required',
                'topview' => 'required',
                'tacgia' => 'required',
                'danhmuc' => 'required',
                'banner' => 'required',
                'theloai' => 'required'
            ],
            [
                
                'tentruyen.required' => 'Chưa nhập tên truyện!',
                'tomtat.required' => 'Chưa nhập mô tả truyện!',
                'tacgia.required' => 'Chưa nhập tác giả!',
                'slug_truyen.required' => 'Chưa nhập slug truyện!',
            ]
        );
        $data = $request->all();
        
        $truyen = Truyen::find($id);

        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->danhmuc_id = $data['danhmuc'];
        $truyen->banner_id = $data['banner'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->trangthai = $data['trangthai'];
        $truyen->tacgia = $data['tacgia'];
        
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->top_view = $data['topview'];
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['theloai'] as $key => $the){
            $truyen->theloai_id = $the[0];
        }
        //them anh
        $get_image = $request->hinhanh;
        if($get_image){
            $path = 'public/uploads/truyen/'.$truyen->hinhanh;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalName();
            $get_image->move($path,$new_image);

            $truyen->hinhanh = $new_image;
        }
        
        $truyen->save();

        $truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);

        return redirect()->route('truyen.index')->with('status','Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        // xoa anh
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        //xoa theloai
        $truyen = ThuocDanh::whereIn('truyen_id',[$truyen->id])->delete();
        //xoa chapter
        $truyen = Truyen::find($id);
        $chapter = Chapter::whereIn('truyen_id',[$truyen->id])->delete();
        // echo $chapter;
        Truyen::find($id)->delete();
        return redirect()->back()->with('status','Xóa truyện thành công!');
    }
    public function truyennoibat(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();
    }
    public function topview(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->top_view = $data['topview'];
        $truyen->save();
    }
    public function filter_topview(Request $request){
        $data = $request->all();
        $truyen = Truyen::where('top_view',$data['value'])->orderBy('updated_at','DESC')->take(10)->get();
        $output = '';
        foreach($truyen as $key => $tr){
            $output.=' <div class="col-12">
                            <table>
                                <tr>
                                    <th>
                                        <a href="'.url('xem-truyen/'.$tr->slug_truyen).'">
                                            <img src="'.asset('public/uploads/truyen/'.$tr->hinhanh).'" alt="'.$tr->tentruyen.'">
                                        </a>
                                    </th>
                                    <th class="text-color">
                                        <a href="'.url('xem-truyen/'.$tr->slug_truyen).'">
                                            <h5>'.$tr->tentruyen.'</h5>
                                        </a>
                                        <small class="text-muted"><h6>'.$tr->views_truyen.' Lượt xem</h6></small>
                                    </th>
                                </tr>
                            </table>
                        </div>';
        }
        echo $output;
    }
    
}
