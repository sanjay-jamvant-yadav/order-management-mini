<?php
	include_once "sqlutil.php";
	include_once "product.php";
	class Admin
	{
		private $email;
		private $password;
		function __construct($email,$password)
		{
			$this->email=$email;
			$this->password=$password;
		}

		function viewProduct()
		{
			$productList=Product::getProductList();
			return $productList;
		}

		function setSession()
		{
			$_SESSION['email']=$this->email;
			$_SESSION['password']=$this->password;
		}
		function validateAdmin()
		{
			$con=SqlUtil::connectdb();
			$sql="select email,password from admin where email='".$this->email."' and password='".$this->password."'";
			$result=$con->query($sql);
			if($result->num_rows == 1)
				return true;
			else
				return false;
		}
		function getAdminEmail()
		{
			return $this->email;
		}
		function getAdminPassword()
		{
			return $this->password;
		}
		function checkSession()
		{
			$con=SqlUtil::connectdb();
			$sql="select email,password from admin where email='".$this->email."' and password='".$this->password."'";
			$result=$con->query($sql);
			if($result->num_rows == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		function logout()
		{
			session_destroy();
			header("location:admin_login.php");
		}
		function addProduct($pname_list,$pprice_list,$item_count)
		{
			
			for($item=0;$item<=$item_count;$item++)
			{
				$product=new Product($pname_list[$item],$pprice_list[$item]);
				$product->insertProduct();
			}
		}
		function getOrderList()
		{
			$con=SqlUtil::connectdb();
			$sql="select * from orderlist";
			$result=$con->query($sql);
			return $result;
		}
		function deleteProduct($productid)
		{
			$con=SqlUtil::connectdb();
			$sql="delete from product where p_id='".$productid."'";
			$con->query($sql);
		}
	}
	
?>