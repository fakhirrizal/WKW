<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- Start your project here-->  
<div id="cssload">
  <span class="loader">
    <span class="loader-inner"></span>
  </span>
  </div>
  <img src="<?= base_url(); ?>/assets/img/other/banner-kependudukan.png" class="img-fluid w-100" alt="">
  <div class="container">
    <h5 class="card-title p-3 border-bottom border-success">Data Kependudukan</h5>
    <div class="text-left">
      <span class="badge badge-default ">TAHUN 2020</span>
    </div>
    <h6 class="card-title pt-3">Berdasarkan Usia</h6>
    <div class="card p-2">
      <table class="table table-sm table-borderless table-hover">
        <tbody>
          <tr>
            <th class="align-middle w-10" scope="row">20%</th>
            <td><img src="<?= base_url(); ?>/assets/img/other/usia1.png" class="w-50" alt=""></td>
            <td class="align-middle w-60">berusia di bawah 15 tahun</td>
          </tr>
          <tr>
            <th class="align-middle w-10" scope="row">72%</th>
            <td><img src="<?= base_url(); ?>/assets/img/other/usia2.png" class="w-50" alt=""></td>
            <td class="align-middle w-60">berusia antara 15-65 tahun</td>
          </tr>
          <tr>
            <th class="align-middle w-10" scope="row">8%</th>
            <td><img src="<?= base_url(); ?>/assets/img/other/usia3.png" class="w-50" alt=""></td>
            <td class="align-middle w-60">berusia di atas 65 tahun</td>
          </tr>
        </tbody>
      </table>
    </div>
    <h6 class="card-title mt-3">Berdasarkan Jenis Kelamin</h6>
    <div class="card">
      <figure class="highcharts-figure">
          <div id="kelamin"></div>
      </figure>
      <h6 class="card-title pl-3">Total : 877.730 Jiwa</h6>
    </div>

    <h6 class="card-title mt-3">Berdasarkan Kelompok Usia</h6>
    <div class="card">
      <figure class="highcharts-figure">
          <div id="usia"></div>
      </figure>
    </div>
  </div>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript">
    Highcharts.chart('kelamin', {
      chart: {
          type: 'bar'
      },
      title: {
          text: ''
      },
      subtitle: {
          text: ''
      },
      xAxis: {
          categories: ['Penduduk'],
          title: {
              text: null
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: '(dalam ratusan ribu)',
              align: 'high'
          },
          labels: {
              overflow: 'justify'
          }
      },
      tooltip: {
          valueSuffix: ' jiwa'
      },
      plotOptions: {
          bar: {
              dataLabels: {
                  enabled: true
              }
          }
      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: 0,
          y: 5,
          floating: true,
          borderWidth: 1,
          backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
          shadow: true
      },
      credits: {
          enabled: false
      },
      series: [{
          name: 'Laki-Laki',
          data: [456.454]
      }, {
          name: 'Perempuan',
          data: [421.276]
      }]
    });
  </script>
  <script type="text/javascript">
    Highcharts.chart('usia', {
      chart: {
          type: 'bar'
      },
      title: {
          text: ''
      },
      subtitle: {
          text: ''
      },
      xAxis: {
          categories: ['0-15', '15-25', '25-35', '35-45', '45-55', '55-65', '>65'],
          title: {
              text: null
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Penduduk',
              align: 'high'
          },
          labels: {
              overflow: 'justify'
          }
      },
      tooltip: {
          valueSuffix: ' jiwa'
      },
      plotOptions: {
          bar: {
              dataLabels: {
                  enabled: true
              }
          }
      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: 0,
          y: 250,
          floating: true,
          borderWidth: 1,
          backgroundColor:
              Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
          shadow: true
      },
      credits: {
          enabled: false
      },
      series: [{
          name: 'Laki-Laki',
          data: [65, 87, 71, 81, 76, 61, 52]
      }, {
          name: 'Perempuan',
          data: [72, 53, 65, 45, 35, 56, 47]
      }]
    });
  </script>