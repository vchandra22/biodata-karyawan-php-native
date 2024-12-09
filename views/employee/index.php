<?php
$title = 'Daftar Karyawan';
include '../views/layout/header.php';
?>

<section class="container mx-auto mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
        <a href="index.php?entity=employee&add=true" class="btn btn-success">Tambah Data Karyawan</a>
    </div>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'success_delete') : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Department berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-hover border">
        <thead class="ext-start align-middle">
            <tr>
                <th>ID Karyawan</th>
                <th>Nama</th>
                <th>No. KTP</th>
                <th>Telp</th>
                <th>Kota Tinggal</th>
                <th>Tanggal Lahir</th>
                <th>Tanggal Masuk</th>
                <th>Department</th>
                <th>Kota Penempatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-start align-middle">
            <?php if (!empty($employees)) : ?>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['id']); ?></td>
                        <td><?php echo htmlspecialchars($employee['nama']); ?></td>
                        <td><?php echo htmlspecialchars($employee['no_ktp']); ?></td>
                        <td><?php echo htmlspecialchars($employee['telp']); ?></td>
                        <td><?php echo htmlspecialchars($employee['kota_tinggal']); ?></td>
                        <td><?php echo htmlspecialchars($employee['tanggal_lahir']); ?></td>
                        <td><?php echo htmlspecialchars($employee['tanggal_masuk']); ?></td>
                        <td><?php echo htmlspecialchars($employee['nama_department']); ?></td>
                        <td><?php echo htmlspecialchars($employee['kota_penempatan']); ?></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?entity=employee&edit=true&id=<?php echo $employee['id']; ?>">Edit</a>
                            <form action="index.php?entity=employee" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="10">Tidak ada data karyawan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
include '../views/layout/footer.php';
?>