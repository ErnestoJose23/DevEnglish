<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Media;
use Str;
use Intervention\Image\ImageManagerStatic as Image;


class UploadMediaService {

    public function updateImg(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('avatar');
        $extension = $file->getClientOriginalExtension();
        if($request->old_avatar == NULL){
            $filename = time() . '.' . $extension;
        }else{
            $filename = $request->old_avatar;
        }
        $img = Image::make($file->path());  
        $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/media/' .$filename));
        return $filename;
    }

    public function uploadImageMessage(Request $request){

        $request->validate([
            'filename' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('filename');
        $extension = $file->getClientOriginalExtension();
        if($request->old_avatar == NULL){
            $filename = time() . '.' . $extension;
        }else{
            $filename = $request->old_avatar;
        }
        $file->move('uploads/media/', $filename);
        return $filename;
    }

    public function updateAudio(Request $request){
        if($request->audio != NULL){
            $media = Media::where('token', $request->token)->first();
            if($media == NULL) $media = new Media();
            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension();
            if($request->old_audio == NULL){
                $filename = time() . '.' . $extension;
            }else{
                $filename = $request->old_audio;
            }
            $file->move('uploads/media/', $filename);
            $media->archive = $filename;
            $media->extention =  $file->getClientOriginalExtension();
            $media->token = $request->token; 
        }
        $media->save();
    }

    public function uploadImages(Request $request){
        if($request->hasfile('filename')){
            foreach($request->file('filename') as $image){
                $media = new Media();
                $media->token = $request->token;
                $extension = $image->getClientOriginalExtension();
                $name= Str::random(5) . '.' . $extension;
                $image->move('uploads/media/', $name);
                $media->extention =  $extension;
                $media->archive = $name;
                $media->save();
            }
        }
    }
    
}