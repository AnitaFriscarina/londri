<?php

function cek_login()
{
    $CI = get_instance();

    if (!$CI->session->userdata('username')) {
        redirect('Auth');
    }
}
