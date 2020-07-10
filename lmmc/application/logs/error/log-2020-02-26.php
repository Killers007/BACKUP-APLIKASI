<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-26 01:48:25 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 01:58:45 --> Severity: Notice --> Undefined index: nip C:\xampp\htdocs\mechapp\application\modules\dokter\views\Jadwal_v.php 13
ERROR - 2020-02-26 01:58:46 --> Severity: Notice --> Undefined index: nip C:\xampp\htdocs\mechapp\application\modules\dokter\views\Jadwal_v.php 13
ERROR - 2020-02-26 02:41:57 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 02:41:57 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 02:56:17 --> Query error: Unknown column 'lmmc_t_kategori_klinik' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_klinik`
JOIN `lmmc_m_klinik` ON `klinikId` = `lmmc_t_kategori_klinik`
WHERE `tKlinikTahun` = '2020'
ERROR - 2020-02-26 02:56:17 --> Query error: Unknown column 'lmmc_t_kategori_klinik' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_klinik`
JOIN `lmmc_m_klinik` ON `klinikId` = `lmmc_t_kategori_klinik`
WHERE `tKlinikTahun` = '2020'
ERROR - 2020-02-26 02:56:50 --> Query error: Unknown column 'lmmc_t_kategori_klinik' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_klinik`
JOIN `lmmc_m_klinik` ON `klinikId` = `lmmc_t_kategori_klinik`
WHERE `tKlinikTahun` = '2020'
ERROR - 2020-02-26 02:56:50 --> Query error: Unknown column 'lmmc_t_kategori_klinik' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_klinik`
JOIN `lmmc_m_klinik` ON `klinikId` = `lmmc_t_kategori_klinik`
WHERE `tKlinikTahun` = '2020'
ERROR - 2020-02-26 02:57:45 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:45 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:45 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:45 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:45 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:46 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:46 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:46 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:46 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 02:57:46 --> Severity: Notice --> Undefined property: stdClass::$tKategoriId C:\xampp\htdocs\mechapp\application\modules\dokter\models\Dokter_m.php 56
ERROR - 2020-02-26 03:05:18 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT `fakNamaResmi`, `fakNamaSingkat`, `jurNamaResmi`, `prodiNamaResmi`, `prodiKode`, IFNULL(jumPeserta.jumPeserta, 0) as jumPeserta, IFNULL(sudahPeriksa.sudahPeriksa, 0) AS sudahPeriksa
FROM `simari_fkg`.`sia_m_fakultas`
JOIN `simari_fkg`.`sia_m_jurusan` ON `jurFakKode` = `fakKode`
JOIN `simari_fkg`.`sia_m_prodi` ON `prodiJurKode` = `simari_fkg`.`sia_m_jurusan`.`jurKode`
LEFT JOIN (SELECT `pesertaProdiid`, COUNT(pesertaNoregis) AS jumPeserta
FROM `lmmc_m_peserta`
WHERE `prodiKode` IN('11201', '11706', '11707', '11708', '11709', '11711', '11901')
AND `pesertaJalurid` = '7'
GROUP BY `pesertaProdiid`) as jumPeserta ON `jumPeserta`.`pesertaProdiid` = `prodiKode`
LEFT JOIN (SELECT `pesertaProdiid`, COUNT(hasilId) AS sudahPeriksa
FROM `lmmc_m_peserta`
LEFT JOIN `lmmc_t_hasilpemeriksaan` ON `hasilPesertaid` = `pesertaNoregis`
JOIN `lmmc_m_klinikdetil` ON `knkdtId` = `hasilKnkdtid`
WHERE `pesertaJalurid` = '7'
AND `knkdtKlinikid` = '1'
GROUP BY `pesertaProdiid`) as sudahPeriksa ON `sudahPeriksa`.`pesertaProdiid` = `prodiKode`
ERROR - 2020-02-26 03:05:19 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT `fakNamaResmi`, `fakNamaSingkat`, `jurNamaResmi`, `prodiNamaResmi`, `prodiKode`, IFNULL(jumPeserta.jumPeserta, 0) as jumPeserta, IFNULL(sudahPeriksa.sudahPeriksa, 0) AS sudahPeriksa
FROM `simari_fkg`.`sia_m_fakultas`
JOIN `simari_fkg`.`sia_m_jurusan` ON `jurFakKode` = `fakKode`
JOIN `simari_fkg`.`sia_m_prodi` ON `prodiJurKode` = `simari_fkg`.`sia_m_jurusan`.`jurKode`
LEFT JOIN (SELECT `pesertaProdiid`, COUNT(pesertaNoregis) AS jumPeserta
FROM `lmmc_m_peserta`
WHERE `prodiKode` IN('11201', '11706', '11707', '11708', '11709', '11711', '11901')
AND `pesertaJalurid` = '7'
GROUP BY `pesertaProdiid`) as jumPeserta ON `jumPeserta`.`pesertaProdiid` = `prodiKode`
LEFT JOIN (SELECT `pesertaProdiid`, COUNT(hasilId) AS sudahPeriksa
FROM `lmmc_m_peserta`
LEFT JOIN `lmmc_t_hasilpemeriksaan` ON `hasilPesertaid` = `pesertaNoregis`
JOIN `lmmc_m_klinikdetil` ON `knkdtId` = `hasilKnkdtid`
WHERE `pesertaJalurid` = '7'
AND `knkdtKlinikid` = '1'
GROUP BY `pesertaProdiid`) as sudahPeriksa ON `sudahPeriksa`.`pesertaProdiid` = `prodiKode`
ERROR - 2020-02-26 03:28:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_hasilpemeriksaan`
JOIN `lmmc_t_jagaklinik` ON `hasilKlinikid` = jagaKlinikid'
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'
ERROR - 2020-02-26 03:28:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_hasilpemeriksaan`
JOIN `lmmc_t_jagaklinik` ON `hasilKlinikid` = jagaKlinikid'
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'
ERROR - 2020-02-26 03:28:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_hasilpemeriksaan`
JOIN `lmmc_t_jagaklinik` ON `hasilKlinikid` = jagaKlinikid'
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'
ERROR - 2020-02-26 03:28:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_hasilpemeriksaan`
JOIN `lmmc_t_jagaklinik` ON `hasilKlinikid` = jagaKlinikid'
WHERE `hasilKlinikid` = '1'
AND `jagaDokterid` = '1'
AND `jagaJalurid` = '7'
ERROR - 2020-02-26 03:29:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''
WHERE `hasilKlinikid` = '1'
AND `jagaJalurid` = '7'' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_hasilpemeriksaan`
JOIN `lmmc_t_jagaklinik` ON `hasilKlinikid` = jagaKlinikid'
WHERE `hasilKlinikid` = '1'
AND `jagaJalurid` = '7'
ERROR - 2020-02-26 03:29:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''
WHERE `hasilKlinikid` = '1'
AND `jagaJalurid` = '7'' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_hasilpemeriksaan`
JOIN `lmmc_t_jagaklinik` ON `hasilKlinikid` = jagaKlinikid'
WHERE `hasilKlinikid` = '1'
AND `jagaJalurid` = '7'
ERROR - 2020-02-26 03:40:45 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:40:45 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:44:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:44:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:44:33 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:44:56 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:44:56 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:45:07 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:45:07 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:45:12 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:45:12 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:49:00 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:49:00 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:50:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:50:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:50:33 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:50:33 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:06 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:06 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:08 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:08 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:17 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:20 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:24 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:25 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:25 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:25 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:26 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:26 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:29 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:31 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:33 --> Could not find the language line "form_validation_matches"
ERROR - 2020-02-26 03:51:57 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:51:57 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 03:56:46 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 04:10:20 --> Severity: Notice --> Undefined variable: values C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:10:20 --> Severity: Notice --> Trying to get property 'tKategoriId' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:10:20 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `prodiKode` NOT IN('11201', '11706', '11707', '11708', '11709', '11711', '11901', '12201', '12901')
AND `prodiIsEksakta` = '0'
ERROR - 2020-02-26 04:10:21 --> Severity: Notice --> Undefined variable: values C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:10:21 --> Severity: Notice --> Trying to get property 'tKategoriId' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:10:21 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `prodiKode` NOT IN('11201', '11706', '11707', '11708', '11709', '11711', '11901', '12201', '12901')
AND `prodiIsEksakta` = '0'
ERROR - 2020-02-26 04:11:12 --> Severity: Notice --> Undefined variable: values C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:12 --> Severity: Notice --> Trying to get property 'tKategoriId' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:12 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `prodiKode` NOT IN('11201', '11706', '11707', '11708', '11709', '11711', '11901', '12201', '12901')
AND `prodiIsEksakta` = '0'
ERROR - 2020-02-26 04:11:12 --> Severity: Notice --> Undefined variable: values C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:12 --> Severity: Notice --> Trying to get property 'tKategoriId' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:12 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `prodiKode` NOT IN('11201', '11706', '11707', '11708', '11709', '11711', '11901', '12201', '12901')
AND `prodiIsEksakta` = '0'
ERROR - 2020-02-26 04:11:15 --> Severity: Notice --> Undefined variable: values C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:15 --> Severity: Notice --> Trying to get property 'tKategoriId' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:15 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `prodiKode` NOT IN('11201', '11706', '11707', '11708', '11709', '11711', '11901', '12201', '12901')
AND `prodiIsEksakta` = '0'
ERROR - 2020-02-26 04:11:15 --> Severity: Notice --> Undefined variable: values C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:15 --> Severity: Notice --> Trying to get property 'tKategoriId' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 21
ERROR - 2020-02-26 04:11:15 --> Query error: Unknown column 'prodiKode' in 'where clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `prodiKode` NOT IN('11201', '11706', '11707', '11708', '11709', '11711', '11901', '12201', '12901')
AND `prodiIsEksakta` = '0'
ERROR - 2020-02-26 04:21:53 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:21:53 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:53 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:21:54 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:21:54 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:22:25 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:22:25 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:22:25 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:22:25 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:22:26 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:22:26 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:22:26 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:22:26 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:22:55 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:22:55 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:22:55 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:22:55 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:23:19 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 30
ERROR - 2020-02-26 04:23:19 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 34
ERROR - 2020-02-26 04:24:05 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:05 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:05 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:05 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:05 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:06 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:06 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:06 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:06 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:24:06 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:24 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:25 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:32 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'klinikFormnama' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 25
ERROR - 2020-02-26 04:25:33 --> Severity: Notice --> Trying to get property 'knkdtNamahasil' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:44 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:44 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:44 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:44 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:44 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:45 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:45 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:45 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:45 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:45 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:55 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:55 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:55 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:55 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:55 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:55 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:56 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:56 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:56 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:25:56 --> Severity: Notice --> Undefined property: stdClass::$knkdtNamahasil C:\xampp\htdocs\mechapp\application\modules\peserta\views\Hasil_v.php 26
ERROR - 2020-02-26 04:26:22 --> Severity: error --> Exception: syntax error, unexpected ''knkdtNamahasil'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 56
ERROR - 2020-02-26 04:26:22 --> Severity: error --> Exception: syntax error, unexpected ''knkdtNamahasil'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 56
ERROR - 2020-02-26 04:36:14 --> Severity: Notice --> Undefined variable: biaya C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 14
ERROR - 2020-02-26 04:36:14 --> Severity: Notice --> Undefined variable: dt_pes C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:14 --> Severity: Notice --> Trying to get property 'tagihanVoucher' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:15 --> Severity: Notice --> Undefined variable: biaya C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 14
ERROR - 2020-02-26 04:36:15 --> Severity: Notice --> Undefined variable: dt_pes C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:15 --> Severity: Notice --> Trying to get property 'tagihanVoucher' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:24 --> Severity: Notice --> Undefined variable: biaya C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 14
ERROR - 2020-02-26 04:36:24 --> Severity: Notice --> Undefined variable: dt_pes C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:24 --> Severity: Notice --> Trying to get property 'tagihanVoucher' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:24 --> Severity: Notice --> Undefined variable: biaya C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 14
ERROR - 2020-02-26 04:36:24 --> Severity: Notice --> Undefined variable: dt_pes C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:24 --> Severity: Notice --> Trying to get property 'tagihanVoucher' of non-object C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 22
ERROR - 2020-02-26 04:36:38 --> Severity: Notice --> Undefined variable: jadwal C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 21
ERROR - 2020-02-26 04:36:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 21
ERROR - 2020-02-26 04:36:38 --> Severity: Notice --> Undefined variable: jadwal C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 21
ERROR - 2020-02-26 04:36:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 21
ERROR - 2020-02-26 04:36:59 --> Severity: Notice --> Undefined index: nama C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 12
ERROR - 2020-02-26 04:36:59 --> Severity: Notice --> Undefined index: username C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 12
ERROR - 2020-02-26 04:37:00 --> Severity: Notice --> Undefined variable: jadwal C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:00 --> Severity: Notice --> Undefined index: nama C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 12
ERROR - 2020-02-26 04:37:00 --> Severity: Notice --> Undefined index: username C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 12
ERROR - 2020-02-26 04:37:00 --> Severity: Notice --> Undefined variable: jadwal C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:14 --> Severity: Notice --> Undefined variable: jadwal C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:15 --> Severity: Notice --> Undefined variable: jadwal C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 04:37:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\peserta\views\Asuransi_kesehatan_v.php 19
ERROR - 2020-02-26 06:03:13 --> Severity: Notice --> Undefined variable: _FILE C:\xampp\htdocs\mechapp\application\modules\peserta\controllers\Peserta.php 269
ERROR - 2020-02-26 07:12:47 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:13:03 --> Could not find the language line "form_validation_numeric"
ERROR - 2020-02-26 07:16:05 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:16:05 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:16:14 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:16:24 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\mechapp\application\modules\peserta\controllers\Peserta.php 316
ERROR - 2020-02-26 07:18:36 --> Query error: Unknown column 'pesertaIsDanaSehat' in 'field list' - Invalid query: UPDATE `lmmc_m_peserta` SET `pesertaIsBpjs` = '0', `pesertaIsDanaSehat` = '1'
WHERE `pesertaNoregis` = '1234455678'
ERROR - 2020-02-26 07:19:39 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:20:53 --> Severity: Warning --> unlink(D:/htdocs/mechapp/assets/mecha/upload/): Is a directory C:\xampp\htdocs\mechapp\application\modules\peserta\models\Peserta_m.php 92
ERROR - 2020-02-26 07:25:56 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:25:57 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:20 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:20 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:23 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:23 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:30 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:30 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:29:31 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:30:23 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:30:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:30:30 --> Could not find the language line "form_validation_numeric"
ERROR - 2020-02-26 07:30:55 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:30:55 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:31:03 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:31:03 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:31:06 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:31:15 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:31:16 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:31:18 --> Could not find the language line "form_validation_numeric"
ERROR - 2020-02-26 07:32:34 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:32:34 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:32:40 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:32:44 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:33:32 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:33:32 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:33:36 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:33:51 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:00 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:00 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:08 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:51 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:53 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:53 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:53 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:34:53 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:45:21 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 07:50:22 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 08:35:23 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 08:48:37 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 08:49:18 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 08:49:18 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 08:56:48 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 08:56:48 --> Could not find the language line "form_validation_required"
ERROR - 2020-02-26 09:20:31 --> Severity: Notice --> Undefined variable: dokter C:\xampp\htdocs\mechapp\application\modules\pemeriksaan\models\Pemeriksaan_m.php 361
