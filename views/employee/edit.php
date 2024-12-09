<?php
$title = 'Edit Karyawan';

include '../views/layout/header.php';
?>

<div class="container mx-auto">
    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
        <div>
            <a class="btn btn-warning" href="index.php?entity=employee">Kembali</a>
        </div>
    </div>

    <?php if (isset($error)) : ?>
        <div class="error" style="color: red; margin-bottom: 10px;">
            <p><?php echo $error; ?></p>
        </div>
    <?php endif; ?>

    <div class="mb-5">
        <form action="index.php?entity=employee&edit=<?php echo $id; ?>" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id_karyawan" value="<?php echo htmlspecialchars($employee['id']); ?>">

            <!-- Hidden fields for data that cannot be changed -->
            <input type="hidden" name="nama" value="<?php echo htmlspecialchars($employee['nama']); ?>">
            <input type="hidden" name="no_ktp" value="<?php echo htmlspecialchars($employee['no_ktp']); ?>">
            <input type="hidden" name="tanggal_masuk" value="<?php echo htmlspecialchars($employee['tanggal_masuk']); ?>">

            <div class="mb-3">
                <label class="form-label my-3" for="nama">Nama Karyawan:</label>
                <input class="form-control" type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($employee['nama']); ?>" disabled>

                <label class="form-label my-3" for="no_ktp">No KTP:</label>
                <input class="form-control" type="text" id="no_ktp" name="no_ktp" value="<?php echo htmlspecialchars($employee['no_ktp']); ?>" disabled>

                <label class="form-label my-3" for="telp">Nomor Tlp:</label>
                <input class="form-control" type="text" id="telp" name="telp" value="<?php echo htmlspecialchars($employee['telp']); ?>" required>

                <label class="form-label my-3" for="kota_tinggal">Kota Tinggal:</label>
                <input class="form-control" type="text" id="kota_tinggal" name="kota_tinggal" value="<?php echo htmlspecialchars($employee['kota_tinggal']); ?>" required>

                <div class="mb-3">
                    <label class="form-label my-3" for="id_department">Department:</label>
                    <select class="form-select" id="id_department" name="id_department" required>
                        <option value="">Pilih Department</option>
                        <?php foreach ($departments as $department) : ?>
                            <option value="<?php echo $department['id']; ?>"
                                <?php echo $department['id'] == $employee['id_department'] ? 'selected' : ''; ?>>
                                <?php echo $department['nama_department']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label class="form-label my-3" for="tanggal_lahir">Tanggal Lahir:</label>
                <input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($employee['tanggal_lahir']); ?>" required>

                <label class="form-label my-3" for="tanggal_masuk">Tanggal Masuk:</label>
                <input class="form-control" type="date" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo htmlspecialchars($employee['tanggal_masuk']); ?>" disabled>

                <label class="form-label my-3" for="kota_penempatan">Kota Penempatan:</label>
                <input class="form-control" type="text" id="kota_penempatan" name="kota_penempatan" value="<?php echo htmlspecialchars($employee['kota_penempatan']); ?>" required>
            </div>

            <button class="btn btn-primary mt-3" type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>

<?php
include '../views/layout/footer.php';
?>