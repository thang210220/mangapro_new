<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\Banner;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasAnyRole('master','admin')){
            return view('home');
        }else{
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
    }
}
