<?php

function activity_log($tipe, $aksi)
{
    $CI = get_instance();

    date_default_timezone_set("Asia/Jakarta");
    $waktu =  date("Y-m-d h:i:sa");
    $param['log_time'] = $waktu; //membuat, menambah, menghapus, mengubah,
    $param['log_user'] = $CI->session->userdata('username');
    $param['log_tipe'] = $tipe; //asset, asesoris, komponen, inventori
    $param['log_aksi'] = $aksi; //membuat, menambah, menghapus, mengubah,



    //load model log
    $CI->load->model('Model_log');

    //save to database
    $CI->Model_log->save_log($param);
}
