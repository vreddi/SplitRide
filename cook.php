<?php
if(isset($_COOKIE['user'])) {
    echo "<h1> Hello, " . $_COOKIE[$cookie_name] . "</h1>";
    echo "Pretty neat, huh?";
} else {
    echo "Cookie '" . $cookie_name . "' is not set!<br>";
    echo "This shouldn't have happened!";
}
?>