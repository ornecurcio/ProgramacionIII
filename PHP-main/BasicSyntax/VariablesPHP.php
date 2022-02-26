
<?php 
    //vbrowsers versions
    // echo $_SERVER['HTTP_USER_AGENT'];

    //if you want to check for Internet Explorer you can do this:
    // if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
    //     echo 'You are using Internet Explorer.<br />';
    // }
    // else
    // {
    //     echo 'You aren´t using Internet Explorer.<br />';
    // }

    // $mystring = 'abc';
    // $findme   = 'a';
    // $pos = strpos($mystring, $findme);

    // Note our use of ===.  Simply == would not work as expected
    // because the position of 'a' was the 0th (first) character.
    // if ($pos === false) {
    //     echo "The string '$findme' was not found in the string '$mystring'";
    // } else {
    //     echo "The string '$findme' was found in the string '$mystring'";
    //     echo " and exists at position $pos";
    // }
    // We can search for the character, ignoring anything before the offset
    $findme   = 'a';
    $newstring = 'abcdefa';
    $pos = strpos($newstring, $findme, 1); // $pos = 7, not 0
    if ($pos === false) {
        echo "The string '$findme' was not found in the string '$newstring'";
    } else {
        echo "The string '$findme' was found in the string '$newstring'";
        echo " and exists at position $pos";
    }
?>