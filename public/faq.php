 <!DOCTYPE html>
    <html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>FAQ Listing</title>
         <link rel="stylesheet" type="text/css" href="../public/css/faq.css" />
		<script type="text/javascript" src="../public/js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="../public/js/faq.js"></script>
       
	</head>
	<body>
      <header>
            <h1>LIMS</h1>
            <nav>
              <a href="home.php">Home</a>
              <a href="Login.php">Login</a>
              <a href="faq.php#barchart" class="selected">Help</a>
            </nav>
        </header>
        
		<div class="faq_container">
			<img src="images/corkboard_heading.jpg" alt="corkboard_heading" width="700" height="175" />

            <!-- Question -->
			<div class="faq" >
				<div class="faq_question">
					<p>What are the missions for developing this web application?</p>
				</div>
				<div class="faq_answer_container">
					<div class="faq_answer">
						<p>This system is development for <strong>National Textile Research Center&#40;NTRC&#41;</strong>. It's a private software. It's not in the public domain. Only NTRC has a proprietary right to access this software. It is intended to use for the ease of labs management in <strong>NTRC</strong>. It covers the procedure of labs and provide the functionality of managing all the common tasks in labs. For more information about <strong>NTRC</strong> and its services, follow thie link below</p>
						<ul>
							<li><a href="http://www.ntu.edu.pk">National Textile Research Center</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Question -->
			<div class="faq" id="barchart">
				<div class="faq_question">
					<p>How many modules of this web application has?</p>
				</div>
				<div class="faq_answer_container">
					<div class="faq_answer">
						<p>The information listed below covers this question</p>
						<ul>
							<li>This web application named <strong>LIMS</strong> has basically three modules. These are the follwings
                                <ul>
                                    <li>Reception Module</li>
                                    <li>Labs Management Module</li>
                                    <li>Admin Module</li>
                                </ul>
                            </li>
						</ul>
					</div>
				</div>
			</div>
			
			

			<!-- Question -->
			<div class="faq">
				<div class="faq_question">
					<p>What are the access privileges of the admins and users of <strong>LIMS</strong>?</p>
				</div>
				<div class="faq_answer_container">
					<div class="faq_answer">
						<p>As there are three types of users, so there are three types of access privileges.</p>
						<ul>
							<li>Admin
                                <ul>
                                    <li>Admin has complete power and is a power distribution source. As a root manager, admin can create, edit and delete the users of this system. Admin has global privileges. Admin can manage the users and can examine the status of tests and he/she has the right to finalize and generate reports and checking statistics</li>
                                </ul>
                            </li>    
							<li>Labs Managers
                                <ul>
                                    <li>Lab Manages can create, edit, delete the test result reports and is capable of managing all the tasks related to lab. He/She has limited privileges as compared to the admin.</li>
                                
                                </ul>
                            
                            </li>
                            <li>Receptionist
                                <ul>
                                    <li>Receptionist is responsible for interaction with the customer, receive samples and feed into the system. He/She can send email and sms notifications to the customer about the sample submission and expected delievery date information. he/She is also responsible for generating receipt to deleiver to the customer.</li>

                                </ul>
                            
                            </li>
						</ul>
					</div>
				</div>
			</div>
			
			<!-- Question -->
			<div class="faq">
				<div class="faq_question">
					<p>Which labs does this system cover?</p>
				</div>
				<div class="faq_answer_container">
					<div class="faq_answer">
						<p>Currently this system covers only <strong>Mechanical Lab</strong>. But in the future it might cover other labs as well. The followings test are performed in Mechanical Lab</p>
						<ul>
							<li>Tensile Strength</li>
                            <li>Tear Strength</li>
                            <li>Color Fastness to crocking or rubbing</li>
                            <li>Busting properties of fabrics and many others etc.</li>
                            
                        </ul>
							<a href="http://www.ntu.edu.pk">Visit the NTU site for more information</a>
						
					</div>
				</div>
			</div>
			
			<!-- Question -->
			<div class="faq">
				<div class="faq_question">
					<p>What are the textile testing services provided by NTRC</p>
				</div>
				<div class="faq_answer_container">
					<div class="faq_answer">
						<p>National Textile University has an ISO17025 accredited testing lab and offers commercial testing services to the textile industry.</p>
						<ul>
							<li><a href="http://www.ntu.edu.pk/textile-testing-services.php">Visit the textile testing services page on NTU</a></li>
						</ul>
						
					</div>
				</div>
			</div>
			
		</div>
    <footer id="footer">
        <p style="text-align:center;"> &copy; <?php echo date("Y"); ?> <a href="login.php">Labs Information Management System</a>, All Rights Reserved.</p>
    </footer><!--/#footer-->	
					
	</body>
    
</html>
