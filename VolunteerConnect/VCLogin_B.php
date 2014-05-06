<?php include('VCHeader.php'); ?>

	<div id="nav">
	    	<strong>VOLUNTEER</strong>CONNECT
            	<a class="attend_link" href="VCDashboard_Attend.php">Attend</a>
    			<a class="myevents_link" href="VCDashboard_Events.php">My Events</a>
    			<a class = "sublinks" href="VCDashboard_Events_Upcoming.php">Upcoming</a>
    			<a class = "sublinks" href="VCDashboard_Events_Saved.php">Saved</a>
   				<a class = "sublinks" href="VCDashboard_Events_Attended.php">Attended</a>
	</div>
	
    <div id="login_img"></div>
    
    <div id="login">
    
        <form method="post">
        	<h1>Sign In</h1>
            <input type="text" name="email" placeholder="Email"><br />
            <input type="text" name="pwd" placeholder="Password"><br />
            <input id="btn" type="submit" value="Sign In">   
        </form>
        
        <hr />
        
          <form method="post">
        	<h1>Volunteer Registration</h1>
            <input type="text" name="name" placeholder="Name"><br />
            <input type="text" name="email" placeholder="Email"><br />
            <input type="password" name="pwd" placeholder="Password"><br />
            <input id="btn" type="submit" value="Register">   
        </form>
        
    </div>
    
</body>
</html>