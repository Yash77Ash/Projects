<?php
session_start();
include("connection.php");
extract($_REQUEST);
$arr=array();

if(isset($_GET['msg'])) {
    $loginmsg=$_GET['msg'];
} else {
    $loginmsg="";
}

if(isset($_SESSION['cust_id'])) {
    $cust_id=$_SESSION['cust_id'];
    $cquery=mysqli_query($con,"select * from customer where cust_email='$cust_id'");
    $cresult=mysqli_fetch_array($cquery);
} else {
    $cust_id="";
}






$query=mysqli_query($con,"select mess.mess_name,mess.mess_id,mess.mess_email,
mess.mess_mob,mess.mess_address,mess.mess_logo,food.food_id,food.foodname,food.cost,
food.paymentmode 
from mess inner join food on mess.mess_id=food.mess_id;");
while($row=mysqli_fetch_array($query))
{
	$arr[]=$row['food_id'];
	shuffle($arr);
}

print_r($arr);

 if(isset($addtocart))
 {
	 
	if(!empty($_SESSION['cust_id']))
	{
		 
		header("location:cart.php?product=$addtocart");
	}
	else
	{
		header("location:?product=$addtocart");
	}
 }
 
 if(isset($login))
 {
	 header("location:login.php");
 }
 if(isset($logout))
 {
	 session_destroy();
	 header("location:index.php");
 }
 $query=mysqli_query($con,"select food.foodname,food.mess_id,food.cost,food.image,cart.cart_id,cart.product_id,cart.customer_id from food inner  join cart on food.food_id=cart.product_id where cart.customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
if(isset($message))
 {
	 
	 if(mysqli_query($con,"insert into tblmessage(fld_name,fld_email,fld_phone,fld_msg) values ('$nm','$em','$ph','$txt')"))
     {
		 echo "<script> alert('We will be Connecting You shortly')</script>";
	 }
	 else
	 {
		 echo "failed";
	 }
 }

?>
<html>
  <head>
     <title>Home</title>
	 <!--bootstrap files-->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <!--bootstrap files-->
	 
	 <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
	 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
     
	 
	 
	 
	 <!-- <script>
	 //search product function
            $(document).ready(function(){
	
	             $("#search_text").keypress(function()
	                      {
	                       load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch2.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#result').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_text').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         $('#result').html(data);			
		                              }
	                                });
	                              });
	                            });
								
								//hotel search
								$(document).ready(function(){
	
	                            $("#search_hotel").keypress(function()
	                         {
	                         load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#resulthotel').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_hotel').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         load_data();			
		                              }
	                                });
	                              });
	                            });
</script> -->
<style>
//body{
     background-image:url("img/main_spice2.jpg");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
}
ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{text-decoration:none;}


</style>
  </head>
  
    
	<body>
	




<div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
<div id="resulthotel" style=" margin:0px auto; position:fixed; top:150px;right:750px; background:white;  z-index: 3000;"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color: black;
    font-size: 32px;
    letter-spacing: 7px;
    text-transform: uppercase;">Tiffin-Wala</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"><?php echo $cresult['cust_name']; ?></i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        
		<!-- <li class="nav-item">
		     <a href="#" class="nav-link"><form method="post"><input type="text" name="search_Mess" id="search_Mess" placeholder="Search Mess " class="form-control " /></form></a>
		  </li> -->
          <!-- <li class="nav-item">
		     <a href="#" class="nav-link"><form method="post"><input type="text" name="search_text" id="search_text" placeholder="Search by Food Name " class="form-control " /></form></a>
		  </li> -->
		  <li class="nav-item active">
          <a class="nav-link" href="index.php">Home
                
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
		<li class="nav-item">
		  <form method="post">
      <?php
