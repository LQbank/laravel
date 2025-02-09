<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Address;
use DB;

class addressController extends Controller
{
    
    //存储ajax返回的信息
    // private $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $address = Address::where('user_id', session('home_user')->id)->get();
      
        return view('home/address/index',['address'=>$address]); 
        // return view('home/address/index'); 
    }

 
    /**
     *  地址添加
     */
    public function add(Request $request)
    {

        // dd($request->all());
        //获取登录用户的uid
        $uid = session('home_user')->id;
        //获取登录用户的uid
        $address = new Address;
        $address->user_id = $uid;
        $address->uname = $request->input('uname');
        $address->phone = $request->input('phone');
        //省
        $address->province = $request->input('province');
        //市
        $address->city = $request->input('city');
        //县
        $address->district = $request->input('country');
        //详细地址
        $address->address = $request->input('address');
        //邮政编码
        $address->postcode = $request->input('zipcode');
      
       

        if($address->save()){
            $this->data['status'] = 0;
            $this->data['msg'] = $address->id;
            echo json_encode($this->data);
            die;
        }else{
            $this->data['status'] = 1;
            $this->data['msg'] = '服务器出错,请稍后重试';
            echo json_encode($this->data);
            die;
        }
    }
    /**
     *  地址删除
     */
    public function del(Request $request)
    {
        $ad_id = $request->input('id');

        $address = Address::find($ad_id);

        if($address->delete()){
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            echo json_encode($this->data);
        }else{
            $this->data['status'] = 1;
            $this->data['msg'] = '请刷新网页';
            echo json_encode($this->data);
            die;
        }
    }
    
    /**
     *  ajax地址设为默认
     *  先将全部设为0，之后将选中设为1
     */
    public function   changeStatus(Request $request)
    {
        

        // $address->phone = $request->input('phone','');

        $address = DB::update("update addresses set status='0' where user_id = ".session('home_user')->id);


        // 查询当前用户的所选地址
        $address = Address::find($request->input('id'));
        // dump($address);

        $address->status ='1';

        if($address->save())
        {
            echo '1';
        }

     


    }
 
}
