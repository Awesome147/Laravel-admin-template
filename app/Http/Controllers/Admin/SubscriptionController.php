<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use ChargeBee_Environment;
use ChargeBee_Subscription;
use ChargeBee_Plan;
use Str;
use ApiHelper;
use Config;
class SubscriptionController extends Controller
{
    public $url;
    public $title;
    public $imageUploadPath;
    public $imageShowPath;
    public function __construct(){
         $this->url =  'admin.subscriptions';
         $this->title = 'Subscriptions';
         $this->folder = 'admin.subscriptions';
       //  $this->imageShowPath =  Config::get('custom_config.image_show_path');
       //  $this->imageUploadPath = Config::get('custom_config.image_upload_path');
         ChargeBee_Environment::configure(Config::get('chargebee.chargebee_site'),Config::get('chargebee.chargebee_key'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $status = Session::get('status');
       /// $id = Session::get('id');
      ///  if($status == 1){
          ///  $data = Subscription::orderBy('id','DESC')->get();
       // }///else{
            $data = Subscription::orderBy('id','DESC')->paginate(10);
      ///  }
       
        return view($this->folder.'.index',['data' =>$data,'title'=>$this->title,'url'=>$this->url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->folder.'.create',['title'=>$this->title,'url'=>$this->url]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|unique:subscriptions',
            'type' => 'required',
            'description' => 'required',
            'number' => 'required|numeric',
            'price' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048*10',
        ]); 
       // $admin_id = Session::get('id');
        $data = new Subscription;
      //  $data->user_id = $admin_id;
        $data->title = $request->post('title');
        $data->type = $request->post('type');
        $data->price = $request->post('price');
        $data->description = $request->post('description');
        $data->number = $request->post('number');
        $data->planId = str_replace(' ','-',$request->post('title'));
        

        try {
            $result = ChargeBee_Plan::create(array(
                "id" => str_replace(' ','-',$request->post('title')),
                "name" => $request->post('title'),
                "invoiceName" => $request->post('title'),
                "price" => $request->post('price')*100,
                'period'=>$request->post('number'),
                'periodUnit'=>$request->post('type'),
                'description'=>$request->post('description'),
            ));
            $plan = $result->plan();
            $data->save();
        } catch (\Throwable $th) {
            return redirect()->route($this->url.'.index')->withFlashWarning($th->getMessage());
        }
       
        return redirect()->route($this->url.'.index')->withFlashSuccess('Record Added Successfully!');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  Subscription::find($id);
        if(!empty($data)){
            return view($this->folder.'.edit',['data'=>$data,'title'=>$this->title,'url'=>$this->url]);
        }else{
            $notification = ['message' => 'Invalid Id!', 'alert-type' => 'error']; 
            return redirect()->route($this->url.'.index')->with($notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        request()->validate([
            'title' => 'required|unique:subscriptions,title,'.$id,
            'type' => 'required',
            'description' => 'required',
            'price' => 'required',
            'number' => 'required|numeric',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048*10',
        ]); 

        $data =  Subscription::find($id);
        $data->title = $request->post('title');
        $data->type = $request->post('type');
        $data->price = $request->post('price');
        $data->description = $request->post('description');
        $data->number = $request->post('number');
        $data->save();
          
        try {
           if(!empty( $data->planId)){
            $result = ChargeBee_Plan::update($data->planId,array(
                 "name" => $request->post('title'),
                "invoiceName" => $request->post('title'),
                "price" => $request->post('price')*100,
                'period'=>$request->post('number'),
                'periodUnit'=>$request->post('type'),
                'description'=>$request->post('description'),
            ));
            $plan = $result->plan();
         }
        } catch (\Throwable $th) {
             return redirect()->route($this->url.'.index')->withFlashWarning($th->getMessage());
        }
        
            
        return redirect()->route($this->url.'.index')->withFlashSuccess('Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Subscription::find($id);
        try {
           if(!empty( $data->planId)){  
                $result = ChargeBee_Plan::delete($data->planId);
                $plan = $result->plan();
           }
             $data->delete();
        } catch (\Throwable $th) {
            return redirect()->route($this->url.'.index')->withFlashWarning($th->getMessage());
        }
      
               
       return redirect()->route($this->url.'.index')->withFlashSuccess('Record Deleted Successfully!');
    }
}
