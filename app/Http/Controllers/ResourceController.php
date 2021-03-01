<?php

namespace App\Http\Controllers;
use App\Models\Resource;
use Illuminate\Http\Request;
use Toastr;

class ResourceController extends Controller
{
    public function store(Request $request){
        if($request->profile != null){
            $photoName = time().'.'.$request->profile->extension();  
            $request->profile->move('uploads', $photoName);
            $input['photo'] = "uploads/".$photoName;
        }
        $input['user_id'] = $request->user_id;
        $input['phone'] = $request->phone;
        $input['address'] = $request->address;
        Resource::create($input);
        return redirect()->back()->with('message','Resource Submitted Successfully');;
    }

    public function generatePdf($id){
     $items = Resource::findOrFail($id);
        return $items;
        view()->share('resource',$items);
        $pdf = PDF::loadView('pdfview');
        return $pdf->download('pdfview.pdf');
    }


    function pdf($resourceId)
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html($resourceId));
     return $pdf->stream();
    }

    function convert_customer_data_to_html($resourceId)
    {

     $resource = Resource::where('id',$resourceId)->first();
        $image = asset($resource->photo);
     $output = '
     <h3 align="center">Resource</h3>
     <img src="'.$image.'" width="30%">
     <br>
     <br>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Email</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Phone</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Address</th>
   </tr>
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$resource->user->name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$resource->user->email.'</td>
       <td style="border: 1px solid; padding:12px;">'.$resource->phone.'</td>
       <td style="border: 1px solid; padding:12px;">'.$resource->address.'</td>
      </tr>
   </table>';

     return $output;
    }
}
