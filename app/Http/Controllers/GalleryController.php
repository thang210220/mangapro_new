<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Chapter;
use App\Models\Truyen;
use App\Models\Gallery;
use Storage;

class GalleryController extends Controller
{
    public function add_gallery($chapter_id){
        $chap_id = $chapter_id;
        return view('admincp.gallery.add_gallery')->with(compact('chap_id'));
    }
    public function select_gallery(Request $request){
        $chapter_id = $request->chap_id;
        $gallery = Gallery::where('chapter_id',$chapter_id)->get();
        $gallery_count = $gallery->count();
        $output = '
        <form>
            '.csrf_field().'
            <table>
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
        ';
        if($gallery_count>0){
            $i = 0;
            foreach($gallery as $key => $gal){
                $i++;
                $output.= '
                    <tr>
                        <img src="'.url('public/uploads/gallery/'.$gal->gallery_image).'" class="img-thumbnail" style="width: 120px; height: 160px; margin-left: 11px; margin-top: 15px; margin-bottom: 15px;">
                        <button type="button" data-gal_id="'.$gal->gallery_id.'"  class="btn btn-danger delete-gallery" style="margin-left: 5px; margin-top: 60px; width: 70px;">Xóa</button>
                        <input type="file" class="file_image" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" name="file" accept="image/*" style="width: 71px; height: 40px; margin-left: -71px; border-radius: 5px"></input>
                    </tr>
                ';
            }
        }else{
            $output.= '<tr>
                <th colspan="4">Chap chưa có nội dung</th>
            </tr>
                ';
        }
        $output.= '
                </tbody>
                </table>
                </form>
                ';
        echo $output;
    }
    public function insert_gallery(Request $request,$chap_id){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery/',$new_image);

                $gallery = new Gallery();
                $gallery->gallery_image = $new_image;
                $gallery->chapter_id = $chap_id;
                $gallery->save();
            }
        }
        return redirect()->back()->with('status','Thêm nội dung thành công');
    }
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        //xóa folders
        $path = 'public/uploads/gallery/'.$gallery->gallery_image;
        if(file_exists($path)){
            unlink($path);
        }
        //xoa database
        $gallery = Gallery::whereIn('chapter_id',[$gallery->gallery_id])->delete();
        Gallery::find($gal_id)->delete();
    }
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/gallery/',$new_image);
            $gallery = Gallery::find($gal_id);
            unlink('public/uploads/gallery/'.$gallery->gallery_image);
            $gallery->gallery_image = $new_image;
        
            $gallery->save();
        }
    }
}
