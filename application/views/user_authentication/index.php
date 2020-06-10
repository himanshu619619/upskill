<!doctypehtml>
<html>
<title>Login with google</title>
<head>
<link rel="stylesheet" href="conform_style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<style type="text/css">
	.gmail_conform_box{
	width:100%;
	height:100%;
	background-color:#f3f3f6;
}
.gmail_conform0{

	width:600px;
	margin:0 auto;
	text-align: center;
margin-top: 23%;
margin-bottom: 20%;
background-color: #fff;

}
.gmail_conform_1{

margin-left:30%;
margin-top:30px;
margin-bottom:30px;

}
.gmail_conform_2{


	margin-top: 20px;
}

@media screen and (max-width: 787px) {

.gmail_conform0{

	width:300px;
	margin:0 auto;
	text-align: center;
margin-top: 23%;
margin-bottom: 20%;
background-color: #fff;

}




	}
</style>

<body>
<div class="gmail_conform_box">
    <div class="container" style="">

     <div class="gmail_conform0">
     <img src="<?php echo base_url('assets');?>/theme/images/googlelogo.gif" width="200px">
     
     <h3> Amass SignIn With Google Account </h3>
   
    

<a href="<?php echo $loginURL; ?>" onclick="return validate_terms();"><img src="<?php echo base_url().'assets/theme/images/glogin.png'; ?>" style="height: 53px;" /></a>
<br/><br/>
<div><p><a href="<?php echo base_url('user/Front/terms');?>">Terms & Conditions</a></p></div>
<div><input type="checkbox" name="condition" id="terms" value="1" checked="checked">&nbsp;Accept Terms & Conditions</div>

<br/>
<a href="<?php echo base_url('home');?>"> <button class="btn btn-link btn-lg gmail_conform_2"> Cancel  </button></a>


     </div>



</div>

<script type="text/javascript">
	function validate_terms()
	{
		if($("input[name=condition]:checked").val()){
		    return true;
		}
		else
		{
			alert('Please Accept Terms & Condition');
			return false;
		}
	}
</script>
</body>
</html>
