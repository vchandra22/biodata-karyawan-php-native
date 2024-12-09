<?php
$title = 'Masa Kerja Karyawan';
include '../views/layout/header.php';
?>

<section class="container mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
        <a href="index.php?entity=employee&export_excel=true" class="btn btn-primary mb-3">Export to Excel</a>
    </div>


    <table class="table table-hover border">
        <thead class="ext-start align-middle">
            <tr>
                <th>Nama</th>
                <th>Department</th>
                <th>Kota Penempatan</th>
                <th>Masa Kerja</th>
            </tr>
        </thead>
        <tbody class="text-start align-middle">
            <?php if (!empty($employees)) : ?>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['nama']); ?></td>
                        <td><?php echo htmlspecialchars($employee['nama_department']); ?></td>
                        <td><?php echo htmlspecialchars($employee['kota_penempatan']); ?></td>
                        <td><?php echo htmlspecialchars($employee['masa_kerja']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Tidak ada data karyawan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
include '../views/layout/footer.php';
?>