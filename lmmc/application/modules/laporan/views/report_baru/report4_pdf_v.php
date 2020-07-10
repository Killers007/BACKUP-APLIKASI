

<html>
<head><title>Laporan Hasil Pemeriksaan Kesehatan</title>
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

	<?php foreach ($datas as $key => $data): ?>

		<?php if (empty(count($data['peserta']))): ?>
			<?php continue; ?>
		<?php endif ?>

		<?php $_length = 25; $_end = false; ?>
		<?php $_jumProdi = ceil(count($data['peserta'])/$_length) ?>
		
			<table class='header' width="100%">
				<tr align="center">
					<td>
						<b class='h1'>LAPORAN HASIL PEMERIKSAAN KESEHATAN (<?php echo strtoupper(@$data['klinik']->klinikNama) ?>)</b><br>
						<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>MAHASISWA BARU UNIVERSITAS LAMBUNG MANGKURAT (<?php echo strtoupper(@$data['kategori']) ?>)</b><br>
						<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'><?php echo @$data['fakultas']->fakNamaResmi ?></b><br>
						<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>JALUR <?php echo @$data['jalur']->jalurNama ?></b><br>
						<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>TAHUN <?php echo @$data['jalur']->jalurTahun ?></b><br>
					</tr>
				</table>
				<hr>
				<br><br>
				<table style="width: 100%; font-size: small;" >
					<tr>
						<td  align='left' style="font-weight:bold;">Program Studi : <?php echo ucwords(strtolower(@$data['fakultas']->prodiNamaResmi)) ?></td>
					</tr>
				</table>

				<div id=clone-krs>
					<div id=box_khs_table>
						<table id=krs_table class="table table-bordered table-hover gridtable" style="width: 100%;font-size:11px;margin-top:15px;padding:0px" border=1>
							<thead>
								<tr>
									<th style="vertical-align: middle; width: 1% ">NO</th>
									<th style="vertical-align: middle; width: 38%">No Pendaftaran</th>
									<th style="vertical-align: middle; width: 39%">Nama</th>
									<th align="center" style="vertical-align: middle; width: 22%"><?php echo @$data['klinik']->klinikNama ?></th>
								</tr>

							</thead>
							<tbody>
								<?php foreach ($data['peserta'] as $key => $value): ?>

									<?php $hasil = '' ?>
									<?php if ($value->knkdtNamahasil == 'Positif'): ?>
										<?php $hasil = 'nafza_positif' ?>
										<?php elseif ($value->knkdtNamahasil == null): ?>
											<?php $hasil = 'tidak_hadir' ?>
										<?php endif ?>

										<tr class="<?php echo $hasil ?>">
											<td align="center"><?php echo ($key + 1) ?></td>
											<td><?php echo $value->pesertaNoregis ?></td>
											<td><?php echo $value->pesertaNama ?></td>
											<td align="center"><?php echo $value->knkdtNamahasil ?></td>
										</tr>

									<?php endforeach ?>
								</tbody>

							</table>
						</div>
					</div>  
					<br><br>

						<table id="keterangan" style="width: 100%">
							<tr>
								<td width="7%"></td>
								<td>&nbsp;KETERANGAN</td>
							</tr>
							<tr>
								<td class="tidak_hadir"></td>
								<td>&nbsp;TIDAK HADIR UNTUK MELAKUKAN PEMERIKSAAN</td>
							</tr>
							<?php if (strstr(strtolower(@$data['klinik']->klinikNama), 'napza')): ?>
								<tr>
									<td class="nafza_positif"></td>
									<td>&nbsp;NAPZA POSITIF</td>
								</tr>
							<?php endif ?>
						</table>
					<br>
				</td>
			</tr>
		</table>

<?php endforeach ?>

</body>
</html>
