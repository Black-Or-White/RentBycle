<?php
	define("servename", "localhost");
	define("username", "root");
	define("password", "");
	define("dbname", "sharebike");
	class user
	{
		private $userid;
		private $wxid;
		private $tel;
		private $type;
		private $link;
		
		function __construct()
		{
			//$this->userid=$userid;
			//$this->wxid=$wxid;
			//$this->tel=$tel;
			//$this->type=$type;
			$num=func_num_args();
			$arr=func_get_args();
			//echo $num;
			if($num==0){
				global $link;//������������ͬʱ��ֵ
				$link=new mysqli(servename,username,password,dbname);
			}elseif ($num==1){
				global $userid;
				$userid=$arr[0];
				global $link;
				$link=new mysqli(servename,username,password,dbname);
			}else{
				echo "�û���ʼ��ʧ��";
			}
			//echo $userid;
		}
		function register($userid,$wxid,$tel,$type)
		{
			//$link=new mysqli(servename,username,password,dbname);
			global $link;
			if($link->connect_error)
			{
				die("����ʧ��: " . $link->connect_error);
			}
			$sql="INSERT INTO userinfo(id,wxid,tel,type)
			VALUES('$userid','$wxid','$tel','$type')";
			if ($link->query($sql)) {
				echo "���û���Ϣ����ɹ�";
			} else {
				echo "Error: " . $sql . "<br>" . $link->error;
			}
		}
		function updateinfo($wxid)
		{
			global $link;
			global $userid;
			if($link->connect_error)
			{
				die("����ʧ��: " . $link->connect_error);
			}
			$sql="UPDATE userinfo SET wxid='$wxid' WHERE id=$userid";
			echo $sql;
			if($link->query($sql)){
				echo "�û�".$userid."����Ϣ�޸ĳɹ�";
			}else{
				echo "Error: " . $sql . "<br>" . $link->error;
			}
			/*$num=func_num_args();
			$arr=func_get_args();
			if($num==2)//ֻ��Ҫ�޸�һ������ֵ����������������ֵ�͸�ֵ����������
			{
				switch ($arr[1])
				{
					case 100:
						$sql="UPDATE userinfo
						SET wxid=$arr[0]
						WHERE id=$userid";
						break;
					case 010:
						$sql="UPDATE userinfo
						SET tel=$arr[0]
						WHERE id=$userid";
						break;
					case 001:
						$sql="UPDATE userinfo
						SET type=$arr[0]
						WHERE id=$userid";
						break;
					default:	
				}
				if($sql!=null)
				{
				if($link->query($sql)){
						echo "�û�".$userid."����Ϣ�޸ĳɹ�";
					}else{
						echo "Error: " . $sql . "<br>" . $link->error;
					}
				}
			}*/
		}
		function deleteinfo($userid_login)
		{
			global $link;
			global $userid;
			if($link->connect_error)
			{
				die("����ʧ��: " . $link->connect_error);
			}
			if($userid==$userid_login)
			{
				$sql="DELETE FROM userinfo WHERE id=$userid";
					
				if($link->query($sql)){
					echo "�û�".$userid."����Ϣɾ���ɹ�";
				}else{
					echo "Error: " . $sql . "<br>" . $link->error;
				}
			}else {
				echo "��û��Ȩ���޸��û�".$userid_login."����Ϣ";
			}
			
		}
	}
?>