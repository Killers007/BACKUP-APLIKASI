<div class="arlo_tm_section">
    <div class="arlo_tm_progress_wrap">
        <div class="container">
            <div class="arlo_title_holder">
                    <h3>Hasil Pemeriksaan</h3>
                </div>
                <br>
                <br>
                <br>
            <div class="progress_wrap_inner">
                <div class="left wow fadeInLeft" data-wow-duration="0.8s" style="visibility: visible; animation-duration: 0.8s; animation-name: fadeInLeft;">
                    <div class="main_title">
                        <h3>Fee Dokter</h3>
                    </div>
                    <div class="text">
                        <p>Insentif (Fee) Dokter disini merupakan biaya yang diterima dokter pemeriksa berdasarkan jumlah peserta yang diperiksanya.</p>
                    </div>
                </div>
                <div class="right wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.8s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <div class="arlo_progress">
                        <?php foreach ($jadwal as $key => $value): ?>
                        <?php $_percent = @($value->jum_hasil / $value->jum_peserta) * 100; ?>
                        <div class="progress_inner" data-value="95" data-color="#ff4b36">
                            <span><span class="label">Klinik <?php echo $value->klinikNama ?></span><span class="number"><?php echo number_format($value->jum_hasil) ?> / <?php echo number_format($value->jum_peserta) ?> Peserta</span></span>
                            <div class="background"><div class="bar open"><div class="bar_in" style="width: <?php echo $_percent ?>%; background-color: rgb(255, 75, 54);"></div></div></div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>