<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Night Gator - Contact</title>
	<meta name="description" content="Night Gator - Gainesvilles Drink Specials. We built this site for both the drinkers and the bar owners.">
	<meta name="author" content="Kennedy's Garage">
	<meta name="robots" content="index, follow">
	<link rel="shortcut icon"  href="img/favicon.ico"/>
	<link rel="stylesheet" href="css/reset.css?v=1">
	<link rel="stylesheet" href="css/style.css?v=1">
	<script src="js/modernizr-1.5.min.js"></script>
	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-17560204-1']);
		_gaq.push(['_trackPageview']);
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>
<body>
<div id="container">

	<header>
		<h1><a href="/"><img src="img/logo.png"/> Night Gator</a></h1>
		<nav>
		<ul>
		<li><a href="monday.php">mon</a></li>
		<li><a href="tuesday.php">tue</a></li>
		<li><a href="wednesday.php">Wed</a></li>
		<li><a href="thursday.php">thu</a></li>
		<li><a href="friday.php">fri</a></li>
		<li><a href="saturday.php">sat</a></li>
		<li><a href="sunday.php">sun</a></li>
		</ul>
		</nav>
	</header>
	
	<div id="content">
		<div id="page">
			<h2>Contact Us</h2>
			<hr/>
			<p>Feel free to contact us anytime at <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#110;&#105;&#103;&#104;&#116;&#103;&#97;&#116;&#111;&#114;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;">&#110;&#105;&#103;&#104;&#116;&#103;&#97;&#116;&#111;&#114;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;</a> or you can fill out this form:</p>
			
			<?
		// Attention! Please read the following.
		// It is important you do not edit pieces of code that aren't tagged as a configurable options identified by the following:
		
        // Configuration option.
		
		// Each option that is easily editable has a modified example given.
		
		
		$error    = '';
        $name     = ''; 
        $email    = '';
        $toemail    = '';
        //$phone    = ''; Remove the // tags and this text to active phone number.
        $subject  = ''; 
        $comments = ''; 
        $verify   = '';
		
        if(isset($_POST['contactus'])) {
        
		$name     = $_POST['name'];
        $email    = $_POST['email'];
        $toemail    = $_POST['toemail'];
        //$phone   = $_POST['phone']; Remove the // tags and this text to active phone number.
        $subject  = $_POST['subject'];
        $comments = $_POST['comments'];
        $verify   = $_POST['verify'];
		

        // Configuration option.
		// You may change the error messages below.
		// e.g. $error = 'Attention! This is a customised error message!';
		
        if(trim($name) == '') {
        	$error = '<div class="error_message">Attention! You must enter your name.</div>';
        } else if(trim($email) == '') {
        	$error = '<div class="error_message">Attention! Please enter a valid email address.</div>';
       
       // Configuration option.
       // Remove the // tags below to active phone number.
	   //} else if(!is_numeric($phone)) {
       //   $error = '<div class="error_message">Attention! Phone number can only contain digits.</div>';
       
        } else if(!isEmail($email)) {
        	$error = '<div class="error_message">Attention! You have enter an invalid e-mail address, try again.</div>';
        }
		
        if(trim($subject) == '') {
        	$error = '<div class="error_message">Attention! Please enter a subject.</div>';
        } else if(trim($comments) == '') {
        	$error = '<div class="error_message">Attention! Please enter your message.</div>';
        } else if(trim($verify) == '') {
	    	$error = '<div class="error_message">Attention! Please enter the verification number.</div>';
	    } else if(trim($verify) != '12') {
	    	$error = '<div class="error_message">Attention! The verification number you entered is incorrect.</div>';
	    }
		
        if($error == '') {
        
			if(get_magic_quotes_gpc()) {
            	$comments = stripslashes($comments);
            }


         // Configuration option.
		 // Enter the email address that you want to emails to be sent to.
		 // Example $address = "joe.doe@yourdomain.com";
		 
         $address = "nightgator@gmail.com";


         // Configuration option.
         // i.e. The standard subject will appear as, "You've been contacted by John Doe."
		 
         // Example, $e_subject = '$name . ' has contacted you via Your Website.';

         $e_subject = 'Contact Form: ' . $name . '.';


         // Configuration option.
		 // You can change this if you feel that you need to.
		 // Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.
					
		 $e_body = "You have been contacted by $name with regards to $subject, their additional message is as follows.\r\n\n";
		 $e_content = "\"$comments\"\r\n\n";
		 
		 // Configuration option.
       	 // RIf you active phone number, swap the tags of $e-reply below to include phone number.
		 //$e_reply = "You can contact $name via email, $email or via phone $phone";
		 $e_reply = "You can contact $name via email, $email";
					
         $msg = $e_body . $e_content . $e_reply;

         mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");


		 // Email has sent successfully, echo a success page.
					
		 echo "<div id='succsess_page'>";
		 echo "<h3>Email Sent Successfully.</h3>";
		 echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
		 echo "</div>";
                      
		}
	}

         if(!isset($_POST['contactus']) || $error != '') // Do not edit.
         {
?>

            
            <? echo $error; ?>
            
            <fieldset>
            

            <form  method="post" action="">

			<label for=name accesskey=U><span class="required">*</span> Your Name</label>
            <input name="name" type="text" id="name" size="30" value="<?=$name;?>" />

			<br />
            <label for=email accesskey=E><span class="required">*</span> Email</label>
            <input name="email" type="text" id="email" size="30" value="<?=$email;?>" />

			<br />
            <!-- Remove these comment tags to activate phone number field.
            <label for=phone accesskey=P><span class="required">*</span> Phone</label>
            <input name="phone" type="text" id="phone" size="30" value="<?=$phone;?>" />

			<br />
            -->
            <label for=subject accesskey=S><span class="required">*</span> Subject</label>
            <select name="subject" type="text" id="subject">
              <option value="Support">Support</option>
              <option value="a Sale">Advertising</option>
              <option value="a Bug fix">Report a error</option>
            </select>

			<br />
            <label for=comments accesskey=C><span class="required">*</span> Your comments</label>
            <textarea name="comments" cols="40" rows="3"  id="comments"><?=$comments;?></textarea>

            <hr />
            
            <p><span class="required">*</span> Are you human?</p>
            
            <label for=verify accesskey=V>&nbsp;&nbsp;&nbsp;11 + 1 =</label>
			<input name="verify" type="text" id="verify" size="4" value="<?=$verify;?>" />

            <input name="contactus" type="submit" class="button" id="contactus" value="Submit" />

            </form>
            
            </fieldset>
            
<? } 
	
function isEmail($email) { // Email address verification, do not edit.
return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

?>

			
		</div><!--/page-->
	</div><!--content-->
	
	<div id="sidebar">
		<div id="facebook">
			<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FNight-Gator%2F52934068339&amp;width=300&amp;colorscheme=dark&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=260" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:260px;" allowTransparency="true"></iframe>
		</div><!--/facebook-->
	</div><!--/sidebar-->
	
	<div class="clear"></div>
	
	<footer>
		<ul id="foot-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="add.php">Add &amp; Update Bar Specials</a></li>
			<li><a href="advertise.php">Advertise</a></li>
			<li><a href="about.php">About</a></li>
			<li class="active"><a href="contact.php">Contact</a></li>
		</ul>
		<p id="copy">&copy; 2008-2011 Night Gator. All Rights Reserved.</p>
		<p id="kg41">Crafted by <a href="http://kennedysgarage.com">Kennedy's Garage</a>.</p>
    </footer>
	<div class="clear"></div>
	
</div><!--/container-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="js/jquery-1.4.2.min.js"><\/script>')</script>
<script src="js/javascript.js"></script>
</body>
</html>