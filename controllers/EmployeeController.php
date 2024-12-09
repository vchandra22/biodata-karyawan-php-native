<?php
require_once '../config/database.php';
require_once '../models/Employee.php';
require_once '../helpers/validation.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeeController
{
    private $db;
    private $employee;

    public function __construct($db)
    {
        $this->db = $db;
        $this->employee = new Employee($db);
    }

    public function getAll()
    {
        $employees = $this->employee->getAllEmployees();
        include '../views/employee/index.php';
    }

    public function add()
    {
        $departmentController = new DepartmentController($this->db);
        $departments = $departmentController->getAllDepartments();

        include '../views/employee/add.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $no_ktp = $_POST['no_ktp'];
            $telp = $_POST['telp'];
            $kota_tinggal = $_POST['kota_tinggal'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $tanggal_masuk = $_POST['tanggal_masuk'];
            $id_department = $_POST['id_department'];
            $kota_penempatan = $_POST['kota_penempatan'];

            if (validateEmployeeName($nama) && validateKtpNumber($no_ktp)) {
                $this->employee->addEmployee($nama, $no_ktp, $telp, $kota_tinggal, $tanggal_lahir, $tanggal_masuk, $id_department, $kota_penempatan);
                header('Location: index.php?entity=employee');
                exit;
            } else {
                echo "Data yang Anda masukkan tidak valid.";
            }
        }
    }

    public function delete($id)
    {
        if ($this->employee->deleteEmployee($id)) {
            header('Location: index.php?entity=employee&status=success_delete');
            exit;
        } else {
            $error = "Terjadi kesalahan saat menghapus data.";
            include '../views/department/index.php';
            exit();
        }
        exit();
    }

    public function edit($id)
    {
        $employee = $this->employee->getEmployeeById($id);
        if ($employee) {
            $departmentController = new DepartmentController($this->db);
            $departments = $departmentController->getAllDepartments();

            include '../views/employee/edit.php';
        } else {
            echo "Data karyawan tidak ditemukan.";
        }
    }

    public function update($nama, $no_ktp, $telp, $kota_tinggal, $tanggal_lahir, $tanggal_masuk, $id_department, $kota_penempatan, $id)
    {
        if (empty($id) || empty($nama) || empty($no_ktp) || empty($telp) || empty($kota_tinggal) || empty($tanggal_lahir) || empty($tanggal_masuk) || empty($id_department) || empty($kota_penempatan)) {
            $error = "Semua kolom harus diisi.";
            include '../views/employee/edit.php';
            exit;
        }

        $this->employee->updateEmployee($id, $nama, $no_ktp, $telp, $kota_tinggal, $tanggal_lahir, $tanggal_masuk, $id_department, $kota_penempatan);

        header('Location: index.php?entity=employee&status=success_update');
        exit;
    }

    public function workingPeriod()
    {
        $employees = $this->employee->getEmployeesForWorkDuration();
        include '../views/employee/masa_kerja.php';
    }

    public function exportToExcel()
    {
        require_once '../vendor/autoload.php';

        $query = "
                SELECT 
                    e.nama,
                    d.nama_department,
                    e.kota_penempatan,
                    TIMESTAMPDIFF(YEAR, e.tanggal_masuk, CURDATE()) AS tahun,
                    TIMESTAMPDIFF(MONTH, e.tanggal_masuk, CURDATE()) % 12 AS bulan,
                    CONCAT(
                        TIMESTAMPDIFF(YEAR, e.tanggal_masuk, CURDATE()), ' Thn, ',
                        TIMESTAMPDIFF(MONTH, e.tanggal_masuk, CURDATE()) % 12, ' Bulan'
                    ) AS masa_kerja
                FROM karyawan e
                JOIN department d ON e.id_department = d.id
                ORDER BY masa_kerja DESC
            ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Department');
        $sheet->setCellValue('C1', 'Kota Penempatan');
        $sheet->setCellValue('D1', 'Masa Kerja');

        $row = 2;
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $row, $employee['nama']);
            $sheet->setCellValue('B' . $row, $employee['nama_department']);
            $sheet->setCellValue('C' . $row, $employee['kota_penempatan']);
            $sheet->setCellValue('D' . $row, $employee['masa_kerja']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Masa_Kerja_Karyawan.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');


        $writer->save('php://output');
        exit();
    }

    public function reportEmployeeByDepartmentAndLocation()
    {
        $query = "
        SELECT 
            d.nama_department,
            e.kota_penempatan,
            COUNT(*) AS jumlah_karyawan
        FROM karyawan e
        JOIN department d ON e.id_department = d.id
        GROUP BY d.nama_department, e.kota_penempatan
        ORDER BY d.nama_department, e.kota_penempatan
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $reportData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cities = array_unique(array_column($reportData, 'kota_penempatan'));

        include '../views/employee/department_vs_location_report.php';
    }

    public function showBirthdayCalendar()
    {
        // Mendapatkan data ulang tahun karyawan bulan ini
        $employees = $this->employee->getBirthdaysThisMonth();

        // Menampilkan view ulang tahun karyawan
        include '../views/employee/ulang_tahun_karyawan.php';
    }
}
