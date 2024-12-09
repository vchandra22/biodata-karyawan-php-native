<?php
$title = 'Kalender Ulang Tahun Karyawan';
include '../views/layout/header.php';
?>

<div class="container mt-5">
    <h1 class="text-start fw-bold mb-4">Kalender Ulang Tahun Karyawan</h1>

    <?php
    $birthdays = [];
    foreach ($employees as $employee) {
        $birthdays[$employee['tanggal_lahir']][] = [
            'nama' => $employee['nama'],
            'department' => $employee['nama_department'],
            'telp' => $employee['telp']
        ];
    }

    // Menentukan bulan dan tahun sekarang
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Menentukan jumlah hari dalam bulan tersebut
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

    // Nama bulan
    $monthName = date('F', strtotime("$currentYear-$currentMonth-01"));
    ?>

    <h3 class="text-start"><?php echo $monthName . ' ' . $currentYear; ?></h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">Sen</th>
                <th class="text-center">Sel</th>
                <th class="text-center">Rab</th>
                <th class="text-center">Kam</th>
                <th class="text-center">Jum</th>
                <th class="text-center">Sab</th>
                <th class="text-center">Min</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dayOfWeek = date('w', strtotime("$currentYear-$currentMonth-01"));

            if ($dayOfWeek == 0) {
                $dayOfWeek = 7;
            }

            $currentDay = 1;

            for ($week = 0; $week < 6; $week++) :
                echo '<tr>';

                // Looping untuk setiap hari dalam minggu
                for ($day = 1; $day <= 7; $day++) :
                    if ($week == 0 && $day < $dayOfWeek) {
                        echo '<td></td>';
                    } else {
                        if ($currentDay <= $daysInMonth) {
                            $date = sprintf("%02d-%02d", $currentDay, $currentMonth);
                            echo '<td class="text-center fs-3 pb-3';

                            // Menandai tanggal yang memiliki ulang tahun dengan warna hijau
                            if (isset($birthdays[$date])) {
                                echo ' bg-success text-white" data-bs-toggle="click" data-date="' . $date . '">';
                                echo $currentDay;
                                foreach ($birthdays[$date] as $employee) {
                                    echo '<br>';
                                    echo '<span class="pe-auto fs-6">' . $employee['nama'] . '</span><br>';
                                }
                            } else {
                                echo '"> ' . $currentDay;
                            }

                            echo '</td>';
                            $currentDay++;
                        } else {
                            echo '<td></td>';
                        }
                    }
                endfor;

                echo '</tr>';
            endfor;
            ?>
        </tbody>
    </table>

    <div id="birthdayDetails" class="my-5"></div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var birthdayDetailsContainer = document.getElementById('birthdayDetails');
        var links = document.querySelectorAll('td[data-date]');

        links.forEach(function(link) {
            link.addEventListener('click', function() {
                var date = this.getAttribute('data-date');
                var employees = <?php echo json_encode($birthdays); ?>;

                if (employees[date]) {
                    var employeeList = employees[date];
                    var detailsHtml = '<h4>Ulang Tahun pada ' + date + '</h4><ul class="list-group">';

                    employeeList.forEach(function(employee) {
                        detailsHtml += '<li class="list-group-item">';
                        detailsHtml += '<strong>Nama:</strong> ' + employee.nama + '<br>';
                        detailsHtml += '<strong>Department:</strong> ' + employee.department + '<br>';
                        detailsHtml += '<strong>Telepon:</strong> ' + employee.telp;
                        detailsHtml += '</li>';
                    });

                    detailsHtml += '</ul>';
                    birthdayDetailsContainer.innerHTML = detailsHtml;
                } else {
                    birthdayDetailsContainer.innerHTML = '';
                }
            });
        });
    });
</script>

<?php
include '../views/layout/footer.php';
?>