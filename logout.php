<?php
session_start();
session_unset();
session_destroy();
//print_r ()
header("Location: http://fridajohansson.codes/Webbshopp_VG/index.php");

?>