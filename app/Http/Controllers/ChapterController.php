<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Chapter;
use App\Models\Truyen;
use App\Models\Gallery;
use Storage;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:publish chapter|edit chapter|delete chapter|add chapter',['only' => ['index','show']]);
        $this->middleware('permission:add chapter', ['only' => ['create','store']]);
        $this->middleware('permission:edit chapter', ['only' => ['edit','update']]);
        $this->middleware('permission:delete chapter', ['only' => ['destroy']]);
    }
    public function index()
    {
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->get();
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.create')->with(compact('truyen'));
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
                'chap' => 'required|max:255',
                'tieude' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                
                // 'noidung' => 'required',
                'truyen_id' => 'required',
            ],
            [
                // 'slug_chapter.unique' => 'Slug truyện đã có, điền tên khác!',
                'chap.required' => 'Chưa nhập chapter!',
                // 'tieude.unique' => 'Tiêu đề đã có, điền tên khác!',
                'tieude.required' => 'Chưa nhập tiêu đề!',
                // 'noidung.required' => 'Chưa nhập nội dung chapter!',
                'slug_chapter.required' => 'Chưa nhập slug chapter!',
            ]
        );
        // $data = $request->all();
        $chapter = new Chapter();
        $chapter->chap = $data['chap'];
        $chapter->tieude = $data['tieude'];
        
        $chapter->slug_chapter = $data['slug_chapter'];
        // $chapter->noidung = $data['noidung'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();

        return redirect()->route('chapter.index')->with('status','Thêm chapter thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen','chapter'));
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
                'chap' => 'required|max:255',
                'tieude' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                
                // 'noidung' => 'required',
                'truyen_id' => 'required',
            ],
            [
                // 'slug_chapter.unique' => 'Slug truyện đã có, điền tên khác!',
                'chap.required' => 'Chưa nhập chapter!',
                // 'tieude.unique' => 'Tiêu đề đã có, điền tên khác!',
                'tieude.required' => 'Chưa nhập tiêu đề!',
                // 'noidung.required' => 'Chưa nhập nội dung chapter!',
                'slug_chapter.required' => 'Chưa nhập slug chapter!',
            ]
        );
        // $data = $request->all();
        $chapter = Chapter::find($id);
        $chapter->chap = $data['chap'];
        $chapter->tieude = $data['tieude'];
        
        $chapter->slug_chapter = $data['slug_chapter'];
        // $chapter->noidung = $data['noidung'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();

        return redirect()->route('chapter.index')->with('status','Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::find($id);
        //xóa folders gallery
        $gallery = Gallery::where('chapter_id',$id)->get();
        foreach($gallery as $key => $gal){
            unlink('public/uploads/gallery/'.$gal->gallery_image);
        }
        //xoa database gallery
        $chapter = Gallery::whereIn('chapter_id',[$chapter->id])->delete();
        Chapter::find($id)->delete();
        
        return redirect()->back()->with('status','Xóa chapter thành công');
    }

    public function ckeditor_image(Request $request){
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move('public/uploads/ckeditor', $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/ckeditor/'.$fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    public function kytu3(Request $request,$kytu3){
        $chapter = Chapter::where('tieude','LIKE',$kytu3.'%')->orWhere('chap','LIKE',$kytu3.'%')->orderBy('id','DESC')->get();
        return view('admincp.chapter.kytu3')->with(compact('chapter')); 
    }
    public function timkiem3(Request $request){
        $data = $request->all();

        $tukhoa3 = $data['tukhoa3'];
        $chapter = Chapter::where('tieude','LIKE','%'.$tukhoa3.'%')->orWhere('chap','LIKE','%'.$tukhoa3.'%')->get();
        return view('admincp.chapter.timkiem3')->with(compact('chapter','tukhoa3')); 
    }
    public function timkiem_ajax3(Request $request){
        $data = $request->all();
        if($data['keywords3']){
            $chapter = Chapter::where('tieude','LIKE','%'.$data['keywords3'].'%')->orWhere('chap','LIKE','%'.$data['keywords3'].'%')->get();
            $output = '
                <ul class="scroll-search3 dropdown-menu" style="display:block;">'
            ;
            foreach($chapter as $key => $chap){
             $output.= '
                <li class="li_timkiem_ajax3"><a href="#">'.$chap->tieude.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
