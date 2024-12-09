<?php
$title = 'Daftar Department';

include '../views/layout/header.php';
?>

<section class="container mx-auto">
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success_delete') : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Department berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="text-start fw-bold"><?php echo $title; ?></h1>
        <a href="index.php?entity=department&add=true" class="btn btn-success">
            Tambah Department
        </a>
    </div>

    <table class="table table-hover border">
        <thead class="text-center">
            <tr>
                <th>Nama Department</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            <?php if (!empty($departments)) : ?>
                <?php foreach ($departments as $department) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($department['nama_department']); ?></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?entity=department&edit=<?php echo urlencode($department['id']); ?>">Edit</a>
                            <form action="index.php?entity=department" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($department['id']); ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">Tidak ada data department.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
// Include footer
include '../views/layout/footer.php';
?>