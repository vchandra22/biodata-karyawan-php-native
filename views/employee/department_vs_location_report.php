<?php
$title = 'Karyawan VS Department';
include '../views/layout/header.php';
?>

<section class="container mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department</th>
                <?php foreach ($cities as $city) : ?>
                    <th><?php echo htmlspecialchars($city); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $departments = array_unique(array_column($reportData, 'nama_department'));
            foreach ($departments as $department) :
                $cityCounts = [];
                foreach ($cities as $city) {
                    $cityCounts[$city] = 0;
                }

                foreach ($reportData as $row) :
                    if ($row['nama_department'] === $department) {
                        $cityCounts[$row['kota_penempatan']] = $row['jumlah_karyawan'];
                    }
                endforeach;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($department); ?></td>
                    <?php foreach ($cities as $city) : ?>
                        <td><?php echo $cityCounts[$city]; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php
include '../views/layout/footer.php';
?>