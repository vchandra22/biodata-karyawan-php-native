<?php
function validateDepartmentName($nama_department)
{
    // Cek apakah tidak kosong dan panjang <= 15 karakter
    if (empty($nama_department) || strlen($nama_department) > 15) {
        return false;
    }

    // Cek apakah hanya berisi huruf, angka, dan spasi
    return preg_match('/^[a-zA-Z0-9 ]+$/', $nama_department);
}

function validateEmployeeName($nama)
{
    // Validasi nama: tidak boleh kosong dan panjang tidak lebih dari 15 karakter
    if (empty($nama) || strlen($nama) > 15) {
        return false;  // Nama tidak valid
    }
    return true;  // Nama valid
}

function validateKtpNumber($no_ktp)
{
    // Validasi nomor KTP: tidak boleh kosong dan harus berupa angka
    if (empty($no_ktp) || !is_numeric($no_ktp)) {
        return false;  // KTP tidak valid
    }
    return true;  // KTP valid
}