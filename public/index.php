<?php
require_once '../config/database.php';
require_once '../controllers/EmployeeController.php';
require_once '../controllers/DepartmentController.php';

$controllerEmployee = new EmployeeController($conn);
$controllerDepartment = new DepartmentController($conn);

if (!isset($_GET['entity']) || $_GET['entity'] === 'employee') {
    // Halaman Employee default
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['add'])) {
            $controllerEmployee->add();
        } elseif (isset($_GET['edit']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            if (empty($id)) {
                echo "ID karyawan tidak valid.";
                exit();
            }
            $controllerEmployee->edit($id);
        } elseif (isset($_GET['working_period'])) {
            $controllerEmployee->workingPeriod();
        } elseif (isset($_GET['department_vs_location_report'])) {
            $controllerEmployee->reportEmployeeByDepartmentAndLocation();
        } elseif (isset($_GET['birthday_report'])) {
            $controllerEmployee->showBirthdayCalendar();
        } elseif (isset($_GET['export_excel'])) {
            $controllerEmployee->exportToExcel();
        } else {
            $controllerEmployee->getAll();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nama']) && isset($_POST['no_ktp']) && isset($_POST['telp']) && isset($_POST['kota_tinggal']) && isset($_POST['id_department']) && isset($_POST['tanggal_lahir']) && isset($_POST['tanggal_masuk']) && isset($_POST['kota_penempatan'])) {
            $controllerEmployee->create();
        } elseif (isset($_POST['_method']) && $_POST['_method'] === 'DELETE' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $controllerEmployee->delete($id);
        } else {
            echo "Invalid request method.";
        }
    } else {
        echo "Invalid request method.";
    }
} elseif (isset($_GET['entity']) && $_GET['entity'] === 'department') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['add']) && $_GET['add'] === 'true') {
            include '../views/department/add.php';
        } elseif (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $controllerDepartment->edit($id);
        } else {
            $controllerDepartment->getAll();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            if (isset($_POST['id_department']) && isset($_POST['nama_department'])) {
                $id_department = $_POST['id_department'];
                $nama_department = $_POST['nama_department'];

                $controllerDepartment->update($id_department, $nama_department);
            } else {
                echo "Data tidak lengkap.";
            }
        } else {
            echo "Invalid request method.";
        }
    }
} elseif (isset($_GET['entity']) && $_GET['entity'] === 'employee') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            if (isset($_POST['id_karyawan']) && isset($_POST['nama']) && isset($_POST['no_ktp']) && isset($_POST['telp']) && isset($_POST['kota_tinggal']) && isset($_POST['id_department']) && isset($_POST['tanggal_lahir']) && isset($_POST['tanggal_masuk']) && isset($_POST['kota_penempatan'])) {
                $id = $_POST['id_karyawan'];
                $nama = $_POST['nama'];
                $no_ktp = $_POST['no_ktp'];
                $telp = $_POST['telp'];
                $kota_tinggal = $_POST['kota_tinggal'];
                $id_department = $_POST['id_department'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $tanggal_masuk = $_POST['tanggal_masuk'];
                $kota_penempatan = $_POST['kota_penempatan'];

                $controllerEmployee->update($id, $nama, $no_ktp, $telp, $kota_tinggal, $id_department, $tanggal_lahir, $tanggal_masuk, $kota_penempatan);
            } else {
                echo "Data tidak lengkap.";
            }
        }
    }
} else {
    echo "Halaman tidak ditemukan.";
}
