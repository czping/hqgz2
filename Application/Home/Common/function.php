<?php
 function is_login()
{
    $user = session('idcard');
    if (empty($user)) {
        return 0;
    } else {

        return 1;
    }

}
?>