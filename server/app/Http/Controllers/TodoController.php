<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Traits\ManagesResponse;
use App\Traits\UploadAble;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    // Load Traits
    use ManagesResponse, UploadAble;

    // Get all Todos
    public function index(){
        try{
            $todos = Todo::OrderBy('created_at', 'DESC')->paginate(24);
            
            return $this->sendResponse($todos, 'Todos retrived successfully!');
        }
            catch (\Exception $exception) {
                return $this->sendError('Server error', $exception, 500);
            }
     
    }
// Get a single Todo
    public function show($id){
        try{
            $todos = Todo::where('id', $id)->first();
            
            return $this->sendResponse($todos, 'Todos retrived successfully!');
        }
            catch (\Exception $exception) {
                return $this->sendError('Server error', $exception, 500);
            }
    }

    // Store Todo
    public function store(Request $request){

        // Validate input data
        $validator = Validator::make($request->all(), [
            
            'title' => 'bail|required|string',
            // 'image' => 'sometimes|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors(), 422);
        }
        // Store data in DB
        try{
            $image = '';
            if($request->hasFile('image')) {
               
                $extensions = ["jpg" , "jpeg" , "png" ];
                $isImage = request("image")->getClientOriginalExtension(); 


if(in_array($isImage , $extensions)){
    $image = $this->uploadOne($request->image, 'images');
   
}else{
    return $this->sendError('Server error', 'invalid Image format', 500);
}
            }
            $todos = Todo::create([
                'title' => $request->title,
                'img_url' => $image,
            ]);
            
            return $this->sendResponseCreated($todos, 'Todos created successfully!');
        }
            catch (\Exception $exception) {
                return $this->sendError('Server error', $exception, 500);
            }

    }

    // Update Todos
    public function update(Request $request, $id){


        // Validate input data
        $validator = Validator::make($request->all(), [
            
            'title' => 'bail|required|string',
            // 'image' => 'sometimes|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors(), 422);
        }
        // Store data in DB
        try{
            $todos = Todo::where('id', $id)->first();
            // $image = '';
            if ($request->hasFile('image')) {
               
                $extensions = ["jpg" , "jpeg" , "png" ];
                $isImage = request("image")->getClientOriginalExtension(); 


if(in_array($isImage , $extensions)){
    $this->deleteOne($todos->img_url);
    $image = $this->uploadOne($request->image, 'images');

   
}else{
    return $this->sendError('Server error', 'invalid Image format', 500);
                }

                $todos->update([
                    'title' => $request->title,
                    'img_url' => $image,
                ]);
            } else {
                $todos->update([
                    'title' => $request->title,
                    // 'img_url' => $image,
                ]);
            }
            
           
            
            return $this->sendResponse($todos, 'Todos Updated successfully!');
        }
            catch (\Exception $exception) {
                return $this->sendError('Server error', $exception, 500);
            }

    }
// Update Todos Image
public function update_img(){

}
    public function toggle_status($id)
    {
        try {
            $data = Todo::find($id);
            if ($data->status == 1) {
                $data->update([
                    'status' => 0,

                ]);
                return $this->sendResponse(null, 'Status Updated successfully!');
            } else {
                $data->update([
                    'status' => 1,

                ]);
                return $this->sendResponse(null, 'Status Updated successfully!');
            }
        } catch (\Exception $exception) {
            return $this->sendError('Server error', $exception, 500);
        }
    }

// Delete Todos
    public function destroy($id)
    {

        $data = Todo::find($id);

        // return $data;
        if ($data) {

            $this->deleteOne($data->img_url);
            $data->delete();
            // return $this->sendResponse(null, 'Todos Deleted successfully!');
            return response('',Response::HTTP_NO_CONTENT);

       

        }
    }



}