<?php

require_once("../backend/config.php");
clearSession();
// redirect($_SERVER["HTTP_REFERER"].'./login.php', false);
redirect('login.php'); 
