<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-25 02:03:12 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\klinik\views\index_2.php 27
ERROR - 2020-04-25 02:03:13 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\klinik\views\index_2.php 27
ERROR - 2020-04-25 02:05:01 --> Severity: error --> Exception: Unable to locate the model you have specified: Jaga_klinik_m C:\xampp\htdocs\mechapp\system\core\Loader.php 348
ERROR - 2020-04-25 02:05:01 --> Severity: error --> Exception: Unable to locate the model you have specified: Jaga_klinik_m C:\xampp\htdocs\mechapp\system\core\Loader.php 348
ERROR - 2020-04-25 02:09:50 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::selectKlinik() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 98
ERROR - 2020-04-25 02:09:50 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::selectKlinik() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 98
ERROR - 2020-04-25 02:10:01 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::selectKlinik() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 98
ERROR - 2020-04-25 02:10:01 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::selectKlinik() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 98
ERROR - 2020-04-25 02:10:02 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::selectKlinik() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 98
ERROR - 2020-04-25 02:10:02 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::selectKlinik() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 98
ERROR - 2020-04-25 02:10:24 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:10:25 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:15:38 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:15:40 --> Query error: Unknown column 'jagaJalurid' in 'where clause' - Invalid query: SELECT CONCAT('<ul>', GROUP_CONCAT(CONCAT('<li>', (dokterNama), '</li>') SEPARATOR ''), '</ul>') AS listDokter, `lmmc_t_kategori_prodi`.*, `dk`.`dokterNama`, `kl`.`klinikNama`
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_dokter` `dk` ON `dokterNip` = `jagaDokterid`
JOIN `lmmc_m_klinik` `kl` ON `klinikId` = `jagaKlinikid`
WHERE `jagaJalurid` IS NULL
GROUP BY `klinikId`, `jagaTanggal`
ERROR - 2020-04-25 02:15:40 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:16:33 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:16:34 --> Query error: Unknown column 'jagaId' in 'order clause' - Invalid query: SELECT *
FROM `lmmc_r_kategori`
ORDER BY `jagaId` ASC, `klinikNama` DESC
 LIMIT 15
ERROR - 2020-04-25 02:16:34 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:17:22 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:17:24 --> Query error: Unknown column 'jagaId' in 'order clause' - Invalid query: SELECT *
FROM `lmmc_r_kategori`
ORDER BY `jagaId` ASC, `klinikNama` DESC
 LIMIT 15
ERROR - 2020-04-25 02:17:24 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:17:50 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 30
ERROR - 2020-04-25 02:17:50 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:17:51 --> Query error: Unknown column 'jagaId' in 'order clause' - Invalid query: SELECT *
FROM `lmmc_r_kategori`
ORDER BY `jagaId` ASC, `klinikNama` DESC
 LIMIT 15
ERROR - 2020-04-25 02:17:51 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 30
ERROR - 2020-04-25 02:17:51 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:18:00 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:18:01 --> Query error: Unknown column 'jagaId' in 'order clause' - Invalid query: SELECT *
FROM `lmmc_r_kategori`
ORDER BY `jagaId` ASC, `klinikNama` DESC
 LIMIT 15
ERROR - 2020-04-25 02:18:01 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:19:50 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:19:51 --> Query error: Unknown column 'ktgprdId' in 'order clause' - Invalid query: SELECT *
FROM `lmmc_r_kategori`
ORDER BY `ktgprdId` ASC, `kategoriNama` DESC
 LIMIT 15
ERROR - 2020-04-25 02:19:51 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:20:32 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:20:33 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:21:12 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:21:14 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:21:31 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:21:33 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:21:54 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:21:55 --> Severity: error --> Exception: Call to undefined function date_convert() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 40
ERROR - 2020-04-25 02:21:55 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:22:06 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:22:08 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:22:50 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:22:52 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:23:10 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:23:11 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:23:31 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:23:32 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:26:00 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:26:02 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:26:45 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:26:46 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:26:59 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:27:00 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:29:37 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:29:39 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:31:50 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:31:51 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:32:02 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:32:03 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:32:41 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:32:42 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:33:14 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:33:15 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:33:30 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:33:31 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:03 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:04 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:14 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:15 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:20 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:22 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:31 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:33 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:34 --> Query error: Unknown column 'jagaKlinikid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_klinik` ON `klinikId` = `jagaKlinikid`
WHERE `ktgprdId` = '1'
ERROR - 2020-04-25 02:34:34 --> Query error: Unknown column 'jagaKlinikid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_klinik` ON `klinikId` = `jagaKlinikid`
WHERE `ktgprdId` = '1'
ERROR - 2020-04-25 02:34:35 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:34:37 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:35:05 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:35:06 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:35:45 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:35:47 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:36:03 --> Query error: Unknown column 'jagaKlinikid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_klinik` ON `klinikId` = `jagaKlinikid`
WHERE `ktgprdId` = '1'
ERROR - 2020-04-25 02:36:03 --> Query error: Unknown column 'jagaKlinikid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_klinik` ON `klinikId` = `jagaKlinikid`
WHERE `ktgprdId` = '1'
ERROR - 2020-04-25 02:36:04 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:36:06 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 02:39:37 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::getListDokter() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 82
ERROR - 2020-04-25 02:39:40 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::getListDokter() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 82
ERROR - 2020-04-25 02:39:43 --> Severity: error --> Exception: Call to undefined method Kategori_prodi_m::getListDokter() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\controllers\Kategori_prodi.php 82
ERROR - 2020-04-25 02:46:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 02:46:54 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 02:46:54 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 02:47:01 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 02:47:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')' at line 5 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
WHERE `jagaJalurid` IS NULL
AND `jagaTanggal` = '1970-01-01'
AND `jagaDokterid` IN()
ERROR - 2020-04-25 02:49:47 --> Severity: Notice --> Undefined variable: res C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\models\Kategori_prodi_m.php 46
ERROR - 2020-04-25 02:49:49 --> Severity: Notice --> Undefined variable: res C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\models\Kategori_prodi_m.php 46
ERROR - 2020-04-25 02:50:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '= ktgprdKategoriId = {kategoriId}
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prod' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
LEFT JOIN `sia_m_prodi` ON `ktgprdProdiId` = `prodiKode` and = ktgprdKategoriId = {kategoriId}
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
LEFT JOIN `sia_m_fakultas` ON `jurFakKode` = `fakKode`
ERROR - 2020-04-25 02:50:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '= ktgprdKategoriId = {kategoriId}
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prod' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
LEFT JOIN `sia_m_prodi` ON `ktgprdProdiId` = `prodiKode` and = ktgprdKategoriId = {kategoriId}
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
LEFT JOIN `sia_m_fakultas` ON `jurFakKode` = `fakKode`
ERROR - 2020-04-25 02:50:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '= ktgprdKategoriId = 3
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
L' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
LEFT JOIN `sia_m_prodi` ON `ktgprdProdiId` = `prodiKode` and = ktgprdKategoriId = 3
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
LEFT JOIN `sia_m_fakultas` ON `jurFakKode` = `fakKode`
ERROR - 2020-04-25 02:50:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '= ktgprdKategoriId = 1
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
L' at line 3 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
LEFT JOIN `sia_m_prodi` ON `ktgprdProdiId` = `prodiKode` and = ktgprdKategoriId = 1
LEFT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
LEFT JOIN `sia_m_fakultas` ON `jurFakKode` = `fakKode`
ERROR - 2020-04-25 02:53:11 --> Query error: Operand should contain 1 column(s) - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
RIGHT JOIN `sia_m_prodi` ON `ktgprdProdiId` = `prodiKode`
RIGHT JOIN `sia_m_jurusan` ON `jurKode` = `prodiJurKode`
RIGHT JOIN `sia_m_fakultas` ON `jurFakKode` = `fakKode`
WHERE ktgprdProdiId IN(SELECT * FROM sia_m_prodi)
ERROR - 2020-04-25 03:10:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')' at line 5 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
WHERE `jagaJalurid` IS NULL
AND `jagaTanggal` = '1970-01-01'
AND `jagaDokterid` IN()
ERROR - 2020-04-25 03:11:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')' at line 5 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
WHERE `jagaJalurid` IS NULL
AND `jagaTanggal` = '1970-01-01'
AND `jagaDokterid` IN()
ERROR - 2020-04-25 03:12:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')' at line 5 - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
WHERE `jagaJalurid` IS NULL
AND `jagaTanggal` = '1970-01-01'
AND `jagaDokterid` IN()
ERROR - 2020-04-25 03:13:37 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:13:38 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:13:40 --> Query error: Unknown column 'jagaKlinikid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_klinik` ON `klinikId` = `jagaKlinikid`
WHERE `ktgprdId` = '1'
ERROR - 2020-04-25 03:13:40 --> Query error: Unknown column 'jagaKlinikid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_t_kategori_prodi`
JOIN `lmmc_m_klinik` ON `klinikId` = `jagaKlinikid`
WHERE `ktgprdId` = '1'
ERROR - 2020-04-25 03:14:03 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 03:14:03 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 03:14:06 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 03:14:06 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 03:14:39 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:14:41 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:14:43 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:14:45 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:15:58 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:15:59 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:17:10 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:17:11 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:17:14 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:17:16 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:17:30 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:17:31 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:18:57 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:18:59 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1566
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> sort() expects parameter 1 to be array, null given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1567
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_diff(): Expected parameter 1 to be an array, null given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_diff(): Expected parameter 1 to be an array, null given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> ksort() expects parameter 1 to be array, string given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1579
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1584
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_diff(): Expected parameter 1 to be an array, null given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> array_diff(): Expected parameter 2 to be an array, null given C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1572
ERROR - 2020-04-25 03:23:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1595
ERROR - 2020-04-25 03:23:34 --> Query error: Column count doesn't match value count at row 2 - Invalid query: INSERT INTO `lmmc_t_kategori_prodi` () VALUES (), ('11201','13201','14201','73201')
ERROR - 2020-04-25 03:23:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\mechapp\system\core\Exceptions.php:271) C:\xampp\htdocs\mechapp\system\core\Common.php 570
ERROR - 2020-04-25 03:23:47 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1592
ERROR - 2020-04-25 03:23:47 --> Query error: Unknown column 'Array' in 'field list' - Invalid query: INSERT INTO `lmmc_t_kategori_prodi` (`ktgprdKategoriId`, `ktgprdProdiId`) VALUES ('3','3'), ('3',Array)
ERROR - 2020-04-25 03:24:06 --> Severity: Notice --> Undefined variable: insert C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\models\Kategori_prodi_m.php 119
ERROR - 2020-04-25 03:24:06 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1592
ERROR - 2020-04-25 03:24:06 --> Query error: Unknown column 'Array' in 'field list' - Invalid query: INSERT INTO `lmmc_t_kategori_prodi` (`ktgprdKategoriId`, `ktgprdProdiId`) VALUES ('3','3'), ('3',Array)
ERROR - 2020-04-25 03:24:25 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\mechapp\system\database\DB_query_builder.php 1592
ERROR - 2020-04-25 03:24:25 --> Query error: Unknown column 'Array' in 'field list' - Invalid query: INSERT INTO `lmmc_t_kategori_prodi` (`ktgprdKategoriId`, `ktgprdProdiId`) VALUES ('3','3'), ('3',Array)
ERROR - 2020-04-25 03:25:00 --> Severity: Notice --> Undefined index: ktgprdProdiiId C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\models\Kategori_prodi_m.php 111
ERROR - 2020-04-25 03:25:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\models\Kategori_prodi_m.php 111
ERROR - 2020-04-25 03:25:00 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2020-04-25 03:25:51 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:25:52 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:27:40 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:27:42 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:28:53 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:28:55 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:28:59 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:01 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:03 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:05 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:09 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:11 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:33 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:34 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:54 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:29:56 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:30:12 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:30:13 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:30:34 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:30:35 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:31:20 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:31:21 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:31:57 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:31:58 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:33:48 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:33:49 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:34:12 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:34:12 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:34:21 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:34:22 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:34:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 03:34:27 --> Could not find the language line "form_validation_required"
ERROR - 2020-04-25 03:34:34 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:34:34 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:36:15 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:36:15 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\kategori_prodi\views\index.php 28
ERROR - 2020-04-25 03:38:20 --> Severity: error --> Exception: syntax error, unexpected 'return' (T_RETURN), expecting function (T_FUNCTION) or const (T_CONST) C:\xampp\htdocs\mechapp\application\modules\welcome\models\Welcome_m.php 70
ERROR - 2020-04-25 03:38:20 --> Severity: error --> Exception: syntax error, unexpected 'return' (T_RETURN), expecting function (T_FUNCTION) or const (T_CONST) C:\xampp\htdocs\mechapp\application\modules\welcome\models\Welcome_m.php 70
ERROR - 2020-04-25 03:38:50 --> Severity: error --> Exception: Call to undefined method Welcome_m::getBiaya() C:\xampp\htdocs\mechapp\application\modules\welcome\controllers\Welcome.php 32
ERROR - 2020-04-25 03:38:50 --> Severity: error --> Exception: Call to undefined method Welcome_m::getBiaya() C:\xampp\htdocs\mechapp\application\modules\welcome\controllers\Welcome.php 32
ERROR - 2020-04-25 03:44:41 --> Query error: Unknown column 'ktgprdProdiId' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `mechapp`.`sia_m_prodi` ON `ktgprdProdiId` = `pesertaProdiid`
WHERE `pesertaJalurid` = '57'
ERROR - 2020-04-25 03:44:42 --> Query error: Unknown column 'ktgprdProdiId' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `mechapp`.`sia_m_prodi` ON `ktgprdProdiId` = `pesertaProdiid`
WHERE `pesertaJalurid` = '57'
ERROR - 2020-04-25 03:47:00 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::get_compilde_select() C:\xampp\htdocs\mechapp\application\modules\welcome\models\Welcome_m.php 67
ERROR - 2020-04-25 03:47:01 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::get_compilde_select() C:\xampp\htdocs\mechapp\application\modules\welcome\models\Welcome_m.php 67
ERROR - 2020-04-25 03:47:06 --> Query error: Operand should contain 1 column(s) - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `mechapp`.`sia_m_prodi` ON `prodiKode` = `pesertaProdiid`
WHERE pesertaProdiid IN(SELECT *
FROM `lmmc_t_kategori_prodi`
WHERE `ktgprdKategoriId` = '1')
AND `pesertaJalurid` = '57'
ERROR - 2020-04-25 03:47:07 --> Query error: Operand should contain 1 column(s) - Invalid query: SELECT *
FROM `lmmc_m_peserta`
JOIN `mechapp`.`sia_m_prodi` ON `prodiKode` = `pesertaProdiid`
WHERE pesertaProdiid IN(SELECT *
FROM `lmmc_t_kategori_prodi`
WHERE `ktgprdKategoriId` = '1')
AND `pesertaJalurid` = '57'
ERROR - 2020-04-25 03:58:02 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\klinik\views\index_2.php 27
ERROR - 2020-04-25 03:58:03 --> Severity: Notice --> Undefined variable: selectTahun C:\xampp\htdocs\mechapp\application\modules\klinik\views\index_2.php 27
ERROR - 2020-04-25 04:05:00 --> Query error: Unknown column 'pesertaProdiid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
WHERE pesertaProdiid IN(SELECT `ktgprdProdiId`
FROM `lmmc_t_kategori_prodi`
JOIN `mechapp`.`sia_m_prodi` ON `prodiKode` = `pesertaProdiid`
JOIN `lmmc_t_hasilpemeriksaan` ON `hasilPesertaid` = `pesertaNoregis`
JOIN `lmmc_m_klinikdetil` ON `knkdtId` = `hasilKnkdtid`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `pesertaJalurid` = '57'
AND `klinikId` = '5'
AND `ktgprdKategoriId` = '1'
GROUP BY DATE(hasilTanggal)
ORDER BY `hasilTanggal` ASC)
ERROR - 2020-04-25 04:05:01 --> Query error: Unknown column 'pesertaProdiid' in 'on clause' - Invalid query: SELECT *
FROM `lmmc_m_peserta`
WHERE pesertaProdiid IN(SELECT `ktgprdProdiId`
FROM `lmmc_t_kategori_prodi`
JOIN `mechapp`.`sia_m_prodi` ON `prodiKode` = `pesertaProdiid`
JOIN `lmmc_t_hasilpemeriksaan` ON `hasilPesertaid` = `pesertaNoregis`
JOIN `lmmc_m_klinikdetil` ON `knkdtId` = `hasilKnkdtid`
JOIN `lmmc_m_klinik` ON `knkdtKlinikid` = `klinikId`
WHERE `pesertaJalurid` = '57'
AND `klinikId` = '5'
AND `ktgprdKategoriId` = '1'
GROUP BY DATE(hasilTanggal)
ORDER BY `hasilTanggal` ASC)
ERROR - 2020-04-25 04:09:56 --> Severity: Notice --> Undefined variable: _reskategori C:\xampp\htdocs\mechapp\application\modules\laporan\models\Laporan_m.php 383
ERROR - 2020-04-25 04:09:56 --> Severity: Notice --> Undefined variable: _reskategori C:\xampp\htdocs\mechapp\application\modules\laporan\models\Laporan_m.php 383
ERROR - 2020-04-25 04:17:04 --> Severity: Notice --> Trying to get property 'biayaHarga' of non-object C:\xampp\htdocs\mechapp\application\modules\tagihan\models\Tagihan_m.php 140
ERROR - 2020-04-25 04:17:04 --> Severity: Notice --> Trying to get property 'biayaHarga' of non-object C:\xampp\htdocs\mechapp\application\modules\tagihan\models\Tagihan_m.php 140
ERROR - 2020-04-25 04:17:04 --> Severity: Notice --> Trying to get property 'biayaHarga' of non-object C:\xampp\htdocs\mechapp\application\modules\tagihan\models\Tagihan_m.php 140
ERROR - 2020-04-25 04:17:35 --> Severity: Notice --> Trying to get property 'biayaHarga' of non-object C:\xampp\htdocs\mechapp\application\modules\tagihan\models\Tagihan_m.php 140
ERROR - 2020-04-25 04:17:36 --> Severity: Notice --> Trying to get property 'biayaHarga' of non-object C:\xampp\htdocs\mechapp\application\modules\tagihan\models\Tagihan_m.php 140
ERROR - 2020-04-25 04:17:36 --> Severity: Notice --> Trying to get property 'biayaHarga' of non-object C:\xampp\htdocs\mechapp\application\modules\tagihan\models\Tagihan_m.php 140
ERROR - 2020-04-25 04:24:16 --> Severity: Notice --> Undefined property: stdClass::$kategoriNama C:\xampp\htdocs\mechapp\application\modules\verifikasi\models\Verifikasi_m.php 128
ERROR - 2020-04-25 04:24:16 --> Severity: Notice --> Undefined property: stdClass::$kategoriId C:\xampp\htdocs\mechapp\application\modules\verifikasi\models\Verifikasi_m.php 131
ERROR - 2020-04-25 04:24:18 --> Severity: Notice --> Undefined property: stdClass::$kategoriNama C:\xampp\htdocs\mechapp\application\modules\verifikasi\models\Verifikasi_m.php 128
ERROR - 2020-04-25 04:24:18 --> Severity: Notice --> Undefined property: stdClass::$kategoriId C:\xampp\htdocs\mechapp\application\modules\verifikasi\models\Verifikasi_m.php 131
ERROR - 2020-04-25 04:39:19 --> Severity: error --> Exception: Call to undefined method Welcome_m::getProdi() C:\xampp\htdocs\mechapp\application\modules\welcome\controllers\Welcome.php 26
