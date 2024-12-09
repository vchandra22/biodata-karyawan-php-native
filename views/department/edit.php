<?php
$title = 'Edit Department';

include '../views/layout/header.php';
?>

<div class="container mx-auto">
    <div class="d-flex justify-content-between align-items-center mt-3">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
        <div>
            <a class="btn btn-warning" href="index.php?entity=department">Kembali</a>
        </div>
    </div>

    <?php echo $id; ?>
    <form action="index.php?entity=department&edit=<?php echo $id; ?>" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id_department" value="<?php echo htmlspecialchars($department['id']); ?>">

        <div class="mb-3">
            <label class="form-label" for="nama_department">Nama Department:</label>
            <input class="form-control" type="text" id="nama_department" name="nama_department"
                value="<?php echo htmlspecialchars($department['nama_department']); ?>" required maxlength="15">

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </div>
        <button class="btn btn-primary mt-1" type="submit">Simpan</button>
    </form>

</div>

<?php
include '../views/layout/footer.php';
?>