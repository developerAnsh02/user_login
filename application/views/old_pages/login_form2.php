<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Custom styles-->
	<style>
	/* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
#background-image: url('<?php echo base_url();?>assets/hexagons.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'vardana', sans-serif;
}

.container{
height: 100%;
align-content: center;

}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
background-image: url('<?php echo base_url();?>assets/hexagons.jpg');
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}

.navbar-brand{
    height: 42px;
    padding: 7px 8px;
}
.dropdown:hover .dropdown-menu {
  display: block;
}

 .navbar {
	min-height:40px; 
 }
.control-label{
	font-family:vardana;
}

.navbar-expand-sm .navbar-nav .nav-link{
	padding-right:1.0rem;
	padding-left:0.5rem;
	color: #ffff;
    font-family: vardana;
    font-size: 16px;
}
a.icon_bar_small, a.icon_bar_small span{
	width: 43px;
    height: 43px;
    line-height: 43px;
    font-size: 15px;
    background-color: #fff;
    padding-left: 5px;
    margin: 2px;
	font-family:vardana;
}
	
	
 @media only screen and (min-width: 1200px)  { 
      	.fullscreen{
			display:none;	
			}
		
    }


    @media only screen and (max-width: 2000px)  and (min-width: 1500px) {
     
		.fullscreen{
			display:block;	
			}
			 .smallscreen{
		   display:none;	
		}
      .header-image{
         height:700px;
      }
    }

	</style>
</head>
<body>

 
   <div class="header-image" style="background-image: url(<?php echo base_url();?>assets/headerbg.jpg) ;background-size: cover; height: 500px;    background-position: 50% 50%;">
      <div class="bs-example">
         <nav class="navbar navbar-expand-md navbar-dark " style="margin:0px;padding:0px;">
            <a href="tel:+447443822098" class="navbar-brand" style="font-size:1rem;"><i class="fa fa-whatsapp"></i> +44 7443822098</a></a>
            <a class="navbar-brand" href="tel:+447520626128" style="font-size:1rem;"> <i class="fa fa-phone"></i> +44 7520626128</a>
            <a class="navbar-brand" href="mailto:order@assignnmentinneed.com" style="font-size:1rem;"> <i class="fa fa-envelope"></i> order@assignnmentinneed.com</a>
            <div class="" href="mailto:order@assignnmentinneed.com" style="font-size:1rem;color: #000000;background: #59b0e2;font-size: 15px;padding: 4px 14px;margin-left: auto;margin-right: 12px;"> Request a Call Back</span>
         </nav>
      </div>
      <div class="bs-example ">
         <nav class="navbar navbar-expand-sm" style="color:white;">
      
         <div class="row smallscreen">
            <!-- Brand -->
            <div class="col-md-5" style="float: left;"> 
               
               <a href="https://www.assignnmentinneed.com" class="navbar-brand"><img src="<?php echo base_url();?>assets/download.png" style="width: 30%;margin: 0 30px 0 20px;"></a>
               
            </div>
            <div class="col-md-7" style="float: right;margin: 0px;font-size:16px;white-space:nowrap;">
               <!-- Links -->
               <ul class="navbar-nav ">
                  <li class="nav-item ">
                     <a class="nav-link" href="https://www.assignnmentinneed.com" >Home</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                     Company
                     </a>
                     <div class="dropdown-menu">
                     <a class="dropdown-item" href="assignnmentinneed.com/assignment-help-expert-uk/">What We Are</a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/why-choose-us/">Why Choose Us</a>
                     </div>
                  </li>
                  <!-- Dropdown -->
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                     Services
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="https://www.assignnmentinneed.com/assignment-writing-uk/"><span>Assignment Writing</span></a>
                        <a class="dropdown-item" href="https://www.assignnmentinneed.com/dissertation-writing-services-uk/"><span>Dissertation Writing</span></a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/essay-writing-help-uk/"><span>Essay Writing</span></a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/research-paper-writing-uk/"><span>Research Paper Writing</span></a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/homework-writing-help-uk/"><span>Homework Writing</span></a>
                     </div>
                  </li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/pricing/"><span>Pricing</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/samples/"><span>Samples</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/blog/"><span>Blog</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="http://orders.assignnmentinneed.com/index.php"><span>Order Now</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/login/"><span>Login/Signup</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/contact-us/"><span> Contact-Us </span></a></li>
               </ul>
               </div>
            </div>
            
            <div class="row fullscreen" style="width:100%">
            <!-- Brand -->
            <div  style="float: left;"> 
               
               <a href="https://www.assignnmentinneed.com" class="navbar-brand"><img src="<?php echo base_url();?>assets/download.png" style="width: 30%;margin: 0 30px 0 20px;"></a>
               
            </div>
            <div  style="float: right;margin: 0px;font-size:18px;white-space:nowrap;">
               <!-- Links -->
               <ul class="navbar-nav ">
                  <li class="nav-item ">
                     <a class="nav-link" href="https://www.assignnmentinneed.com" >Home</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                     Company
                     </a>
                     <div class="dropdown-menu">
                     <a class="dropdown-item" href="assignnmentinneed.com/assignment-help-expert-uk/">What We Are</a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/why-choose-us/">Why Choose Us</a>
                     </div>
                  </li>
                  <!-- Dropdown -->
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                     Services
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="https://www.assignnmentinneed.com/assignment-writing-uk/"><span>Assignment Writing</span></a>
                        <a class="dropdown-item" href="https://www.assignnmentinneed.com/dissertation-writing-services-uk/"><span>Dissertation Writing</span></a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/essay-writing-help-uk/"><span>Essay Writing</span></a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/research-paper-writing-uk/"><span>Research Paper Writing</span></a>
                     <a class="dropdown-item" href="https://www.assignnmentinneed.com/homework-writing-help-uk/"><span>Homework Writing</span></a>
                     </div>
                  </li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/pricing/"><span>Pricing</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/samples/"><span>Samples</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/blog/"><span>Blog</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="http://orders.assignnmentinneed.com/index.php"><span>Order Now</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/login/"><span>Login/Signup</span></a></li>
                  <li class="nav-item "><a class="nav-link" href="https://www.assignnmentinneed.com/contact-us/"><span> Contact-Us </span></a></li>
               </ul>
               </div>
            </div>
            
         </nav>
      </div>
</div>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><a href="https://assignnmentinneed.com/" style="color:#FFC312"><i class="fas fa-home"></i> </a></span>
					
				</div>
			</div>
			<div class="card-body">
			 <div class="" style="color:white;">
				<?php echo validation_errors();?>
				
				<?php if($this->session->flashdata('success')): ?>
				 <div class="alert alert-success alert-dismissible" >
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <h5><i class="icon fa fa-check"></i> Success!</h5>
						 <?php echo $this->session->flashdata('success'); ?>
					   </div>
				  <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
			  <?php endif; ?>

			  <?php if($this->session->flashdata('failed')): ?>
				 <div class="alert alert-error alert-dismissible " >
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <h5><i class="icon fa fa-check"></i> Alert!</h5>
						 <?php echo $this->session->flashdata('failed'); ?>
					   </div>
			  <?php endif; ?>

			</div>
				 <form action="<?php echo base_url() ;?>index.php/User_authentication/user_login_process" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						
						 <input type="text" class="form-control" placeholder="Email" name="username" autocomplete="off">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" name="chech" value="1">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="<?php echo base_url() ;?>/User_authentication/user_registration_show">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="<?php echo base_url() ;?>User_authentication/ForgotPassword">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Footer -->
<footer class="page-footer font-small indigo" style="background-color: #202c5a;color:#fff;padding: 50px;">

  <!-- Footer Links -->
  <div class=" text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- Links -->
        <h5 class=" mt-3 mb-4" style="color:white;">About us</h5>
        
        	<div style="margin-right: 10%;">
        		<p>Assignment In Need is an organization of over 200 people. We are based in UK and was established in 2014. Our team intends to write the assignment with proper quality as per the due date.</p></div>
        
        
      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- Links -->
        <h5 class=" mt-3 mb-4" style="color:white;">Quick Links</h5>

        <ul style="list-style-type: inherit;color: #fff;"><li><a href="https://www.assignnmentinneed.com/contact-us/" style="color: #fff;">Call Back</a></li><li><a href="https://www.assignnmentinneed.com/prakash/order.php" style="color: #fff;">Order Now</a></li><li><a href="https://www.assignnmentinneed.com/contact-us/" style="color: #fff;">Connect With Us</a></li><li><a href="#" style="color: #fff;">Services</a></li></ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- Links -->
        <h5 class=" mt-3 mb-4" style="color:white;">Policies</h5>

       <ul style=" list-style-type: inherit;color: #fff;"><li><a href="https://www.assignnmentinneed.com/privacy-policy/" style="color: #fff;">Privacy Policy</a></li><li><a href="https://www.assignnmentinneed.com/guarantee-policy/" style="color: #fff;">Guarantee</a></li><li><a href="https://www.assignnmentinneed.com/refund-policy/" style="color: #fff;">Refund Policy</a></li><li><a href="https://www.assignnmentinneed.com/cancellation-policy/" style="color: #fff;">Cancellation Policy</a></li></ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- Links -->
        <h5 class=" mt-3 mb-4" style="color:white;">Contact Us</h5>

       <div class="textwidget"><p><i class="icon-location"></i>International House, Constance Street, London E16</p>
		<p><i class="fa fa-envelope"></i> <a href="mailto: order@assignnmentinneed.com" style="color: #fff;"> order@assignnmentinneed.com</a><br>
		<i class="fa fa-mobile"></i> <a href="tel:+44-7520626128" style="color: #fff;">+44-7520626128<br>
		</a></p>
		</div>

      </div>
      <div class="col-md-2 mx-auto">

        <!-- Links -->
        <h5 class="mt-3 mb-4" style="color:white;">Social </h5>

       <div class="textwidget">
	       	<div style="display: flex;">
	       		<a href="https://www.facebook.com/assignmentinneed/" class="icon_bar  icon_bar_facebook icon_bar_small" target="_blank" rel="noopener noreferrer"><span class="b"><i class="fa fa-facebook"></i></span></a><br>
				<br>
				<a href="https://www.instagram.com/assignmentinneedlondon_uk/" class="icon_bar  icon_bar_flickr icon_bar_small" target="_blank" rel="noopener noreferrer"><span class="b"><i class="fa fa-instagram"></i></span></a><br>
				<br>
				<a href="#" class="icon_bar  icon_bar_twitter icon_bar_small"><span class="b"><i class="fa fa-twitter"></i></span></a><br>
				<br>
				<a href="#" class="icon_bar  icon_bar_linkedin icon_bar_small"><span class="b"><i class="fa fa-linkedin"></i></span></a>
			</div>
		</div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <hr style="border-top: 1px solid rgb(239 228 228 / 10%);">
  <div class="footer-copyright text-center py-3">© 2020 Assignment In Need. All Rights Reserved. <a href="https://www.assignnmentinneed.com/"> Assignment In Need</a>
  </div>

  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script>
  $('#close').on('click', function(e) { 
   $(this).parent('.error_mesg').remove(); 
});
</script>