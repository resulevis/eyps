/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : eyps

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-09-13 16:51:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_anabilim_dallari`
-- ----------------------------
DROP TABLE IF EXISTS `tb_anabilim_dallari`;
CREATE TABLE `tb_anabilim_dallari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fakulte_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_anabilim_dallari
-- ----------------------------
INSERT INTO `tb_anabilim_dallari` VALUES ('1', '1', 'Anesteziyoloji ve Reanimasyon Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('2', '1', 'Çocuk Cerrahisi Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('3', '1', 'Genel Cerrahi Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('4', '1', 'Göğüs Cerrahisi Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('5', '1', 'Göz Hastalıkları Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('6', '1', 'Kadın Hastalıkları ve Doğum Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('7', '1', 'Kalp ve Damar Cerrahisi Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('8', '1', 'Kulak Burun Boğaz Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('9', '1', 'Nöroşirürji Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('10', '1', 'Ortopedi ve Travmatoloji Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('11', '1', 'Plastik ve Rekonstrüktif Anabilim Dalı', '1');
INSERT INTO `tb_anabilim_dallari` VALUES ('12', '1', 'Üroloji Anabilim Dalı', '1');

-- ----------------------------
-- Table structure for `tb_bolumler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_bolumler`;
CREATE TABLE `tb_bolumler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `fakulte_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_bolumler
-- ----------------------------
INSERT INTO `tb_bolumler` VALUES ('1', '1', '1', 'Cerrahi Tıp Bilimleri Bölümü', '1');
INSERT INTO `tb_bolumler` VALUES ('2', '1', '1', 'Dahili Tıp Bilimleri Bölümü', '1');

-- ----------------------------
-- Table structure for `tb_dersler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_dersler`;
CREATE TABLE `tb_dersler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) DEFAULT NULL,
  `anabilim_dali_id` int(11) DEFAULT NULL,
  `ders_kategori_id` int(11) DEFAULT NULL,
  `ders_kodu` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_dersler
-- ----------------------------
INSERT INTO `tb_dersler` VALUES ('1', '1', '12', '1', 'TFANT101', 'Anatomi / Anatomy', '1');
INSERT INTO `tb_dersler` VALUES ('2', '1', null, '1', 'TFBFZ102', 'Biyofizik / Biophysics', '1');
INSERT INTO `tb_dersler` VALUES ('3', '1', null, '1', 'TFBIS103', 'Biyoistatistik / Biostatistics', '1');
INSERT INTO `tb_dersler` VALUES ('4', '1', null, '1', 'TFBIK104', 'Tıbbi Biyokimya / Biochemistry', '1');
INSERT INTO `tb_dersler` VALUES ('5', '1', null, '1', 'TFDAB105', 'Davranış Bilimleri / Behavioral Sciences', '1');
INSERT INTO `tb_dersler` VALUES ('6', '1', null, '1', 'TFFZY106', 'Fizyoloji / Physiology', '1');
INSERT INTO `tb_dersler` VALUES ('7', '1', null, '1', 'TFHSA107', 'Halk Sağlığı / Public Health', '1');
INSERT INTO `tb_dersler` VALUES ('8', '1', null, '1', 'TFHIE108', 'Histoloji-Embriyoloji / Histology and Embryology', '1');
INSERT INTO `tb_dersler` VALUES ('9', '1', null, '1', 'TFMIB109', 'Tıbbi Mikrobiyoloji / Microbiology', '1');
INSERT INTO `tb_dersler` VALUES ('10', '1', null, '1', 'TFTIB110', 'Tıbbi Biyoloji / Medical Biology', '1');
INSERT INTO `tb_dersler` VALUES ('11', '1', null, '1', 'TFTIG111', 'Tıbbi Genetik / Medical Genetics', '1');
INSERT INTO `tb_dersler` VALUES ('12', '1', null, '1', 'TFTIT111', 'Tıbbi Terminoloji / Medical Terminology', '1');
INSERT INTO `tb_dersler` VALUES ('13', '1', null, '1', 'TFTE112', 'Tıp Eğitimi ve BiliĢimi / Medical Education', '1');
INSERT INTO `tb_dersler` VALUES ('14', '1', null, '1', 'TFTTE113', 'Tıp Tarihi ve Etik / Medical History and Ethics', '1');
INSERT INTO `tb_dersler` VALUES ('15', '1', null, '1', 'TFİLE114', 'İletişim Becerisi / CommunicationSkills', '1');
INSERT INTO `tb_dersler` VALUES ('16', '1', null, '1', 'TFANT201', 'Anatomi / Anatomy', '1');
INSERT INTO `tb_dersler` VALUES ('17', '1', null, '1', 'TFBFZ202', 'Biyofizik / Biophysics', '1');
INSERT INTO `tb_dersler` VALUES ('18', '1', null, '1', 'TFBIK204', 'Biyokimya / Biochemistry', '1');
INSERT INTO `tb_dersler` VALUES ('19', '1', null, '1', 'TFFAR205', 'Farmakoloji / Pharmacology', '1');
INSERT INTO `tb_dersler` VALUES ('20', '1', null, '1', 'TFFIZ206', 'Fizyoloji / Physiology', '1');
INSERT INTO `tb_dersler` VALUES ('21', '1', null, '1', 'TFHIE207', 'Histoloji-Embriyoloji / Histology and Embryology', '1');
INSERT INTO `tb_dersler` VALUES ('23', '1', null, '1', 'TFMIK208', 'Mikrobiyoloji / Microbiology', '1');
INSERT INTO `tb_dersler` VALUES ('24', '1', null, '1', 'TFPRZ209', 'Parazitoloji / Parasitology', '1');
INSERT INTO `tb_dersler` VALUES ('25', '1', null, '1', 'TFPAT210', 'Patoloji / Pathology', '1');
INSERT INTO `tb_dersler` VALUES ('26', '1', null, '1', 'TFTIB211', 'Tıbbi Biyoloji / Medical Biology', '1');
INSERT INTO `tb_dersler` VALUES ('27', '1', null, '1', 'TFTEG213', 'Tıp Eğitimi ve Bilişimi / Medical Education', '1');
INSERT INTO `tb_dersler` VALUES ('28', '1', null, '1', 'TFTTE214', 'Tıp Tarihi ve Etik / Medical History and Ethics', '1');
INSERT INTO `tb_dersler` VALUES ('29', '1', null, '1', 'TFTIG2015', 'Tıbbi Genetik / Medical Genetics', '1');
INSERT INTO `tb_dersler` VALUES ('30', '1', null, '1', 'TFACT301', 'Acil Tıp / Emergency Medicine', '1');
INSERT INTO `tb_dersler` VALUES ('31', '1', null, '1', 'TFADT302', 'Adli Tıp / Forensic Medicine', '1');
INSERT INTO `tb_dersler` VALUES ('32', '1', null, '1', 'TFAIH303', 'Aile Hekimliği / Family Medicine', '1');
INSERT INTO `tb_dersler` VALUES ('33', '1', null, '1', 'TFBSC305', 'Beyin Cerrahisi / Neurosurgery', '1');
INSERT INTO `tb_dersler` VALUES ('34', '1', null, '1', 'TFBIK307', 'Tıbbi Biyokimya / Clinical Biochemistry', '1');
INSERT INTO `tb_dersler` VALUES ('35', '1', null, '1', 'TFBIFZ307', 'Biyofizik/Biophisic', '1');
INSERT INTO `tb_dersler` VALUES ('36', '1', null, '1', 'TFCCE308', 'Çocuk Cerrahisi / Pediatric Surgery', '1');
INSERT INTO `tb_dersler` VALUES ('37', '1', null, '1', 'TFCPS309', 'Çocuk Psikiyatrisi / Child and Adolescent Psychiatry', '1');
INSERT INTO `tb_dersler` VALUES ('38', '1', null, '1', 'TFPED310', 'Çocuk Sağlığı ve Hastalıkları / Pediatrics', '1');
INSERT INTO `tb_dersler` VALUES ('39', '1', null, '1', 'TFDER311', 'Dermatoloji / Dermatology', '1');
INSERT INTO `tb_dersler` VALUES ('40', '1', null, '1', 'TFENF312', 'Enfeksiyon Hastalıkları / Infectious Diseases', '1');
INSERT INTO `tb_dersler` VALUES ('41', '1', null, '1', 'TFFAR313', 'Farmakoloji / Pharmacology', '1');
INSERT INTO `tb_dersler` VALUES ('42', '1', null, '1', 'TFFTR314', 'Fizik Tedavi ve Rehabilitasyon / Physical Medicine and Rehabilitation', '1');
INSERT INTO `tb_dersler` VALUES ('43', '1', null, '1', 'TFGEC315', 'Genel Cerrahi / General Surgery', '1');
INSERT INTO `tb_dersler` VALUES ('44', '1', null, '1', 'TFGOC316', 'Göğüs Cerrahisi / Chest Surgery', '1');
INSERT INTO `tb_dersler` VALUES ('45', '1', null, '1', 'TFGOH317', 'Göğüs Hastalıkları / Chest Diseases', '1');
INSERT INTO `tb_dersler` VALUES ('46', '1', null, '1', 'TFGOZ318', 'Göz Hastalıkları / Ophthalmology', '1');
INSERT INTO `tb_dersler` VALUES ('47', '1', null, '1', 'TFHSA319', 'Halk Sağlığı / Public Health', '1');
INSERT INTO `tb_dersler` VALUES ('48', '1', null, '1', 'TFDAH320', 'İç Hastalıkları / Internal Medicine', '1');
INSERT INTO `tb_dersler` VALUES ('49', '1', null, '1', 'TFKHD321', 'Kadın Hastalıkları ve Doğum / Obstetrics and Gynecology', '1');
INSERT INTO `tb_dersler` VALUES ('50', '1', null, '1', 'TFKAR322', 'Kardiyoloji / Cardiology', '1');
INSERT INTO `tb_dersler` VALUES ('51', '1', null, '1', 'TFKDC323', 'Kalp Damar Cerrahisi / Cardiovascular Surgery', '1');
INSERT INTO `tb_dersler` VALUES ('52', '1', null, '1', 'TFKBB324', 'Kulak Burun Boğaz / Otorhinolaryngology', '1');
INSERT INTO `tb_dersler` VALUES ('53', '1', null, '1', 'TFNOR325', 'Nöroloji / Neurology', '1');
INSERT INTO `tb_dersler` VALUES ('54', '1', null, '1', 'TFORT338', 'Ortopedi ve Travmatoloji / Orthopedic and Traumatology', '1');
INSERT INTO `tb_dersler` VALUES ('55', '1', null, '1', 'TFPAT337', 'Patoloji / Pathology', '1');
INSERT INTO `tb_dersler` VALUES ('56', '1', null, '1', 'TFPRC328', 'Plastik Cerrahi / PlasticReconstructive and Aesthetic Surgery', '1');
INSERT INTO `tb_dersler` VALUES ('57', '1', null, '1', 'TFPSK329', 'Psikiyatri / Psychiatry', '1');
INSERT INTO `tb_dersler` VALUES ('58', '1', null, '1', 'TFSHK330', 'Spor Hekimliği / Sports Medicine', '1');
INSERT INTO `tb_dersler` VALUES ('59', '1', null, '1', 'TFPRZ332', 'Parazitoloji / Parasitology', '1');
INSERT INTO `tb_dersler` VALUES ('60', '1', null, '1', 'TFMIC333', 'Tıbbi Mikrobiyoloji / Medical Microbiology', '1');
INSERT INTO `tb_dersler` VALUES ('61', '1', null, '1', 'TFTEG336', 'Tıp Eğitimi ve BiliĢimi / Medical Education', '1');
INSERT INTO `tb_dersler` VALUES ('62', '1', null, '1', 'TFTTE333', 'Tıp Tarihi ve Etik / Medical History and Ethics', '1');
INSERT INTO `tb_dersler` VALUES ('63', '1', null, '1', 'TFURO334', 'Üroloji / Urology', '1');
INSERT INTO `tb_dersler` VALUES ('64', '1', null, '1', 'TFİSG336', 'İş Sağlığı ve Güvenliği', '1');
INSERT INTO `tb_dersler` VALUES ('65', '1', null, '1', 'TFTIG336', 'Tıbbi Genetik / Medical Genetic', '1');
INSERT INTO `tb_dersler` VALUES ('66', '1', null, '1', 'TFNUT336', 'Nükleer Tıp / Nuclear Medicine', '1');

-- ----------------------------
-- Table structure for `tb_ders_kategorileri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ders_kategorileri`;
CREATE TABLE `tb_ders_kategorileri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_ders_kategorileri
-- ----------------------------
INSERT INTO `tb_ders_kategorileri` VALUES ('1', '1', 'Zorunlu Ders', '1');
INSERT INTO `tb_ders_kategorileri` VALUES ('2', '1', 'Seçmeli Ders', '1');
INSERT INTO `tb_ders_kategorileri` VALUES ('3', '1', 'Alttan Ders', '0');

-- ----------------------------
-- Table structure for `tb_ders_yili_donemleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ders_yili_donemleri`;
CREATE TABLE `tb_ders_yili_donemleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) DEFAULT NULL,
  `ders_yili_id` int(11) DEFAULT NULL,
  `donem_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_ders_yili_donemleri
-- ----------------------------
INSERT INTO `tb_ders_yili_donemleri` VALUES ('1', '1', '1', '1');
INSERT INTO `tb_ders_yili_donemleri` VALUES ('2', '1', '1', '2');
INSERT INTO `tb_ders_yili_donemleri` VALUES ('3', '1', '1', '3');
INSERT INTO `tb_ders_yili_donemleri` VALUES ('4', '1', '1', '4');
INSERT INTO `tb_ders_yili_donemleri` VALUES ('5', '1', '1', '5');
INSERT INTO `tb_ders_yili_donemleri` VALUES ('11', '1', '1', '6');

-- ----------------------------
-- Table structure for `tb_ders_yillari`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ders_yillari`;
CREATE TABLE `tb_ders_yillari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `baslangic_tarihi` date DEFAULT NULL,
  `bitis_tarihi` date DEFAULT NULL,
  `ilk_goruntulenecek` tinyint(4) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_ders_yillari
-- ----------------------------
INSERT INTO `tb_ders_yillari` VALUES ('1', '1', '2022 - 2023 Ders Yılı', '2022-09-19', '2023-06-19', '1', '1');
INSERT INTO `tb_ders_yillari` VALUES ('3', '1', '2023 - 2024 Ders Yılı', '2023-09-17', '2024-06-20', '0', '1');

-- ----------------------------
-- Table structure for `tb_donemler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_donemler`;
CREATE TABLE `tb_donemler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_donemler
-- ----------------------------
INSERT INTO `tb_donemler` VALUES ('1', '1', '1', 'Dönem I', '1');
INSERT INTO `tb_donemler` VALUES ('2', '1', '1', 'Dönem II', '1');
INSERT INTO `tb_donemler` VALUES ('3', '1', '1', 'Dönem III', '1');
INSERT INTO `tb_donemler` VALUES ('4', '1', '1', 'Dönem IV', '1');
INSERT INTO `tb_donemler` VALUES ('5', '1', '1', 'Dönem V', '1');
INSERT INTO `tb_donemler` VALUES ('6', '1', '1', 'Dönem VI', '1');

-- ----------------------------
-- Table structure for `tb_donem_dersleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_dersleri`;
CREATE TABLE `tb_donem_dersleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int(10) unsigned DEFAULT NULL,
  `ders_id` int(11) DEFAULT NULL,
  `teorik_ders_saati` int(11) DEFAULT NULL,
  `uygulama_ders_saati` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_donem_dersleri
-- ----------------------------
INSERT INTO `tb_donem_dersleri` VALUES ('1', '1', '1', '72', '20');
INSERT INTO `tb_donem_dersleri` VALUES ('2', '1', '2', '26', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('3', '1', '3', '47', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('4', '1', '4', '84', '10');
INSERT INTO `tb_donem_dersleri` VALUES ('5', '1', '5', '11', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('6', '1', '6', '37', '1');
INSERT INTO `tb_donem_dersleri` VALUES ('7', '1', '7', '12', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('8', '1', '8', '52', '17');
INSERT INTO `tb_donem_dersleri` VALUES ('9', '1', '9', '9', '2');
INSERT INTO `tb_donem_dersleri` VALUES ('10', '1', '10', '64', '10');
INSERT INTO `tb_donem_dersleri` VALUES ('11', '1', '11', '7', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('13', '1', '13', '4', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('22', '1', '14', '16', '0');
INSERT INTO `tb_donem_dersleri` VALUES ('24', '1', '15', '8', '0');

-- ----------------------------
-- Table structure for `tb_donem_gorevlileri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_gorevlileri`;
CREATE TABLE `tb_donem_gorevlileri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int(11) DEFAULT NULL,
  `gorev_kategori_id` int(11) DEFAULT NULL,
  `ogretim_elemani_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_donem_gorevlileri
-- ----------------------------
INSERT INTO `tb_donem_gorevlileri` VALUES ('10', '1', '1', '25');
INSERT INTO `tb_donem_gorevlileri` VALUES ('11', '1', '5', '22');
INSERT INTO `tb_donem_gorevlileri` VALUES ('12', '1', '7', '12');
INSERT INTO `tb_donem_gorevlileri` VALUES ('13', '1', '7', '11');
INSERT INTO `tb_donem_gorevlileri` VALUES ('14', '1', '7', '9');

-- ----------------------------
-- Table structure for `tb_donem_ogrencileri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_ogrencileri`;
CREATE TABLE `tb_donem_ogrencileri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `ogrenci_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_donem_ogrencileri
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_donem_subeleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_subeleri`;
CREATE TABLE `tb_donem_subeleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_donem_subeleri
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_fakulteler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_fakulteler`;
CREATE TABLE `tb_fakulteler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `ilk_goruntulenecek` tinyint(4) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_fakulteler
-- ----------------------------
INSERT INTO `tb_fakulteler` VALUES ('1', '1', 'Tıp Fakültesi', '1', '1');
INSERT INTO `tb_fakulteler` VALUES ('2', '1', 'Van Meslek', '0', '0');

-- ----------------------------
-- Table structure for `tb_gorev_kategorileri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_gorev_kategorileri`;
CREATE TABLE `tb_gorev_kategorileri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_gorev_kategorileri
-- ----------------------------
INSERT INTO `tb_gorev_kategorileri` VALUES ('1', '1', 'Başkoordinatör');
INSERT INTO `tb_gorev_kategorileri` VALUES ('2', '1', 'Başkoordinatör Yrd');
INSERT INTO `tb_gorev_kategorileri` VALUES ('3', '1', 'Dönem Koordinatörü');
INSERT INTO `tb_gorev_kategorileri` VALUES ('4', '1', 'Dönem Koordinatör Yrd.');
INSERT INTO `tb_gorev_kategorileri` VALUES ('5', '1', 'Ders Kurulu Başkanı');
INSERT INTO `tb_gorev_kategorileri` VALUES ('6', '1', 'Ders Kurulu Başkan Yrd.');
INSERT INTO `tb_gorev_kategorileri` VALUES ('7', '1', 'Sınav Gözetmeni');

-- ----------------------------
-- Table structure for `tb_komiteler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_komiteler`;
CREATE TABLE `tb_komiteler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int(11) DEFAULT NULL,
  `ders_kodu` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ders_kurulu_sira` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `baslangic_tarihi` date DEFAULT NULL,
  `bitis_tarihi` date DEFAULT NULL,
  `sinav_tarihi` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_komiteler
-- ----------------------------
INSERT INTO `tb_komiteler` VALUES ('1', '1', 'TFTGI1001', 'Tıbba Giriş', '1', '2022-09-19', '2022-11-04', '2022-11-04');
INSERT INTO `tb_komiteler` VALUES ('2', '1', 'TFHTY1001', 'Hücrenin Temel Yapısı', '2', '2022-11-07', '2022-12-30', '2022-12-30');
INSERT INTO `tb_komiteler` VALUES ('3', '1', 'TFHUG1001', 'Hücre ve Genetik - I', '3', '2023-01-02', '2023-02-03', '2023-02-03');
INSERT INTO `tb_komiteler` VALUES ('4', '1', 'TFHUG1002', 'Hücre ve Genetik - II', '4', '2023-02-20', '2023-03-30', '2023-03-31');
INSERT INTO `tb_komiteler` VALUES ('5', '1', 'TFDKI1001', 'Doku ve Kas İskelet Sistemi - I', '5', '2023-04-03', '2023-05-11', '2023-05-12');
INSERT INTO `tb_komiteler` VALUES ('6', '1', 'TFDKI1002', 'Doku ve Kas İskelet Sistemi - II', '6', '2023-05-15', '2023-06-22', '2023-06-23');

-- ----------------------------
-- Table structure for `tb_komite_dersleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_dersleri`;
CREATE TABLE `tb_komite_dersleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `komite_id` int(11) DEFAULT NULL,
  `donem_ders_id` int(11) DEFAULT NULL,
  `teorik_ders_saati` smallint(6) DEFAULT NULL,
  `uygulama_ders_saati` smallint(6) DEFAULT NULL,
  `soru_sayisi` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_komite_dersleri
-- ----------------------------
INSERT INTO `tb_komite_dersleri` VALUES ('1', '1', '2', '10', '5', '2');
INSERT INTO `tb_komite_dersleri` VALUES ('2', '1', '3', '47', '0', '37');
INSERT INTO `tb_komite_dersleri` VALUES ('3', '1', '5', '11', '0', '9');
INSERT INTO `tb_komite_dersleri` VALUES ('4', '1', '7', '56', '0', '9');
INSERT INTO `tb_komite_dersleri` VALUES ('5', '1', '14', '16', '0', '13');
INSERT INTO `tb_komite_dersleri` VALUES ('6', '1', '15', '8', '0', '5');
INSERT INTO `tb_komite_dersleri` VALUES ('7', '1', '13', '4', '0', '3');
INSERT INTO `tb_komite_dersleri` VALUES ('8', '1', '4', '8', '2', '9');
INSERT INTO `tb_komite_dersleri` VALUES ('9', '1', '6', '5', '1', '2');

-- ----------------------------
-- Table structure for `tb_komite_dersleri_ogretim_uyeleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_dersleri_ogretim_uyeleri`;
CREATE TABLE `tb_komite_dersleri_ogretim_uyeleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `komite_ders_id` int(11) DEFAULT NULL,
  `ogretim_uyesi_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_komite_dersleri_ogretim_uyeleri
-- ----------------------------
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('104', '1', '25');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('105', '1', '1');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('106', '1', '22');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('107', '1', '18');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('108', '1', '26');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('109', '1', '23');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('110', '1', '16');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('111', '1', '3');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('112', '1', '4');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('113', '1', '2');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('114', '1', '20');
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES ('115', '1', '15');

-- ----------------------------
-- Table structure for `tb_komite_gorevlileri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_gorevlileri`;
CREATE TABLE `tb_komite_gorevlileri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `komite_id` int(11) DEFAULT NULL,
  `gorev_kategori_id` int(11) DEFAULT NULL,
  `ogretim_elemani_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_komite_gorevlileri
-- ----------------------------
INSERT INTO `tb_komite_gorevlileri` VALUES ('5', '1', '1', '25');
INSERT INTO `tb_komite_gorevlileri` VALUES ('6', '1', '5', '18');

-- ----------------------------
-- Table structure for `tb_komite_ogrencileri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_ogrencileri`;
CREATE TABLE `tb_komite_ogrencileri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `komite_id` int(11) DEFAULT NULL,
  `ogrenci_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_komite_ogrencileri
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_modul`
-- ----------------------------
DROP TABLE IF EXISTS `tb_modul`;
CREATE TABLE `tb_modul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `modul` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `klasor` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `simge` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `menude_goster` tinyint(4) DEFAULT 1,
  `ust_id` int(11) DEFAULT 0,
  `kategori` tinyint(4) DEFAULT 0,
  `sira` tinyint(4) DEFAULT 1,
  `harici_sayfa` tinyint(4) DEFAULT 0,
  `kategori_acik` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_modul
-- ----------------------------
INSERT INTO `tb_modul` VALUES ('1', 'Anasayfa', 'anasayfa', 'anasayfa', 'fa fa-home', '1', '0', '0', '1', '0', '0');
INSERT INTO `tb_modul` VALUES ('2', 'Sistem Kullanıcıları', 'sistemKullanicilari', 'sistemKullanicilari', 'fas fa-users-cog text-red', '1', '0', '0', '30', '0', '0');
INSERT INTO `tb_modul` VALUES ('3', 'Yetkiler', 'yetkiler', 'yetkiler', 'far fa-circle text-green', '1', '68', '0', '7', '0', '0');
INSERT INTO `tb_modul` VALUES ('32', 'Modul Yetkileri', 'modulYetkileri', 'modulYetkileri', 'far fa-circle text-yellow', '1', '68', '0', '8', '0', '0');
INSERT INTO `tb_modul` VALUES ('68', 'Sistem İşlemleri', null, null, 'fas fa-sliders-h', '1', '0', '1', '100', '0', '0');
INSERT INTO `tb_modul` VALUES ('90', 'Ön Tanım', null, null, 'fas fa-sitemap', '1', '0', '1', '12', '0', '0');
INSERT INTO `tb_modul` VALUES ('109', 'Üniversiteler', 'universiteler', 'universiteler', 'fas fa-university text-green', '1', '125', '0', '1', '0', '0');
INSERT INTO `tb_modul` VALUES ('110', 'Bölümler', 'bolumler', 'bolumler', 'fas fa-school text-yellow', '1', '125', '0', '3', '0', '0');
INSERT INTO `tb_modul` VALUES ('111', 'Fakülteler', 'fakulteler', 'fakulteler', 'fas fa-building text-blue', '1', '125', '0', '2', '0', '0');
INSERT INTO `tb_modul` VALUES ('112', 'Programlar', 'programlar', 'programlar', 'fas fa-book-reader text-purple', '1', '125', '0', '4', '0', '0');
INSERT INTO `tb_modul` VALUES ('113', 'Ders Yılları', 'dersYillari', 'dersYillari', 'fas fa-calendar-alt text-blue', '1', '127', '0', '1', '0', '0');
INSERT INTO `tb_modul` VALUES ('114', 'Ders Kategorileri', 'dersKategorileri', 'dersKategorileri', 'far fa-circle text-green', '1', '129', '0', '1', '0', '0');
INSERT INTO `tb_modul` VALUES ('115', 'Dönem Tanımları', 'donemler', 'donemler', 'far fa-circle text-orange', '1', '129', '0', '2', '0', '0');
INSERT INTO `tb_modul` VALUES ('116', 'Dersler', 'dersler', 'dersler', 'fas fa-book text-orange', '1', '0', '0', '20', '0', '0');
INSERT INTO `tb_modul` VALUES ('117', 'Öğretim Elemanları', 'ogretimElemanlari', 'ogretimElemanlari', 'fas fa-user-md text-blue', '1', '0', '0', '25', '0', '0');
INSERT INTO `tb_modul` VALUES ('118', 'Dönem Dersleri', 'donemDersleri', 'donemDersleri', 'fas fa-book text-orange', '1', '127', '0', '3', '0', '0');
INSERT INTO `tb_modul` VALUES ('119', 'Komiteler', 'komiteler', 'komiteler', 'fas fa-calendar-plus text-blue', '1', '128', '0', '1', '0', '0');
INSERT INTO `tb_modul` VALUES ('120', 'Komite Dersleri', 'komiteDersleri', 'KomiteDersleri', 'fas fa-book text-green', '1', '128', '0', '2', '0', '0');
INSERT INTO `tb_modul` VALUES ('121', 'Görev Kategorileri', 'gorevKategorileri', 'gorevKategorileri', 'far fa-circle text-blue', '1', '129', '0', '3', '0', '0');
INSERT INTO `tb_modul` VALUES ('122', 'Dönem Görevlileri', 'donemGorevlileri', 'donemGorevlileri', 'fas fa-users text-purple', '1', '127', '0', '4', '0', '0');
INSERT INTO `tb_modul` VALUES ('123', 'Komite Görevlileri', 'komiteGorevlileri', 'komiteGorevlileri', 'fas fa-user text-orange', '1', '128', '0', '4', '0', '0');
INSERT INTO `tb_modul` VALUES ('124', 'Komite Öğretim Üyeleri', 'komiteDersOgretimUyeleri', 'komiteDersOgretimUyeleri', 'fas fa-users text-purple', '1', '128', '0', '3', '0', '0');
INSERT INTO `tb_modul` VALUES ('125', 'Organizasyon Şeması', null, null, 'fas fa-sitemap text-green', '1', '0', '1', '5', '0', '0');
INSERT INTO `tb_modul` VALUES ('126', 'Aktif Dönemler', 'dersYiliDonemler', 'dersYiliDonemler', 'fas fa-list-ol text-green', '1', '127', '0', '2', '0', '0');
INSERT INTO `tb_modul` VALUES ('127', 'Ders Yılı Dönem İşlemleri', null, null, 'fas fa-calendar-alt text-yellow', '1', '0', '1', '10', '0', '0');
INSERT INTO `tb_modul` VALUES ('128', 'Ders Kurulu İşlemleri', null, null, 'fas fa-calendar-plus text-purple', '1', '0', '1', '15', '0', '0');
INSERT INTO `tb_modul` VALUES ('129', 'Sabit Tanımlar', null, null, 'fas fa-table', '1', '0', '1', '35', '0', '0');
INSERT INTO `tb_modul` VALUES ('130', 'Öğrenci İşlemleri', null, null, 'fas fa-users text-danger', '1', '0', '1', '16', '0', '0');
INSERT INTO `tb_modul` VALUES ('131', 'Öğrenciler', 'ogrenciler', 'ogrenciler', 'fas fa-users text-info', '1', '130', '0', '1', '0', '0');
INSERT INTO `tb_modul` VALUES ('132', 'Dönem Öğrencileri', 'donemOgrencileri', 'donemOgrencileri', 'fas fa-users text-purple', '1', '130', '0', '2', '0', '0');

-- ----------------------------
-- Table structure for `tb_modul_yetki_islemler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_modul_yetki_islemler`;
CREATE TABLE `tb_modul_yetki_islemler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul_id` int(11) DEFAULT NULL,
  `yetki_islem_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=781 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_modul_yetki_islemler
-- ----------------------------
INSERT INTO `tb_modul_yetki_islemler` VALUES ('7', '3', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('8', '3', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('9', '3', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('10', '3', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('11', '3', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('12', '3', '15');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('13', '32', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('14', '32', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('15', '32', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('16', '32', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('17', '32', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('46', '53', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('47', '53', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('48', '53', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('49', '53', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('50', '53', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('51', '54', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('52', '54', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('53', '54', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('54', '54', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('55', '54', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('56', '55', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('57', '55', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('58', '55', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('59', '55', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('60', '55', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('61', '56', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('62', '56', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('63', '56', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('64', '56', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('65', '56', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('66', '57', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('67', '57', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('68', '57', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('69', '57', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('70', '57', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('71', '58', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('72', '58', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('73', '58', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('74', '58', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('75', '58', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('76', '59', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('77', '59', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('78', '59', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('79', '59', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('80', '59', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('81', '60', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('82', '60', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('83', '60', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('84', '60', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('85', '60', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('86', '61', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('87', '61', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('88', '61', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('89', '61', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('90', '61', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('91', '62', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('92', '62', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('93', '62', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('94', '62', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('95', '62', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('114', '1', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('115', '1', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('378', '70', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('379', '70', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('380', '70', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('381', '70', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('382', '70', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('383', '70', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('384', '2', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('385', '2', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('386', '2', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('387', '2', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('388', '2', '11');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('389', '2', '12');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('390', '2', '15');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('391', '49', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('392', '49', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('393', '49', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('394', '49', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('456', '63', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('457', '63', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('458', '63', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('459', '63', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('460', '63', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('461', '63', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('462', '63', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('463', '63', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('577', '65', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('578', '65', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('579', '65', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('580', '65', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('581', '65', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('582', '65', '6');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('583', '65', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('584', '65', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('585', '66', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('586', '66', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('587', '66', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('588', '66', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('589', '66', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('590', '66', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('591', '66', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('592', '51', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('593', '51', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('594', '51', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('595', '51', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('596', '51', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('597', '51', '24');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('598', '51', '25');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('599', '51', '26');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('600', '51', '27');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('601', '51', '29');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('602', '51', '30');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('603', '51', '31');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('604', '51', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('605', '51', '33');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('606', '51', '34');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('607', '51', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('608', '51', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('609', '51', '38');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('610', '51', '41');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('611', '52', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('612', '52', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('613', '52', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('614', '52', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('615', '52', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('616', '52', '26');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('617', '52', '29');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('618', '52', '41');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('619', '48', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('620', '48', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('621', '48', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('622', '48', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('623', '48', '6');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('624', '48', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('625', '48', '24');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('626', '48', '26');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('627', '48', '27');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('628', '48', '28');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('629', '48', '29');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('630', '48', '30');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('631', '48', '31');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('632', '48', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('633', '48', '33');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('634', '48', '34');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('635', '48', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('636', '48', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('637', '48', '38');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('638', '48', '39');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('639', '48', '40');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('640', '48', '41');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('641', '71', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('642', '71', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('643', '72', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('644', '72', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('647', '50', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('648', '50', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('649', '50', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('650', '50', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('651', '50', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('652', '50', '24');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('653', '50', '25');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('654', '50', '26');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('655', '50', '27');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('656', '50', '29');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('657', '50', '30');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('658', '50', '31');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('659', '50', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('660', '50', '33');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('661', '50', '34');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('662', '69', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('663', '69', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('664', '69', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('665', '69', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('666', '69', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('667', '69', '6');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('668', '69', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('669', '69', '25');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('670', '69', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('671', '69', '33');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('672', '69', '34');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('673', '69', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('674', '69', '38');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('675', '69', '39');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('676', '69', '40');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('681', '73', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('682', '73', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('683', '73', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('684', '73', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('685', '73', '26');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('686', '73', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('687', '73', '41');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('708', '77', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('709', '77', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('710', '77', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('711', '77', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('712', '77', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('713', '77', '34');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('714', '77', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('715', '74', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('716', '74', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('717', '74', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('718', '74', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('719', '74', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('720', '74', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('721', '74', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('722', '75', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('723', '75', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('724', '75', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('725', '75', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('726', '75', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('727', '75', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('728', '75', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('729', '75', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('730', '78', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('731', '78', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('732', '78', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('733', '78', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('734', '78', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('735', '78', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('736', '78', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('737', '78', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('738', '76', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('739', '76', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('740', '76', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('741', '76', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('742', '76', '23');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('743', '76', '32');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('744', '76', '35');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('745', '76', '36');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('746', '80', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('747', '80', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('748', '80', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('749', '80', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('750', '80', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('755', '92', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('756', '92', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('757', '92', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('758', '92', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('759', '92', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('760', '91', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('761', '91', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('762', '91', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('763', '91', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('764', '91', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('765', '86', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('766', '86', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('767', '86', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('768', '86', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('769', '86', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('770', '87', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('771', '87', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('772', '87', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('773', '87', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('774', '87', '5');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('775', '98', '1');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('776', '98', '2');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('777', '98', '3');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('778', '98', '4');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('779', '98', '6');
INSERT INTO `tb_modul_yetki_islemler` VALUES ('780', '98', '23');

-- ----------------------------
-- Table structure for `tb_mufredat`
-- ----------------------------
DROP TABLE IF EXISTS `tb_mufredat`;
CREATE TABLE `tb_mufredat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ust_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ders_yili_donem_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `ders_id` int(11) DEFAULT NULL,
  `ogretim_elemani_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_mufredat
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ogrenciler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ogrenciler`;
CREATE TABLE `tb_ogrenciler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `fakulte_id` int(11) DEFAULT NULL,
  `bolum_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `tc_kimlik_no` varchar(11) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ogrenci_no` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adi` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `soyadi` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sinif` tinyint(4) DEFAULT NULL,
  `kayit_yili` year(4) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cep_tel` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adres` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_ogrenciler
-- ----------------------------
INSERT INTO `tb_ogrenciler` VALUES ('1', '1', '1', '1', '1', '13337993572', '3', 'Resül', 'EVİS', '5', '2022', 'resulevis60@gmail.com', '5366373523', 'Van merkez', '1');
INSERT INTO `tb_ogrenciler` VALUES ('2', '1', '1', '1', '1', '13337993571', '860', 'Resül', 'EVİS', '2', '2022', 'resulevis60@gmail.com', '5366373523', 'Van Merkez', '1');

-- ----------------------------
-- Table structure for `tb_ogretim_elemanlari`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ogretim_elemanlari`;
CREATE TABLE `tb_ogretim_elemanlari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `fakulte_id` int(11) DEFAULT NULL,
  `anabilim_dali_id` int(11) DEFAULT NULL,
  `tc_kimlik_no` varchar(11) COLLATE utf8_turkish_ci DEFAULT NULL,
  `unvan_id` int(11) DEFAULT NULL,
  `adi` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `soyadi` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cep_tel` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_ogretim_elemanlari
-- ----------------------------
INSERT INTO `tb_ogretim_elemanlari` VALUES ('1', '1', '1', '1', null, '1', 'Sıddık', 'KESKİN', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('2', '1', '1', '1', null, '3', 'Şükran', 'SEVİMLİ', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('3', '1', '1', '1', null, '3', 'Sinemis', 'ÇETİN DAĞLI', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('4', '1', '1', '1', null, '3', 'Mehmet Emin', 'LAYIK', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('5', '1', '1', '1', null, '5', 'Duygu', 'KORKMAZ', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('6', '1', '1', '1', null, '5', 'Tuncay', 'ULU', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('7', '1', '1', '1', null, '5', 'Ahmet', 'SALTIK', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('8', '1', '1', '1', null, '5', 'Zülkaf', 'AKBALIK', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('9', '1', '1', '1', null, '5', 'Zeynep', 'ŞAHİN', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('10', '1', '1', '1', null, '5', 'Hale Mükerrem', 'KAYA', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('11', '1', '1', '1', null, '5', 'Rukiye', 'TOKUŞ', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('12', '1', '1', '1', null, '5', 'İslam', 'KÖSE', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('14', '1', '1', '1', null, '3', 'Hava', 'BEKTAŞ', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('15', '1', '1', '1', null, '4', 'Nuray', 'KAYA', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('16', '1', '1', '1', null, '3', 'İzzet', 'ÇELEĞEN', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('18', '1', '1', '1', null, '2', 'Özlem Ergül', 'ERKEÇ', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('20', '1', '1', '1', null, '3', 'Mustafa', 'BİLİCİ', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('21', '1', '1', '3', null, '1', 'Resül', 'EVİS', 'resul.evis@yyu.edu.tr', '05366373523', '0');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('22', '1', '1', '1', '', '2', 'Tahir', 'ÇAKIR', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('23', '1', '1', '1', null, '2', 'Hamit Hakan', 'ALP', null, null, '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('25', '1', '1', '2', null, '1', 'Halil', 'ÖZKOL', 'mail@mail.com', '5555555555', '1');
INSERT INTO `tb_ogretim_elemanlari` VALUES ('26', '1', '1', '1', null, '2', 'Zübeyir', 'HUYUT', 'mail@mail.com', '555 555 5555', '1');

-- ----------------------------
-- Table structure for `tb_programlar`
-- ----------------------------
DROP TABLE IF EXISTS `tb_programlar`;
CREATE TABLE `tb_programlar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `universite_id` int(11) DEFAULT NULL,
  `bolum_id` int(11) DEFAULT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  `varsayilan` tinyint(4) DEFAULT 0,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_programlar
-- ----------------------------
INSERT INTO `tb_programlar` VALUES ('1', '1', '1', 'Tıp Lisans', '1', '1');
INSERT INTO `tb_programlar` VALUES ('19', '1', '1', 'Program ', '0', '1');

-- ----------------------------
-- Table structure for `tb_roller`
-- ----------------------------
DROP TABLE IF EXISTS `tb_roller`;
CREATE TABLE `tb_roller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `varsayilan` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_roller
-- ----------------------------
INSERT INTO `tb_roller` VALUES ('1', 'Varsayılan', '1');
INSERT INTO `tb_roller` VALUES ('14', 'Şube Yetkisi', '0');
INSERT INTO `tb_roller` VALUES ('15', 'Şube Personeli̇', '0');
INSERT INTO `tb_roller` VALUES ('16', 'Merkez Yetkilisi', '0');
INSERT INTO `tb_roller` VALUES ('17', 'Supervi̇sor', '0');
INSERT INTO `tb_roller` VALUES ('18', 'Soru Yönetimi', '0');

-- ----------------------------
-- Table structure for `tb_rol_yetkiler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol_yetkiler`;
CREATE TABLE `tb_rol_yetkiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `islem_turu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1091 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_rol_yetkiler
-- ----------------------------
INSERT INTO `tb_rol_yetkiler` VALUES ('44', '14', '1', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('45', '14', '1', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('46', '15', '1', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('47', '15', '1', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('68', '16', '3', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('69', '16', '32', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('75', '16', '49', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('111', '16', '55', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('112', '16', '55', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('113', '16', '55', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('114', '16', '54', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('115', '16', '54', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('116', '16', '54', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('117', '16', '53', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('118', '16', '53', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('119', '16', '53', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('120', '16', '56', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('121', '16', '56', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('122', '16', '56', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('123', '16', '57', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('124', '16', '57', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('125', '16', '57', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('126', '16', '59', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('127', '16', '59', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('128', '16', '59', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('129', '16', '60', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('130', '16', '60', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('131', '16', '60', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('132', '16', '61', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('133', '16', '61', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('134', '16', '61', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('135', '16', '62', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('136', '16', '62', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('137', '16', '62', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('138', '16', '2', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('139', '17', '2', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('140', '17', '2', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('141', '17', '2', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('142', '17', '2', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('143', '17', '2', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('144', '17', '3', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('145', '17', '3', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('146', '17', '3', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('147', '17', '3', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('148', '17', '3', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('149', '17', '3', '15');
INSERT INTO `tb_rol_yetkiler` VALUES ('150', '17', '32', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('151', '17', '32', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('152', '17', '32', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('153', '17', '32', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('154', '17', '32', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('161', '17', '49', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('162', '17', '49', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('163', '17', '49', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('164', '17', '49', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('165', '17', '49', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('186', '17', '53', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('187', '17', '53', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('188', '17', '53', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('189', '17', '53', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('190', '17', '53', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('191', '17', '54', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('192', '17', '54', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('193', '17', '54', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('194', '17', '54', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('195', '17', '54', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('196', '17', '55', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('197', '17', '55', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('198', '17', '55', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('199', '17', '55', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('200', '17', '55', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('201', '17', '56', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('202', '17', '56', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('203', '17', '56', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('204', '17', '56', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('205', '17', '56', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('206', '17', '57', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('207', '17', '57', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('208', '17', '57', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('209', '17', '57', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('210', '17', '57', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('211', '17', '58', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('212', '17', '58', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('213', '17', '58', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('214', '17', '58', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('215', '17', '58', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('216', '17', '59', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('217', '17', '59', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('218', '17', '59', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('219', '17', '59', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('220', '17', '59', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('221', '17', '60', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('222', '17', '60', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('223', '17', '60', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('224', '17', '60', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('225', '17', '60', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('226', '17', '61', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('227', '17', '61', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('228', '17', '61', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('229', '17', '61', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('230', '17', '61', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('231', '17', '62', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('232', '17', '62', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('233', '17', '62', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('234', '17', '62', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('235', '17', '62', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('236', '17', '1', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('237', '17', '1', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('277', '17', '69', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('278', '17', '69', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('279', '17', '69', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('280', '17', '69', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('281', '17', '69', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('282', '17', '69', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('283', '17', '69', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('291', '16', '1', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('292', '16', '1', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('303', '17', '48', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('304', '17', '48', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('305', '17', '48', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('306', '17', '48', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('307', '17', '48', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('308', '17', '48', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('309', '17', '48', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('310', '17', '48', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('311', '17', '48', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('401', '16', '63', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('402', '16', '63', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('403', '16', '63', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('404', '16', '63', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('405', '16', '63', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('406', '16', '63', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('407', '15', '63', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('408', '15', '63', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('409', '15', '63', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('410', '15', '63', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('411', '15', '63', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('412', '15', '63', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('419', '14', '69', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('420', '14', '69', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('421', '14', '69', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('422', '14', '69', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('423', '14', '69', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('424', '14', '69', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('425', '14', '69', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('426', '16', '70', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('427', '16', '70', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('428', '16', '70', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('429', '16', '70', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('430', '16', '70', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('431', '16', '70', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('432', '15', '70', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('433', '15', '70', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('434', '15', '70', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('435', '15', '70', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('436', '15', '70', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('437', '15', '70', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('438', '14', '70', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('439', '14', '70', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('440', '14', '70', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('441', '14', '70', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('442', '14', '70', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('443', '14', '70', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('455', '15', '50', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('456', '15', '50', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('457', '15', '50', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('458', '15', '50', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('459', '15', '50', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('460', '15', '50', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('461', '15', '50', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('462', '15', '50', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('463', '15', '50', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('464', '15', '50', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('477', '17', '50', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('478', '17', '50', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('479', '17', '50', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('480', '17', '50', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('481', '17', '50', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('482', '17', '50', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('483', '17', '50', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('484', '17', '50', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('485', '17', '50', '27');
INSERT INTO `tb_rol_yetkiler` VALUES ('486', '17', '50', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('487', '17', '50', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('488', '17', '50', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('489', '17', '50', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('538', '14', '52', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('539', '14', '52', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('540', '14', '52', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('541', '14', '52', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('542', '14', '52', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('543', '15', '52', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('544', '15', '52', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('545', '15', '52', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('546', '15', '52', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('547', '15', '52', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('548', '16', '52', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('549', '16', '52', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('550', '16', '52', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('551', '16', '52', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('552', '16', '52', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('553', '16', '52', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('554', '17', '52', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('555', '17', '52', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('556', '17', '52', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('557', '17', '52', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('558', '17', '52', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('559', '17', '52', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('560', '17', '52', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('561', '17', '63', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('562', '17', '63', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('563', '17', '63', '3');
INSERT INTO `tb_rol_yetkiler` VALUES ('564', '17', '63', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('565', '17', '63', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('566', '17', '63', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('567', '17', '63', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('568', '16', '69', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('569', '16', '69', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('570', '16', '69', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('571', '16', '69', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('572', '16', '69', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('573', '16', '69', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('574', '16', '69', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('575', '15', '69', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('576', '15', '69', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('577', '15', '69', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('578', '15', '69', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('579', '15', '69', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('580', '17', '51', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('581', '17', '51', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('582', '17', '51', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('583', '17', '51', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('584', '17', '51', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('585', '17', '51', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('586', '17', '51', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('587', '17', '51', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('588', '17', '51', '27');
INSERT INTO `tb_rol_yetkiler` VALUES ('589', '17', '51', '28');
INSERT INTO `tb_rol_yetkiler` VALUES ('590', '17', '51', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('591', '17', '51', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('592', '17', '51', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('593', '17', '51', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('594', '17', '51', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('595', '17', '51', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('596', '17', '51', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('597', '17', '51', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('598', '15', '66', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('599', '15', '66', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('600', '15', '66', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('601', '15', '66', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('602', '15', '66', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('603', '15', '66', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('604', '15', '65', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('605', '15', '65', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('606', '15', '65', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('607', '15', '65', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('608', '15', '65', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('609', '15', '65', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('628', '14', '62', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('629', '14', '62', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('630', '14', '62', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('647', '14', '50', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('648', '14', '50', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('649', '14', '50', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('650', '14', '50', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('651', '14', '50', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('652', '14', '50', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('653', '14', '50', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('654', '14', '50', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('655', '14', '50', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('656', '14', '50', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('657', '14', '50', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('658', '14', '50', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('659', '14', '50', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('692', '15', '48', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('693', '15', '48', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('694', '15', '48', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('695', '15', '48', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('696', '15', '48', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('697', '15', '48', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('698', '15', '48', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('699', '15', '48', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('700', '15', '48', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('701', '15', '48', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('737', '14', '51', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('738', '14', '51', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('739', '14', '51', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('740', '14', '51', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('741', '14', '51', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('742', '14', '51', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('743', '14', '51', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('744', '14', '51', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('745', '14', '51', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('746', '14', '51', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('747', '14', '51', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('748', '14', '51', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('749', '14', '51', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('750', '14', '51', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('751', '14', '51', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('752', '14', '51', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('753', '14', '51', '38');
INSERT INTO `tb_rol_yetkiler` VALUES ('754', '15', '51', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('755', '15', '51', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('756', '15', '51', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('757', '15', '51', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('758', '15', '51', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('759', '15', '51', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('760', '15', '51', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('761', '15', '51', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('762', '15', '51', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('763', '15', '51', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('764', '15', '51', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('765', '15', '51', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('766', '15', '51', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('767', '15', '51', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('768', '15', '51', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('769', '15', '51', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('827', '16', '65', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('828', '16', '65', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('829', '16', '65', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('830', '16', '65', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('831', '16', '65', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('832', '16', '65', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('833', '16', '66', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('834', '16', '66', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('835', '16', '66', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('836', '16', '66', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('837', '16', '66', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('838', '14', '66', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('839', '14', '66', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('840', '14', '66', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('841', '14', '66', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('842', '14', '66', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('843', '14', '66', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('844', '14', '65', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('845', '14', '65', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('846', '14', '65', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('847', '14', '65', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('848', '14', '65', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('849', '14', '65', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('850', '14', '65', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('851', '14', '48', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('852', '14', '48', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('853', '14', '48', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('854', '14', '48', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('855', '14', '48', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('856', '14', '48', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('857', '14', '48', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('858', '14', '48', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('859', '14', '48', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('860', '14', '48', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('861', '14', '48', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('862', '14', '48', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('863', '14', '48', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('864', '14', '48', '39');
INSERT INTO `tb_rol_yetkiler` VALUES ('865', '14', '48', '40');
INSERT INTO `tb_rol_yetkiler` VALUES ('866', '14', '63', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('867', '14', '63', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('868', '14', '63', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('869', '14', '63', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('870', '14', '63', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('871', '14', '63', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('872', '14', '63', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('873', '14', '63', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('874', '16', '50', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('875', '16', '50', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('876', '16', '50', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('877', '16', '50', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('878', '16', '50', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('879', '16', '50', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('880', '16', '50', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('881', '16', '50', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('882', '16', '50', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('883', '16', '50', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('884', '16', '50', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('885', '16', '50', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('886', '16', '50', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('904', '16', '51', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('905', '16', '51', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('906', '16', '51', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('907', '16', '51', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('908', '16', '51', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('909', '16', '51', '24');
INSERT INTO `tb_rol_yetkiler` VALUES ('910', '16', '51', '25');
INSERT INTO `tb_rol_yetkiler` VALUES ('911', '16', '51', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('912', '16', '51', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('913', '16', '51', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('914', '16', '51', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('915', '16', '51', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('916', '16', '51', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('917', '16', '51', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('918', '16', '51', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('919', '16', '51', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('920', '16', '51', '38');
INSERT INTO `tb_rol_yetkiler` VALUES ('921', '16', '51', '41');
INSERT INTO `tb_rol_yetkiler` VALUES ('922', '16', '48', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('923', '16', '48', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('924', '16', '48', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('925', '16', '48', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('926', '16', '48', '6');
INSERT INTO `tb_rol_yetkiler` VALUES ('927', '16', '48', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('928', '16', '48', '26');
INSERT INTO `tb_rol_yetkiler` VALUES ('929', '16', '48', '29');
INSERT INTO `tb_rol_yetkiler` VALUES ('930', '16', '48', '30');
INSERT INTO `tb_rol_yetkiler` VALUES ('931', '16', '48', '31');
INSERT INTO `tb_rol_yetkiler` VALUES ('932', '16', '48', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('933', '16', '48', '33');
INSERT INTO `tb_rol_yetkiler` VALUES ('934', '16', '48', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('935', '16', '48', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('936', '16', '48', '38');
INSERT INTO `tb_rol_yetkiler` VALUES ('937', '16', '73', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('938', '16', '73', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('939', '16', '73', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('940', '16', '73', '41');
INSERT INTO `tb_rol_yetkiler` VALUES ('947', '15', '74', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('948', '15', '74', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('949', '15', '74', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('950', '15', '74', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('951', '15', '74', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('952', '15', '74', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('953', '15', '74', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('954', '16', '74', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('955', '16', '74', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('956', '16', '74', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('957', '16', '74', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('958', '16', '74', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('959', '16', '74', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('960', '16', '74', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('961', '14', '74', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('962', '14', '74', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('963', '14', '74', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('964', '14', '74', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('965', '14', '74', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('966', '14', '74', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('967', '14', '74', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('968', '16', '75', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('969', '16', '75', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('970', '16', '75', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('971', '16', '75', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('972', '16', '75', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('973', '16', '75', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('974', '16', '75', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('975', '16', '75', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('976', '14', '75', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('977', '14', '75', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('978', '14', '75', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('979', '14', '75', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('980', '14', '75', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('981', '14', '75', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('982', '14', '75', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('983', '14', '75', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('984', '15', '75', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('985', '15', '75', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('986', '15', '75', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('987', '15', '75', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('988', '15', '75', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('989', '15', '75', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('990', '15', '75', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('991', '15', '75', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1013', '16', '77', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1014', '16', '77', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1015', '16', '77', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1016', '16', '77', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1017', '16', '77', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1018', '16', '77', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('1019', '16', '77', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1020', '15', '77', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1021', '15', '77', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1022', '15', '77', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1023', '15', '77', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1024', '15', '77', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1025', '15', '77', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('1026', '15', '77', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1027', '14', '77', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1028', '14', '77', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1029', '14', '77', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1030', '14', '77', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1031', '14', '77', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1032', '14', '77', '34');
INSERT INTO `tb_rol_yetkiler` VALUES ('1033', '14', '77', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1034', '16', '78', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1035', '16', '78', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1036', '16', '78', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1037', '16', '78', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1038', '16', '78', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('1039', '16', '78', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1040', '16', '78', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1041', '16', '78', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1042', '14', '78', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1043', '14', '78', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1044', '14', '78', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1045', '14', '78', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1046', '14', '78', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('1047', '14', '78', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1048', '14', '78', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1049', '14', '78', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1050', '15', '78', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1051', '15', '78', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1052', '15', '78', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1053', '15', '78', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1054', '15', '78', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('1055', '15', '78', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1056', '15', '78', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1057', '15', '78', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1065', '14', '76', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1066', '14', '76', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1067', '14', '76', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1068', '14', '76', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1069', '14', '76', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('1070', '14', '76', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1071', '14', '76', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1072', '14', '76', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1073', '15', '76', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1074', '15', '76', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1075', '15', '76', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1076', '15', '76', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1077', '15', '76', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('1078', '15', '76', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1079', '15', '76', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1080', '15', '76', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1081', '16', '76', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1082', '16', '76', '2');
INSERT INTO `tb_rol_yetkiler` VALUES ('1083', '16', '76', '4');
INSERT INTO `tb_rol_yetkiler` VALUES ('1084', '16', '76', '5');
INSERT INTO `tb_rol_yetkiler` VALUES ('1085', '16', '76', '23');
INSERT INTO `tb_rol_yetkiler` VALUES ('1086', '16', '76', '32');
INSERT INTO `tb_rol_yetkiler` VALUES ('1087', '16', '76', '35');
INSERT INTO `tb_rol_yetkiler` VALUES ('1088', '16', '76', '36');
INSERT INTO `tb_rol_yetkiler` VALUES ('1089', '14', '91', '1');
INSERT INTO `tb_rol_yetkiler` VALUES ('1090', '1', '1', '1');

-- ----------------------------
-- Table structure for `tb_rol_yetkili_firmalar`
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol_yetkili_firmalar`;
CREATE TABLE `tb_rol_yetkili_firmalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `firma_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of tb_rol_yetkili_firmalar
-- ----------------------------
INSERT INTO `tb_rol_yetkili_firmalar` VALUES ('18', '2', '4');
INSERT INTO `tb_rol_yetkili_firmalar` VALUES ('17', '2', '3');
INSERT INTO `tb_rol_yetkili_firmalar` VALUES ('16', '2', '2');
INSERT INTO `tb_rol_yetkili_firmalar` VALUES ('8', '8', '1');
INSERT INTO `tb_rol_yetkili_firmalar` VALUES ('9', '8', '32');
INSERT INTO `tb_rol_yetkili_firmalar` VALUES ('15', '2', '1');

-- ----------------------------
-- Table structure for `tb_rol_yetkili_subeler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol_yetkili_subeler`;
CREATE TABLE `tb_rol_yetkili_subeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `sube_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of tb_rol_yetkili_subeler
-- ----------------------------
INSERT INTO `tb_rol_yetkili_subeler` VALUES ('11', '14', '2');
INSERT INTO `tb_rol_yetkili_subeler` VALUES ('9', '14', '3');

-- ----------------------------
-- Table structure for `tb_sistem_kullanici`
-- ----------------------------
DROP TABLE IF EXISTS `tb_sistem_kullanici`;
CREATE TABLE `tb_sistem_kullanici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `soyadi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sifre` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rol_id` int(11) NOT NULL DEFAULT 1,
  `super` tinyint(4) DEFAULT 0,
  `resim` varchar(255) COLLATE utf8_turkish_ci DEFAULT 'resim_yok.jpg',
  `tc_no` varchar(11) COLLATE utf8_turkish_ci DEFAULT NULL,
  `dogum_tarihi` datetime DEFAULT NULL,
  `universiteler` varchar(255) COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_sistem_kullanici
-- ----------------------------
INSERT INTO `tb_sistem_kullanici` VALUES ('19', 'Serbest', 'ZİYANAK', 'serbest.ziyanak@gmail.com', '0(544) 496-1144', 'bc000ebca4a5687a014d9c9f94da86e8', '14', '1', '19.jpg', '45982964018', '1989-01-20 00:00:00', '1');
INSERT INTO `tb_sistem_kullanici` VALUES ('28', 'Fırat', 'KAPAR', 'frtkpr@gmail.com', '0(542) 220-5037', '8be2809a53bb3dd3638f9e5b82cd4902', '14', '1', '28.png', '11111111111', '1970-01-01 00:00:00', '1');
INSERT INTO `tb_sistem_kullanici` VALUES ('29', 'Serdar', 'ÇAÇA', 'serdar@gmail.com', '0(537) 612-4543', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', 'resim_yok.jpg', '12345678910', '1991-11-11 00:00:00', '1');
INSERT INTO `tb_sistem_kullanici` VALUES ('30', 'Resul', 'EVİS', 'resulevis60@gmail.com', '0(555) 555-5555', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', 'resim_yok.jpg', '12345678910', '1988-11-11 00:00:00', '1');

-- ----------------------------
-- Table structure for `tb_sistem_kullanici_yetkili_birimler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_sistem_kullanici_yetkili_birimler`;
CREATE TABLE `tb_sistem_kullanici_yetkili_birimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birim_id` int(11) DEFAULT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_sistem_kullanici_yetkili_birimler
-- ----------------------------
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES ('1', '1', '1');
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES ('2', '2', '1');
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES ('3', '1', '2');
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES ('4', '1', '4');
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES ('5', '1', '7');

-- ----------------------------
-- Table structure for `tb_soru_bankasi`
-- ----------------------------
DROP TABLE IF EXISTS `tb_soru_bankasi`;
CREATE TABLE `tb_soru_bankasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `soru` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `soru_turu_id` int(11) DEFAULT NULL,
  `soru_dosyasi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `mufredat_id` int(11) DEFAULT NULL,
  `ders_yili_donem_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `ders_id` int(11) DEFAULT NULL,
  `ogretim_elemani_id` int(11) DEFAULT NULL,
  `zorluk_derecesi` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_soru_bankasi
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_soru_secenekleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_soru_secenekleri`;
CREATE TABLE `tb_soru_secenekleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `soru_id` int(11) DEFAULT NULL,
  `secenek` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `dogru_secenek` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_soru_secenekleri
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_soru_turleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_soru_turleri`;
CREATE TABLE `tb_soru_turleri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `coklu_secenek` tinyint(4) DEFAULT 0,
  `metin` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_soru_turleri
-- ----------------------------
INSERT INTO `tb_soru_turleri` VALUES ('1', 'Çoktan Tek Seçmeli', '0', '0');
INSERT INTO `tb_soru_turleri` VALUES ('2', 'Çoktan Çok Seçmeli', '1', '0');
INSERT INTO `tb_soru_turleri` VALUES ('3', 'Açık Uçlu', '0', '1');

-- ----------------------------
-- Table structure for `tb_universiteler`
-- ----------------------------
DROP TABLE IF EXISTS `tb_universiteler`;
CREATE TABLE `tb_universiteler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_universiteler
-- ----------------------------
INSERT INTO `tb_universiteler` VALUES ('1', 'Van Yüzüncü Yıl Üniversitesi', '1');
INSERT INTO `tb_universiteler` VALUES ('2', 'İstanbul Teknik Üniversitesi', '0');
INSERT INTO `tb_universiteler` VALUES ('3', 'Hacattepe Üniversitesi', '0');
INSERT INTO `tb_universiteler` VALUES ('4', 'Yıldız Teknik Üniversitesi', '1');

-- ----------------------------
-- Table structure for `tb_unvanlar`
-- ----------------------------
DROP TABLE IF EXISTS `tb_unvanlar`;
CREATE TABLE `tb_unvanlar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_unvanlar
-- ----------------------------
INSERT INTO `tb_unvanlar` VALUES ('1', 'Prof. Dr.', '1');
INSERT INTO `tb_unvanlar` VALUES ('2', 'Doc. Dr.', '2');
INSERT INTO `tb_unvanlar` VALUES ('3', 'Dr. Öğr. Üyesi', '3');
INSERT INTO `tb_unvanlar` VALUES ('4', 'Öğr. Gör. Dr.', '4');
INSERT INTO `tb_unvanlar` VALUES ('5', 'Arş. Gör. Dr.', '5');
INSERT INTO `tb_unvanlar` VALUES ('6', 'Öğr. Gör.', '6');
INSERT INTO `tb_unvanlar` VALUES ('7', 'Arş. Gör.', '7');

-- ----------------------------
-- Table structure for `tb_yetki`
-- ----------------------------
DROP TABLE IF EXISTS `tb_yetki`;
CREATE TABLE `tb_yetki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici_id` int(11) DEFAULT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `yetki_islem_turu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_yetki
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_yetki_islem_turleri`
-- ----------------------------
DROP TABLE IF EXISTS `tb_yetki_islem_turleri`;
CREATE TABLE `tb_yetki_islem_turleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `gorunen_adi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_yetki_islem_turleri
-- ----------------------------
INSERT INTO `tb_yetki_islem_turleri` VALUES ('1', 'goruntule', 'Görüntüle');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('2', 'ekle', 'Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('3', 'sil', 'Sil');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('4', 'duzenle', 'Düzenle');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('5', 'kaydet', 'Kaydet');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('6', 'rapor', 'Rapor Al');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('10', 'super', 'Super Yetki Ataması');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('11', 'rol-degistir', 'Kullanıcı Rol Değiştir');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('12', 'birim-ata', 'Birim Yetkisi Ver');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('15', 'rol-islem-ata', 'Rol Yetkilendirme');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('22', 'yedek_al', 'Yedek Alma');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('23', 'detaylar', 'Detaylar');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('24', 'arac_satis', 'Araç Satış');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('25', 'prosesler', 'Prosesler');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('26', 'arac_sec', 'Araç Seç Butonu');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('27', 'onayla', 'Onayla');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('28', 'onay_kaldir', 'Onay Kaldır');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('29', 'satis_sozlesmesi', 'Satış Sözleşmesi');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('30', 'kapak_yazdir', 'Kapak Yazdır');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('31', 'qr_kod_yazdir', 'QR Kod Yazdır');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('32', 'ara', 'Ara');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('33', 'hizmet_sozlesmesi', 'Hizmet Sözleşmesi');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('34', 'onaya_gonder', 'Onaya Gönder');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('35', 'whatsapp', 'Whatsapp');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('36', 'randevu_olustur', 'Randevu Oluştur');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('38', 'medya_sil', 'Medya Sil');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('39', 'ekstra_hizmet_bedeli_onayla', 'Ekstra Hizmet Bedelini Onayla');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('40', 'ekstra_hizmet_bedeli_onay_kaldir', 'Ekstra Hizmet Bedeli Onayını Kaldır');
INSERT INTO `tb_yetki_islem_turleri` VALUES ('41', 'yayindan_kaldir', 'Yayından Kaldır');
