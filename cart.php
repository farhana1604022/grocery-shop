<?php

session_start();
$database_name="ripa1";
$con=mysqli_connect("localhost","root","",$database_name);

if(isset($_POST["add"])){
	if(isset($_SESSION["cart"])){
		$item_array_id=array_column($_SESSION["cart"],"product_id");
		if(!in_array($_GET["id"],$item_array_id)){
			$count= count($_SESSION["cart"]);
			$item_array=array(
				'product_id'=> $_GET["id"],
				'item_name'=> $_GET["hidden_name"],
				'product_price'=> $_GET["hidden_price"],
				'item_quantity'=> $_GET["quantity"]
				
		
			);
			$_SESSION["cart"][$count]=$item_array;
			echo '<script >window.location="cart.php"</script>';
		}	else{
				echo'<script">alert("product is already Added o Cart")</script>';
				echo '<script >window.location="cart.php"</script>';
		}	
	}else{
		$item_array=array(
				'product_id'=> $_GET["id"],
				'item_name'=> $_GET["hidden_name"],
				'product_price'=> $_GET["hidden_price"],
				'item_quantity'=> $_GET["quantity"]
				
		
		);
		$_SESSION["cart"][0]=$item_array;
	
		}	
	}
	if(isset($_GET["action"])){
			
			if($_GET["action"]=="delete"){
				foreach($_SESSION["cart"] as $keys=>$value{
					if($value["product_id"]==$_GET["id"]){
						
					unset($_SESSION["cart"][$keys]);
					echo '<script>alert("Product has been removed !")</script>';
					echo '<script>window.location="cart.php</script>';
					}
				}
			}
		}

?>






<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Shopping cart</title>
	
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
	
	<style>
	@import url('https://fonts.googleapis.com/css?family=Titillium+Web&display=swap');
	
	.product{
		border: 1px solid #eaeaec;
		margin: -1px 19px 3px -1px;
		padding: 10px;
		text-align:center;
		background-color: #efefef;
		
	}
	table,th,tr{
		text-align: center;
	}
	.title2{
		text-align: center;
		color: #66afe9;
		background-color: #efefef;
		padding: 2%;
	}
	
	h2{
		
		text-align: center;
		color: #66afe9;
		background-color: #efefef;
		padding: 2%;
	}
	table th{
		background-color: #efefef;
	}
	</style>
	
</head>

</head>
<body>
	
	<div class="container" style="width: 65%"> 
	<h2> Our Products </h2>
	
	<?php
		$query= "SELECT*FROM product ORDER BY id ASC";
		$result= mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_array($result)) {
		
		
	?>
				 <div class="col-md-3"> 

				<form method="post" action="cart.php?action=add&id=<?php echo $row["id"] ?>">
				 <div class="product">   
				 <img src="<?php echo $row["image"];?>"  class="img-responsive">
				 <h5 class="text-info"><?php echo $row["pname"];?></h5>
				 <h5 class="text-danger"> Tk<?php echo $row["price"];?></h5>
				 <input type="text" name="quantity" class="form-control" value="1">
				 <input type="hidden" name="hidden_name" value="<?php echo $row["pname"];?>">
				 <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
				 <input type="submit" name="add_to_cart" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
				 </div>
				 </form>
				</div>
				<?php
			}
		}
	?>
	 
	 <div style="clear:both"></div>
	 <br>
	 <h3  class="title2">Shopping Cart Details</h3>
	
	 <div class="table-responsive"> 
		<table class="table table-bordered">
		<tr>
			<th width="30%">Product Name</th>
			<th width="10%">Quantity</th>
			<th width="13%">Price Details</th>
			<th width="10%">Total Price</th>
			<th width="17%">Remove Item</th>
		</tr>
	 
		<?php
			if(!empty($_SESSION["cart"])){
				$total=0;
				foreach($_SESSION["cart"] as $key => $value){
				
		?>
		<tr>
			<td><?php echo $value["name"]; ?></td> 
			<td><?php echo $value["item_quantity"]; ?></td>
			<td>Tk<?php echo $value["product_price"];?></td>
			<td><?php echo number_format($value["item_quantity"]* $value["product_price"],2);?></td>
			<td><a href="cart.php?action=delete&id=<?php echo $value["product_id"];?>"><span class="text-danger">Remove Item</span></a></td>
		</tr>
		<?php
			
			$total = $total+($value["item_quantity"]* $value["product_price"]);
				}
		?>
		<tr>
			<td colspan="3" align="right">Total</td>
			<th align="right">Tk <?php echo number_format($total,2);?></th>
			<td></td>
		</tr>
		<?php
	}
				
	?>
		</table>
	 </div>
	 
	</div>
	
</body>
</html>