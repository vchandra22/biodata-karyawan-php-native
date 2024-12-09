<?php
class Department
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // menambah department baru
    public function addDepartment($nama_department)
    {
        $sql = "SELECT * FROM department WHERE nama_department = :nama_department";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nama_department', $nama_department);
        $stmt->execute();

        // jika department sudah ada
        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            $sql = "INSERT INTO department (nama_department) VALUES (:nama_department)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nama_department', $nama_department);
            if ($stmt->execute()) {
                echo "Data berhasil ditambahkan.";
                return true;
            } else {
                echo "Gagal menambahkan data.";
                return false;
            }
        }
    }

    public function isDepartmentExists($nama_department)
    {
        $sql = "SELECT COUNT(*) FROM department WHERE nama_department = :nama_department";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nama_department', $nama_department);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // mendapatkan dedpartment berdasarkan ID
    public function getDepartmentById($id)
    {
        $sql = "SELECT * FROM department WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // mengedit department
    public function updateDepartment($id, $nama_department)
    {
        $query = "UPDATE `department` SET `nama_department` = :nama_department WHERE `department`.`id` = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_department', $nama_department);

        return $stmt->execute();
    }

    // menghapus department
    public function deleteDepartment($id)
    {
        $sql = "DELETE FROM department WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // menampilkan semua department
    public function getAllDepartments()
    {
        $sql = "SELECT * FROM department";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
