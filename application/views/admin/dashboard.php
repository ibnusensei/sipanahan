<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Anggota</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash"><canvas width="67" height="30"
                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                    </div>
                </li>
                <li class="ms-auto"><span class="counter text-success"><?= $user->num_rows() ?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Team</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash2"><canvas width="67" height="30"
                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                    </div>
                </li>
                <li class="ms-auto"><span class="counter text-purple"><?= $team->num_rows() ?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Pelatih</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash3"><canvas width="67" height="30"
                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                    </div>
                </li>
                <li class="ms-auto"><span class="counter text-info"><?= $pelatih->num_rows() ?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <canvas id="myChart"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="prestasiPerTahun"></canvas>
    </div>
    <div class="col-md-6 d-none">
        <canvas id="test"></canvas>
    </div>
</div>

<?php
    //Inisialisasi nilai variabel awal
    $tim= "";
    $jumlah=null;
    foreach ($userPerTim as $item)
    {
        $t=$item->tim;
        $tim .= "'$t'". ", ";

        $jum=$item->total;
        $jumlah .= "$jum". ", ";
    }
?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $tim; ?>],
            datasets: [{
                label:'Data Anggota Per Team ',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        max: 20
                    }
                }]
            }
        }
    });
</script>

<?php
    //Inisialisasi nilai variabel awal
    $tanggal= "";
    $jumlah=null;
    foreach ($prestasiPerTahun as $item)
    {
        $t = date('F Y', strtotime($item->tanggal));
        $tanggal .= "'$t'". ", ";

        $jum = $item->total;
        $jumlah .= "$jum". ", ";
    }
?>
<script>
    var ctx = document.getElementById('prestasiPerTahun').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $tanggal; ?>],
            datasets: [{
                label:'Data Prestasi Perbulan ',
                backgroundColor: ['#ffadad', '#ffd6a5', '#fdffb6','#caffbf', '#9bf6ff', '#a0c4ff', '#bdb2ff', '#ffc6ff'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>

<script>

    var ctx = document.getElementById('test').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'radar',
        // The data for our dataset
        data: {
            labels: [
            'Stance',
            'Nocking',
            'Set Up',
            'Drawing',
            'Anchoring',
            'Holding',
            'Aiming',
            'Release',
            'Follow Through'
          ],
          datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 90, 81, 56, 55, 40],
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
          }]
        },
        // Configuration options go here
        options: {
            elements: {
            line: {
                borderWidth: 3
            }
            }
        },
    });
</script>