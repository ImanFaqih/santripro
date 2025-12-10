<?php
$page = $_GET['p']  ?? '' ;

$base = __DIR__; // folder SANTRI_PRO

switch ($page) {

    // ADMIN
    case 'dashboard_admin':
        include $base.'/pages_admin/dashboard_admin.php';
        break;

    case 'approve':
        include $base.'/pages_admin/menu_aprrove.php';
        break;

    case 'data_yanbu_admin':
        include $base.'/pages_admin/data_yanbu/Menu_yanbu_admin.php';
        break;

    case 'tambah_data_yanbu_admin':
        include $base.'/pages_admin/data_yanbu/tambah_data_yanbu_admin.php';
        break;

    case 'edit_data_yanbu_admin':
        include $base.'/pages_admin/data_yanbu/edit_data_yanbu_admin.php';              
        break;

    case 'detail_data_yanbu_admin':
        include $base.'/pages_admin/data_yanbu/detail_data_yanbu_admin.php';
        break;  

    case 'hapus_data_yanbu_admin':
        include $base.'/pages_admin/data_yanbu/hapus_data_yanbu_admin.php';
        break;

        
    case 'data_alquran_admin':
        include $base.'/pages_admin/data_alquran/Menu_alquran_admin.php';
        break;

    case 'tambah_data_alquran_admin':
        include $base.'/pages_admin/data_alquran/tambah_data_alquran_admin.php';
        break;

    case 'edit_data_alquran_admin':
        include $base.'/pages_admin/data_alquran/edit_data_alquran_admin.php';
        break;

    case 'detail_data_alquran_admin':
        include $base.'/pages_admin/data_alquran/detail_data_alquran_admin.php';
        break;

    case 'hapus_data_alquran_admin':
        include $base.'/pages_admin/data_alquran/hapus_data_alquran_admin.php';
        break;
            
    case 'data_juzama_admin':
        include $base.'/pages_admin/data_juzama/Menu_juzama_admin.php';
        break;

    case 'tambah_data_juzama_admin':
        include $base.'/pages_admin/data_juzama/tambah_data_juzama_admin.php';
        break;

    case 'edit_data_juzama_admin':
        include $base.'/pages_admin/data_juzama/edit_data_juzama_admin.php';
        break;
    
    case 'detail_data_juzama_admin':
        include $base.'/pages_admin/data_juzama/detail_data_juzama_admin.php';
        break;

    case 'hapus_data_juzama_admin':
        include $base.'/pages_admin/data_juzama/hapus_data_juzama_admin.php';
        break;

    // USTADZ
    case 'dashboard_ustadz':
        include $base.'/pages_ustadz/dashboard_ustadz.php';
        break;
    case 'data_yanbu_ustadz':
        include $base.'/pages_ustadz/Menu_yanbu_ustadz.php';
        break;

    case 'data_juzama_ustadz':
        include $base.'/pages_ustadz/Menu_juzama_ustadz.php';
        break;

    case 'data_alquran_ustadz':
        include $base.'/pages_ustadz/Menu_alquran_ustadz.php';
        break;

    case 'tambah_data_ustadz':
        include $base.'/pages_ustadz/tambah_data_ustadz.php';
        break;

        // SANTRI
    case 'dashboard_santri':
        include $base.'/pages_santri/dashboard_santri.php';
        break;

    case 'data_yanbu_santri':
        include $base.'/pages_santri/Menu_yanbu_santri.php';
        break;

    case 'data_juzama_santri':
        include $base.'/pages_santri/Menu_juzama_santri.php';
        break;

    case 'data_alquran_santri':
        include $base.'/pages_santri/Menu_alquran_santri.php';
        break;

    default:
        echo "<div class='p-4'><h3>Selamat Datang di Santri Pro!</h3><p>Pilih menu di sidebar untuk memulai.</p></div>";
        break;

}
