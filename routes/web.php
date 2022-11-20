<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThongkeController;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'home']);
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen']);
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/xep-hang', [IndexController::class, 'xephang']);
Route::get('/trang-thai', [IndexController::class, 'trangthai']);
Route::get('/xem-tatca', [IndexController::class, 'xemtatca']);
Route::get('/filter-topview-truyen', [TruyenController::class, 'filter_topview']);

Route::get('/dang-ky', [IndexController::class, 'dangky']);
Route::get('/dang-nhap', [IndexController::class, 'dangnhap']);

Route::post('/tim-kiem', [IndexController::class, 'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);

Route::post('/tim-kiem2', [IndexController::class, 'timkiem2']);
Route::post('/timkiem-ajax2', [IndexController::class, 'timkiem_ajax2']);

Route::post('/tim-kiem3', [ChapterController::class, 'timkiem3']);
Route::post('/timkiem-ajax3', [ChapterController::class, 'timkiem_ajax3']);

Route::post('/truyennoibat', [TruyenController::class, 'truyennoibat']);
Route::post('/topview', [TruyenController::class, 'topview']);

Route::get('/kytu/{kytu}', [IndexController::class, 'kytu']);
Route::get('/kytu2/{kytu2}', [IndexController::class, 'kytu2']);
Route::get('/kytu3/{kytu3}', [ChapterController::class, 'kytu3']);

Route::get('/hoanthanh', [IndexController::class, 'hoanthanh']);
Route::get('/dangtienhanh', [IndexController::class, 'dangtienhanh']);

Route::post('/uploads-ckeditor', [ChapterController::class, 'ckeditor_image']);
Route::get('add-gallery/{chapter_id}', [GalleryController::class, 'add_gallery']);
Route::post('insert-gallery/{chap_id}', [GalleryController::class, 'insert_gallery']);
Route::post('select-gallery', [GalleryController::class, 'select_gallery']);
Route::post('delete-gallery', [GalleryController::class, 'delete_gallery']);
Route::post('update-gallery', [GalleryController::class, 'update_gallery']);

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
    Route::resource('/user', UserController::class);
    Route::get('/phan-vaitro/{id}', [UserController::class, 'phanvaitro']);
    Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen']);
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles']);
    Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission']);
    Route::post('/insert-permission', [UserController::class, 'insert_per_permission']);

    Route::resource('/danhmuc', DanhmucController::class);
    Route::resource('/truyen', TruyenController::class);
    Route::resource('/chapter', ChapterController::class);
    Route::resource('/theloai', TheLoaiController::class);
    Route::resource('/banner', BannerController::class);
    Route::resource('/thongke', ThongkeController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
   
});