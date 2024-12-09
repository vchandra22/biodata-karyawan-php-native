<?php
require_once '../config/database.php';
require_once '../models/Department.php';
require_once '../helpers/validation.php';

class DepartmentController
{
    private $db;
    private $department;

    public function __construct($db)
    {
        $this->db = $db;
        $this->department = new Department($db);
    }

    // fungsi untuk menambah department baru
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_department = trim($_POST['nama_department']);

            // Validasi format nama department
            if (!validateDepartmentName($nama_department)) {
                $error = "Nama department tidak valid. Harus diisi dan maksimal 15 karakter.";
                include '../views/department/add.php';
                exit();
            }

            // Validasi jika nama department sudah ada
            if ($this->department->isDepartmentExists($nama_department)) {
                $error = "Department dengan nama tersebut sudah ada.";
                include '../views/department/add.php';
                exit();
            } else {
                if ($this->department->addDepartment($nama_department)) {
                    header("Location: index.php?entity=department&status=success_add");
                    exit();
                } else {
                    header("Location: index.php?status=error_add");
                    exit();
                }
            }
        } else {
            include '../views/department/add.php';
        }
    }

    // mendapatkan department berdasarkan ID
    public function getDepartmentById($id)
    {
        return $this->department->getDepartmentById($id); // Ambil data department berdasarkan ID
    }

    public function edit($id)
    {
        // Fetch the department data
        $department = $this->department->getDepartmentById($id);

        if ($department) {
            include '../views/department/edit.php';
        } else {
            echo "Department with ID $id not found.";
        }
    }


    // fungsi untuk mengedit department
    public function update($id, $nama_department)
    {
        $nama_department = trim($nama_department);

        // Validasi nama department
        if (empty($nama_department) || strlen($nama_department) > 15) {
            $error = "Nama department tidak valid. Harus diisi dan maksimal 15 karakter.";
            include '../views/department/edit.php';  // Kembali ke halaman edit dengan error
            exit();
        }

        // Cek apakah nama department sudah ada
        if ($this->department->isDepartmentExists($nama_department, $id)) {
            $error = "Department dengan nama tersebut sudah ada.";
            include '../views/department/edit.php';  // Kembali ke halaman edit dengan error
            exit();
        }

        // Perbarui data department
        $this->department->updateDepartment($id, $nama_department);

        header("Location: index.php?entity=department&status=success_update");
        exit();
    }

    // fungsi untuk menghapus department
    public function delete($id)
    {
        if ($this->department->deleteDepartment($id)) {
            header("Location: index.php?entity=department&status=success_delete");
            exit();
        } else {
            $error = "Terjadi kesalahan saat menghapus data.";
            include '../views/department/index.php';
            exit();
        }
        exit();
    }

    // fungsi untuk menampilkan semua department
    public function getAll()
    {
        $departments = $this->department->getAllDepartments();
        include '../views/department/index.php';
    }

    public function getAllDepartments()
    {
        $query = "SELECT * FROM department";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
