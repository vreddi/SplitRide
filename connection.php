<?php
/*
FILE-NAME: connection.php

DESCRIPTION: Establishes a connection with the MYSQL Server and also has the functions
to clean the connection i.e remove the connection and delete all vulnerable private 
data.
*/

    $link = false;
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
    
    
    /*
    * Establishes Connection to the MYSQL Server. This function automatically also selects
    * the working database for SplitRide namely 'splitrid_db'.
    *
    * @return connection link
    */
    function getConnection()
    {
        global $link;
        
        // Connection already exists
        if( $link )
            return $link;
           
        /* Getting Connection Link */
        /* Implementation: mysql_connect( __HOSTNAME__, __USERNAME__, __PASSWORD__) */ 
        $link = mysqli_connect( 'engr-cpanel-mysql.engr.illinois.edu', 'splitrid_admin', '12345', 'splitrid_db') or die('Could not connect to server.' );
        
        echo "<h1 style=\" top: 0;\">";
        echo("Successful Connection!");
        echo "</h1>";
        /* SELECT the Databse to Use */
        //mysqli_select_db('splitrid_db', $link) or die('Could not select database.');
        
        // Return the connection link to the requester
        return $link;
    }
    
    
    
    function clearConnection()
    {
        global $link;
        if( $link != false )
            mysqli_close($link);
        $link = false;
    }
    
?>
