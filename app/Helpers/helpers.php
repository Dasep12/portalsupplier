<?php

use Illuminate\Support\Facades\DB;
use Modules\Administrator\App\Models\Customers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;

function getSuratJalanNumber($idCustomers)
{
    if ($idCustomers) {
        $data =  DB::select("SELECT max(substr(tts.no_surat_jalan,1,4)) noUrut  
        from  tbl_trn_shipingmaterial tts
        where types in ('out') and types_trans in ('Order') and tts.customer_id  = $idCustomers  and date_format(date_trans,'%Y')= '" . date('Y') . "' ");
        $cust  = Customers::find($idCustomers);
        // dd($data);
        if ($data[0]->noUrut != null) {
            $increase =  $data[0]->noUrut + 1;
            $str_dn_ = str_pad($increase, 4, 0, STR_PAD_LEFT);
            $DN =  $str_dn_ . '/' . "SJ/" . 'RIM/' . $cust->code_customers . '/' . getRomawiMonth((int) date('m')) . '/' . date('Y');
            return $DN;
        } else {
            $DN =  '0001/' . "SJ/" . 'RIM/' . $cust->code_customers . '/' . getRomawiMonth((int) date('m')) . '/' . date('Y');
            return $DN;
        }
    }
    return null;
}

function getSuratJalanAdjust($idCustomers)
{
    if ($idCustomers) {
        $data =  DB::select("SELECT max(substr(tts.no_surat_jalan,1,4)) noUrut  
        from  tbl_trn_shipingmaterial tts
        where types_trans ='Adjust' and tts.customer_id  = $idCustomers ");
        $cust  = Customers::find($idCustomers);

        if ($data[0]->noUrut) {
            $increase =  $data[0]->noUrut + 1;
            $str_dn_ = str_pad($increase, 4, 0, STR_PAD_LEFT);
            $DN =  $str_dn_ . '/' . "ADJUST/" . 'RIM/' . $cust->code_customers . '/' . getRomawiMonth((int) date('m')) . '/' . date('Y');
            return $DN;
        } else {
            $DN =  '0001/' . "ADJUST/" . 'RIM/' . $cust->code_customers . '/' . getRomawiMonth((int) date('m')) . '/' . date('Y');
            return $DN;
        }
    }
    return null;
}

function getRomawiMonth($month)
{
    $romawiMonths = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];

    return $romawiMonths[$month];
}

function CrudMenuPermission($MenuUrl, $UserId, $act)
{
    $data = DB::table("vw_menu")
        ->where('MenuUrl', $MenuUrl)
        ->where('user_id', $UserId)
        ->select('view', 'delete', 'edit', 'add')
        ->get()
        ->first();
    if ($act == "add") {
        if ($data) {
            return $data->add;
        } else {
            return null;
        }
    } else  if ($act == "delete") {
        if ($data) {
            return $data->delete;
        } else {
            return null;
        }
    } else if ($act == "edit") {
        if ($data) {
            return $data->edit;
        } else {
            return null;
        }
    } else if ($act == "view") {
        if ($data) {
            return $data->view;
        } else {
            return null;
        }
    }
}


function passwordCrypt($type, $pass)
{
    // Compress before encryption
    $compressedData = gzcompress($pass);

    // Encrypt compressed data
    $encryptedData = Crypt::encrypt($compressedData);

    // Decrypt and decompress
    $decryptedData = Crypt::decrypt($encryptedData);
    $originalData = gzuncompress($decryptedData);


    if ($type == "encrypt") {
        return $decryptedData;
    } else {
        return $originalData;
    }
}

function EncryptPassword($string)
{
    $key = "BNC121";
    $cipher = "AES-256-CBC";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($string, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext, $key, true);
    return base64_encode($iv . $hmac . $ciphertext);
}

function DecryptPassword($string)
{
    $cipher = "AES-256-CBC";
    $key = "BNC121";
    $c = base64_decode($string);
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext, $key, true);
    if (hash_equals($hmac, $calcmac)) {
        return $original_plaintext;
    }
    return false;
}
