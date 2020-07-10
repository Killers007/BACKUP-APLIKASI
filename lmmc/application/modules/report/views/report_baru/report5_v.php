<html>
<head>
	<title>Cetak</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?=base_url();?>assets/css/cetak.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/bootstrap.css" type="text/css" /> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data/css/font-awesome.min.css" type="text/css" />

	<script src="<?php echo base_url(); ?>assets/data/js/jquery.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/data/js/bootstrap.js"></script> -->
	<script src="<?php echo base_url(); ?>assets/js/moment.js" type="text/javascript" /></script>
	<style type="text/css">
		@page { 
			size: landscape;
		}
		.h1{
			font-size:22px;font-weight:bold;margin-top:-12px;margin-top:1px;
		}
		.h2
		{
			font-size:16px;font-weight:bold;margin-top:0px;
		}
		.text-center 
		{
			text-align:center;
		}

		body {font-family: 'Roboto';font-size: 7px;}
		.info{font-size:12px;}
		html {font-family: verdana,arial,sans-serif;font-size:11px;}
		.gridtable {font-size:11px;color:#333333;border-width: 1px;border-color: #666666;border-collapse: collapse;}
		.gridtable th, .gridtable tr {border-width: 1px;padding: 15px;border-style: solid;border-color: #666666;}
		.gridtable td, .gridtable th {border-width: 1px;	padding: 10px;border-style: solid;border-color: #666666;}
		table.header {font-size:11px;color:#333333;border-width: 0px;border-color: #666666;border-collapse: collapse;}
		table.header th {border-width: 0px;padding: 8px;border-style: solid;border-color: #666666;background-color: #dedede;}
		table.header td {border-width: 0px;padding: 8px;border-style: solid;border-color: #666666;background-color: #ffffff;}
	</style>
	
</head>
<body style="page-break-after: always;">

	<?php $_length = 17; $_end = false; ?>
	<?php $_jumProdi = ceil(count($data['prodi'])/$_length) ?>

	<?php $_jumSudahPeriksa = 0 ?>
	<?php $_jumPeserta = 0 ?>
	<?php $_jumBelumPeriksa = 0 ?>

	<?php $_arrJumtanggal = [] ?>
	
	<?php for ($i = 0; $i < $_jumProdi ; $i++){ ?>
		<page <?php echo (!$isPdf)?"size='A4'":'' ?> style="width: 297mm;height: 210mm;">
				<table width="100%" class="header">
					<tbody>
						<tr align="center">
							<td>
								<b class='h1'>LAPORAN HASIL PEMERIKSAAN KESEHATAN (<?php echo strtoupper($data['klinik']) ?>)</b><br>
								<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>MAHASISWA BARU UNIVERSITAS LAMBUNG MANGKURAT (<?php echo strtoupper($data['kategori']) ?>)</b><br>
								<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>JALUR <?php echo $data['jalur']->jalurNama ?></b><br>
								<b style='font-size:16px;font-weight:bold;margin-top:0px' class='h2'>TAHUN <?php echo $data['jalur']->jalurTahun ?></b><br>
							</td>
						</tr>
					</tbody>
				</table>
				<hr>
			<br>
			<div class="row clearfix">
				<div class="col-md-12">
					<table class="table table-bordered table-hover gridtable" style="width: 100%">
						<thead>
							<tr>
								<th rowspan="2" class="text-center" style="vertical-align: middle; width: 1px">NO</th>
								<th rowspan="2" class="text-center" style="vertical-align: middle; width: 45%">FAKULTAS / Program Studi</th>
								<th rowspan="2" class="text-center" style="vertical-align: middle;">JUMLAH PESERTA</th>
								<?php if (!empty($data['header_tanggal'])): ?>
									<th colspan="<?php echo count($data['header_tanggal']) ?>" class="text-center" style="vertical-align: middle;">Tanggal Pemeriksaan</th>
								<?php endif ?>
								<th colspan="2" class="text-center" style="vertical-align: middle;">JUMLAH</th>
							</tr>
							<tr>
								<?php foreach ($data['header_tanggal'] as $value): ?>
									<th class="text-center"><?php echo $value ?></th>
								<?php endforeach ?>
								<th class="text-center">SUDAH PERIKSA</th>
								<th class="text-center">BELUM PERIKSA</th>
							</tr>
						</thead>
						<tbody>
							
							<?php foreach ($data['prodi'] as $key => $value): ?>
								<?php if ($key >= 0 + ($_length * $i) && $key < $_length + ($_length * $i)): ?>
								<tr>
									<td class="text-center"><?php echo ($key + 1) ?></td>
									<td><?php echo "$value->fakNamaResmi / $value->prodiNamaResmi" ?></td>
									<th class="text-center"><?php echo $value->jumPeserta ?></th>

									<?php foreach ($data['header_tanggal'] as $key => $tanggal): ?>
										<?php $_arrJumtanggal[$tanggal][] = intval(@$value->dataTanggal[$tanggal]); ?>
										<td class="text-center"><?php echo intval(@$value->dataTanggal[$tanggal]); ?></td>
									<?php endforeach ?>

									<td class="text-center"><?php echo $value->sudahPeriksa ?></td>
									<td class="text-center"><?php echo $value->jumPeserta - $value->sudahPeriksa ?></td>

									<?php $_jumSudahPeriksa += $value->sudahPeriksa ?>
									<?php $_jumPeserta += $value->jumPeserta ?>
									<?php $_jumBelumPeriksa += $value->jumPeserta - $value->sudahPeriksa ?>
								</tr>
							<?php endif ?>
						<?php endforeach ?>
						<?php if ($i == $_jumProdi - 1): ?>
							<?php $_end = true; ?>
							<tr style="background-color: #f1f8e9">
								<td></td>
								<th>Jumlah</th>
								<th class="text-center"><?php echo $_jumPeserta ?></th>
								<?php foreach ($data['header_tanggal'] as $tanggal): ?>
									<th class="text-center"><?php echo array_sum(@$_arrJumtanggal[$tanggal]); ?></th>
								<?php endforeach ?>
								<th class="text-center"><?php echo $_jumSudahPeriksa ?></th>
								<th class="text-center"><?php echo $_jumBelumPeriksa ?></th>
							</tr>
						<?php endif ?>
					</tbody>
				</table>

				<?php if ($_end): ?>
					<br><br><br>
					<table class="" style="width: 100%; font-size: 15px">
						<tr>
							<td>Panitia Pemeriksa Kesehatan</td>
							<td width="33%"></td>
							<td>Panitia Pemeriksa Kesehatan</td>
						</tr>
						<tr>
							<td>Penanggung Jawab</td>
							<td width="33%"></td>
							<td>Ketua</td>
						</tr>
						<tr><td><br></td></tr>
						<tr><td><br></td></tr>
						<tr><td><br></td></tr>
						<tr>
							<td>Prof Dr. drg Rosihan Adhani S.sos, MS</td>
							<td width="33%"></td>
							<td>Prof Dr. drg Rosihan Adhani S.sos, MS</td>
						</tr>
						<tr>
							<td>NIP 129189313212673713</td>
							<td width="33%"></td>
							<td>NIP 129189313212673713</td>
						</tr>
					</table>
					<br>
					<br>
					<br>

				<?php endif ?>


			</div>
		</div>
	</page>
	<div style="margin-top: 50px"></div>

<?php } ?>

</body>

</html>