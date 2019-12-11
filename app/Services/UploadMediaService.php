<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Media;
use Str;


class UploadMediaService {

    public function updateImg(Request $request){

        $request->validate([
            'media' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('media');
        $extension = $file->getClientOriginalExtension();
        $media = Media::where('id', $request->media_id)->first();
        if($media == NULL){
            $media = new Media();
            $filename = time() . '.' . $extension;
            $media->token = Str::random(10);
        }else{
            $filename = $media->archive;
        }
        
        $file->move('uploads/media/', $filename);
        $media->extention =  $file->getClientOriginalExtension();
        $media->archive = $filename;
        $media->save();
        
        return $media->id;
    }

    public function updateAudio(Request $request){
        if($request->audio != NULL){
            $media = Media::where('token', $request->token)->first();
            if($media == NULL) $media = new Media();
            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension();
            $filename= time() . '.' . $extension;
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