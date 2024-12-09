<?php

class Employee
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllEmployees()
    {
        // Query untuk mengambil data karyawan dan nama departemen terkait
        $query = "SELECT karyawan.*, department.nama_department 
                FROM karyawan
                JOIN department ON karyawan.id_department = department.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getEmployeeById($id)
    {
        $query = "SELECT * FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function generateEmployeeId()
    {
        $year = date('y');
        $month = date('m');

        $query = "SELECT id FROM karyawan WHERE id LIKE ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$year . $month . '%']);

        $lastId = $stmt->fetchColumn();

        $lastNumber = 0;
        if ($lastId) {
            $lastNumber = (int) substr($lastId, 4);
        }

        $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);

        return $year . $month . $newNumber;
    }

    public function addEmployee($nama, $no_ktp, $telp, $kota_tinggal, $tanggal_lahir, $tanggal_masuk, $id_department, $kota_penempatan)
    {
        try {
            $employeeId = $this->generateEmployeeId();

            $sql = "INSERT INTO karyawan 
            (id, nama, no_ktp, telp, kota_tinggal, tanggal_lahir, tanggal_masuk, id_department, kota_penempatan) 
            VALUES 
            (:employeeId, :nama, :no_ktp, :telp, :kota_tinggal, :tanggal_lahir, :tanggal_masuk, :id_department, :kota_penempatan)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':employeeId', $employeeId);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_ktp', $no_ktp);
            $stmt->bindParam(':telp', $telp);
            $stmt->bindParam(':kota_tinggal', $kota_tinggal);
            $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
            $stmt->bindParam(':tanggal_masuk', $tanggal_masuk);
            $stmt->bindParam(':id_department', $id_department);
            $stmt->bindParam(':kota_penempatan', $kota_penempatan);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error: " . implode(", ", $stmt->errorInfo()));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo "An error occurred while adding the employee. Please try again later.";
            return false;
        }
    }


    public function deleteEmployee($id)
    {
        $sql = "DELETE FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEmployee($id, $nama, $no_ktp, $telp, $kota_tinggal, $tanggal_lahir, $tanggal_masuk, $id_department, $kota_penempatan)
    {
        $query = "UPDATE `karyawan` SET `nama` = :nama, `no_ktp` = :no_ktp, `telp` = :telp, `kota_tinggal` = :kota_tinggal, `tanggal_lahir` = :tanggal_lahir, `tanggal_masuk` = :tanggal_masuk, `id_department` = :id_department, `kota_penempatan` = :kota_penempatan WHERE `karyawan`.`id` = :id;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':no_ktp', $no_ktp);
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':kota_tinggal', $kota_tinggal);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':tanggal_masuk', $tanggal_masuk);
        $stmt->bindParam(':id_department', $id_department);
        $stmt->bindParam(':kota_penempatan', $kota_penempatan);

        return $stmt->execute();
    }

    public function getEmployeesForWorkDuration()
    {
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

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBirthdaysThisMonth()
    {
        $query = "
            SELECT nama, telp, department.nama_department, DATE_FORMAT(tanggal_lahir, '%d-%m') AS tanggal_lahir
            FROM karyawan
            JOIN department ON karyawan.id_department = department.id
            WHERE MONTH(tanggal_lahir) = MONTH(CURDATE())
            ORDER BY DAY(tanggal_lahir)
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
