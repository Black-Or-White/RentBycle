<?php
	include 'dataBaseConfig.php';
	class dataBaseOperate
	{
		private $link;
		function dataBaseOperate()
		{
			global $link;
			$link = new mysqli(servename,username,password,dbname);
			if($link->connect_error)
			{
				die("���ݿ�����ʧ��".$link->connect_error);
			}else {
				echo "���ݿ����ӳɹ�";
			}
		}
		
		function insertData($info,$tableName)
		{
			global $link;
			$column=null;
			$value =null;
			foreach($info as $x=>$x_value)//ƴ������
			{
// 				$x="'".$x."'";
				$column=$column.$x.",";
				$x_value="'".$x_value."'";
				$value=$value.$x_value.",";
			}
			$column=substr($column, 0,strlen($column)-1);//ȥ�����Ķ���
			$value=substr($value,0,strlen($value)-1);
			$sql = "INSERT INTO $tableName($column) VALUES($value)";
			echo $sql;

			if($link->query($sql))
			{
				echo "����Ϣ����ɹ�";
			}else
			{
				echo "Error: " . $sql . "<br>" . $link->error;
			}
		}
		function updateData($info,$KEY,$tableName)
		{
			global $link;
			$valueChange=null;
			foreach($info as $x=>$x_value)//ƴ������
			{
				$x_value="'".$x_value."'";
				$valueChange=$x."=".$x_value.",";
			}
			$valueChange=substr($valueChange,0,strlen($valueChange)-1);
			$majorKey=null;
			foreach($KEY as $y=>$y_value)
			{
				$y_value="'".$y_value."'";
				$majorKey=$y."=".$y_value.",";
			}
			$majorKey=substr($majorKey,0,strlen($majorKey)-1);
			$sql= "UPDATE $tableName SET $valueChange WHERE $majorKey";
			if($link->query($sql))
			{
				echo "����Ϣ�޸ĳɹ�";
			}else
			{
				echo "Error: " . $sql . "<br>" . $link->error;
			}
		}
	}
?>