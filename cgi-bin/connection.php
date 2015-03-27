<?php
/*
FILE-NAME: connection.php

DESCRIPTION: Establishes a connection with the MYSQL Server and also has the functions
to clean the connection i.e remove the connection and delete all vulnerable private 
data.
*/

    $link = false;
    
    
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
        $link = mysql_connect( 'engr-cpanel-mysql.engr.illinois.edu', 'splitrid_admin', '12345') or die('Could not connect to server.' );
        
        echo "<h1 style=\" top: 0;\">"
        echo("Successful Connection!");
        echo "</h1>"
        /* SELECT the Databse to Use */
        mysql_select_db('splitrid_db', $link) or die('Could not select database.');
        
        // Return the connection link to the requester
        return $link;
    }
    
    
    
    function clearConnection()
    {
        global $link;
        if( $link != false )
            mysql_close($link);
        $link = false;
    }
    
?>
