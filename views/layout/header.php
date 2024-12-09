<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <title><?php echo $title ?? 'Halaman'; ?></title>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom mb-3 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-danger fw-bold" href="index.php" style="font-size: 32px;">PT. Indoprima Gemilang</a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto aligns items to the right -->
                    <li class="nav-item">
                        <a class="nav-link px-3 text-white" href="index.php?entity=employee">Data Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 text-white" href="index.php?entity=department">Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 text-white" href="index.php?entity=employee&working_period">Masa Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 text-white" href="index.php?entity=employee&department_vs_location_report">Karyawan VS Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 text-white" href="index.php?entity=employee&birthday_report">Hari Ulang Tahun Karyawan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>