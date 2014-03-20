<script src="<?= base_url('assets/highchart/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/highchart/themes/grid.js') ?>"></script>
<script type="text/javascript">
$(function(){
  get_data_series('admin/get_total_pengunjung','visitor');
});

function redirect(url){
  location.href = '<?= base_url() ?>/'+url;
}

function get_data_series(url, chart){
      $.ajax({
          url: '<?= base_url("'+url+'") ?>',
          dataType: 'json',
          success: function(data) {
              if (chart === 'visitor') {
                   draw_line_chart(data);
              }
          }
      });
  }

  function draw_line_chart(data){
        $('#visitor').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            exporting: {
                enabled: false
            },
            xAxis: {
                categories: data.tanggal
            },
            yAxis:{
                title: {
                    text: 'Jumlah'
                }
            },
            title: {
                text: 'Grafik Pengunjung'
            },
            tooltip: {
                pointFormat: '{point.y} pengunjung'
            },
            series: [{
                type: 'spline',
                name : 'Pasien',
                data: data.jumlah
            }]
        });
    }
</script>

 <div class="row"> 
    <div class="col-lg-8"><div id="visitor"></div></div>
    <div class="col-lg-4">
       <div class="row">
          <div class="col-lg-6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-12">
                    <i class="fa fa-building-o fa-5x"></i>
                  </div>
                  <div class="col-xs-12 text-right">
                    <p class="announcement-heading"><?= $total_museum ?></p>
                    <p class="announcement-text">Museum</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6" onclick="redirect('admin/museum')">
                      Lihat Data Museum
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-12">
                    <i class="fa fa-archive fa-5x"></i>
                  </div>
                  <div class="col-xs-12 text-right">
                    <p class="announcement-heading"><?= $total_artikel ?></p>
                    <p class="announcement-text">Artikel</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6" onclick="redirect('admin/artikel')">
                      Lihat Semua Artikel
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>

        </div><!-- /.row -->
    </div>

 </div>

<br/><br/>
  <div class="row">
    <div class="col-lg-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Artikel Yang Sering Dikunjungi</h3>
        </div>
        <div class="panel-body">
          <div class="list-group">
            <?php foreach ($artikel_populer as $key => $value):?>
            <a class="list-group-item">
              <span class="badge"><?= $value->hit ?> view</span>
              <i class="fa fa-archive"></i> <?= $value->judul ?>
            </a>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Museum Yang Sering Dikunjungi</h3>
        </div>
        <div class="panel-body">
          <?php foreach ($museum_populer as $key => $value):?>
            <a class="list-group-item">
              <span class="badge"><?= $value->hit ?> view</span>
              <i class="fa fa-archive"></i> <?= $value->nama ?>
            </a>
            <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div><!-- /.row -->

