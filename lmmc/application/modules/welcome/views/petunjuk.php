
<section id="content">

    <section class="hbox stretch">
        <section class="vbox" style="background-color: white;">
            <header class="header bg-white b-b b-light">
                <section class="row m-b-md" style="">
                    <div class="col-xs-8 col-md-8 col-lg-8">
                        <?php 
                        $text = "Jalur $dataJalur->jalurNama Tahun $dataJalur->jalurTahun";
                        ?>
                        <h1 class="m-b-xs text-black hidden-xs"><small class="m-b-xs text-black">Dashboard | <span style="font-size: 13px"><?php echo $text; ?></span></small></h1>
                        <h2 class="m-b-xs text-black hidden-lg hidden-md hidden-sm"><small></small></h2>
                    </div>
                </section>
            </header>
            <section class="scrollable space padder">

                <div class="box-body">


                    <div class="row panel-body" style="">

                        <div class="col-sm-12">
                          <div class="panel b-a">

                            <div class="row m-n">
                               <div class="col-md-6 b-t b-l b-r child">
                                <a style="color: #8e9294" href="#" class="block padder-v hover">
                                    <span class="i-s i-s-2x pull-left m-r-sm">
                                        <i class="i i-hexagon2 i-s-base text-primary-lt hover-rotate" ></i>
                                        <i class="fa fa-users i-sm text-white"></i>
                                    </span>
                                    <span class="clear">
                                        <span class="h4 block m-t-xs text-primary">Peserta Beasiswa</span>
                                        <span class="h5 block m-t-xs text-primary">
                                            <small class="text-muted text-u-c" id="pesertaBeasiswa">
                                            </small>
                                        </span>
                                    </span>
                                </a>
                            </div>

                            <div class="col-md-3 b-t b-l b-r child">
                                <a style="color: #8e9294" href="#" class="block padder-v hover">
                                    <span class="i-s i-s-2x pull-left m-r-sm">
                                        <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate" ></i>
                                        <i class="fa fa-users i-sm text-white"></i>
                                    </span>
                                    <span class="clear">
                                        <span class="h4 block m-t-xs text-success">Pembayaran Lunas</span>
                                        <span class="h5 block m-t-xs text-success">
                                            <small class="text-muted text-u-c" id="pembayaranLunas">

                                            </small>
                                        </span>
                                    </span>
                                </a>
                            </div>

                            <div class="col-md-3 b-t b-l b-r child">
                                <a style="color: #8e9294" href="#" class="block padder-v hover">
                                    <span class="i-s i-s-2x pull-left m-r-sm">
                                        <i class="i i-hexagon2 i-s-base text-danger-lt hover-rotate" ></i>
                                        <i class="fa fa-users i-sm text-white"></i>
                                    </span>
                                    <span class="clear">
                                        <span class="h4 block m-t-xs text-danger">Pembayaran Belum Lunas</span>
                                        <span class="h5 block m-t-xs text-danger">
                                            <small class="text-muted text-u-c" id="pembayaranBelumLunas">

                                            </small>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="row m-n dynamic-color">

                            <?php $_color = [
                                array('rgb' => 'rgb(255, 99, 132)', 'color' => 'danger'),
                                array('rgb' => 'rgb(54, 162, 235)', 'color' => 'info'),
                                array('rgb' => 'rgb(26, 174, 136)', 'color' => 'success'),
                                array('rgb' => 'rgb(51, 122, 183)', 'color' => 'primary'),
                            ] ?>
                            <?php $_jumPeserta = 0; ?>
                            <?php foreach ($dataBiaya as $key => $value): ?>
                                <?php if (!isset($_color[$key]['color'])): ?>
                                    <?php echo $key = 0; ?>
                                <?php endif ?>
                                <div class="col-md-3 b-t b-l b-r child">
                                    <?php $_color[$key]['kategoriNama'] = $value->kategoriNama; ?>
                                    <a style="color: #8e9294" href="#" data-kategorinama="<?php echo $value->kategoriNama ?>" data-rgb="<?php echo $_color[$key]['rgb'] ?>" data-kategoriid="<?php echo $value->kategoriId ?>" class="btnDetailChart block padder-v hover">
                                        <span class="i-s i-s-2x pull-left m-r-sm"  title="Detail" data-toggle="tooltip" >
                                            <i class="i i-hexagon2 i-s-base text-<?php echo $_color[$key]['color'] ?>-lt hover-rotate" ></i>
                                            <i class="i  i-bars i-sm text-white"></i>
                                        </span>
                                        <span class="clear">
                                            <?php $_jumPeserta += $value->jumPeserta ?>
                                            <span class="h4 block m-t-xs text-<?php echo $_color[$key]['color'] ?>"><?php echo $value->kategoriNama ?></span>
                                            <span class="h5 block m-t-xs text-<?php echo $_color[$key]['color'] ?>"><i class="i i-users2"> </i><small class="text-muted text-u-c"> <?php echo number_format($value->jumPeserta,0,',','.') ?> Peserta</small></span>
                                            <span class="h5 block m-t-xs text-<?php echo $_color[$key]['color'] ?>"><i class="fa fa-money"> </i>
                                                <small class="text-muted text-u-c"> Rp. <?php echo number_format($value->biayaHarga,2,',','.') ?> Biaya Pendaftaran &nbsp;&nbsp;
                                                    <?php if ($value->biayaHarga == null): ?>
                                                        <span title="Atur Biaya Pemeriksaan" id="settingBiaya" data-toggle="tooltip" class="fa fa-cogs"></span>
                                                    <?php endif ?>
                                                </small>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            <?php endforeach ?>
                            <div class="col-md-12 b text-center">
                                <a href="#" class="block padder-v hover">

                                    <span class="clear">
                                        <span class="h4 block m-t-xs text-danger"><?php echo number_format($_jumPeserta,0,',','.') ?> Peserta</span>
                                        <small class="text-muted text-u-c">Total</small>
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="row panel-body" style="margin-bottom: 30px">

                <div class="col-sm-12">
                    <div class="panel b-a">


                     <div id="container" style="width: 100%;">
                        <div id="cover-spin"> </div>
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <br>
</section>
</section>
</section>
<span class="text-center"></span>

