<?php
/**
 * API--login/register
 */
namespace API\Controller;
// use API\Controller;

// 指定允许其他域名访问  
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:POST');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 

class APIController{
	/* 账号注册 */
	public function register()
	{
		$m_home_user = M("home_user");
		$m_tel_code = M("tel_code");
		if (IS_POST) {
			$code = I('param.code');
			$map['tel | username'] = $tel = I('param.tel');
			$user_name = $m_home_user->where($map)->find();

			$code_map['name'] = $tel;
			$code_map['code'] = $code;
			$code_map['status'] = 2;   // 2 已发送  1 已验证
			$code_data = $m_tel_code->where($code_map)->find();

			if ($code_data) {
				$saves['status'] = 1;
				$m_tel_code->where($code_map)->save($saves);
				if (!$user_name) {
					$data['tel'] = $tel;
					$data['username'] = $tel;
					$data['password'] = md5(I('param.password'));
					$data['create_ip'] = get_client_ip();
					$data['status'] = 1;
					$data['create_time'] = time();
					
					$result = $m_home_user->add($data);
					
					if ($result) {
						$info = "注册成功";
						$error_code = 1;
					} else {
						$info = "注册失败";
						$error_code = 2;
					}
				} else {
					$info = "手机号已被注册";
					$error_code = 2;
				}
			} else {
				$info = "验证码错误";
				$error_code = 2;
			}
		} else {
			$info = "请求错误";
			$error_code = 3;
		}

		$echo['code'] = $error_code;
		$echo['msg'] = $info;
		$echo['data']['uid'] = $result;
		echo json_encode($echo);
	}


	/* 注册验证码 */
	public function phone_validation()
	{
		$m_home_user = M("home_user");
		$m_tel_code = M("tel_code");
		if (IS_POST) {
			$tel = I("param.tel");
			$map['tel'] = $tel;
			$map['status'] = 1;
			$user_data = $m_home_user->where($map)->find();
			
			if (!$user_data) {
				$code = mt_rand(1000,9999);
				//在这里发送手机验证码
				
				$add_code['name'] = $tel;
				$add_code['code'] = $code;
				$add_code['time'] = time();
				$add_code['status'] = 2;
				$add_result = $m_tel_code->add($add_code);
				
				if ($add_result) {
					$error_code = 1;
					$info = '发送成功';    
				} else {
					$error_code = 3;
					$info = '发送失败';    
				}
			} else {
				$error_code = 2;     //用户已注册
				$info = '用户已注册';    
			}
			
			
		} else {
			$info = "请求错误";
			$error_code = 3;
		}
		$echo['msg'] = $info;
		$echo['code'] = $error_code;
		$echo['data'] = '';
		echo json_encode($echo);
	}
	
	/* 登陆 */
	public function login()
	{
		$m_home_user = M("home_user");
		if (IS_POST) {
			$password = I('param.password');
			$map["tel"] = I('param.tel');
			$map['password'] = md5($password);
			$result = $m_home_user->where($map)->find();

			if ($result) {
				if ($result['id'] > 0) {
					if ($result['status'] == 1) {
						$echo['data'] = $result;
						$info = "登录成功";
						$error_code = 1;
					} else {
						$info = "用户被封";   
						$error_code = 2;
					}
				} else {
					$info = "用户名或密码不对";     
					$error_code = 2;
				}
			} else {
				$info = "用户不存在";   
				$error_code = 2;
			}
		} else {
			$info = "请求失败";       
			$error_code = 3;
		}

		$echo['msg'] = $info;
		$echo['code'] = $error_code;
		echo json_encode($echo);
	}

}
