<?php
$target_path = "./uploads/";
$target_path = $target_path.basename( $_FILES['fileToUpload']['name']);

if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {

} else{
    echo "Sorry, file not uploaded, please try again!";
}
?>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Data Extraction</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<p hidden><?php $targetmobile = system("python hellomobile.py $target_path");  ?> <!--system() is for executing a system command and immediately displaying the output - presumably text. -->
		<?php  $mobiled = preg_replace("/[^+0-9\']/", "", $targetmobile);
		$mobiledd = str_replace("''",",",$mobiled);
		$mobileddd = preg_replace("/[\']/", "", $mobiledd);
		 ?></p>
		<p hidden><?php $targetemail = system("python helloemail.py $target_path");  ?>
			<?php  $emaild = preg_replace("/[\[\]]/", "", $targetemail);
			$emaildd = str_replace("''",",",$emaild);
			$emailddd = preg_replace("/[\']/", "", $emaildd);
			 ?></p>
		<p hidden><?php $targeturl = system("python hellourl.py $target_path");  ?>
				 <?php  $urld = preg_replace("/[\[\]]/", "", $targeturl);
				 $urldd = str_replace("''",",",$urld);
				 $urlddd = preg_replace("/[\']/", "", $urldd);
		?></p>
	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post">
				<span class="contact100-form-title">
					<center>🕵️‍Details🕵</center>‍
				</span>

        <pre><font size="4"><b>  Mobile Number</b></font></pre>

        <div class="wrap-input100 validate-input" data-validate="Please enter your mobile number"> <!-- bootstrap modal popup -->

					<textarea class="input100" type="text" name="mobilenumber" id="mobilenumber" placeholder="Mobile number"><?php echo $mobileddd; ?></textarea>
					<span class="focus-input100"></span>
				</div>

        <pre><font size="4"><b>  Url</b></font></pre>

				<div class="wrap-input100 validate-input" data-validate = "Please enter the URL">
					<textarea class="input100" type="text" name="url" id="url" placeholder="Url"><?php echo $urlddd; ?></textarea>
					<span class="focus-input100"></span>
				</div>

        <pre><font size="4"><b>  Email</b></font></pre>

        <div class="wrap-input100 validate-input" data-validate = "Please enter email: e@a.x">
					<textarea class="input100" name="email" id="email" placeholder="Email"><?php echo $emailddd; ?></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" id="butsave" name="save">
					Save
					</button>
				</div>
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <center><p>👉Inserted Successfully👈</p></center>
        </div>
			</form>

			<p name="hidmobilenumber" id="hidmobilenumber" hidden><?php echo $mobileddd ?> </p>
			<p name="hidurl" id="hidurl" hidden><?php echo $urlddd ?> </p>
			<p name="hidemail" id="hidemail" hidden><?php echo $emailddd ?> </p>


			<script>
			$(document).ready(function() {
				$('#butsave').on('click', function() {
			    if((($('#mobilenumber').val())==($('#hidmobilenumber').val()))&&(($('#url').val())==($('#hidurl').val()))&&(($('#email').val())==($('#hidemail').val())))
			    {
			      alert("data is ok");
					$("#butsave").attr("disabled", "disabled");
					var mobilenumber = $('#mobilenumber').val();
					var email = $('#email').val();
					var url= $('#url').val();
			   	    var editcheck = 0;
					if(mobilenumber!="" && email!="" && url!=""){
						$.ajax({
							url: "datastore.php",
							type: "POST",
							data: {
								mobilenumber: mobilenumber,
								email: email,
								url: url,
			          editcheck: editcheck // editable nodes
							},
							cache: false,
							success: function(dataResult){

									$("#butsave").removeAttr("disabled");
									$('#fupForm').find('textarea').val('');
									$("#success").show();

							}
						});
					}
					else{
						alert('Please fill all the field !');
					}
			  }else{

			    $("#butsave").attr("disabled", "disabled");
			    var mobilenumber = $('#mobilenumber').val();
			    var email = $('#email').val();
			    var url = $('#url').val();
			    var editcheck = 1;
			    if(mobilenumber!="" && email!="" && url!=""){
			      $.ajax({
			        url: "datastore.php",
			        type: "POST",
			        data: {
			          mobilenumber: mobilenumber,
			          email: email,
			          url: url,
			          editcheck: editcheck
			        },
			        cache: false,
			        success: function(dataResult){

			            $("#butsave").removeAttr("disabled");
			            $('#fupForm').find('textarea').val('');
			            $("#success").show();

			        }
			      });
			    }
			    else{
			      alert('Please fill all the field !');
			    }


			  }


				});
			});
			</script>



			<div class="contact100-more">
				Contact us at our email: <span class="contact100-more-highlight">nradadiya21@gmail.com</span>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments); // It represent all the arguments passed to functions.
  }
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13'); //API
</script>

</body>
</html>
