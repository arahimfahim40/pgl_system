<?php

namespace App\Http\Controllers;

use App\MessageModel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageControllerCustomer extends Controller
{
    protected $message;
    public function __construct(MessageModel $message)
    {
         $this->middleware('auth');
         $this->message=$message;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_message(Request $request)
    {
        $send_messages=DB::table('notifications')
        ->select('notifications.*','users.username')
        ->join('users','users.id','=','notifications.admin_id')
        ->where(['customer_id'=>Auth::id(),'type'=>0])
        ->orderBy('id','desc')
        ->paginate(300);

        $receive_messages=DB::table('notifications')
        ->select('notifications.*','users.username')
        ->join('users','users.id','=','notifications.admin_id')
        ->where(['customer_id'=>Auth::id(),'type'=>1])
        ->orderBy('id','desc')
        ->paginate(300);

        $users=DB::table('users')->select('id','username')->where('user_type_id',1)->get();

        return view('customer.message.message')->with(['send_messages'=>$send_messages,'receive_messages'=>$receive_messages,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function compose_message(Request $request)
    {
            $data = array(
                'subject' =>$request['subject'],
                'content' =>$request['content'],
                'customer_id'=>Auth::id(),
                'admin_id'=>$request['receiver'],
                'type'=>0
                 );
            if(DB::table('notifications')->insert($data)){
                echo json_encode(true);
            }
            else {
                echo json_encode(false);
            }            
             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function message_detail($id='')
    {
       $send_messages=DB::table('notifications')
        ->select('notifications.*','users.username')
        ->join('users','users.id','=','notifications.admin_id')
        ->where(['customer_id'=>Auth::id(),'type'=>0])
        ->orderBy('id','desc')
        ->paginate(300);

        $receive_messages=DB::table('notifications')
        ->select('notifications.*','users.username')
        ->join('users','users.id','=','notifications.admin_id')
        ->where(['customer_id'=>Auth::id(),'type'=>1])
        ->where('notifications.id',$id)
        ->orderBy('id','desc')
        ->paginate(300);

        DB::table('notifications')->where(['id'=>$id,'customer_id'=>Auth::id()])->update(['status'=>1]);

        $users=DB::table('users')->select('id','username')->where('user_type_id',1)->get();

        return view('customer.message.message')->with(['send_messages'=>$send_messages,'receive_messages'=>$receive_messages,'users'=>$users]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MessageModel  $messageModel
     * @return \Illuminate\Http\Response
     */
    public function show(MessageModel $messageModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MessageModel  $messageModel
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageModel $messageModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MessageModel  $messageModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageModel $messageModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MessageModel  $messageModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageModel $messageModel)
    {
        //
    }
}
