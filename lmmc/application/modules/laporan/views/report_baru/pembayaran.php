

<html>
<head><title>Laporan Pembayaran dan Asuransi Kesehatan</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<style>
		body {font-family: 'Roboto';font-size: 7px;}
		.info{font-size:12px;}
		html {font-family: verdana,arial,sans-serif;font-size:11px;}
		.gridtable {font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;}
		.gridtable th, .gridtable tr {border-width: 1px;padding: 15px;border-style: solid;border-color: #666666;}
		.gridtable td, .gridtable th {border-width: 1px;	padding: 10px;border-style: solid;border-color: #666666;}
		table.header {font-size:11px;color:#333333;border-width: 0px;border-color: #666666;border-collapse: collapse;}
		table.header th {border-width: 0px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;}
		table.header td {border-width: 0px;padding: 8px;border-style: solid;border-color: #666666;background-color: #ffffff;}
		.tidak_hadir{
			background-color: antiquewhite;
			-webkit-print-color-adjust: exact;
		}
		.nafza_positif{
			background-color: aliceblue;
			-webkit-print-color-adjust: exact;
		}
		#keterangan{
			font-size: small;
		}
		.h1{
			font-size:22px;font-weight:bold;margin-top:-12px;margin-top:1px;
		}
		.h2
		{
			font-size:16px;font-weight:bold;margin-top:0px;
		}
		.biayaGrid {font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;}
		.biayaGrid th, .biayaGrid tr {border-width: 0px;padding: 15px;border-style: solid;border-color: #666666;}
		.biayaGrid td, .biayaGrid th {border-width: 0px;	padding: 10px;border-style: solid;border-color: #666666;}
		page[size='A4'] {
			background: white;
			width: 21cm;
			height: 28.7cm;
			display: block;
			margin: 0 auto;
			padding-left: 25px;
			padding-right: 25px;
			padding-top: 25px;
			margin-bottom: 0.5cm;
			border:1px solid #dadada
		}
		media print {
			body, page[size='A4'] {
				margin: 0;
				padding-left: 0px;
				padding-right: 0px;
				border:0px
			}
		}
	}
</style>
</head>
<body >


		
		<?php $_length = 25; $_end = false; ?>
		<?php $_jumProdi = ceil(count($datas)/$_length) ?>
		<?php $_biayaAll = 0 ?>
		<?php $_biayaLunas = 0 ?>
		<?php $_biayaBelumLunas = 0 ?>
		
		<?php for ($i = 0; $i < $_jumProdi ; $i++){ ?>
		<page <?php //echo "size='A4'" ?>>
			<table class='header' width="100%">
				<tr align="center">
					<td>
						<b class='h1'>LAPORAN PEMBAYARAN DAN ASURANSI KESEHATAN JALUR <?php echo strtoupper($dataJalur->jalurNama) ?></b><br>
						<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>MAHASISWA BARU UNIVERSITAS LAMBUNG MANGKURAT</b><br>
						<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>TAHUN <?php echo $dataJalur->jalurTahun ?></b><br>
					</tr>
				</table>
				<hr>
				<br>

				<div id=clone-krs>
					<div id=box_khs_table>
						<table id=krs_table class="table table-bordered table-hover gridtable" style="width: 100%;font-size:11px;margin-top:15px;padding:0px" border=1>
							<thead>
								<tr>
									<th style="vertical-align: middle" width="1%">No</th>
									<th style="vertical-align: middle">Nomor Peserta</th>
									<th style="vertical-align: middle">Nama Peserta</th>
									<th style="vertical-align: middle">Program Studi</th>
									<th style="vertical-align: middle">Biaya</th>
									<th style="vertical-align: middle">Status</th>
									<th style="vertical-align: middle">Asuransi Kesehatan</th>
								</tr>

							</thead>
							<tbody>
								<?php foreach ($datas as $key => $value): ?>
									<?php if ($key >= 0 + ($_length * $i) && $key < $_length + ($_length * $i)): ?>

										<?php ($value->tagihanIslunas)?$_biayaLunas += $value->tagihanBiaya:$_biayaBelumLunas += $value->tagihanBiaya; ?>
										<?php $_biayaAll += $value->tagihanBiaya; ?>
										<tr>
											<td align="center"><?php echo ($key +1) ?></td>
											<td><?php echo $value->tagihanNoRegis ?></td>
											<td><?php echo $value->tagihanPesertaNama ?></td>
											<td><?php echo $value->tagihanProdiNama ?></td>
											<td><?php echo 'Rp. '.number_format($value->tagihanBiaya) ?></td>
											<td><?php echo ($value->tagihanIslunas)?'<span class="label label-success">Lunas</span>':'<span class="label label-danger">Belum Lunas</span>' ?></td>
											<td align="center">
												<?php if ($value->pesertaIsBpjs): ?>
													BPJS
												<?php else: ?>
													Tidak Bersedia
												<?php endif ?>
													
											</td>
										</tr>
									<?php endif ?>

									<?php endforeach ?>
									<?php if ($i == $_jumProdi - 1): ?>
										<?php $_end = true; ?>
									<?php endif ?>
								</tbody>

							</table>
						</div>
					</div>  
					<br><br>
						
					<?php if ($_end): ?>
						<h1><b>Total Biaya Pendaftaran Peserta LMMC ULM</b></h1>
						<table id="keterangan" class="biayaGrid">
							<tr>
								<td width="200px">Lunas</td>
								<td width="1px">:</td>
								<td><?php echo 'Rp. '.number_format($_biayaLunas) ?></td>
							</tr>
							<tr>
								<td width="100px">Belum Lunas</td>
								<td width="1px">:</td>
								<td><?php echo 'Rp. '.number_format($_biayaBelumLunas) ?></td>
							</tr>
							<tr>
								<td width="100px">Total Keseluruhan</td>
								<td width="1px">:</td>
								<td><?php echo 'Rp. '.number_format($_biayaAll) ?></td>
							</tr>
							
						</table>
					<?php endif ?>
					<br>
				</td>
			</tr>
		</table>
	</page>
	<?php } ?>

</body>
</html>
