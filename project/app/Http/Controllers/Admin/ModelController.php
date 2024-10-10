<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelNumber;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class ModelController extends AdminBaseController
{
    public function datatables(){
        $datas = ModelNumber::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action',function(ModelNumber $data){
                                $default = $data->is_default == 1 ? '<a><i class="fa fa-check"></i> Default</a>' : '<a class="status" data-href="'.route('admin.model.status',$data->id).'">Set Default</a>';
                                return '<div class="action-list"><a data-href="' . route('admin.model.edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__("Edit").'</a><a href="javascript:;" data-href="' . route('admin.model.delete',['id' => $data->id]) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>'.$default.'</div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.model_number.index');
    }

    public function create(){
        return view('admin.model_number.create');
    }

    public function store(Request $request){
        //--- Validation Section
        $rules = [
            'model_number' => 'required',
                ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = new ModelNumber();
        $input = $request->all();
        $input['is_default'] = 0;
        $data->fill($input)->save();

        //--- Redirect Section     
        $msg = __('Data Added Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends  
    }

    public function update(Request $request,$id){
        //--- Validation Section
        $rules = [
            'model_number' => 'required',
                ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = ModelNumber::find($id);
        $input = $request->all();
        $input['is_default'] = 0;
        $data->update($input);

        //--- Redirect Section     
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends  
    }

    public function edit($id){
        $data = ModelNumber::findOrFail($id);
        return view('admin.model_number.edit',compact('data'));
    }

    public function status($id){
        $font_update =  ModelNumber::find($id);
        $font_update->is_default = 1;
        $font_update->update();

        $previous_fonts = ModelNumber::where('id','!=',$id)->get();

        foreach($previous_fonts as $previous_font){
            $previous_font->is_default = 0;
            $previous_font->update();
        }
        cache()->forget('default_font');
        //--- Redirect Section     
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends  
   }

   //*** GET Request Delete
   public function destroy($id)
   {

       if($id == 1)
       {
       return response()->json(__("You don't have access to remove this font."));
       }
       $data = ModelNumber::findOrFail($id);
       if($data->is_default == 1)
       {
       return response()->json(__("You can not remove default font."));            
       }
       $data->delete();
       //--- Redirect Section     
       $msg = __('Data Deleted Successfully.');
       return response()->json($msg);      
       //--- Redirect Section Ends     
   }
}
