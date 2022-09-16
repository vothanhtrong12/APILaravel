<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {
        $username= $_POST['username'];
        $email= $_POST['email'];
        // ==========================================================================================
        if(preg_match('/Select|select|SELECT/', $username)||preg_match('/Update|update|UPDATE/', $username)||preg_match('/DELETE|Delete|delete/', $username)){
            return response()->json(['check'=>401,'message'=>'Rejected']);
        }else if(preg_match('/Select|select|SELECT/', $email)||preg_match('/Update|update|UPDATE/', $email)||preg_match('/DELETE|Delete|delete/', $email)){
            return response()->json(['check'=>401,'message'=>'Rejected']);
        }else if(!preg_match('/(.+)@(.+)\.(com)/i',$email)){
            return response()->json(['check'=>401,'message'=>'Email không hợp lệ']);
        }else{
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $password = substr(str_shuffle($permitted_chars), 0, 5);
            $password1= Hash::make($password);
            $check = DB::Table('users')->where('email',$email)->orWhere('username',$username)->count();
            if($check!=0){
                return response()->json(['check'=>403,'message'=>'exist']);
            }else{
                DB::Table('users')->insert(['username'=>$username,'password'=>$password1,'email'=>$email,'created_at'=>now()]);
                $details = [
                    'title' => 'Email thông báo tài khoản',
                    'username'=> $username,
                    'password'=> $password,
                    'time'=>'Tài khoản được tạo vào lúc: '.date('d/m/yy',time()),
                    'thongbao'=>'Vui lòng đăng nhập và thay đổi mật khẩu . '
                ];
                Mail::to($email)->send(new \App\Mail\emailthongbao($details));
                return response()->json(['check'=>200]);
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allUser()
    {
        $result =User::all();
        $arr=[];
        foreach ($result as  $value) {
            $arr1=['idUser'=>$value['id'],'username'=>$value['username'],'fullName'=>$value['fullName'],'email'=>$value['email'],'created_at'=>$value['created_at'],'email_verified_at'=>$value['email_verified_at'],'ggId'=>$value['ggId'],'status'=>$value['status'],'image'=>$value['image']];
            array_push($arr,$arr1);
            $arr1=[];
        }
        return response()->json($arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
