<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category_Post;
use App\Category_product;
use Illuminate\Http\Request;
use DB;
use App\Video;
use Session;
use App\CatePost;
use Toastr;
use App\Slider;
use App\Admin;
use App\Http\Requests;
use App\Videos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
session_start();
class VideoController extends Controller
{
    public function AuthLogin(){

        if(Session()->get('login_normal')){

            $admin_id = Session()->get('admin_id');
        }else{
            $admin_id = Auth::id();
        }
            if($admin_id){
                return Redirect::to('dashboard');
            }else{
                return Redirect::to('admin')->send();
            }


    }
    public function video(){
    	return view('admin.videos.list_video');
    }
    public function insert_video(Request $request){
    	$data = $request->all();
    	$video = new Videos();
    	$sub_link = substr($data['video_link'], 17);
    	$video->video_name = $data['video_title'];
    	$video->video_desc = $data['video_desc'];
    	$video->video_link = $sub_link;
    	$video->slug_video = $data['video_slug'];

    	$get_image = $request->file('file');
    	if($get_image){
    			$get_name_image = $get_image->getClientOriginalName();
	            $name_image = current(explode('.',$get_name_image));
	            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
	            $get_image->move('public/uploads/videos',$new_image);
	           	$video->video_image = $new_image;
    	}
    	$video->save();
    }
    public function delete_video(Request $request){
    	$data = $request->all();
    	$video_id = $data['video_id'];

    	$video = Videos::find($video_id);
	    unlink('public/uploads/videos/'.$video->video_image);

    	$video->delete();
    }
    public function update_video(Request $request){
    	$data = $request->all();
    	$video_id = $data['video_id'];
    	$video_edit =  $data['video_edit'];
    	$video_check =  $data['video_check'];
    	$video = Videos::find($video_id);

    	if($video_check=='video_title'){

    		$video->video_name = $video_edit;

    	}
    	elseif($video_check=='video_desc'){

	    	$video->video_desc = $video_edit;

    	}
    	elseif($video_check=='video_link'){

	    	$sub_link = substr($video_edit, 17);
	    	$video->video_link = $sub_link;


    	}else{

	    	$video->slug_video = $video_edit;

    	}
    	$video->save();
    }
    public function update_video_image(Request $request){

    	$get_image = $request->file('file');
    	$video_id = $request->video_id;
    	if($get_image){
    			$video = Videos::find($video_id);
	           	unlink('public/uploads/videos/'.$video->video_image);
    			$get_name_image = $get_image->getClientOriginalName();
	            $name_image = current(explode('.',$get_name_image));
	            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
	            $get_image->move('public/uploads/videos',$new_image);
	            $video->video_image = $new_image;
	           	$video->save();

    	}
    }
     public function select_video(Request $request){
    	$admin = new Admin();
    	$video = Videos::orderBy('video_id','DESC')->get();
    	$video_count = $video->count();
    	$output = ' <form>
    					'.csrf_field().'
						<div class="panel-body">
                        <table class="table table-hover" id="dataTables-example">
					        <thead>
					          <tr>
					            <th>Thứ tự</th>
					            <th>Tên video</th>
					            <th>Slug video</th>
					            <th>Hình ảnh video</th>
					            <th>Mô tả</th>
                                <th>Link</th>
					            <th>Demo video</th>
					            <th style="width:30px;">Quản lý</th>
					          </tr>
					        </thead>
					        <tbody>

    	';
    	if($video_count>0){
    		$i = 0;
    		foreach($video as $key => $vid){
    			$i++;
    			$output.='

    				 <tr>
    				 <td>'.$i.'</td>
			           <td contenteditable data-video_id="'.$vid->video_id.'" data-video_type="video_title" class="video_edit" id="video_title_'.$vid->video_id.'">'.$vid->video_name.'</td>

			           <td contenteditable data-video_id="'.$vid->video_id.'" data-video_type="video_slug" class="video_edit" id="video_slug_'.$vid->video_id.'">'.$vid->slug_video.'</td>

			      		<td>
			      		<img src="'.url('public/uploads/videos/'.$vid->video_image).'" class="img-thumbnail" width="250" height="150">
                        <div class="form-wrapper">
                         <div class="upload-btn-wrapper">
                         <input type="file" class="file_img_video" data-video_id="'.$vid->video_id.'" id="file-video-'.$vid->video_id.'" name="file" accept="image/*" />
                         <span id="error_gallery"></span>
						 '. $admin -> hasrole(['admin','author']){ '
                             <button style="width: 100px;" class="btn_upload">Tải File Lên</button>
						 '}.'
                         </div>
			      		</div>
			      		</td>


			           <td contenteditable data-video_id="'.$vid->video_id.'" data-video_type="video_desc" class="video_edit" id="video_desc_'.$vid->video_id.'">'.$vid->video_desc.'</td>
                       <td contenteditable data-video_id="'.$vid->video_id.'" data-video_type="video_link" class="video_edit" id="video_link_'.$vid->video_id.'">https://youtu.be/'.$vid->video_link.'
			           </td>
			           <td><iframe width="200" height="200" src="https://www.youtube.com/embed/'.$vid->video_link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
						'. $admin -> hasrole(['admin','author']){ '
						<td><button type="button" data-video_id="'.$vid->video_id.'"  class="btn btn-sm btn-danger btn-delete-video">Xóa video</button></td>
						' }. '
						</tr>




    			';
    		}
    	}else{
    		$output.='
    				 <tr>
                                        <td colspan="4">Chưa có video nào hết</td>

                                      </tr>


    			';

    	}
    	$output.='
    				 </tbody>
    				 </table>
					 </div>
    				 </form>


    			';
    	echo $output;
    }
    public function video_shop(Request $request){
    	 //category post
        $category_post = Category_Post::orderBy('category_post_id','DESC')->get();

        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        //seo
        $meta_desc = "Video Review K-Shopper";
        $meta_keywords = "Giay Thời trang Nam, Nữ";
        $meta_title = "Videos K-Shopper";
        $url_canonical = $request->url();
		$image_og =' ';
        //--seo

    	$cate_product = Category_product::where('category_status','0')->orderby('category_id','desc')->get();



        $all_video = Videos::orderby('video_id','DESC')->paginate(6);

    	return view('pages.videos.video')->with('category',$cate_product)->with('all_video',$all_video)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post); //1


    }
    public function watch_video(Request $request){
    	$video_id = $request->video_id;
    	$video = Videos::find($video_id);
    	$output['video_title'] = $video->video_name;
    	$output['video_desc'] = $video->video_desc;

    	$output['video_link'] = '<video id="my_yt_video"
					       class="vlite-js"
					       data-youtube-id="'.$video->video_link.'">
					</video>';


    	echo json_encode($output); //giải mã dữ liệu sang json

    }

}
