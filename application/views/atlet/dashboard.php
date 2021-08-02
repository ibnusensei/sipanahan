<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="white-box analytics-info">
            <h3 class="box-title">Penilaian</h3>
            <canvas id="nilai"></canvas>
        </div>
    </div>
    <div class=" row col-md-6">
        <div class="col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Prestasi</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-success"><?= $prestasi->num_rows() ?></span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Kehadiran</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash2"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-purple"><?= $kehadiran->num_rows() ?> / <?= $latihan->num_rows() ?></span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Bonus</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash3"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-info"><?= rupiah($bonus) ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
    $this->load->model(['m_app']);
    $nilai = $this->m_app->getPenilaian($this->session->id)->row();
?>
<?php $total = $nilai->n1 .','. $nilai->n2 .','. $nilai->n3 .','. $nilai->n4 .','. $nilai->n5 .','. $nilai->n6 .','. $nilai->n7 .','. $nilai->n8 .','. $nilai->n9 ?>
<script>
    var ctx = document.getElementById('nilai').getContext('2d');
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
            label: 'Penilaian',
            data: [<?= $total ?>],
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
            scales: {
            ticks: {
            beginAtZero: true,
            min: 0,
            max: 100,
            stepSize: 20
            },
        },
            elements: {
            line: {
                borderWidth: 3
            }
            }
        },
    });
</script>