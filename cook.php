<?php
	$cookie_name = 'user';
	if(isset($_COOKIE['user'])) {
	    echo "<h1> Hello, " . $_COOKIE[$cookie_name] . "</h1>";
	    echo "Pretty neat, huh?";
	} else {
	    echo "Cookie '" . $cookie_name . "' is not set!<br>";
	    echo "This shouldn't have happened!";
	}
?>

<html>
 Choose Image : <input name="img" size="35" type="file"/><br/>
 <input type="submit" name="submit" value="Upload"/>
</form>
</html>