</section>
<style type="text/css">
    .form-control1
    {
        font-weight: bold;
    }

    #cover-spin {
        position:absolute;
        width:100%;
        left:0;right:0;top:0;bottom:0;
        background-color: rgba(255,255,255,0.6);
        z-index:9999;
        display:none;
    }

    @-webkit-keyframes spin {
        from {-webkit-transform:rotate(0deg);}
        to {-webkit-transform:rotate(360deg);}
    }

    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }

    #cover-spin::after {
        content:'';
        display:block;
        position:absolute;
        left:48%;top:40%;
        width:40px;height:40px;
        border-style:solid;
        border-color:black;
        border-top-color:transparent;
        border-width: 4px;
        border-radius:50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
</style>

<!-- <script type="text/javascript" src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/js/chart.min.js') ?>"></script>


<script type="text/javascript">
    'use strict';

    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    (function(global) {

        var COLORS = [
        '#4dc9f6',
        '#f67019',
        '#f53794',
        '#537bc4',
        '#acc236',
        '#166a8f',
        '#00a950',
        '#58595b',
        '#8549ba'
        ];

        var Samples = global.Samples || (global.Samples = {});
        var Color = global.Color;

        Samples.utils = {
            srand: function(seed) {
                this._seed = seed;
            },

            color: function(index) {
                return COLORS[index % COLORS.length];
            },

            transparentize: function(color, opacity) {
                var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                return Color(color).alpha(alpha).rgbString();
            }
        };

    // DEPRECATED
    window.randomScalingFactor = function() {
        return Math.round(Samples.utils.rand(0, 100));
    };

    // INITIALIZATION

    Samples.utils.srand(Date.now());

    // Google Analytics
    /* eslint-disable */
    if (document.location.hostname.match(/^(www\.)?chartjs\.org$/)) {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-28909194-3', 'auto');
        ga('send', 'pageview');
    }
    /* eslint-enable */

}(this));
</script>


<script type="text/javascript">
    var phpColor = <?php echo json_encode($_color); ?>;

    var color = Chart.helpers.color;
    var barChartData = [];

    setInterval(function()
    {
        reloadDetail();
        
    }, 30 * 1000);

    reloadDetail();
    function reloadDetail()
    {
        $.ajax({
            url: '<?php echo base_url('welcome') ?>/detail',
            type: 'POST',
            dataType: 'JSON',
            success: function(res)
            {
              $('#pesertaBeasiswa').html(res.pesertaBeasiswa+' Peserta');
              $('#pembayaranLunas').html(res.pembayaranLunas+' Peserta');
              $('#pembayaranBelumLunas').html(res.pembayaranBelumLunas+' Peserta');
          }
      })
    }

    window.onload = function() {
        $('.btnDetailChart:eq(0)').trigger('click');
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'horizontalBar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart'
                },
                maintainAspectRatio: false,
                // aspectRatio : 1,
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            autoSkip: false
                        }
                    }],
                    pointLabels :{
                        fontStyle: "bold",
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: '100px',
                        bottom: '100px'
                    }
                },
            }
        });

    };

    $('#cover-spin').hide();

    $(document).on('click', '#settingBiaya', function(event) {

      window.location = '<?php echo base_url('biaya') ?>'

  });

    $(document).on('click', '.btnDetailChart', function(event) {

        var kategoriNama = $(this).data('kategorinama');
        var kategoriId = $(this).data('kategoriid');
        var dsColor = $(this).data('rgb');
        $('#cover-spin').show();

        var selector = $(this);

        $.each(phpColor, function(index, val) {

            if (kategoriNama == val.kategoriNama) 
            {
                $(selector).find('i').addClass('text-'+val.color+'-lt')
                $(selector).find('span').addClass('text-'+val.color);
            }
            else
            {
                $('.dynamic-color').find('.child').find('span').removeClass('text-'+val.color)
                $('.dynamic-color').find('.child').find('i').removeClass('text-'+val.color+'-lt')
                $('.dynamic-color').find('.child').find('span').addClass('text-default')
                $('.dynamic-color').find('.child').find('i').addClass('text-default-lt')
            }
        });


        $.ajax({
            url: '<?php echo base_url('welcome') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {kategoriId: kategoriId},
            success: function(res)
            {

                var labels = [];

                barChartData.datasets = [];
                var newDataset = {
                    label: 'Jumlah Peserta',
                    backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                    borderColor: dsColor,
                    borderWidth: 1,
                    data: []
                };

                $.each(res, function(index, val) {

                    labels.push(val.prodiJjarKode+' - '+val.prodiNamaResmi+` (`+val.jumPeserta+`)`);
                    newDataset.data.push(val.jumPeserta);

                });

                barChartData.labels = labels;
                barChartData.datasets.push(newDataset);

                var pixel =  (30 * labels.length) + 200 ;
                $('#container').css('height', pixel+'px');

                myBar.options.title.text = kategoriNama;

                window.myBar.update();
                $('#cover-spin').fadeOut(200);
            }
        })


        
    });

    var colorNames = Object.keys(window.chartColors);


</script>
