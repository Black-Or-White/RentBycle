<?php
/**
 **作者：陆海亚
 **时间：2016－11－10
 **功能：用户类
 **
 **/
require_once './dataBase/dataBaseOperate.php';
require_once 'commonFunc.php';
class User{
	private $attr;
	public function __construct($attr){
		$this->attr = array(
				'wxid'=>$attr['wxid'],
				'tel'=>'',
				'type'=>1,
				'token'=>getRandChar(12),
		);
		$db = new dBoperate('userinfo');
		$userid = $db->insertData($this->attr);
		if($userid){
			$this->attr['userid'] = $userid;
		}else{
			return errorInfo(40005);
		}
	}
	public function upgrade($attr){
		$db = new dBoperate('userinfo');
		if(!empty($attr['picurl'])&&!empty($attr['userid'])){
			$db->updateData(array('type'=>2),array('userid'=>$attr['userid']));
		}
	}
	public function checkAndQueryUserInfo($attr){
		if(!empty($attr['userid'])&&!empty($attr['token'])){
			$sql = "select * from userinfo where userid='".$attr['userid']."' and token='".$attr['token']."'";
			$db = new dBoperate('userinfo');
			$res = $de->query($sql);
			if(!empty($res)){
				return json_encode($res);
			}else{
				return false;
			}
		}
	}
}