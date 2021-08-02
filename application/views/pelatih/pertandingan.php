<!-- ========================================================== -->
<!-- Three charts -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title">Daftar <?= $title ?></h3>
                    <p class="text-muted">Sistem Informasi Atlet Panahan Banjarmasin</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Tanggal & Waktu</th>
                            <th class="border-top-0">Pertandingan</th>
                            <th class="border-top-0">Tingkat</th>
                            <th class="border-top-0">Pelatih</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pertandingan as $x => $data):?>
                        <tr>
                            <td><?= $x+1 ?></td>
                            <td><?= longdate_indo($data->tanggal) ?> <br> <?= $data->waktu ?></td>
                            <td><?= $data->tempat ?></td>
                            <td><?= $tingkat[$data->tingkat - 1] ?></td>
                            <td><?= $data->nama ?></td>  
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  



<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });


</script>

