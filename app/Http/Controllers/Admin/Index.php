<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\AdminCommon;
use Illuminate\Support\Facades\Validator;

class Index extends AdminCommon
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 后台首页
     */
    public function index ()
    {
        //print_r(session('admin'));
        return view('admin.index.index')->with('title','后台管理');
    }
    public function welcome()
    {
        return view('admin.index.welcome');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View 登陆页
     */
    public function login ()
    {
        return view('admin.index.login')->with('title','后台登陆');
    }

    /**
     * 处理登陆页
     * @param Request $request
     * @return array
     */
    public function dologin (Request $request)
    {
        $status = 0;//设置初始登陆状态
        $data   = $request->only(['username', 'password']);//获取数据
        //验证规则
        $rule     = ['username' => 'required', 'password' => 'required'];
        $msg      = ['username.required' => '请输入用户名', 'password.required' => '请输入密码'];
        $validate = Validator::make($data, $rule, $msg);//验证
        if (!$validate->fails()) {//如果验证通过
            $admin = new Admin();
            $res   = $admin->getOne($data['username']);
            if (!empty($res)) {
                if ($res['status'] !== 0) {//管理员状态非0，允许通过
                    $password = $this->_md5($data['password']);
                    if ($res['password'] == $password) {//密码校验
                        $status  = 1;
                        $message = '登陆成功!!';
                        $request->session()->put('adminName',$res);
                    } else {
                        $message = '密码错误!';
                    }
                } else {
                    $message = '该用户已被冻结';
                }
            } else {
                $message = "用户名不存在";
            }
        } else {
            $message = $validate->errors();//验证错误信息
        }
        return ['status' => $status, 'message' => $message];
    }

    /**
     * 注销
     * @param Request $request
     */
    public function logout(Request $request)
    {
       return  $request->session()->forget('adminName');
    }

    /**
     * 改良版md5加密算法
     * @param $string
     * @param string $str
     * @return string
     */
    protected function _md5 ($string, $str = 'mall'): string
    {
        return md5($string . $str);
    }
}