if (empty($cust_id)) {
?>
    <a href="login.php"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart" class="badge badge-light">0</span></i></span></a>
    
    &nbsp;&nbsp;&nbsp;
    <form method="post" action="login.php">
        <button class="btn btn-outline-danger my-2 my-sm-0" name="login" type="submit">Log In</button>
    </form>
    &nbsp;&nbsp;&nbsp;
<?php
} else {
?>
    <a href="cart.php"><span style="color:green; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:green;" id="cart" class="badge badge-light"><?php if (isset($re)) { echo $re; }?></span></i></span></a>
    
    &nbsp;&nbsp;&nbsp;
    <form method="post">
        <button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>
    </form>
    &nbsp;&nbsp;&nbsp;
<?php
}
?>

			</form>
        </li>
		
      </ul>
	  
    </div>
	
</nav>
<!--menu ends-->
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/1.jpg" alt="Chinchwad" class="d-block w-100">
      <div class="carousel-caption">
        <h3>Chinchwad</h3>
        <p>We had such a great time in Chinchwad!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/2.avif" alt="Pimpri" class="d-block w-100">
      <div class="carousel-caption">
        <h3>Pimpri</h3>
        <p>Thank you, Pimpri!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/3.jpg" alt="Bhosari" class="d-block w-100">
      <div class="carousel-caption">
        <h3>Bhosari</h3>
        <p>We love the Bhosari!</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>



<!--slider ends-->







<!--container 1 starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="container-fluid rounded" style="border: solid 2px #343a40;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mess ID</th>
                            <th>Mess Name</th>
                            <th>Food Image</th>
                            <th>Name of Food</th>
                            <th>Price</th>
                            <th>Add to Cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($con, "SELECT mess.mess_email, mess.mess_name, mess.mess_mob,
                            mess.mess_mob, mess.mess_address, mess.mess_id, mess.mess_logo,
                            food.food_id, food.foodname, food.cost, food.paymentmode, food.image
                            FROM mess
                            INNER JOIN food ON mess.mess_id = food.mess_id");

                        if (!$query) {
                            echo "Error: " . mysqli_error($con);
                        } else {
                            while ($res = mysqli_fetch_assoc($query)) {
                                $hotel_logo = "img/Mess/" . $res['mess_email'] . "/" . $res['mess_logo'];
                                $food_pic = "img/Mess/" . $res['mess_email'] . "/foodimages/" . $res['image'];
                            ?>
                                <tr>
                                    <td><?php echo $res['food_id']; ?></td>
                                    <td><?php echo $res['mess_name']; ?></td>
                                    <td><img src="<?php echo $food_pic; ?>" class="rounded" height="100px" width="100px"></td>
                                    <td><?php echo $res['foodname']; ?></td>
                                    <td><?php echo "Rs " . $res['cost']; ?></td>
                                    <td>
                                        <form method="post" >
                                            <button type="submit" name="addtocart" value="<?php echo $res['food_id']; ?>" class="btn btn-primary btn-lg">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--container 1 ends-->

<!--container 2 starts-->
<!-- <div class="container-fluid"> -->
    <!-- <div class="row">      main row -->
        <!-- <div class="col-sm-6">      main row 2 left -->
            <!-- <br><br><br><br><br><br><br><br><br><br><br><br> -->
            <!-- <div class="container-fluid rounded" style="border:solid 1px #F0F0F0;">product container -->
			<!-- <div class="container-fluid"> -->
    <!-- <div class="row">
        <div class="col-sm-12">
            <div class="container-fluid rounded" style="border: solid 2px #343a40;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mess Name</th>
                            <th>Product Image</th>
                            <th>Name of Product</th>
                            <th>Price</th>
                            <th>Add to Cart</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div> -->

        <!--main row 2 left main ends-->

        <!--main row 2 left right starts-->
        <!-- <div class="col-sm-6">
            <div class="container-fluid">
                <img src="img/pastaveg_640x480.jpg" height="300px" width="100%">
            </div> -->
            <!-- <div class="container">
                <p style="font-family: 'Lobster'; font-weight:light; font-size:25px;"></p>
            </div>
        </div> -->
        <!--main row 2 left right ends-->

    </div><!--main row 2 ends-->
</div>
<!--container 2 ends-->


<!--container 2 ends-->

<!--footer primary-->
	     
		    <?php
			include("footer.php");
			?>
			 			 
		  
          

	</body>
</html>