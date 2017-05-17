<?php
	$mystring = 'abc';
	$findme   = 'a';
	$pos = strpos($mystring, $findme);

	// Note our use of ===.  Simply == would not work as expected
	// because the position of 'a' was the 0th (first) character.
	if ($pos === false) {
	    echo "The string '$findme' was not found in the string '$mystring'";
	} else {
	    echo "The string '$findme' was found in the string '$mystring'";
	    echo " and exists at position $pos";
	}
	echo "<br /><br /> <hr>";

	$mystring = 'abc';
	$findme   = 'a';
	$pos = strpos($mystring, $findme);

	// The !== operator can also be used.  Using != would not work as expected
	// because the position of 'a' is 0. The statement (0 != false) evaluates 
	// to false.
	if ($pos !== false) {
	     echo "The string '$findme' was found in the string '$mystring'";
	         echo " and exists at position $pos";
	} else {
	     echo "The string '$findme' was not found in the string '$mystring'";
	}
	echo "<br /><br /> <hr>";

	// We can search for the character, ignoring anything before the offset
	$newstring = 'abcdef abcdef';
	$pos = strpos($newstring, 'a', 1); 

	echo $pos;
?>