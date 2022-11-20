<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Banner;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\ThuocDanh;
use App\Models\Slider;
use App\Models\Gallery;

class IndexController extends Controller
{
    public function kytu(Request $request,$kytu){
        $truyen = Truyen::with('thuocnhieutheloaitruyen')->where('tentruyen','LIKE',$kytu.'%')->orderBy('id','desc')->get();

        return view('pages.kytu')->with(compact('truyen')); 
    }
    public function kytu2(Request $request,$kytu2){
        $chapter = Chapter::where('tieude','LIKE',$kytu2.'%')->orderBy('id','DESC')->get();
        return view('pages.kytu2')->with(compact('chapter')); 
    }
    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['keywords']){
            $truyen = Truyen::where('tentruyen','LIKE','%'.$data['keywords'].'%')->get();
            $output = '
                <ul class="scroll-search dropdown-menu" style="display:block;">'
            ;
            foreach($truyen as $key => $tr){
             $output.= '
                <li class="li_timkiem_ajax"><a href="#">'.$tr->tentruyen.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function timkiem_ajax2(Request $request){
        $data = $request->all();
        if($data['keywords2']){
            $truyen = Truyen::where('tentruyen','LIKE','%'.$data['keywords2'].'%')->get();
            $output = '
                <ul class="scroll-search2 dropdown-menu" style="display:block;">'
            ;
            foreach($truyen as $key => $tr){
             $output.= '
                <li class="li_timkiem_ajax2"><a href="#">'.$tr->tentruyen.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function home(){
        $banner = Banner::orderBy('updated_at','DESC')->take(5)->get();
        //
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $truyen = Truyen::orderBy('updated_at','DESC')->take(24)->get();
        $chapter = Chapter::with('truyen')->orderBy('updated_at','DESC')->take(8)->get();
        //
        $truyennoibat = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',1)->take(15)->get();
        
        return view('pages.home')->with(compact('banner','danhmuc','theloai','truyen','chapter','truyennoibat')); 
    }
    public function xemtatca(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $xemtatca = Truyen::orderBy('updated_at','DESC')->paginate(24);
        
        return view('pages.all')->with(compact('danhmuc','theloai','xemtatca'));
    }
    public function danhmuc($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        $tendanhmuc= $danhmuc_id->tendanhmuc;
        //
        $truyen = Truyen::orderBy('updated_at','DESC')->where('danhmuc_id',$danhmuc_id->id)->paginate(24);
      
        return view('pages.danhmuc')->with(compact('danhmuc','truyen','tendanhmuc','theloai'));
    }
    public function theloai($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //Nhieu the loai
        $theloai_id = Theloai::where('slug_theloai',$slug)->first();
        $theloaitruyen = ThuocDanh::where('danhmuc_id',$theloai_id->id)->get();
        $nhieutheloai = [];
        foreach($theloaitruyen as $key => $the){
            $nhieutheloai[] = $the->truyen_id;
        }
        // dd($nhieutheloai);
        $tentheloai = $theloai_id->tentheloai;
        //phân trang
        $truyen = Truyen::whereIn('id',$nhieutheloai)->orderBy('id','DESC')->paginate(24);
       
        return view('pages.theloai')->with(compact('theloai','danhmuc','theloai_id','tentheloai','truyen'));
    }
    public function xephang(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $day = Truyen::orderBy('updated_at','DESC')->where('top_view',0)->take(10)->get();
        $week = Truyen::orderBy('updated_at','DESC')->where('top_view',1)->take(10)->get();
        $month = Truyen::orderBy('updated_at','DESC')->where('top_view',2)->take(10)->get();
        return view('pages.xephang')->with(compact('danhmuc','theloai','day','week','month'));
    }
    public function trangthai(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('updated_at','DESC')->paginate(24);
        return view('pages.trangthai')->with(compact('danhmuc','theloai','truyen'));
    }
    public function hoanthanh(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $hoanthanh = Truyen::orderBy('updated_at','DESC')->where('trangthai',0)->paginate(24);
        return view('pages.hoanthanh')->with(compact('danhmuc','theloai','hoanthanh'));
    }
    public function dangtienhanh(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $dangtienhanh = Truyen::orderBy('updated_at','DESC')->where('trangthai',1)->paginate(24);
        return view('pages.dangtienhanh')->with(compact('danhmuc','theloai','dangtienhanh'));
    }
    public function xemtruyen($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $truyen = Truyen::with('danhmuctruyen','theloai','thuocnhieutheloaitruyen')->where('slug_truyen',$slug)->first();
        //
        $truyen = Truyen::where('id', $truyen->id)->first();
        $truyen->views_truyen = $truyen->views_truyen + 1;
        $truyen->save();
        //
        $truyennoibat = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',1)->take(5)->get();
        $truyenxemnhieu = Truyen::orderBy('updated_at','DESC')->where('truyen_noibat',2)->take(5)->get();
        //
        $chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_moinhat = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();
        //
        $cungdanhmuc = Truyen::with('danhmuctruyen','theloai')->orderBy('updated_at','DESC')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->take(4)->get();

        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau','theloai','truyennoibat','truyenxemnhieu','chapter_moinhat'));
    }
    public function xemchapter($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $truyen = Chapter::where('slug_chapter',$slug)->first();
        //breadcrumb
        $truyen_breadcrumb = Truyen::with('danhmuctruyen','theloai')->where('id',$truyen->truyen_id)->first();
        //
        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        $chapter = Chapter::where('id', $chapter->id)->first();
        $chapter->views_chapter = $chapter->views_chapter + 1;
        $chapter->save();
        //
        $all_chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->truyen_id)->get();
        //
        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');
        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        $gallery = Gallery::where('chapter_id',$chapter->id)->get();

        return view('pages.chapter')->with(compact('danhmuc','chapter','all_chapter','theloai','truyen_breadcrumb','next_chapter','previous_chapter','max_id','min_id','gallery'));
    }
    public function timkiem(Request $request){
        $data = $request->all();
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $tukhoa = $data['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->paginate(24);
        return view('pages.timkiem')->with(compact('danhmuc','truyen','theloai','slide_truyen','tukhoa')); 
    }
    public function timkiem2(Request $request){
        $data = $request->all();
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        //
        $tukhoa2 = $data['tukhoa2'];
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa2.'%')->orWhere('tacgia','LIKE','%'.$tukhoa2.'%')->get();
        return view('admincp.timkiem')->with(compact('danhmuc','truyen','theloai','slide_truyen','tukhoa2')); 
    }
    public function dangky(){
        return view('auth.register');
    }
    public function dangnhap(){
        return view('auth.login');
    }
    
}
