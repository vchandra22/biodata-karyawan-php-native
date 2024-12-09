<?php
$title = 'Tambah Department';

include '../views/layout/header.php';
?>


<div class="container mx-auto">
    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
        <div>
            <a class="btn btn-warning" href="index.php">Kembali</a>
        </div>
    </div>

    <form action="index.php?entity=department" method="POST">
        <div class="mb-3">
            <label class="form-label" for="nama_department">Nama Department:</label>
            <input class="form-control" type="text" id="nama_department" name="nama_department" required maxlength="15">

            <?php if (isset($error)) : ?>
                <div class="error" style="color: red; margin-bottom: 10px;">
                    <p><?php echo $error; ?></p>
                </div>
            <?php endif; ?>
        </div>
        <button class="btn btn-primary mt-1" type="submit">Simpan</button>
    </form>
</div>

<?php
include '../views/layout/footer.php';
?>