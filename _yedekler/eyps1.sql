/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100425 (10.4.25-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : eyps

 Target Server Type    : MySQL
 Target Server Version : 100425 (10.4.25-MariaDB)
 File Encoding         : 65001

 Date: 02/12/2022 17:03:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for deneme
-- ----------------------------
DROP TABLE IF EXISTS `deneme`;
CREATE TABLE `deneme`  (
  `ip` int NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of deneme
-- ----------------------------
INSERT INTO `deneme` VALUES (2130706433);

-- ----------------------------
-- Table structure for tb_anabilim_dallari
-- ----------------------------
DROP TABLE IF EXISTS `tb_anabilim_dallari`;
CREATE TABLE `tb_anabilim_dallari`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fakulte_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_anabilim_dallari
-- ----------------------------
INSERT INTO `tb_anabilim_dallari` VALUES (1, 1, 'Anesteziyoloji ve Reanimasyon Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (2, 1, 'Çocuk Cerrahisi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (3, 1, 'Genel Cerrahi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (4, 1, 'Göğüs Cerrahisi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (5, 1, 'Göz Hastalıkları Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (6, 1, 'Kadın Hastalıkları ve Doğum Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (7, 1, 'Kalp ve Damar Cerrahisi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (8, 1, 'Kulak Burun Boğaz Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (9, 1, 'Nöroşirürji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (10, 1, 'Ortopedi ve Travmatoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (11, 1, 'Plastik ve Rekonstrüktif Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (12, 1, 'Üroloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (13, 1, 'Anatomi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (14, 1, 'Biyofizik Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (15, 1, 'Biyoistatistik Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (16, 1, 'Biyokimya Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (17, 1, 'Fizyoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (18, 1, 'Histoloji ve Embriyoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (19, 1, 'Mikrobiyoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (20, 1, 'Patoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (21, 1, 'Tıbbi Biyoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (22, 1, 'Tıbbi Parazitoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (23, 1, 'Tıp Eğitimi ve Bilişimi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (24, 1, 'Tıp Tarihi ve Etik Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (25, 1, 'Acil Tıp Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (26, 1, 'Adli Tıp Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (27, 1, 'Aile Hekimliği Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (28, 1, 'Çocuk Sağlığı ve Hastalıkları Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (29, 1, 'Dermatoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (30, 1, 'Farmakoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (31, 1, 'Fiziksel Tıp ve Rehabilitasyon Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (32, 1, 'Göğüs Hastalıkları Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (33, 1, 'Halk Sağlığı Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (34, 1, 'İç Hastalıkları Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (35, 1, 'Kardiyoloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (36, 1, 'Klinik Bakteriyoloji ve Enfeksiyon Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (37, 1, 'Nöroloji Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (38, 1, 'Nükleer Tıp Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (39, 1, 'Psikiyatri Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (40, 1, 'Radyasyon Onkolojisi Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (41, 1, 'Radyodiagnostik Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (42, 1, 'Spor Hekimliği Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (43, 1, 'Tıbbi Genetik Anabilim Dalı', 1);
INSERT INTO `tb_anabilim_dallari` VALUES (44, 1, 'Diğer', 1);

-- ----------------------------
-- Table structure for tb_anket_cevaplari
-- ----------------------------
DROP TABLE IF EXISTS `tb_anket_cevaplari`;
CREATE TABLE `tb_anket_cevaplari`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `anket_id` int NULL DEFAULT NULL,
  `soru_id` int NULL DEFAULT NULL,
  `ogrenci_id` int NULL DEFAULT NULL,
  `cevap` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_anket_cevaplari
-- ----------------------------
INSERT INTO `tb_anket_cevaplari` VALUES (1, 1, 1, 131, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (2, 1, 2, 131, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (3, 1, 3, 131, 4);
INSERT INTO `tb_anket_cevaplari` VALUES (4, 1, 4, 131, 5);
INSERT INTO `tb_anket_cevaplari` VALUES (5, 1, 1, 129, 1);
INSERT INTO `tb_anket_cevaplari` VALUES (6, 1, 2, 129, 1);
INSERT INTO `tb_anket_cevaplari` VALUES (7, 1, 3, 129, 1);
INSERT INTO `tb_anket_cevaplari` VALUES (8, 1, 4, 129, 1);
INSERT INTO `tb_anket_cevaplari` VALUES (9, 2, 1, 129, 1);
INSERT INTO `tb_anket_cevaplari` VALUES (10, 2, 2, 129, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (11, 2, 3, 129, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (12, 2, 4, 129, 1);
INSERT INTO `tb_anket_cevaplari` VALUES (13, 1, 1, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (14, 1, 2, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (15, 1, 3, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (16, 1, 4, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (17, 2, 1, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (18, 2, 2, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (19, 2, 3, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (20, 2, 4, 2, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (21, 1, 1, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (22, 1, 2, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (23, 1, 3, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (24, 1, 4, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (25, 2, 1, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (26, 2, 2, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (27, 2, 3, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (28, 2, 4, 1, 2);
INSERT INTO `tb_anket_cevaplari` VALUES (29, 2, 1, 131, 4);
INSERT INTO `tb_anket_cevaplari` VALUES (30, 2, 2, 131, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (31, 2, 3, 131, 3);
INSERT INTO `tb_anket_cevaplari` VALUES (32, 2, 4, 131, 2);

-- ----------------------------
-- Table structure for tb_anket_ogrencileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_anket_ogrencileri`;
CREATE TABLE `tb_anket_ogrencileri`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `anket_id` int NULL DEFAULT NULL,
  `ogrenci_id` int NULL DEFAULT NULL,
  `anket_bitti` tinyint UNSIGNED NULL DEFAULT 0 COMMENT '1 Olması Bitti anlamında 0 Olması Katılmadığı anlamında',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_anket_ogrencileri
-- ----------------------------
INSERT INTO `tb_anket_ogrencileri` VALUES (1, 1, 3, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (2, 1, 9, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (3, 1, 4, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (4, 1, 129, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (5, 1, 131, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (6, 1, 2, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (7, 1, 1, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (8, 2, 3, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (9, 2, 9, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (10, 2, 4, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (11, 2, 129, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (12, 2, 130, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (13, 2, 2, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (14, 2, 1, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (15, 2, 131, 1);
INSERT INTO `tb_anket_ogrencileri` VALUES (16, 3, 3, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (17, 3, 9, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (18, 3, 4, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (19, 3, 129, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (20, 3, 130, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (21, 3, 2, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (22, 3, 1, 0);
INSERT INTO `tb_anket_ogrencileri` VALUES (23, 3, 131, 0);

-- ----------------------------
-- Table structure for tb_anket_sablon
-- ----------------------------
DROP TABLE IF EXISTS `tb_anket_sablon`;
CREATE TABLE `tb_anket_sablon`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `fakulte_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `donem_id` int NULL DEFAULT NULL,
  `adi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_anket_sablon
-- ----------------------------
INSERT INTO `tb_anket_sablon` VALUES (1, 1, NULL, NULL, NULL, 'Anket Değerlendirme Formu', 0);
INSERT INTO `tb_anket_sablon` VALUES (2, 1, NULL, NULL, NULL, 'Öğretim Görevlisi Değerlendirme', 1);

-- ----------------------------
-- Table structure for tb_anket_sablon_sorulari
-- ----------------------------
DROP TABLE IF EXISTS `tb_anket_sablon_sorulari`;
CREATE TABLE `tb_anket_sablon_sorulari`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sablon_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_anket_sablon_sorulari
-- ----------------------------
INSERT INTO `tb_anket_sablon_sorulari` VALUES (1, 2, 'Öğretim Görevlisi bilgisi yeterli mi?', 1);
INSERT INTO `tb_anket_sablon_sorulari` VALUES (2, 2, 'Öğretim görevlisi zamanında geliyor', 1);
INSERT INTO `tb_anket_sablon_sorulari` VALUES (3, 2, 'Öğretim görevlisi tertipli mi?', 1);
INSERT INTO `tb_anket_sablon_sorulari` VALUES (4, 2, 'Öğrencilere kaba davranıyor mu?', 1);

-- ----------------------------
-- Table structure for tb_anket_sorulari
-- ----------------------------
DROP TABLE IF EXISTS `tb_anket_sorulari`;
CREATE TABLE `tb_anket_sorulari`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `anket_id` int NULL DEFAULT NULL,
  `soru_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_anket_sorulari
-- ----------------------------
INSERT INTO `tb_anket_sorulari` VALUES (1, 1, 1);
INSERT INTO `tb_anket_sorulari` VALUES (2, 1, 2);
INSERT INTO `tb_anket_sorulari` VALUES (3, 1, 3);
INSERT INTO `tb_anket_sorulari` VALUES (4, 1, 4);
INSERT INTO `tb_anket_sorulari` VALUES (5, 2, 1);
INSERT INTO `tb_anket_sorulari` VALUES (6, 2, 2);
INSERT INTO `tb_anket_sorulari` VALUES (7, 2, 3);
INSERT INTO `tb_anket_sorulari` VALUES (8, 2, 4);
INSERT INTO `tb_anket_sorulari` VALUES (9, 3, 1);
INSERT INTO `tb_anket_sorulari` VALUES (10, 3, 2);
INSERT INTO `tb_anket_sorulari` VALUES (11, 3, 3);
INSERT INTO `tb_anket_sorulari` VALUES (12, 3, 4);

-- ----------------------------
-- Table structure for tb_anketler
-- ----------------------------
DROP TABLE IF EXISTS `tb_anketler`;
CREATE TABLE `tb_anketler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `fakulte_id` int NULL DEFAULT NULL,
  `donem_id` int NULL DEFAULT NULL,
  `kategori` int NULL DEFAULT NULL,
  `kategori_id` int NULL DEFAULT NULL,
  `sablon_id` int NULL DEFAULT NULL,
  `adi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_anketler
-- ----------------------------
INSERT INTO `tb_anketler` VALUES (1, 1, NULL, 1, 1, 1, 2, 'Tıbba Giriş Komite  Degerlendirmesi', 1);
INSERT INTO `tb_anketler` VALUES (2, 1, NULL, 1, 1, 1, 2, 'Sınav Sonrası Anket', 1);
INSERT INTO `tb_anketler` VALUES (3, 1, NULL, 1, 1, 1, 2, 'asdasd', 1);

-- ----------------------------
-- Table structure for tb_bolumler
-- ----------------------------
DROP TABLE IF EXISTS `tb_bolumler`;
CREATE TABLE `tb_bolumler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `fakulte_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_bolumler
-- ----------------------------
INSERT INTO `tb_bolumler` VALUES (1, 1, 1, 'Cerrahi Tıp Bilimleri Bölümü', 1);
INSERT INTO `tb_bolumler` VALUES (2, 1, 1, 'Dahili Tıp Bilimleri Bölümü', 1);

-- ----------------------------
-- Table structure for tb_ders_kategorileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_ders_kategorileri`;
CREATE TABLE `tb_ders_kategorileri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_ders_kategorileri
-- ----------------------------
INSERT INTO `tb_ders_kategorileri` VALUES (1, 1, 'Zorunlu Ders', 1);
INSERT INTO `tb_ders_kategorileri` VALUES (2, 1, 'Seçmeli Ders', 1);
INSERT INTO `tb_ders_kategorileri` VALUES (3, 1, 'Alttan Ders', 0);

-- ----------------------------
-- Table structure for tb_ders_yili_donemleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_ders_yili_donemleri`;
CREATE TABLE `tb_ders_yili_donemleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` int NULL DEFAULT NULL,
  `ders_yili_id` int NULL DEFAULT NULL,
  `donem_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_ders_yili_donemleri
-- ----------------------------
INSERT INTO `tb_ders_yili_donemleri` VALUES (1, 1, 1, 1);
INSERT INTO `tb_ders_yili_donemleri` VALUES (2, 1, 1, 2);
INSERT INTO `tb_ders_yili_donemleri` VALUES (3, 1, 1, 3);
INSERT INTO `tb_ders_yili_donemleri` VALUES (4, 1, 1, 4);
INSERT INTO `tb_ders_yili_donemleri` VALUES (5, 1, 1, 5);
INSERT INTO `tb_ders_yili_donemleri` VALUES (11, 1, 1, 6);

-- ----------------------------
-- Table structure for tb_ders_yillari
-- ----------------------------
DROP TABLE IF EXISTS `tb_ders_yillari`;
CREATE TABLE `tb_ders_yillari`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `baslangic_tarihi` date NULL DEFAULT NULL,
  `bitis_tarihi` date NULL DEFAULT NULL,
  `ilk_goruntulenecek` tinyint NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_ders_yillari
-- ----------------------------
INSERT INTO `tb_ders_yillari` VALUES (1, 1, '2022 - 2023 Ders Yılı', '2022-09-19', '2023-06-19', 1, 1);
INSERT INTO `tb_ders_yillari` VALUES (3, 1, '2023 - 2024 Ders Yılı', '2023-09-17', '2024-06-20', 0, 1);

-- ----------------------------
-- Table structure for tb_dersler
-- ----------------------------
DROP TABLE IF EXISTS `tb_dersler`;
CREATE TABLE `tb_dersler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` int NULL DEFAULT NULL,
  `anabilim_dali_id` int NULL DEFAULT NULL,
  `ders_kategori_id` int NULL DEFAULT NULL,
  `ders_kodu` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 70 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_dersler
-- ----------------------------
INSERT INTO `tb_dersler` VALUES (1, 1, 13, 1, 'TFANT101', 'Anatomi / Anatomy', 1);
INSERT INTO `tb_dersler` VALUES (2, 1, 14, 1, 'TFBFZ102', 'Biyofizik / Biophysics', 1);
INSERT INTO `tb_dersler` VALUES (3, 1, 15, 1, 'TFBIS103', 'Biyoistatistik / Biostatistics', 1);
INSERT INTO `tb_dersler` VALUES (4, 1, 16, 1, 'TFBIK104', 'Tıbbi Biyokimya / Biochemistry', 1);
INSERT INTO `tb_dersler` VALUES (5, 1, 44, 1, 'TFDAB105', 'Davranış Bilimleri / Behavioral Sciences', 1);
INSERT INTO `tb_dersler` VALUES (6, 1, 17, 1, 'TFFZY106', 'Fizyoloji / Physiology', 1);
INSERT INTO `tb_dersler` VALUES (7, 1, 33, 1, 'TFHSA107', 'Halk Sağlığı / Public Health', 1);
INSERT INTO `tb_dersler` VALUES (8, 1, 18, 1, 'TFHIE108', 'Histoloji-Embriyoloji / Histology and Embryology', 1);
INSERT INTO `tb_dersler` VALUES (9, 1, 19, 1, 'TFMIB109', 'Tıbbi Mikrobiyoloji / Microbiology', 1);
INSERT INTO `tb_dersler` VALUES (10, 1, 21, 1, 'TFTIB110', 'Tıbbi Biyoloji / Medical Biology', 1);
INSERT INTO `tb_dersler` VALUES (11, 1, 43, 1, 'TFTIG111', 'Tıbbi Genetik / Medical Genetics', 1);
INSERT INTO `tb_dersler` VALUES (12, 1, 44, 1, 'TFTIT111', 'Tıbbi Terminoloji / Medical Terminology', 1);
INSERT INTO `tb_dersler` VALUES (13, 1, 23, 1, 'TFTE112', 'Tıp Eğitimi ve Bilişimi / Medical Education', 1);
INSERT INTO `tb_dersler` VALUES (14, 1, 24, 1, 'TFTTE113', 'Tıp Tarihi ve Etik / Medical History and Ethics', 1);
INSERT INTO `tb_dersler` VALUES (15, 1, 44, 1, 'TFİLE114', 'İletişim Becerisi / CommunicationSkills', 1);
INSERT INTO `tb_dersler` VALUES (16, 1, 13, 1, 'TFANT201', 'Anatomi / Anatomy', 1);
INSERT INTO `tb_dersler` VALUES (17, 1, 14, 1, 'TFBFZ202', 'Biyofizik / Biophysics', 1);
INSERT INTO `tb_dersler` VALUES (18, 1, 16, 1, 'TFBIK204', 'Biyokimya / Biochemistry', 1);
INSERT INTO `tb_dersler` VALUES (19, 1, 30, 1, 'TFFAR205', 'Farmakoloji / Pharmacology', 1);
INSERT INTO `tb_dersler` VALUES (20, 1, 17, 1, 'TFFIZ206', 'Fizyoloji / Physiology', 1);
INSERT INTO `tb_dersler` VALUES (21, 1, 18, 1, 'TFHIE207', 'Histoloji-Embriyoloji / Histology and Embryology', 1);
INSERT INTO `tb_dersler` VALUES (23, 1, 19, 1, 'TFMIK208', 'Mikrobiyoloji / Microbiology', 1);
INSERT INTO `tb_dersler` VALUES (24, 1, 22, 1, 'TFPRZ209', 'Parazitoloji / Parasitology', 1);
INSERT INTO `tb_dersler` VALUES (25, 1, 20, 1, 'TFPAT210', 'Patoloji / Pathology', 1);
INSERT INTO `tb_dersler` VALUES (26, 1, 21, 1, 'TFTIB211', 'Tıbbi Biyoloji / Medical Biology', 1);
INSERT INTO `tb_dersler` VALUES (27, 1, 23, 1, 'TFTEG213', 'Tıp Eğitimi ve Bilişimi / Medical Education', 1);
INSERT INTO `tb_dersler` VALUES (28, 1, 24, 1, 'TFTTE214', 'Tıp Tarihi ve Etik / Medical History and Ethics', 1);
INSERT INTO `tb_dersler` VALUES (29, 1, 43, 1, 'TFTIG2015', 'Tıbbi Genetik / Medical Genetics', 1);
INSERT INTO `tb_dersler` VALUES (30, 1, 25, 1, 'TFACT301', 'Acil Tıp / Emergency Medicine', 1);
INSERT INTO `tb_dersler` VALUES (31, 1, 26, 1, 'TFADT302', 'Adli Tıp / Forensic Medicine', 1);
INSERT INTO `tb_dersler` VALUES (32, 1, 27, 1, 'TFAIH303', 'Aile Hekimliği / Family Medicine', 1);
INSERT INTO `tb_dersler` VALUES (33, 1, 37, 1, 'TFBSC305', 'Beyin Cerrahisi / Neurosurgery', 1);
INSERT INTO `tb_dersler` VALUES (34, 1, 16, 1, 'TFBIK307', 'Tıbbi Biyokimya / Clinical Biochemistry', 1);
INSERT INTO `tb_dersler` VALUES (35, 1, 14, 1, 'TFBIFZ307', 'Biyofizik/Biophisic', 1);
INSERT INTO `tb_dersler` VALUES (36, 1, 2, 1, 'TFCCE308', 'Çocuk Cerrahisi / Pediatric Surgery', 1);
INSERT INTO `tb_dersler` VALUES (37, 1, 39, 1, 'TFCPS309', 'Çocuk Psikiyatrisi / Child and Adolescent Psychiatry', 1);
INSERT INTO `tb_dersler` VALUES (38, 1, 28, 1, 'TFPED310', 'Çocuk Sağlığı ve Hastalıkları / Pediatrics', 1);
INSERT INTO `tb_dersler` VALUES (39, 1, 29, 1, 'TFDER311', 'Dermatoloji / Dermatology', 1);
INSERT INTO `tb_dersler` VALUES (40, 1, 36, 1, 'TFENF312', 'Enfeksiyon Hastalıkları / Infectious Diseases', 1);
INSERT INTO `tb_dersler` VALUES (41, 1, 30, 1, 'TFFAR313', 'Farmakoloji / Pharmacology', 1);
INSERT INTO `tb_dersler` VALUES (42, 1, 31, 1, 'TFFTR314', 'Fizik Tedavi ve Rehabilitasyon / Physical Medicine and Rehabilitation', 1);
INSERT INTO `tb_dersler` VALUES (43, 1, 3, 1, 'TFGEC315', 'Genel Cerrahi / General Surgery', 1);
INSERT INTO `tb_dersler` VALUES (44, 1, 4, 1, 'TFGOC316', 'Göğüs Cerrahisi / Chest Surgery', 1);
INSERT INTO `tb_dersler` VALUES (45, 1, 32, 1, 'TFGOH317', 'Göğüs Hastalıkları / Chest Diseases', 1);
INSERT INTO `tb_dersler` VALUES (46, 1, 5, 1, 'TFGOZ318', 'Göz Hastalıkları / Ophthalmology', 1);
INSERT INTO `tb_dersler` VALUES (47, 1, 33, 1, 'TFHSA319', 'Halk Sağlığı / Public Health', 1);
INSERT INTO `tb_dersler` VALUES (48, 1, 34, 1, 'TFDAH320', 'İç Hastalıkları / Internal Medicine', 1);
INSERT INTO `tb_dersler` VALUES (49, 1, 6, 1, 'TFKHD321', 'Kadın Hastalıkları ve Doğum / Obstetrics and Gynecology', 1);
INSERT INTO `tb_dersler` VALUES (50, 1, 35, 1, 'TFKAR322', 'Kardiyoloji / Cardiology', 1);
INSERT INTO `tb_dersler` VALUES (51, 1, 7, 1, 'TFKDC323', 'Kalp Damar Cerrahisi / Cardiovascular Surgery', 1);
INSERT INTO `tb_dersler` VALUES (52, 1, 8, 1, 'TFKBB324', 'Kulak Burun Boğaz / Otorhinolaryngology', 1);
INSERT INTO `tb_dersler` VALUES (53, 1, 37, 1, 'TFNOR325', 'Nöroloji / Neurology', 1);
INSERT INTO `tb_dersler` VALUES (54, 1, 10, 1, 'TFORT338', 'Ortopedi ve Travmatoloji / Orthopedic and Traumatology', 1);
INSERT INTO `tb_dersler` VALUES (55, 1, 20, 1, 'TFPAT337', 'Patoloji / Pathology', 1);
INSERT INTO `tb_dersler` VALUES (56, 1, 11, 1, 'TFPRC328', 'Plastik Cerrahi / PlasticReconstructive and Aesthetic Surgery', 1);
INSERT INTO `tb_dersler` VALUES (57, 1, 39, 1, 'TFPSK329', 'Psikiyatri / Psychiatry', 1);
INSERT INTO `tb_dersler` VALUES (58, 1, 42, 1, 'TFSHK330', 'Spor Hekimliği / Sports Medicine', 1);
INSERT INTO `tb_dersler` VALUES (59, 1, 22, 1, 'TFPRZ332', 'Parazitoloji / Parasitology', 1);
INSERT INTO `tb_dersler` VALUES (60, 1, 19, 1, 'TFMIC333', 'Tıbbi Mikrobiyoloji / Medical Microbiology', 1);
INSERT INTO `tb_dersler` VALUES (61, 1, 23, 1, 'TFTEG336', 'Tıp Eğitimi ve Bilişimi / Medical Education', 1);
INSERT INTO `tb_dersler` VALUES (62, 1, 24, 1, 'TFTTE333', 'Tıp Tarihi ve Etik / Medical History and Ethics', 1);
INSERT INTO `tb_dersler` VALUES (63, 1, 12, 1, 'TFURO334', 'Üroloji / Urology', 1);
INSERT INTO `tb_dersler` VALUES (64, 1, 44, 1, 'TFİSG336', 'İş Sağlığı ve Güvenliği', 1);
INSERT INTO `tb_dersler` VALUES (65, 1, 43, 1, 'TFTIG336', 'Tıbbi Genetik / Medical Genetic', 1);
INSERT INTO `tb_dersler` VALUES (66, 1, 38, 1, 'TFNUT336', 'Nükleer Tıp / Nuclear Medicine', 1);

-- ----------------------------
-- Table structure for tb_donem_dersleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_dersleri`;
CREATE TABLE `tb_donem_dersleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int UNSIGNED NULL DEFAULT NULL,
  `ders_id` int NULL DEFAULT NULL,
  `teorik_ders_saati` int NULL DEFAULT NULL,
  `uygulama_ders_saati` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_donem_dersleri
-- ----------------------------
INSERT INTO `tb_donem_dersleri` VALUES (1, 1, 1, 72, 20);
INSERT INTO `tb_donem_dersleri` VALUES (2, 1, 2, 26, 0);
INSERT INTO `tb_donem_dersleri` VALUES (3, 1, 3, 47, 0);
INSERT INTO `tb_donem_dersleri` VALUES (4, 1, 4, 84, 10);
INSERT INTO `tb_donem_dersleri` VALUES (5, 1, 5, 11, 0);
INSERT INTO `tb_donem_dersleri` VALUES (6, 1, 6, 37, 1);
INSERT INTO `tb_donem_dersleri` VALUES (7, 1, 7, 12, 0);
INSERT INTO `tb_donem_dersleri` VALUES (8, 1, 8, 52, 17);
INSERT INTO `tb_donem_dersleri` VALUES (9, 1, 9, 9, 2);
INSERT INTO `tb_donem_dersleri` VALUES (10, 1, 10, 64, 10);
INSERT INTO `tb_donem_dersleri` VALUES (11, 1, 11, 7, 0);
INSERT INTO `tb_donem_dersleri` VALUES (13, 1, 13, 4, 0);
INSERT INTO `tb_donem_dersleri` VALUES (22, 1, 14, 16, 0);
INSERT INTO `tb_donem_dersleri` VALUES (24, 1, 15, 8, 0);

-- ----------------------------
-- Table structure for tb_donem_gorevlileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_gorevlileri`;
CREATE TABLE `tb_donem_gorevlileri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int NULL DEFAULT NULL,
  `gorev_kategori_id` int NULL DEFAULT NULL,
  `ogretim_elemani_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_donem_gorevlileri
-- ----------------------------
INSERT INTO `tb_donem_gorevlileri` VALUES (10, 1, 1, 25);
INSERT INTO `tb_donem_gorevlileri` VALUES (11, 1, 5, 22);
INSERT INTO `tb_donem_gorevlileri` VALUES (12, 1, 7, 12);
INSERT INTO `tb_donem_gorevlileri` VALUES (13, 1, 7, 11);
INSERT INTO `tb_donem_gorevlileri` VALUES (14, 1, 7, 9);

-- ----------------------------
-- Table structure for tb_donem_ogrencileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_ogrencileri`;
CREATE TABLE `tb_donem_ogrencileri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `ogrenci_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 157 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_donem_ogrencileri
-- ----------------------------
INSERT INTO `tb_donem_ogrencileri` VALUES (7, 4, NULL, 1);
INSERT INTO `tb_donem_ogrencileri` VALUES (8, 4, NULL, 2);
INSERT INTO `tb_donem_ogrencileri` VALUES (9, 4, NULL, 3);
INSERT INTO `tb_donem_ogrencileri` VALUES (10, 4, NULL, 4);
INSERT INTO `tb_donem_ogrencileri` VALUES (11, 4, NULL, 5);
INSERT INTO `tb_donem_ogrencileri` VALUES (12, 4, NULL, 6);
INSERT INTO `tb_donem_ogrencileri` VALUES (13, 4, NULL, 7);
INSERT INTO `tb_donem_ogrencileri` VALUES (14, 4, NULL, 8);
INSERT INTO `tb_donem_ogrencileri` VALUES (15, 4, NULL, 9);
INSERT INTO `tb_donem_ogrencileri` VALUES (16, 4, NULL, 10);
INSERT INTO `tb_donem_ogrencileri` VALUES (17, 4, NULL, 11);
INSERT INTO `tb_donem_ogrencileri` VALUES (18, 4, NULL, 12);
INSERT INTO `tb_donem_ogrencileri` VALUES (19, 4, NULL, 13);
INSERT INTO `tb_donem_ogrencileri` VALUES (20, 4, NULL, 14);
INSERT INTO `tb_donem_ogrencileri` VALUES (21, 4, NULL, 15);
INSERT INTO `tb_donem_ogrencileri` VALUES (22, 4, NULL, 16);
INSERT INTO `tb_donem_ogrencileri` VALUES (23, 4, NULL, 17);
INSERT INTO `tb_donem_ogrencileri` VALUES (24, 4, NULL, 18);
INSERT INTO `tb_donem_ogrencileri` VALUES (25, 4, NULL, 19);
INSERT INTO `tb_donem_ogrencileri` VALUES (26, 4, NULL, 20);
INSERT INTO `tb_donem_ogrencileri` VALUES (27, 4, NULL, 21);
INSERT INTO `tb_donem_ogrencileri` VALUES (28, 4, NULL, 22);
INSERT INTO `tb_donem_ogrencileri` VALUES (29, 4, NULL, 23);
INSERT INTO `tb_donem_ogrencileri` VALUES (30, 4, NULL, 24);
INSERT INTO `tb_donem_ogrencileri` VALUES (31, 4, NULL, 25);
INSERT INTO `tb_donem_ogrencileri` VALUES (32, 4, NULL, 26);
INSERT INTO `tb_donem_ogrencileri` VALUES (33, 4, NULL, 27);
INSERT INTO `tb_donem_ogrencileri` VALUES (34, 4, NULL, 28);
INSERT INTO `tb_donem_ogrencileri` VALUES (35, 4, NULL, 29);
INSERT INTO `tb_donem_ogrencileri` VALUES (36, 4, NULL, 30);
INSERT INTO `tb_donem_ogrencileri` VALUES (37, 4, NULL, 31);
INSERT INTO `tb_donem_ogrencileri` VALUES (38, 4, NULL, 32);
INSERT INTO `tb_donem_ogrencileri` VALUES (39, 4, NULL, 33);
INSERT INTO `tb_donem_ogrencileri` VALUES (40, 4, NULL, 34);
INSERT INTO `tb_donem_ogrencileri` VALUES (41, 4, NULL, 35);
INSERT INTO `tb_donem_ogrencileri` VALUES (42, 4, NULL, 36);
INSERT INTO `tb_donem_ogrencileri` VALUES (43, 4, NULL, 37);
INSERT INTO `tb_donem_ogrencileri` VALUES (44, 4, NULL, 38);
INSERT INTO `tb_donem_ogrencileri` VALUES (45, 4, NULL, 39);
INSERT INTO `tb_donem_ogrencileri` VALUES (46, 4, NULL, 40);
INSERT INTO `tb_donem_ogrencileri` VALUES (47, 4, NULL, 41);
INSERT INTO `tb_donem_ogrencileri` VALUES (48, 4, NULL, 42);
INSERT INTO `tb_donem_ogrencileri` VALUES (49, 4, NULL, 43);
INSERT INTO `tb_donem_ogrencileri` VALUES (50, 4, NULL, 44);
INSERT INTO `tb_donem_ogrencileri` VALUES (51, 4, NULL, 45);
INSERT INTO `tb_donem_ogrencileri` VALUES (52, 4, NULL, 46);
INSERT INTO `tb_donem_ogrencileri` VALUES (53, 4, NULL, 47);
INSERT INTO `tb_donem_ogrencileri` VALUES (54, 4, NULL, 48);
INSERT INTO `tb_donem_ogrencileri` VALUES (55, 4, NULL, 49);
INSERT INTO `tb_donem_ogrencileri` VALUES (56, 4, NULL, 50);
INSERT INTO `tb_donem_ogrencileri` VALUES (57, 4, NULL, 51);
INSERT INTO `tb_donem_ogrencileri` VALUES (58, 4, NULL, 52);
INSERT INTO `tb_donem_ogrencileri` VALUES (59, 4, NULL, 53);
INSERT INTO `tb_donem_ogrencileri` VALUES (60, 4, NULL, 54);
INSERT INTO `tb_donem_ogrencileri` VALUES (61, 4, NULL, 55);
INSERT INTO `tb_donem_ogrencileri` VALUES (62, 4, NULL, 56);
INSERT INTO `tb_donem_ogrencileri` VALUES (63, 4, NULL, 57);
INSERT INTO `tb_donem_ogrencileri` VALUES (64, 4, NULL, 58);
INSERT INTO `tb_donem_ogrencileri` VALUES (65, 4, NULL, 59);
INSERT INTO `tb_donem_ogrencileri` VALUES (66, 4, NULL, 60);
INSERT INTO `tb_donem_ogrencileri` VALUES (67, 4, NULL, 61);
INSERT INTO `tb_donem_ogrencileri` VALUES (68, 4, NULL, 62);
INSERT INTO `tb_donem_ogrencileri` VALUES (69, 4, NULL, 63);
INSERT INTO `tb_donem_ogrencileri` VALUES (70, 4, NULL, 64);
INSERT INTO `tb_donem_ogrencileri` VALUES (71, 4, NULL, 65);
INSERT INTO `tb_donem_ogrencileri` VALUES (72, 4, NULL, 66);
INSERT INTO `tb_donem_ogrencileri` VALUES (73, 4, NULL, 67);
INSERT INTO `tb_donem_ogrencileri` VALUES (74, 4, NULL, 68);
INSERT INTO `tb_donem_ogrencileri` VALUES (75, 4, NULL, 69);
INSERT INTO `tb_donem_ogrencileri` VALUES (76, 4, NULL, 70);
INSERT INTO `tb_donem_ogrencileri` VALUES (77, 4, NULL, 71);
INSERT INTO `tb_donem_ogrencileri` VALUES (78, 4, NULL, 72);
INSERT INTO `tb_donem_ogrencileri` VALUES (79, 4, NULL, 73);
INSERT INTO `tb_donem_ogrencileri` VALUES (80, 4, NULL, 74);
INSERT INTO `tb_donem_ogrencileri` VALUES (81, 4, NULL, 75);
INSERT INTO `tb_donem_ogrencileri` VALUES (82, 4, NULL, 76);
INSERT INTO `tb_donem_ogrencileri` VALUES (83, 4, NULL, 77);
INSERT INTO `tb_donem_ogrencileri` VALUES (84, 4, NULL, 78);
INSERT INTO `tb_donem_ogrencileri` VALUES (85, 4, NULL, 79);
INSERT INTO `tb_donem_ogrencileri` VALUES (86, 4, NULL, 80);
INSERT INTO `tb_donem_ogrencileri` VALUES (87, 4, NULL, 81);
INSERT INTO `tb_donem_ogrencileri` VALUES (88, 4, NULL, 82);
INSERT INTO `tb_donem_ogrencileri` VALUES (89, 4, NULL, 83);
INSERT INTO `tb_donem_ogrencileri` VALUES (90, 4, NULL, 84);
INSERT INTO `tb_donem_ogrencileri` VALUES (91, 4, NULL, 85);
INSERT INTO `tb_donem_ogrencileri` VALUES (92, 4, NULL, 86);
INSERT INTO `tb_donem_ogrencileri` VALUES (93, 4, NULL, 87);
INSERT INTO `tb_donem_ogrencileri` VALUES (94, 4, NULL, 88);
INSERT INTO `tb_donem_ogrencileri` VALUES (95, 4, NULL, 89);
INSERT INTO `tb_donem_ogrencileri` VALUES (96, 4, NULL, 90);
INSERT INTO `tb_donem_ogrencileri` VALUES (97, 4, NULL, 91);
INSERT INTO `tb_donem_ogrencileri` VALUES (98, 4, NULL, 92);
INSERT INTO `tb_donem_ogrencileri` VALUES (99, 4, NULL, 93);
INSERT INTO `tb_donem_ogrencileri` VALUES (100, 4, NULL, 94);
INSERT INTO `tb_donem_ogrencileri` VALUES (101, 4, NULL, 95);
INSERT INTO `tb_donem_ogrencileri` VALUES (102, 4, NULL, 96);
INSERT INTO `tb_donem_ogrencileri` VALUES (103, 4, NULL, 97);
INSERT INTO `tb_donem_ogrencileri` VALUES (104, 4, NULL, 98);
INSERT INTO `tb_donem_ogrencileri` VALUES (105, 4, NULL, 99);
INSERT INTO `tb_donem_ogrencileri` VALUES (106, 4, NULL, 100);
INSERT INTO `tb_donem_ogrencileri` VALUES (107, 4, NULL, 101);
INSERT INTO `tb_donem_ogrencileri` VALUES (108, 4, NULL, 102);
INSERT INTO `tb_donem_ogrencileri` VALUES (109, 4, NULL, 103);
INSERT INTO `tb_donem_ogrencileri` VALUES (110, 4, NULL, 104);
INSERT INTO `tb_donem_ogrencileri` VALUES (111, 4, NULL, 105);
INSERT INTO `tb_donem_ogrencileri` VALUES (112, 4, NULL, 106);
INSERT INTO `tb_donem_ogrencileri` VALUES (113, 4, NULL, 107);
INSERT INTO `tb_donem_ogrencileri` VALUES (114, 4, NULL, 108);
INSERT INTO `tb_donem_ogrencileri` VALUES (115, 4, NULL, 109);
INSERT INTO `tb_donem_ogrencileri` VALUES (116, 4, NULL, 110);
INSERT INTO `tb_donem_ogrencileri` VALUES (117, 4, NULL, 111);
INSERT INTO `tb_donem_ogrencileri` VALUES (118, 4, NULL, 112);
INSERT INTO `tb_donem_ogrencileri` VALUES (119, 4, NULL, 113);
INSERT INTO `tb_donem_ogrencileri` VALUES (120, 4, NULL, 114);
INSERT INTO `tb_donem_ogrencileri` VALUES (121, 4, NULL, 115);
INSERT INTO `tb_donem_ogrencileri` VALUES (122, 4, NULL, 116);
INSERT INTO `tb_donem_ogrencileri` VALUES (123, 4, NULL, 117);
INSERT INTO `tb_donem_ogrencileri` VALUES (124, 4, NULL, 118);
INSERT INTO `tb_donem_ogrencileri` VALUES (125, 4, NULL, 119);
INSERT INTO `tb_donem_ogrencileri` VALUES (126, 4, NULL, 120);
INSERT INTO `tb_donem_ogrencileri` VALUES (127, 4, NULL, 121);
INSERT INTO `tb_donem_ogrencileri` VALUES (128, 4, NULL, 122);
INSERT INTO `tb_donem_ogrencileri` VALUES (129, 4, NULL, 123);
INSERT INTO `tb_donem_ogrencileri` VALUES (130, 4, NULL, 124);
INSERT INTO `tb_donem_ogrencileri` VALUES (131, 4, NULL, 125);
INSERT INTO `tb_donem_ogrencileri` VALUES (132, 4, NULL, 126);
INSERT INTO `tb_donem_ogrencileri` VALUES (133, 4, NULL, 127);
INSERT INTO `tb_donem_ogrencileri` VALUES (134, 4, NULL, 128);
INSERT INTO `tb_donem_ogrencileri` VALUES (135, 4, NULL, 129);
INSERT INTO `tb_donem_ogrencileri` VALUES (136, 4, NULL, 130);
INSERT INTO `tb_donem_ogrencileri` VALUES (156, 1, NULL, 131);

-- ----------------------------
-- Table structure for tb_donem_subeleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_donem_subeleri`;
CREATE TABLE `tb_donem_subeleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_donem_subeleri
-- ----------------------------

-- ----------------------------
-- Table structure for tb_donemler
-- ----------------------------
DROP TABLE IF EXISTS `tb_donemler`;
CREATE TABLE `tb_donemler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_donemler
-- ----------------------------
INSERT INTO `tb_donemler` VALUES (1, 1, 1, 'Dönem I', 1);
INSERT INTO `tb_donemler` VALUES (2, 1, 1, 'Dönem II', 1);
INSERT INTO `tb_donemler` VALUES (3, 1, 1, 'Dönem III', 1);
INSERT INTO `tb_donemler` VALUES (4, 1, 1, 'Dönem IV', 1);
INSERT INTO `tb_donemler` VALUES (5, 1, 1, 'Dönem V', 1);
INSERT INTO `tb_donemler` VALUES (6, 1, 1, 'Dönem VI', 1);

-- ----------------------------
-- Table structure for tb_fakulteler
-- ----------------------------
DROP TABLE IF EXISTS `tb_fakulteler`;
CREATE TABLE `tb_fakulteler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `ilk_goruntulenecek` tinyint NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_fakulteler
-- ----------------------------
INSERT INTO `tb_fakulteler` VALUES (1, 1, 'Tıp Fakültesi', 1, 1);
INSERT INTO `tb_fakulteler` VALUES (2, 1, 'Van Meslek', 0, 0);

-- ----------------------------
-- Table structure for tb_gorev_kategorileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_gorev_kategorileri`;
CREATE TABLE `tb_gorev_kategorileri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_gorev_kategorileri
-- ----------------------------
INSERT INTO `tb_gorev_kategorileri` VALUES (1, 1, 'Başkoordinatör');
INSERT INTO `tb_gorev_kategorileri` VALUES (2, 1, 'Başkoordinatör Yrd');
INSERT INTO `tb_gorev_kategorileri` VALUES (3, 1, 'Dönem Koordinatörü');
INSERT INTO `tb_gorev_kategorileri` VALUES (4, 1, 'Dönem Koordinatör Yrd.');
INSERT INTO `tb_gorev_kategorileri` VALUES (5, 1, 'Ders Kurulu Başkanı');
INSERT INTO `tb_gorev_kategorileri` VALUES (6, 1, 'Ders Kurulu Başkan Yrd.');
INSERT INTO `tb_gorev_kategorileri` VALUES (7, 1, 'Sınav Gözetmeni');

-- ----------------------------
-- Table structure for tb_komite_dersleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_dersleri`;
CREATE TABLE `tb_komite_dersleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `komite_id` int NULL DEFAULT NULL,
  `donem_ders_id` int NULL DEFAULT NULL,
  `teorik_ders_saati` smallint NULL DEFAULT NULL,
  `uygulama_ders_saati` smallint NULL DEFAULT NULL,
  `soru_sayisi` smallint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_komite_dersleri
-- ----------------------------
INSERT INTO `tb_komite_dersleri` VALUES (1, 1, 22, 5, 3, 1);
INSERT INTO `tb_komite_dersleri` VALUES (2, 1, 24, 10, 5, 1);
INSERT INTO `tb_komite_dersleri` VALUES (3, 1, 13, 10, 5, 3);
INSERT INTO `tb_komite_dersleri` VALUES (4, 1, 1, 30, 20, 15);

-- ----------------------------
-- Table structure for tb_komite_dersleri_ogretim_uyeleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_dersleri_ogretim_uyeleri`;
CREATE TABLE `tb_komite_dersleri_ogretim_uyeleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `komite_ders_id` int NULL DEFAULT NULL,
  `ogretim_uyesi_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_komite_dersleri_ogretim_uyeleri
-- ----------------------------
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES (5, 4, 1);
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES (9, 2, 1);
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES (10, 1, 1);
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES (11, 1, 21);
INSERT INTO `tb_komite_dersleri_ogretim_uyeleri` VALUES (12, 3, 21);

-- ----------------------------
-- Table structure for tb_komite_gorevlileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_gorevlileri`;
CREATE TABLE `tb_komite_gorevlileri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `komite_id` int NULL DEFAULT NULL,
  `gorev_kategori_id` int NULL DEFAULT NULL,
  `ogretim_elemani_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_komite_gorevlileri
-- ----------------------------
INSERT INTO `tb_komite_gorevlileri` VALUES (1, 1, 1, 25);

-- ----------------------------
-- Table structure for tb_komite_ogrencileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_komite_ogrencileri`;
CREATE TABLE `tb_komite_ogrencileri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `komite_id` int NULL DEFAULT NULL,
  `ogrenci_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_komite_ogrencileri
-- ----------------------------
INSERT INTO `tb_komite_ogrencileri` VALUES (2, 1, 3);
INSERT INTO `tb_komite_ogrencileri` VALUES (3, 1, 9);
INSERT INTO `tb_komite_ogrencileri` VALUES (4, 1, 4);
INSERT INTO `tb_komite_ogrencileri` VALUES (5, 1, 129);
INSERT INTO `tb_komite_ogrencileri` VALUES (6, 1, 130);
INSERT INTO `tb_komite_ogrencileri` VALUES (8, 1, 2);
INSERT INTO `tb_komite_ogrencileri` VALUES (9, 1, 1);
INSERT INTO `tb_komite_ogrencileri` VALUES (13, 20, 1);
INSERT INTO `tb_komite_ogrencileri` VALUES (17, 1, 131);

-- ----------------------------
-- Table structure for tb_komiteler
-- ----------------------------
DROP TABLE IF EXISTS `tb_komiteler`;
CREATE TABLE `tb_komiteler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ders_yili_donem_id` int NULL DEFAULT NULL,
  `ders_kodu` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `ders_kurulu_sira` varchar(10) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `baslangic_tarihi` date NULL DEFAULT NULL,
  `bitis_tarihi` date NULL DEFAULT NULL,
  `sinav_tarihi` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_komiteler
-- ----------------------------
INSERT INTO `tb_komiteler` VALUES (1, 1, 'TFTGI1001', 'Tıbba Giriş', '1', '2022-09-19', '2022-11-04', '2022-11-04');
INSERT INTO `tb_komiteler` VALUES (2, 1, 'TFHTY1001', 'Hücrenin Temel Yapısı', '2', '2022-11-07', '2022-12-30', '2022-12-30');
INSERT INTO `tb_komiteler` VALUES (3, 1, 'TFHUG1001', 'Hücre ve Genetik - I', '3', '2023-01-02', '2023-02-03', '2023-02-03');
INSERT INTO `tb_komiteler` VALUES (4, 1, 'TFHUG1002', 'Hücre ve Genetik - II', '4', '2023-02-20', '2023-03-30', '2023-03-31');
INSERT INTO `tb_komiteler` VALUES (5, 1, 'TFDKI1001', 'Doku ve Kas İskelet Sistemi - I', '5', '2023-04-03', '2023-05-11', '2023-05-12');
INSERT INTO `tb_komiteler` VALUES (6, 1, 'TFDKI1002', 'Doku ve Kas İskelet Sistemi - II', '6', '2023-05-15', '2023-06-22', '2023-06-23');
INSERT INTO `tb_komiteler` VALUES (15, 2, 'TFDKS2003', 'Dolaşım, Kan, Lenf ve Solunum Sistemi', NULL, '2022-09-12', '2022-10-27', '2022-10-28');
INSERT INTO `tb_komiteler` VALUES (16, 2, 'TFSME2003', 'Sindirim, Metabolizma ve Endokrin Sistem', NULL, '2022-10-31', '2022-12-15', '2022-12-16');
INSERT INTO `tb_komiteler` VALUES (17, 2, 'TFUGS2003', 'Ürogenital Sistem', NULL, '2022-12-19', '2023-01-26', '2023-01-27');
INSERT INTO `tb_komiteler` VALUES (18, 2, 'TFMSS2004', 'Merkezi Sinir Sistemi', NULL, '2023-01-30', '2023-04-20', '2023-04-21');
INSERT INTO `tb_komiteler` VALUES (19, 2, 'TFMSS2004', 'Hastalıkların Temelleri', NULL, '2023-04-24', '2023-06-23', '2023-06-23');
INSERT INTO `tb_komiteler` VALUES (20, 3, 'TFDKİ3005', 'Deri ve Kas-İskelet sistemi Hastalıkları', NULL, '2022-09-05', '2022-10-07', '2022-10-07');
INSERT INTO `tb_komiteler` VALUES (21, 3, 'TFMSS3005', 'Merkezi Sinir Sistemi ve Duyu Hastalıkları', NULL, '2022-10-10', '2022-11-18', '2022-11-18');
INSERT INTO `tb_komiteler` VALUES (22, 3, 'TFDSS3005', 'Dolaşım ve Solunum Sistemi Hastalıkları', NULL, '2022-11-21', '2022-12-30', '2022-12-30');
INSERT INTO `tb_komiteler` VALUES (23, 3, 'TFSİS3006', 'Sindirim Sistemi Hastalıkları', NULL, '2023-01-02', '2023-02-03', '2023-02-03');
INSERT INTO `tb_komiteler` VALUES (24, 3, 'TFEMK3006', 'Endokrin, Metabolizma, Kan ve Lenf Sistemi Hastalıkları', NULL, '2023-02-20', '2023-03-24', '2023-03-24');
INSERT INTO `tb_komiteler` VALUES (25, 3, 'TFUGS3006', 'Ürogenital Sistem Hastalıkları ', NULL, '2023-03-27', '2023-05-12', '2023-05-12');
INSERT INTO `tb_komiteler` VALUES (26, 3, 'TFBBS3006', 'Birinci Basamak Sağlık Hizmetleri ve Kliniğe Giriş', NULL, '2023-05-15', '2023-06-23', '2023-06-23');

-- ----------------------------
-- Table structure for tb_modul
-- ----------------------------
DROP TABLE IF EXISTS `tb_modul`;
CREATE TABLE `tb_modul`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `modul` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `klasor` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `simge` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `menude_goster` tinyint NULL DEFAULT 1,
  `ust_id` int NULL DEFAULT 0,
  `kategori` tinyint NULL DEFAULT 0,
  `sira` tinyint NULL DEFAULT 1,
  `harici_sayfa` tinyint NULL DEFAULT 0,
  `kategori_acik` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 146 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_modul
-- ----------------------------
INSERT INTO `tb_modul` VALUES (1, 'Anasayfa', 'anasayfa', 'anasayfa', 'fa fa-home', 1, 0, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (2, 'Sistem Kullanıcıları', 'sistemKullanicilari', 'sistemKullanicilari', 'fas fa-users-cog text-red', 1, 0, 0, 99, 0, 0);
INSERT INTO `tb_modul` VALUES (3, 'Yetkiler', 'yetkiler', 'yetkiler', 'far fa-circle text-green', 1, 68, 0, 7, 0, 0);
INSERT INTO `tb_modul` VALUES (32, 'Modul Yetkileri', 'modulYetkileri', 'modulYetkileri', 'far fa-circle text-yellow', 1, 68, 0, 8, 0, 0);
INSERT INTO `tb_modul` VALUES (68, 'Sistem İşlemleri', NULL, NULL, 'fas fa-sliders-h', 1, 0, 1, 100, 0, 0);
INSERT INTO `tb_modul` VALUES (90, 'Ön Tanım', NULL, NULL, 'fas fa-sitemap', 1, 0, 1, 12, 0, 0);
INSERT INTO `tb_modul` VALUES (109, 'Üniversiteler', 'universiteler', 'universiteler', 'fas fa-university text-green', 1, 125, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (110, 'Bölümler', 'bolumler', 'bolumler', 'fas fa-school text-yellow', 1, 125, 0, 3, 0, 0);
INSERT INTO `tb_modul` VALUES (111, 'Fakülteler', 'fakulteler', 'fakulteler', 'fas fa-building text-blue', 1, 125, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (112, 'Programlar', 'programlar', 'programlar', 'fas fa-book-reader text-purple', 1, 125, 0, 4, 0, 0);
INSERT INTO `tb_modul` VALUES (113, 'Ders Yılları', 'dersYillari', 'dersYillari', 'fas fa-calendar-alt text-blue', 1, 127, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (114, 'Ders Kategorileri', 'dersKategorileri', 'dersKategorileri', 'far fa-circle text-green', 1, 129, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (115, 'Dönem Tanımları', 'donemler', 'donemler', 'far fa-circle text-orange', 1, 129, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (116, 'Dersler', 'dersler', 'dersler', 'fas fa-book text-orange', 1, 0, 0, 20, 0, 0);
INSERT INTO `tb_modul` VALUES (117, 'Öğretim Elemanları', 'ogretimElemanlari', 'ogretimElemanlari', 'fas fa-user-md text-blue', 1, 0, 0, 25, 0, 0);
INSERT INTO `tb_modul` VALUES (118, 'Dönem Dersleri', 'donemDersleri', 'donemDersleri', 'fas fa-book text-orange', 1, 127, 0, 3, 0, 0);
INSERT INTO `tb_modul` VALUES (119, 'Komiteler', 'komiteler', 'komiteler', 'fas fa-calendar-plus text-blue', 1, 128, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (120, 'Komite Dersleri', 'komiteDersleri', 'komiteDersleri', 'fas fa-book text-green', 1, 128, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (121, 'Görev Kategorileri', 'gorevKategorileri', 'gorevKategorileri', 'far fa-circle text-blue', 1, 129, 0, 3, 0, 0);
INSERT INTO `tb_modul` VALUES (122, 'Dönem Görevlileri', 'donemGorevlileri', 'donemGorevlileri', 'fas fa-users text-purple', 1, 127, 0, 4, 0, 0);
INSERT INTO `tb_modul` VALUES (123, 'Komite Görevlileri', 'komiteGorevlileri', 'komiteGorevlileri', 'fas fa-user text-orange', 1, 128, 0, 4, 0, 0);
INSERT INTO `tb_modul` VALUES (124, 'Komite Öğretim Üyeleri', 'komiteDersOgretimUyeleri', 'komiteDersOgretimUyeleri', 'fas fa-users text-purple', 1, 128, 0, 3, 0, 0);
INSERT INTO `tb_modul` VALUES (125, 'Organizasyon Şeması', NULL, NULL, 'fas fa-sitemap text-green', 1, 0, 1, 5, 0, 0);
INSERT INTO `tb_modul` VALUES (126, 'Aktif Dönemler', 'dersYiliDonemler', 'dersYiliDonemler', 'fas fa-list-ol text-green', 1, 127, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (127, 'Ders Yılı Dönem İşlemleri', NULL, NULL, 'fas fa-calendar-alt text-yellow', 1, 0, 1, 10, 0, 0);
INSERT INTO `tb_modul` VALUES (128, 'Ders Kurulu İşlemleri', NULL, NULL, 'fas fa-calendar-plus text-purple', 1, 0, 1, 15, 0, 0);
INSERT INTO `tb_modul` VALUES (129, 'Sabit Tanımlar', NULL, NULL, 'fas fa-table', 1, 0, 1, 35, 0, 0);
INSERT INTO `tb_modul` VALUES (130, 'Öğrenci İşlemleri', NULL, NULL, 'fas fa-users text-danger', 1, 0, 1, 16, 0, 0);
INSERT INTO `tb_modul` VALUES (131, 'Öğrenciler', 'ogrenciler', 'ogrenciler', 'fas fa-users text-info', 1, 130, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (132, 'Dönem Öğrencileri', 'donemOgrencileri', 'donemOgrencileri', 'fas fa-users text-purple', 1, 130, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (133, 'Müfredat', 'mufredat', 'mufredat', 'fas fa-list-alt', 1, 0, 0, 40, 0, 0);
INSERT INTO `tb_modul` VALUES (134, 'Komite Öğrencileri', 'komiteOgrencileri', 'komiteOgrencileri', 'fas fa-users text-pink', 1, 130, 0, 3, 0, 0);
INSERT INTO `tb_modul` VALUES (135, 'Soru İşlemleri', NULL, NULL, 'fas fa-question-circle text-purple', 1, 0, 1, 40, 0, 0);
INSERT INTO `tb_modul` VALUES (136, 'Soru Türleri', 'soru_turleri', 'soru_turleri', 'fas fa-question text-warning', 1, 135, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (137, 'Soru Bankası', 'soruBankasi', 'soruBankasi', 'fas fa-question text-danger', 1, 135, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (138, 'Sınav İşlemleri', '', NULL, 'fas fa-file text-danger', 1, 0, 1, 41, 0, 0);
INSERT INTO `tb_modul` VALUES (139, 'Sınavlar', 'sinavlar', 'sinavlar', 'fas fa-file text-green', 1, 138, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (140, 'Sınav', 'sinav', 'sinav', 'fas fa-edit', 1, 138, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (141, 'Sınavlar Listesi', 'sinavlarListesi', 'sinavlar', 'fas fa-file text-orange', 1, 138, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (142, 'Anket İşlemleri', '', '', 'fas fa-edit text-green', 1, 0, 1, 42, 0, 0);
INSERT INTO `tb_modul` VALUES (143, 'Anketler', 'anketler', 'anketler', 'fas fa-question text-orange', 1, 142, 0, 2, 0, 0);
INSERT INTO `tb_modul` VALUES (144, 'Anket Şablonu', 'sablonlar', 'anketler', 'fas fa-copy text-warning', 1, 142, 0, 1, 0, 0);
INSERT INTO `tb_modul` VALUES (145, 'Anket Cevapla', 'anket', 'anketler', 'fas fa-edit', 0, 142, 0, 1, 0, 0);

-- ----------------------------
-- Table structure for tb_modul_yetki_islemler
-- ----------------------------
DROP TABLE IF EXISTS `tb_modul_yetki_islemler`;
CREATE TABLE `tb_modul_yetki_islemler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `modul_id` int NULL DEFAULT NULL,
  `yetki_islem_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 879 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_modul_yetki_islemler
-- ----------------------------
INSERT INTO `tb_modul_yetki_islemler` VALUES (7, 3, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (8, 3, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (9, 3, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (10, 3, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (11, 3, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (12, 3, 15);
INSERT INTO `tb_modul_yetki_islemler` VALUES (13, 32, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (14, 32, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (15, 32, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (16, 32, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (17, 32, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (46, 53, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (47, 53, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (48, 53, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (49, 53, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (50, 53, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (51, 54, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (52, 54, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (53, 54, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (54, 54, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (55, 54, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (56, 55, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (57, 55, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (58, 55, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (59, 55, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (60, 55, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (61, 56, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (62, 56, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (63, 56, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (64, 56, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (65, 56, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (66, 57, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (67, 57, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (68, 57, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (69, 57, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (70, 57, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (71, 58, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (72, 58, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (73, 58, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (74, 58, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (75, 58, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (76, 59, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (77, 59, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (78, 59, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (79, 59, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (80, 59, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (81, 60, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (82, 60, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (83, 60, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (84, 60, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (85, 60, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (86, 61, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (87, 61, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (88, 61, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (89, 61, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (90, 61, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (91, 62, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (92, 62, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (93, 62, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (94, 62, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (95, 62, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (114, 1, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (115, 1, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (378, 70, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (379, 70, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (380, 70, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (381, 70, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (382, 70, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (383, 70, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (384, 2, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (385, 2, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (386, 2, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (387, 2, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (388, 2, 11);
INSERT INTO `tb_modul_yetki_islemler` VALUES (389, 2, 12);
INSERT INTO `tb_modul_yetki_islemler` VALUES (390, 2, 15);
INSERT INTO `tb_modul_yetki_islemler` VALUES (391, 49, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (392, 49, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (393, 49, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (394, 49, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (456, 63, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (457, 63, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (458, 63, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (459, 63, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (460, 63, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (461, 63, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (462, 63, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (463, 63, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (577, 65, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (578, 65, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (579, 65, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (580, 65, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (581, 65, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (582, 65, 6);
INSERT INTO `tb_modul_yetki_islemler` VALUES (583, 65, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (584, 65, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (585, 66, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (586, 66, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (587, 66, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (588, 66, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (589, 66, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (590, 66, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (591, 66, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (592, 51, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (593, 51, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (594, 51, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (595, 51, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (596, 51, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (597, 51, 24);
INSERT INTO `tb_modul_yetki_islemler` VALUES (598, 51, 25);
INSERT INTO `tb_modul_yetki_islemler` VALUES (599, 51, 26);
INSERT INTO `tb_modul_yetki_islemler` VALUES (600, 51, 27);
INSERT INTO `tb_modul_yetki_islemler` VALUES (601, 51, 29);
INSERT INTO `tb_modul_yetki_islemler` VALUES (602, 51, 30);
INSERT INTO `tb_modul_yetki_islemler` VALUES (603, 51, 31);
INSERT INTO `tb_modul_yetki_islemler` VALUES (604, 51, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (605, 51, 33);
INSERT INTO `tb_modul_yetki_islemler` VALUES (606, 51, 34);
INSERT INTO `tb_modul_yetki_islemler` VALUES (607, 51, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (608, 51, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (609, 51, 38);
INSERT INTO `tb_modul_yetki_islemler` VALUES (610, 51, 41);
INSERT INTO `tb_modul_yetki_islemler` VALUES (611, 52, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (612, 52, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (613, 52, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (614, 52, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (615, 52, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (616, 52, 26);
INSERT INTO `tb_modul_yetki_islemler` VALUES (617, 52, 29);
INSERT INTO `tb_modul_yetki_islemler` VALUES (618, 52, 41);
INSERT INTO `tb_modul_yetki_islemler` VALUES (619, 48, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (620, 48, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (621, 48, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (622, 48, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (623, 48, 6);
INSERT INTO `tb_modul_yetki_islemler` VALUES (624, 48, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (625, 48, 24);
INSERT INTO `tb_modul_yetki_islemler` VALUES (626, 48, 26);
INSERT INTO `tb_modul_yetki_islemler` VALUES (627, 48, 27);
INSERT INTO `tb_modul_yetki_islemler` VALUES (628, 48, 28);
INSERT INTO `tb_modul_yetki_islemler` VALUES (629, 48, 29);
INSERT INTO `tb_modul_yetki_islemler` VALUES (630, 48, 30);
INSERT INTO `tb_modul_yetki_islemler` VALUES (631, 48, 31);
INSERT INTO `tb_modul_yetki_islemler` VALUES (632, 48, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (633, 48, 33);
INSERT INTO `tb_modul_yetki_islemler` VALUES (634, 48, 34);
INSERT INTO `tb_modul_yetki_islemler` VALUES (635, 48, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (636, 48, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (637, 48, 38);
INSERT INTO `tb_modul_yetki_islemler` VALUES (638, 48, 39);
INSERT INTO `tb_modul_yetki_islemler` VALUES (639, 48, 40);
INSERT INTO `tb_modul_yetki_islemler` VALUES (640, 48, 41);
INSERT INTO `tb_modul_yetki_islemler` VALUES (641, 71, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (642, 71, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (643, 72, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (644, 72, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (647, 50, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (648, 50, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (649, 50, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (650, 50, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (651, 50, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (652, 50, 24);
INSERT INTO `tb_modul_yetki_islemler` VALUES (653, 50, 25);
INSERT INTO `tb_modul_yetki_islemler` VALUES (654, 50, 26);
INSERT INTO `tb_modul_yetki_islemler` VALUES (655, 50, 27);
INSERT INTO `tb_modul_yetki_islemler` VALUES (656, 50, 29);
INSERT INTO `tb_modul_yetki_islemler` VALUES (657, 50, 30);
INSERT INTO `tb_modul_yetki_islemler` VALUES (658, 50, 31);
INSERT INTO `tb_modul_yetki_islemler` VALUES (659, 50, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (660, 50, 33);
INSERT INTO `tb_modul_yetki_islemler` VALUES (661, 50, 34);
INSERT INTO `tb_modul_yetki_islemler` VALUES (662, 69, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (663, 69, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (664, 69, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (665, 69, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (666, 69, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (667, 69, 6);
INSERT INTO `tb_modul_yetki_islemler` VALUES (668, 69, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (669, 69, 25);
INSERT INTO `tb_modul_yetki_islemler` VALUES (670, 69, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (671, 69, 33);
INSERT INTO `tb_modul_yetki_islemler` VALUES (672, 69, 34);
INSERT INTO `tb_modul_yetki_islemler` VALUES (673, 69, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (674, 69, 38);
INSERT INTO `tb_modul_yetki_islemler` VALUES (675, 69, 39);
INSERT INTO `tb_modul_yetki_islemler` VALUES (676, 69, 40);
INSERT INTO `tb_modul_yetki_islemler` VALUES (681, 73, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (682, 73, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (683, 73, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (684, 73, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (685, 73, 26);
INSERT INTO `tb_modul_yetki_islemler` VALUES (686, 73, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (687, 73, 41);
INSERT INTO `tb_modul_yetki_islemler` VALUES (708, 77, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (709, 77, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (710, 77, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (711, 77, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (712, 77, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (713, 77, 34);
INSERT INTO `tb_modul_yetki_islemler` VALUES (714, 77, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (715, 74, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (716, 74, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (717, 74, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (718, 74, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (719, 74, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (720, 74, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (721, 74, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (722, 75, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (723, 75, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (724, 75, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (725, 75, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (726, 75, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (727, 75, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (728, 75, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (729, 75, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (730, 78, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (731, 78, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (732, 78, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (733, 78, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (734, 78, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (735, 78, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (736, 78, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (737, 78, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (738, 76, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (739, 76, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (740, 76, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (741, 76, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (742, 76, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (743, 76, 32);
INSERT INTO `tb_modul_yetki_islemler` VALUES (744, 76, 35);
INSERT INTO `tb_modul_yetki_islemler` VALUES (745, 76, 36);
INSERT INTO `tb_modul_yetki_islemler` VALUES (746, 80, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (747, 80, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (748, 80, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (749, 80, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (750, 80, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (755, 92, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (756, 92, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (757, 92, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (758, 92, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (759, 92, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (760, 91, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (761, 91, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (762, 91, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (763, 91, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (764, 91, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (765, 86, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (766, 86, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (767, 86, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (768, 86, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (769, 86, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (770, 87, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (771, 87, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (772, 87, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (773, 87, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (774, 87, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (775, 98, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (776, 98, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (777, 98, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (778, 98, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (779, 98, 6);
INSERT INTO `tb_modul_yetki_islemler` VALUES (780, 98, 23);
INSERT INTO `tb_modul_yetki_islemler` VALUES (841, 139, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (842, 139, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (843, 139, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (844, 139, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (845, 139, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (846, 139, 47);
INSERT INTO `tb_modul_yetki_islemler` VALUES (847, 139, 48);
INSERT INTO `tb_modul_yetki_islemler` VALUES (848, 139, 50);
INSERT INTO `tb_modul_yetki_islemler` VALUES (849, 139, 51);
INSERT INTO `tb_modul_yetki_islemler` VALUES (850, 139, 52);
INSERT INTO `tb_modul_yetki_islemler` VALUES (851, 139, 53);
INSERT INTO `tb_modul_yetki_islemler` VALUES (852, 139, 54);
INSERT INTO `tb_modul_yetki_islemler` VALUES (853, 139, 55);
INSERT INTO `tb_modul_yetki_islemler` VALUES (854, 139, 56);
INSERT INTO `tb_modul_yetki_islemler` VALUES (855, 0, 54);
INSERT INTO `tb_modul_yetki_islemler` VALUES (856, 133, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (857, 133, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (858, 133, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (859, 133, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (860, 133, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (861, 133, 44);
INSERT INTO `tb_modul_yetki_islemler` VALUES (862, 133, 54);
INSERT INTO `tb_modul_yetki_islemler` VALUES (863, 137, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (864, 137, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (865, 137, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (866, 137, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (867, 137, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (868, 137, 47);
INSERT INTO `tb_modul_yetki_islemler` VALUES (869, 137, 48);
INSERT INTO `tb_modul_yetki_islemler` VALUES (870, 117, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (871, 117, 2);
INSERT INTO `tb_modul_yetki_islemler` VALUES (872, 117, 3);
INSERT INTO `tb_modul_yetki_islemler` VALUES (873, 117, 4);
INSERT INTO `tb_modul_yetki_islemler` VALUES (874, 117, 5);
INSERT INTO `tb_modul_yetki_islemler` VALUES (875, 141, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (876, 140, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (877, 145, 1);
INSERT INTO `tb_modul_yetki_islemler` VALUES (878, 145, 5);

-- ----------------------------
-- Table structure for tb_mufredat
-- ----------------------------
DROP TABLE IF EXISTS `tb_mufredat`;
CREATE TABLE `tb_mufredat`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ust_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `ders_yili_donem_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `ders_id` int NULL DEFAULT NULL,
  `ogretim_elemani_id` int NULL DEFAULT NULL,
  `ogrenim_hedefi_mi` tinyint NULL DEFAULT NULL,
  `kategori` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_mufredat
-- ----------------------------
INSERT INTO `tb_mufredat` VALUES (1, 0, 'Ders Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (2, 1, '1. Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (3, 2, '1. Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (4, 3, '1. Alt Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (5, 4, 'Öğrenim Hedefi 1', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (7, 4, 'Öğrenim Hedefi 2', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (8, 4, 'Öğrenim Hedefi 3', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (9, 4, 'Öğrenim Hedefi 4', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (10, 3, '2. Alt Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (11, 3, '3. Alt Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (12, 10, 'Öğrenim Hedefi 1', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (13, 10, 'Öğrenim Hedefi 2', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (14, 10, 'Öğrenim Hedefi 3', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (15, 10, 'Öğrenim Hedefi 4', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (16, 10, 'Öğrenim Hedefi 5', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (17, 11, 'Öğrenim Hedefi 1', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (18, 11, 'Öğrenim Hedefi 2', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (19, 11, 'Öğrenim Hedefi 3', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (21, 0, 'Ders Kategori', 1, 1, 2, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (22, 21, '1. Alt Kategori', 1, 1, 2, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (23, 22, '1 Alt Alt Kategori', 1, 1, 2, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (24, 23, '1. Alt Alt Alt Kategori', 1, 1, 2, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (25, 24, 'Öğrenim Hedefi', 1, 1, 2, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (26, 24, 'Öğrenim Hedefi', 1, 1, 2, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (27, 24, 'Öğrenim Hedefi', 1, 1, 2, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (28, 24, 'Öğrenim Hedefi', 1, 1, 2, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (29, 1, '2. Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (30, 0, '1. Ders Kategori', 1, 1, 14, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (31, 29, '1. Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (32, 31, '1. Alt Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (33, 31, '2. Alt Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (34, 31, '3. Alt Alt Alt kategori', 1, 1, 1, NULL, NULL, 0);
INSERT INTO `tb_mufredat` VALUES (35, 1, '3. Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (36, 2, '2. Alt Alt Kategori', 1, 1, 1, NULL, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (37, 0, 'Kategori', 1, 1, 14, 21, NULL, 1);
INSERT INTO `tb_mufredat` VALUES (38, 37, 'Alt Kategori', 1, 1, 14, 21, NULL, 1);

-- ----------------------------
-- Table structure for tb_ogrenciler
-- ----------------------------
DROP TABLE IF EXISTS `tb_ogrenciler`;
CREATE TABLE `tb_ogrenciler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `fakulte_id` int NULL DEFAULT NULL,
  `bolum_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `tc_kimlik_no` varchar(11) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `ogrenci_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `adi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `soyadi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sinif` tinyint NULL DEFAULT NULL,
  `kayit_yili` year NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `rol_id` int UNSIGNED NULL DEFAULT 14,
  `super` tinyint NULL DEFAULT 0,
  `cep_tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `adres` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `kullanici_turu` varchar(25) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT 'ogrenci',
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 132 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_ogrenciler
-- ----------------------------
INSERT INTO `tb_ogrenciler` VALUES (1, 1, 1, 1, 1, '', '17060001008', 'Şeyma Nur', 'ERÇİN', NULL, NULL, '2@gmail.com', '4297f44b13955235245b2497399d7a93', NULL, 14, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (2, 1, 1, 1, 1, '', '17060001009', 'Oğulcan', 'AKÇAY', NULL, NULL, '3@gmail.com', '4297f44b13955235245b2497399d7a93', NULL, 14, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (3, 1, 1, 1, 1, '', '17060001010', 'Azad', 'ZENGİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (4, 1, 1, 1, 1, '', '17060001011', 'Ferhat', 'BUCAĞA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (5, 1, 1, 1, 1, '', '17060001012', 'Ayşenur', 'ALMA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (6, 1, 1, 1, 1, '', '17060001013', 'Erkan', 'BAĞTAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (7, 1, 1, 1, 1, '', '17060001014', 'Berçem Fatma', 'YILDIZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (8, 1, 1, 1, 1, '', '17060001015', 'Musa', 'İNCEER', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (9, 1, 1, 1, 1, '', '17060001016', 'Fatma Betül', 'UĞURLU', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (10, 1, 1, 1, 1, '', '17060001017', 'Elif Sümeyya', 'AKSÖZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (11, 1, 1, 1, 1, '', '17060001018', 'Hasan', 'SÖNMEZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (12, 1, 1, 1, 1, '', '17060001019', 'Sözdar', 'CİHAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (13, 1, 1, 1, 1, '', '17060001020', 'Muhammed', 'ERTAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (14, 1, 1, 1, 1, '', '17060001022', 'Ömer', 'BEKİ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (15, 1, 1, 1, 1, '', '17060001023', 'Onur', 'DEMİR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (16, 1, 1, 1, 1, '', '17060001024', 'Neslihan', 'DİZMAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (17, 1, 1, 1, 1, '', '17060001025', 'Taha Miraç', 'GÜNEŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (18, 1, 1, 1, 1, '', '17060001026', 'Cevdet', 'ŞEYLAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (19, 1, 1, 1, 1, '', '17060001027', 'Tekin', 'TÜRKER', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (20, 1, 1, 1, 1, '', '17060001028', 'Meryem', 'ERŞEN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (21, 1, 1, 1, 1, '', '17060001029', 'Dudu', 'ÇEKİCİ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (22, 1, 1, 1, 1, '', '17060001031', 'Şehnaz', 'DOĞAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (23, 1, 1, 1, 1, '', '17060001035', 'Mehmet', 'ALTUN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (24, 1, 1, 1, 1, '', '17060001036', 'Elif Berfin', 'KÖKLİ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (25, 1, 1, 1, 1, '', '17060001037', 'Kadir', 'KALAÇ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (26, 1, 1, 1, 1, '', '17060001038', 'Yunus', 'KAYA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (27, 1, 1, 1, 1, '', '17060001039', 'Zelal', 'YAYLA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (28, 1, 1, 1, 1, '', '17060001040', 'Veysel Karani', 'ŞAHİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (29, 1, 1, 1, 1, '', '17060001041', 'Burhan', 'KIZILTAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (30, 1, 1, 1, 1, '', '17060001043', 'İbrahim', 'ÇOBANOĞLU', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (31, 1, 1, 1, 1, '', '17060001047', 'Özcan', 'DAYAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (32, 1, 1, 1, 1, '', '17060001048', 'Vedat', 'KAVAK', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (33, 1, 1, 1, 1, '', '17060001051', 'Mert', 'KARTAL', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (34, 1, 1, 1, 1, '', '17060001053', 'Evin', 'BÖLER', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (35, 1, 1, 1, 1, '', '17060001054', 'Beyza', 'TUR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (36, 1, 1, 1, 1, '', '17060001055', 'Mizgin', 'BOZKURT', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (37, 1, 1, 1, 1, '', '17060001057', 'Naz Neval', 'ERTAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (38, 1, 1, 1, 1, '', '17060001058', 'Yasin', 'DENİZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (39, 1, 1, 1, 1, '', '17060001060', 'Ahmet', 'KOÇAK', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (40, 1, 1, 1, 1, '', '17060001062', 'Emine', 'KIZILDEMİR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (41, 1, 1, 1, 1, '', '17060001063', 'Arif', 'GÖKDERE', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (42, 1, 1, 1, 1, '', '17060001065', 'Hüseyin Harun', 'KADIRHAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (43, 1, 1, 1, 1, '', '17060001066', 'Diyar', 'VARIŞLI', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (44, 1, 1, 1, 1, '', '17060001067', 'Yüksel', 'METİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (45, 1, 1, 1, 1, '', '17060001069', 'Fatma', 'YUTAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (46, 1, 1, 1, 1, '', '17060001072', 'İbrahim Halil', 'ERZEN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (47, 1, 1, 1, 1, '', '17060001073', 'Mehmet Barsim', 'BOĞATEKİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (48, 1, 1, 1, 1, '', '17060001074', 'Tuğba', 'ATLAM', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (49, 1, 1, 1, 1, '', '17060001075', 'Adem', 'KARAMAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (50, 1, 1, 1, 1, '', '17060001078', 'Bedirhan', 'ERDAL', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (51, 1, 1, 1, 1, '', '17060001079', 'Cihat', 'SEVİNÇ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (52, 1, 1, 1, 1, '', '17060001080', 'Nurşen', 'CENGİZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (53, 1, 1, 1, 1, '', '17060001081', 'Ahmet Alperen', 'BAYRAM', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (54, 1, 1, 1, 1, '', '17060001082', 'Yasemin', 'TUNÇAY', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (55, 1, 1, 1, 1, '', '17060001087', 'İsmail', 'ERDOĞAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (56, 1, 1, 1, 1, '', '17060001088', 'Afşin', 'DUMAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (57, 1, 1, 1, 1, '', '17060001090', 'Cennet', 'ÖZTÜRK', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (58, 1, 1, 1, 1, '', '17060001091', 'Mesut', 'GÜLER', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (59, 1, 1, 1, 1, '', '17060001093', 'Mustafa', 'GÜVEN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (60, 1, 1, 1, 1, '', '17060001094', 'Veysel', 'GÜR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (61, 1, 1, 1, 1, '', '17060001095', 'Zafer', 'KATAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (62, 1, 1, 1, 1, '', '17060001096', 'Gamze', 'AĞCA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (63, 1, 1, 1, 1, '', '17060001098', 'Saliha Nihan', 'ÜRKMEZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (64, 1, 1, 1, 1, '', '17060001099', 'Eda', 'AYDIN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (65, 1, 1, 1, 1, '', '17060001101', 'Murat', 'AKSOY', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (66, 1, 1, 1, 1, '', '17060001102', 'Pelin', 'UNUL', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (67, 1, 1, 1, 1, '', '17060001109', 'Ezgi', 'CESUR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (68, 1, 1, 1, 1, '', '17060001111', 'Batuhan', 'BAYKUŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (69, 1, 1, 1, 1, '', '17060001112', 'Serhat', 'UYGUR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (70, 1, 1, 1, 1, '', '17060001113', 'Muhammed', 'AYDIN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (71, 1, 1, 1, 1, '', '17060001116', 'Nefise', 'AYDEMİR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (72, 1, 1, 1, 1, '', '17060001118', 'Fatmanur', 'MİRBEY', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (73, 1, 1, 1, 1, '', '17060001119', 'Gönül Aslı', 'CAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (74, 1, 1, 1, 1, '', '17060001120', 'Ömer Faruk', 'YUNAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (75, 1, 1, 1, 1, '', '17060001121', 'Zehra', 'HANBABA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (76, 1, 1, 1, 1, '', '17060001124', 'Ümmügülsüm', 'GÜRAY', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (77, 1, 1, 1, 1, '', '17060001125', 'Betül', 'AYÇİÇEK', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (78, 1, 1, 1, 1, '', '17060001127', 'Çağdaş', 'DİLEKCİ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (79, 1, 1, 1, 1, '', '17060001130', 'Arzu', 'DEMİRTAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (80, 1, 1, 1, 1, '', '17060001131', 'Sümeyye Nur', 'ÖNER', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (81, 1, 1, 1, 1, '', '17060001134', 'Hasret', 'BULUT', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (82, 1, 1, 1, 1, '', '17060001135', 'Esra', 'DEĞER', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (83, 1, 1, 1, 1, '', '17060001137', 'Melike', 'KARA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (84, 1, 1, 1, 1, '', '17060001138', 'Mücahit', 'ÇALIŞKAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (85, 1, 1, 1, 1, '', '17060001139', 'Fehime', 'KURT', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (86, 1, 1, 1, 1, '', '17060001143', 'Ümran', 'YAZAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (87, 1, 1, 1, 1, '', '17060001144', 'Saruhan Fikri', 'AYDIN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (88, 1, 1, 1, 1, '', '17060001147', 'Nursena', 'KARABULUT', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (89, 1, 1, 1, 1, '', '17060001148', 'Gurbet', 'KARABAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (90, 1, 1, 1, 1, '', '17060001149', 'Melek', 'DEMİR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (91, 1, 1, 1, 1, '', '17060001150', 'Beyza', 'ÖZDEMİR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (92, 1, 1, 1, 1, '', '17060001129', 'Beyzanur', 'EYVAZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (93, 1, 1, 1, 1, '', '17060001151', 'Emine Şevval', 'YILMAZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (94, 1, 1, 1, 1, '', '17060001153', 'Muhammed Hamza', 'YAZÇİÇEK', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (95, 1, 1, 1, 1, '', '17060001162', 'Ahmet Sait', 'AĞIRTAŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (96, 1, 1, 1, 1, '', '17060001165', 'Ahmed.M.Y.', 'SAIDAM', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (97, 1, 1, 1, 1, '', '17060001171', 'Serkan', 'CEYLAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (98, 1, 1, 1, 1, '', '16060001006', 'Deniz', 'YAŞAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (99, 1, 1, 1, 1, '', '16060001011', 'Şahin', 'YAŞAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (100, 1, 1, 1, 1, '', '16060001021', 'Mehmet Emin', 'ÇAKIR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (101, 1, 1, 1, 1, '', '16060001024', 'Rojin', 'KIZILAY', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (102, 1, 1, 1, 1, '', '16060001028', 'Melek', 'KAYA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (103, 1, 1, 1, 1, '', '16060001045', 'Baran', 'DAKMAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (104, 1, 1, 1, 1, '', '16060001060', 'Mehmet Ali', 'SEÇMEN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (105, 1, 1, 1, 1, '', '16060001071', 'Berivan İdil', 'ABİ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (106, 1, 1, 1, 1, '', '16060001088', 'Dilek', 'AFERİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (107, 1, 1, 1, 1, '', '16060001104', 'Ali', 'EROĞULLARI', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (108, 1, 1, 1, 1, '', '16060001129', 'Mevlüt Özgür', 'ACAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (109, 1, 1, 1, 1, '', '16060001151', 'Mohamad', 'ALHAMDO', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (110, 1, 1, 1, 1, '', '15060001133', 'Abdulsamet', 'BEŞKARDEŞ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (111, 1, 1, 1, 1, '', '14060001069', 'İbrahim', 'GÜLTEKİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (112, 1, 1, 1, 1, '', '14060001135', 'Nail', 'BEYAZIT', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (113, 1, 1, 1, 1, '', '19060001152', 'Elif', 'AVA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (114, 1, 1, 1, 1, '', '19060001153', 'Barış', 'TUNÇ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (115, 1, 1, 1, 1, '', '19060001162', 'Neslihan', 'ARSLAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (116, 1, 1, 1, 1, '', '20060001152', 'Yasemin', 'ÖZMEN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (117, 1, 1, 1, 1, '', '20060001153', 'Abdullah Harun', 'YILMAZ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (118, 1, 1, 1, 1, '', '21060001170', 'Hakan', 'BAYRAM', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (119, 1, 1, 1, 1, '', '16060001061', 'Fulya', 'ŞAHİN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (120, 1, 1, 1, 1, '', '16060001080', 'Ramazan', 'YALMAÇ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (121, 1, 1, 1, 1, '', '15060001059', 'Dıjvar', 'DENLİ', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (122, 1, 1, 1, 1, '', '14060001130', 'Gülezgi', 'KAYAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (123, 1, 1, 1, 1, '', '13060001135', 'Muhammed', 'FATİH', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (124, 1, 1, 1, 1, '', '16060001121', 'Furkan Kağan', 'DALDABAN', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (125, 1, 1, 1, 1, '', '20060001007', 'Muhammed Enes', 'UÇAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (126, 1, 1, 1, 1, '', '20060001002', 'Dilara', 'AVCI', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (127, 1, 1, 1, 1, '', '16060001119', 'Ömer', 'KUTLU', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (128, 1, 1, 1, 1, '', '16060001013', 'Abdullah', 'SEVAL', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (129, 1, 1, 1, 1, '', '14060001140', 'M.Kasım', 'ÇAKILLIKOYAK', NULL, NULL, '1@gmail.com', '4297f44b13955235245b2497399d7a93', NULL, 14, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (130, 1, 1, 1, 1, '', '15060001168', 'Mehmet', 'YAZAR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'ogrenci', 1);
INSERT INTO `tb_ogrenciler` VALUES (131, 1, 1, 1, 1, '13337993570', '16060001081', 'Öğrenci', 'Profili', 11, 2021, 'resul.evis@gmail.com', '4297f44b13955235245b2497399d7a93', NULL, 14, 0, '5366373523', 'Seyrantepe Mah. Van', 'ogrenci', 1);

-- ----------------------------
-- Table structure for tb_ogretim_elemanlari
-- ----------------------------
DROP TABLE IF EXISTS `tb_ogretim_elemanlari`;
CREATE TABLE `tb_ogretim_elemanlari`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `fakulte_id` int NULL DEFAULT NULL,
  `anabilim_dali_id` int NULL DEFAULT NULL,
  `tc_kimlik_no` varchar(11) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `unvan_id` int NULL DEFAULT NULL,
  `adi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `soyadi` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `cep_tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `rol_id` int NULL DEFAULT 15,
  `super` tinyint NULL DEFAULT 0,
  `kullanici_turu` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT 'ogretmen',
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_ogretim_elemanlari
-- ----------------------------
INSERT INTO `tb_ogretim_elemanlari` VALUES (1, 1, 1, 1, NULL, 1, 'Sıddık', 'KESKİN', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (2, 1, 1, 1, NULL, 3, 'Şükran', 'SEVİMLİ', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (3, 1, 1, 1, NULL, 3, 'Sinemis', 'ÇETİN DAĞLI', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (4, 1, 1, 1, NULL, 3, 'Mehmet Emin', 'LAYIK', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (5, 1, 1, 1, NULL, 5, 'Duygu', 'KORKMAZ', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (6, 1, 1, 1, NULL, 5, 'Tuncay', 'ULU', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (7, 1, 1, 1, NULL, 5, 'Ahmet', 'SALTIK', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (8, 1, 1, 1, NULL, 5, 'Zülkaf', 'AKBALIK', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (9, 1, 1, 1, NULL, 5, 'Zeynep', 'ŞAHİN', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (10, 1, 1, 1, NULL, 5, 'Hale Mükerrem', 'KAYA', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (11, 1, 1, 1, NULL, 5, 'Rukiye', 'TOKUŞ', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (12, 1, 1, 1, NULL, 5, 'İslam', 'KÖSE', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (14, 1, 1, 1, NULL, 3, 'Hava', 'BEKTAŞ', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (15, 1, 1, 1, NULL, 4, 'Nuray', 'KAYA', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (16, 1, 1, 1, NULL, 3, 'İzzet', 'ÇELEĞEN', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (18, 1, 1, 1, NULL, 2, 'Özlem Ergül', 'ERKEÇ', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (20, 1, 1, 1, NULL, 3, 'Mustafa', 'BİLİCİ', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (21, 1, 1, 3, NULL, 1, 'Öğretmen ', 'Profili', 'resulevis@yyu.edu.tr', '05366373524', '4297f44b13955235245b2497399d7a93', NULL, 15, 0, 'ogretmen', 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (22, 1, 1, 1, '', 2, 'Tahir', 'ÇAKIR', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (23, 1, 1, 1, NULL, 2, 'Hamit Hakan', 'ALP', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (25, 1, 1, 2, NULL, 1, 'Halil', 'ÖZKOL', 'mail@mail.com', '5555555555', NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (26, 1, 1, 1, NULL, 2, 'Zübeyir', 'HUYUT', 'mail@mail.com', '555 555 5555', NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `tb_ogretim_elemanlari` VALUES (27, 1, 1, 1, '', 2, 'Habibe', 'ÜRGÜN', 'habibe.urgun@gmail.com', '5366373532', '4297f44b13955235245b2497399d7a93', NULL, 15, 0, 'ogretmen', 1);

-- ----------------------------
-- Table structure for tb_programlar
-- ----------------------------
DROP TABLE IF EXISTS `tb_programlar`;
CREATE TABLE `tb_programlar`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `bolum_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `varsayilan` tinyint NULL DEFAULT 0,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_programlar
-- ----------------------------
INSERT INTO `tb_programlar` VALUES (1, 1, 1, 'Tıp Lisans', 1, 1);

-- ----------------------------
-- Table structure for tb_rol_yetkiler
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol_yetkiler`;
CREATE TABLE `tb_rol_yetkiler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NULL DEFAULT NULL,
  `modul_id` int NULL DEFAULT NULL,
  `islem_turu_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_rol_yetkiler
-- ----------------------------
INSERT INTO `tb_rol_yetkiler` VALUES (1, 20, 133, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (2, 20, 1, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (4, 20, 2, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (5, 20, 2, 2);
INSERT INTO `tb_rol_yetkiler` VALUES (6, 20, 2, 4);
INSERT INTO `tb_rol_yetkiler` VALUES (7, 20, 2, 5);
INSERT INTO `tb_rol_yetkiler` VALUES (8, 20, 2, 11);
INSERT INTO `tb_rol_yetkiler` VALUES (9, 20, 32, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (10, 20, 32, 2);
INSERT INTO `tb_rol_yetkiler` VALUES (11, 20, 32, 3);
INSERT INTO `tb_rol_yetkiler` VALUES (12, 20, 32, 4);
INSERT INTO `tb_rol_yetkiler` VALUES (13, 20, 32, 5);
INSERT INTO `tb_rol_yetkiler` VALUES (24, 20, 3, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (25, 20, 3, 2);
INSERT INTO `tb_rol_yetkiler` VALUES (26, 20, 3, 3);
INSERT INTO `tb_rol_yetkiler` VALUES (27, 20, 3, 4);
INSERT INTO `tb_rol_yetkiler` VALUES (28, 20, 3, 5);
INSERT INTO `tb_rol_yetkiler` VALUES (58, 15, 139, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (59, 15, 139, 47);
INSERT INTO `tb_rol_yetkiler` VALUES (60, 15, 139, 50);
INSERT INTO `tb_rol_yetkiler` VALUES (61, 15, 139, 53);
INSERT INTO `tb_rol_yetkiler` VALUES (62, 15, 139, 54);
INSERT INTO `tb_rol_yetkiler` VALUES (63, 15, 139, 55);
INSERT INTO `tb_rol_yetkiler` VALUES (64, 15, 139, 56);
INSERT INTO `tb_rol_yetkiler` VALUES (71, 15, 133, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (72, 15, 133, 2);
INSERT INTO `tb_rol_yetkiler` VALUES (73, 15, 133, 3);
INSERT INTO `tb_rol_yetkiler` VALUES (74, 15, 133, 4);
INSERT INTO `tb_rol_yetkiler` VALUES (75, 15, 133, 5);
INSERT INTO `tb_rol_yetkiler` VALUES (76, 15, 133, 44);
INSERT INTO `tb_rol_yetkiler` VALUES (77, 15, 133, 54);
INSERT INTO `tb_rol_yetkiler` VALUES (78, 15, 137, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (79, 15, 137, 3);
INSERT INTO `tb_rol_yetkiler` VALUES (80, 15, 137, 47);
INSERT INTO `tb_rol_yetkiler` VALUES (81, 15, 137, 48);
INSERT INTO `tb_rol_yetkiler` VALUES (82, 15, 117, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (83, 15, 117, 4);
INSERT INTO `tb_rol_yetkiler` VALUES (84, 15, 117, 5);
INSERT INTO `tb_rol_yetkiler` VALUES (85, 14, 141, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (86, 14, 140, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (87, 14, 1, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (88, 14, 145, 1);
INSERT INTO `tb_rol_yetkiler` VALUES (89, 14, 145, 5);

-- ----------------------------
-- Table structure for tb_rol_yetkili_firmalar
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol_yetkili_firmalar`;
CREATE TABLE `tb_rol_yetkili_firmalar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NULL DEFAULT NULL,
  `firma_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of tb_rol_yetkili_firmalar
-- ----------------------------
INSERT INTO `tb_rol_yetkili_firmalar` VALUES (18, 2, 4);
INSERT INTO `tb_rol_yetkili_firmalar` VALUES (17, 2, 3);
INSERT INTO `tb_rol_yetkili_firmalar` VALUES (16, 2, 2);
INSERT INTO `tb_rol_yetkili_firmalar` VALUES (8, 8, 1);
INSERT INTO `tb_rol_yetkili_firmalar` VALUES (9, 8, 32);
INSERT INTO `tb_rol_yetkili_firmalar` VALUES (15, 2, 1);

-- ----------------------------
-- Table structure for tb_rol_yetkili_subeler
-- ----------------------------
DROP TABLE IF EXISTS `tb_rol_yetkili_subeler`;
CREATE TABLE `tb_rol_yetkili_subeler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NULL DEFAULT NULL,
  `sube_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of tb_rol_yetkili_subeler
-- ----------------------------
INSERT INTO `tb_rol_yetkili_subeler` VALUES (11, 14, 2);
INSERT INTO `tb_rol_yetkili_subeler` VALUES (9, 14, 3);

-- ----------------------------
-- Table structure for tb_roller
-- ----------------------------
DROP TABLE IF EXISTS `tb_roller`;
CREATE TABLE `tb_roller`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `varsayilan` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_roller
-- ----------------------------
INSERT INTO `tb_roller` VALUES (1, 'Varsayılan', 1);
INSERT INTO `tb_roller` VALUES (14, 'Öğrenci', 1);
INSERT INTO `tb_roller` VALUES (15, 'Öğretmen', 1);
INSERT INTO `tb_roller` VALUES (20, 'Admin', 0);

-- ----------------------------
-- Table structure for tb_sinav_bitirenler
-- ----------------------------
DROP TABLE IF EXISTS `tb_sinav_bitirenler`;
CREATE TABLE `tb_sinav_bitirenler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sinav_id` int NULL DEFAULT NULL,
  `ogrenci_id` int NULL DEFAULT NULL,
  `iptal_eden_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sinav_bitirenler
-- ----------------------------

-- ----------------------------
-- Table structure for tb_sinav_cevaplari
-- ----------------------------
DROP TABLE IF EXISTS `tb_sinav_cevaplari`;
CREATE TABLE `tb_sinav_cevaplari`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ogrenci_id` int NULL DEFAULT NULL,
  `sinav_id` int NULL DEFAULT NULL,
  `soru_id` int NULL DEFAULT NULL,
  `cevap_id` int NULL DEFAULT NULL,
  `cevap_metin` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sinav_cevaplari
-- ----------------------------

-- ----------------------------
-- Table structure for tb_sinav_ogrencileri
-- ----------------------------
DROP TABLE IF EXISTS `tb_sinav_ogrencileri`;
CREATE TABLE `tb_sinav_ogrencileri`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sinav_id` int NULL DEFAULT NULL,
  `ogrenci_id` int NULL DEFAULT NULL,
  `sinav_bitti_mi` tinyint UNSIGNED NULL DEFAULT 0,
  `okudum_anladim` tinyint NULL DEFAULT 0,
  `sinav_puani` int NULL DEFAULT NULL,
  `sinav_bitiren_ip_adresi` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sinavi_aktif_eden` int NULL DEFAULT NULL,
  `ek_sure` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 117 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sinav_ogrencileri
-- ----------------------------
INSERT INTO `tb_sinav_ogrencileri` VALUES (108, 16, 128, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (109, 16, 3, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (110, 16, 9, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (111, 16, 4, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (112, 16, 129, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (113, 16, 130, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (114, 16, 2, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (115, 16, 1, 0, 0, NULL, NULL, NULL, 0);
INSERT INTO `tb_sinav_ogrencileri` VALUES (116, 16, 131, 0, 0, NULL, '', NULL, 0);

-- ----------------------------
-- Table structure for tb_sinav_sorulari
-- ----------------------------
DROP TABLE IF EXISTS `tb_sinav_sorulari`;
CREATE TABLE `tb_sinav_sorulari`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sinav_id` int NULL DEFAULT NULL,
  `ogretim_elemani_id` int NULL DEFAULT NULL,
  `soru_id` int NULL DEFAULT NULL,
  `ders_id` int NULL DEFAULT NULL,
  `ekleyen` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sinav_sorulari
-- ----------------------------
INSERT INTO `tb_sinav_sorulari` VALUES (20, 16, 21, 13, 14, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (21, 16, 1, 5, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (22, 16, 1, 10, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (23, 16, 1, 8, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (24, 16, 1, 11, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (25, 16, 1, 3, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (26, 16, 1, 6, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (27, 16, 1, 7, 1, 31);
INSERT INTO `tb_sinav_sorulari` VALUES (28, 16, 1, 9, 1, 31);

-- ----------------------------
-- Table structure for tb_sinavlar
-- ----------------------------
DROP TABLE IF EXISTS `tb_sinavlar`;
CREATE TABLE `tb_sinavlar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `universite_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `donem_id` int NULL DEFAULT NULL,
  `komite_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `aciklama` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `sinav_oncesi_aciklama` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `sinav_sonrasi_aciklama` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `sinav_suresi` int NULL DEFAULT NULL,
  `sinav_baslangic_tarihi` date NOT NULL,
  `sinav_baslangic_saati` time NULL DEFAULT NULL,
  `sinav_bitis_tarihi` date NULL DEFAULT NULL,
  `sinav_bitis_saati` time NULL DEFAULT NULL,
  `sinava_giris_tarihi` date NULL DEFAULT NULL,
  `sinava_giris_saati` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sorulari_karistir` tinyint NULL DEFAULT NULL,
  `secenekleri_karistir` tinyint NULL DEFAULT NULL,
  `ip_adresi` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `soru_sayisi` int NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sinavlar
-- ----------------------------
INSERT INTO `tb_sinavlar` VALUES (16, '1', 1, 1, 'Tıbba Giriş 1. sınav', '<p>Sınav AÇıklaması</p>', '<p>Sınav Öncesi Açıklama</p>', '<p>Sınav Sonrası Açıklaması</p>', 120, '2022-11-30', '10:02:02', '2022-11-30', '11:30:00', NULL, NULL, 1, 1, '192.168.1.30/40', 20, 1);

-- ----------------------------
-- Table structure for tb_sistem_kullanici
-- ----------------------------
DROP TABLE IF EXISTS `tb_sistem_kullanici`;
CREATE TABLE `tb_sistem_kullanici`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `soyadi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `telefon` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `rol_id` int NOT NULL DEFAULT 1,
  `super` tinyint NULL DEFAULT 0,
  `resim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT 'resim_yok.jpg',
  `tc_no` varchar(11) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `dogum_tarihi` datetime NULL DEFAULT NULL,
  `universiteler` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT '',
  `kullanici_turu` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT 'admin',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sistem_kullanici
-- ----------------------------
INSERT INTO `tb_sistem_kullanici` VALUES (19, 'Serbest', 'ZİYANAK', 'serbest.ziyanak@gmail.com', '0(544) 496-1144', 'bc000ebca4a5687a014d9c9f94da86e8', 14, 1, '19.jpg', '45982964018', '1989-01-20 00:00:00', '1', 'admin');
INSERT INTO `tb_sistem_kullanici` VALUES (28, 'Fırat', 'KAPAR', 'frtkpr@gmail.com', '0(542) 220-5037', '4297f44b13955235245b2497399d7a93', 14, 1, '28.png', '11111111111', '1970-01-01 00:00:00', '1', 'admin');
INSERT INTO `tb_sistem_kullanici` VALUES (31, 'Admin', 'PROFİLİ', 'resulevis60@gmail.com', '0(536) 637-3523', '4297f44b13955235245b2497399d7a93', 20, 1, '31.jpg', '13337993570', '1997-02-02 00:00:00', '1', 'admin');

-- ----------------------------
-- Table structure for tb_sistem_kullanici_yetkili_birimler
-- ----------------------------
DROP TABLE IF EXISTS `tb_sistem_kullanici_yetkili_birimler`;
CREATE TABLE `tb_sistem_kullanici_yetkili_birimler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `birim_id` int NULL DEFAULT NULL,
  `kullanici_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_sistem_kullanici_yetkili_birimler
-- ----------------------------
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES (1, 1, 1);
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES (2, 2, 1);
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES (3, 1, 2);
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES (4, 1, 4);
INSERT INTO `tb_sistem_kullanici_yetkili_birimler` VALUES (5, 1, 7);

-- ----------------------------
-- Table structure for tb_soru_bankasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_soru_bankasi`;
CREATE TABLE `tb_soru_bankasi`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `soru` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL,
  `soru_turu_id` int NULL DEFAULT NULL,
  `soru_dosyasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `mufredat_id` int NULL DEFAULT NULL,
  `ders_yili_donem_id` int NULL DEFAULT NULL,
  `program_id` int NULL DEFAULT NULL,
  `ders_id` int NULL DEFAULT NULL,
  `ogretim_elemani_id` int NULL DEFAULT NULL,
  `zorluk_derecesi` tinyint NULL DEFAULT NULL,
  `puan` int NULL DEFAULT NULL,
  `etiket` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `editor` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_soru_bankasi
-- ----------------------------
INSERT INTO `tb_soru_bankasi` VALUES (1, '<p>En hareketli sinovial eklem tipini işaretleyiniz.<br></p>', 1, '', 1, 1, 1, 1, 1, 3, 10, 'sinovial eklem', 0);
INSERT INTO `tb_soru_bankasi` VALUES (2, '<p>Üst ekstremitenin orta hatta yaklaşması hareketine ne ad verilir?<br></p>', 1, '', 1, 1, 1, 1, 1, 3, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (3, '<p>Vertebra cisimleri ile kaburga başları arasındaki eklemlere ne ad verilir?<br></p>', 1, '', 1, 1, 1, 1, 1, 3, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (4, '<p>Art. radio-ulnaris proximalis’in eklem tipini işaretleyiniz.<br></p>', 1, '', 1, 1, 1, 1, 1, 3, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (5, '<p>Ayak tabanının dışa doğru döndürülmesine ne ad verilir?<br></p>', 1, '', 1, 1, 1, 1, 1, 3, 5, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (6, '<p>.Hangi kas ağız açıklığı (yarığı) ile ilgili<b> <u>değildir?</u></b></p>', 1, '', 1, 1, 1, 1, 1, 2, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (7, '<p>Hangisi yüzeyel sırt kası <b><u>değildir?</u></b></p>', 1, '', 1, 1, 1, 1, 1, 2, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (8, '<p>M. pectoralis major’un insertio ve origo’ları ile ilgili <b><u>olmayan</u></b> şıkkı işaretleyiniz.<br></p>', 1, '', 1, 1, 1, 1, 1, 3, 15, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (9, '<p>Hangi kas, ön-kola ekstansiyon yaptırır?</p>', 1, '', 1, 1, 1, 1, 1, 1, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (10, '<p>Hangisi ayağa dorsifleksiyon <b><u>yaptırmaz?</u></b></p>', 1, '', 1, 1, 1, 1, 1, 1, 10, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (11, '<p><b>(I)</b> Omur cisimleri ile kaburga başları arasında plan tipi eklem bulunur.</p><p><b>(II) </b>Bir omurun transvers çıkıntısı ile bir kaburganın tuberculum costae’si arasında plan tipi eklem bulunur.</p><p>Aşağıdakilerden hangisi doğrudur.</p>', 1, '', 1, 1, 1, 1, 1, 4, 15, '', 0);
INSERT INTO `tb_soru_bankasi` VALUES (12, '<p>Fibröz eklemler için doğru olan şıkkı işaretleyiniz.</p><p><b>(I) </b>Syndesmosis<br></p><p><b>(II) </b>Gomphosis</p><p><b>(IV)</b> Synchondrosis</p><p><b>(III)</b> Sutura<br></p>', 1, '', 1, 1, 1, 1, 1, 5, 20, 'Fibröz eklemler', 0);
INSERT INTO `tb_soru_bankasi` VALUES (13, '<p>Soru Bankası Deneme Amaçlı&nbsp;</p><p>Asağıdakilerden hangileri <b><u>doğrudur?</u></b></p>', 2, '', 38, 1, 1, 14, 21, 5, 10, 'ABCDE', 0);
INSERT INTO `tb_soru_bankasi` VALUES (14, '<p>ASDASDASD</p>', 2, '63637d9e7165c.jpg', 37, 1, 1, 14, 1, 5, 10, 'ABCD', 0);
INSERT INTO `tb_soru_bankasi` VALUES (15, '<p>Sorudur</p>', 1, '636cd0e45ab13.jpg', 1, 1, 1, 1, 21, 1, 10, 'etiketsorusu', 0);

-- ----------------------------
-- Table structure for tb_soru_secenekleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_soru_secenekleri`;
CREATE TABLE `tb_soru_secenekleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `soru_id` int NULL DEFAULT NULL,
  `secenek` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL,
  `dogru_secenek` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_soru_secenekleri
-- ----------------------------
INSERT INTO `tb_soru_secenekleri` VALUES (1, 1, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (2, 1, 'b', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (3, 1, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (4, 1, 'd', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (5, 1, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (6, 2, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (7, 2, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (8, 2, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (9, 2, 'd', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (10, 2, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (11, 3, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (12, 3, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (13, 3, 'c', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (14, 3, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (15, 3, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (16, 4, 'a', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (17, 4, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (18, 4, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (19, 4, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (20, 4, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (21, 5, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (22, 5, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (23, 5, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (24, 5, 'd', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (25, 5, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (26, 6, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (27, 6, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (28, 6, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (29, 6, 'd', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (30, 6, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (31, 7, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (32, 7, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (33, 7, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (34, 7, 'd', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (35, 7, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (36, 8, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (37, 8, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (38, 8, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (39, 8, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (40, 8, 'e', 1);
INSERT INTO `tb_soru_secenekleri` VALUES (41, 9, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (42, 9, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (43, 9, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (44, 9, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (45, 9, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (46, 10, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (47, 10, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (48, 10, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (49, 10, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (50, 10, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (51, 11, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (52, 11, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (53, 11, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (54, 11, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (55, 11, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (56, 12, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (57, 12, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (58, 12, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (59, 12, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (60, 12, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (61, 13, 'f', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (62, 13, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (63, 13, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (64, 13, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (65, 13, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (66, 13, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (67, 14, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (68, 14, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (69, 14, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (70, 14, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (71, 14, 'e', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (72, 15, 'a', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (73, 15, 'b', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (74, 15, 'c', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (75, 15, 'd', NULL);
INSERT INTO `tb_soru_secenekleri` VALUES (76, 15, 'e', NULL);

-- ----------------------------
-- Table structure for tb_soru_turleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_soru_turleri`;
CREATE TABLE `tb_soru_turleri`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `universite_id` int NULL DEFAULT NULL,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `coklu_secenek` tinyint NULL DEFAULT 0,
  `metin` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_soru_turleri
-- ----------------------------
INSERT INTO `tb_soru_turleri` VALUES (1, 1, 'Çoktan Tek Seçmeli', 0, 0);
INSERT INTO `tb_soru_turleri` VALUES (2, 1, 'Çoktan Çok Seçmeli', 1, 0);
INSERT INTO `tb_soru_turleri` VALUES (3, 1, 'Açık Uçlu', 0, 1);

-- ----------------------------
-- Table structure for tb_universiteler
-- ----------------------------
DROP TABLE IF EXISTS `tb_universiteler`;
CREATE TABLE `tb_universiteler`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `aktif` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_universiteler
-- ----------------------------
INSERT INTO `tb_universiteler` VALUES (1, 'Van Yüzüncü Yıl Üniversitesi', 1);
INSERT INTO `tb_universiteler` VALUES (2, 'İstanbul Teknik Üniversitesi', 0);
INSERT INTO `tb_universiteler` VALUES (3, 'Hacattepe Üniversitesi', 0);
INSERT INTO `tb_universiteler` VALUES (4, 'Yıldız Teknik Üniversitesi', 1);

-- ----------------------------
-- Table structure for tb_unvanlar
-- ----------------------------
DROP TABLE IF EXISTS `tb_unvanlar`;
CREATE TABLE `tb_unvanlar`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `sira` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_unvanlar
-- ----------------------------
INSERT INTO `tb_unvanlar` VALUES (1, 'Prof. Dr.', 1);
INSERT INTO `tb_unvanlar` VALUES (2, 'Doc. Dr.', 2);
INSERT INTO `tb_unvanlar` VALUES (3, 'Dr. Öğr. Üyesi', 3);
INSERT INTO `tb_unvanlar` VALUES (4, 'Öğr. Gör. Dr.', 4);
INSERT INTO `tb_unvanlar` VALUES (5, 'Arş. Gör. Dr.', 5);
INSERT INTO `tb_unvanlar` VALUES (6, 'Öğr. Gör.', 6);
INSERT INTO `tb_unvanlar` VALUES (7, 'Arş. Gör.', 7);

-- ----------------------------
-- Table structure for tb_yetki
-- ----------------------------
DROP TABLE IF EXISTS `tb_yetki`;
CREATE TABLE `tb_yetki`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NULL DEFAULT NULL,
  `modul_id` int NULL DEFAULT NULL,
  `yetki_islem_turu_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_yetki
-- ----------------------------

-- ----------------------------
-- Table structure for tb_yetki_islem_turleri
-- ----------------------------
DROP TABLE IF EXISTS `tb_yetki_islem_turleri`;
CREATE TABLE `tb_yetki_islem_turleri`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `gorunen_adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_yetki_islem_turleri
-- ----------------------------
INSERT INTO `tb_yetki_islem_turleri` VALUES (1, 'goruntule', 'Görüntüle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (2, 'ekle', 'Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (3, 'sil', 'Sil');
INSERT INTO `tb_yetki_islem_turleri` VALUES (4, 'duzenle', 'Düzenle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (5, 'kaydet', 'Kaydet');
INSERT INTO `tb_yetki_islem_turleri` VALUES (6, 'rapor', 'Rapor Al');
INSERT INTO `tb_yetki_islem_turleri` VALUES (10, 'super', 'Super Yetki Ataması');
INSERT INTO `tb_yetki_islem_turleri` VALUES (11, 'rol-degistir', 'Kullanıcı Rol Değiştir');
INSERT INTO `tb_yetki_islem_turleri` VALUES (42, 'gorevli-ekle', 'Ders Öğretim  Görevlisi Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (43, 'gorevli-listesi', 'Ders Ogretim Gorevlisi ');
INSERT INTO `tb_yetki_islem_turleri` VALUES (44, 'kategori-ekle', 'Kategori Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (47, 'detaylar', 'Detaylar');
INSERT INTO `tb_yetki_islem_turleri` VALUES (48, 'guncelle', 'Guncelle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (49, 'secenek-ekle', 'Seçenek Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (50, 'ogrenci-listesi', 'Öğrenci Listesi');
INSERT INTO `tb_yetki_islem_turleri` VALUES (51, 'ogrenci-ekle', 'Öğrenci Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (52, 'ogrenci-cikar', 'Öğrenci Çıkar');
INSERT INTO `tb_yetki_islem_turleri` VALUES (53, 'sorular', 'Soru Lisetesi');
INSERT INTO `tb_yetki_islem_turleri` VALUES (54, 'soru-ekle', 'Soru Ekle');
INSERT INTO `tb_yetki_islem_turleri` VALUES (55, 'soru-cikar', 'Soru Çıkar');
INSERT INTO `tb_yetki_islem_turleri` VALUES (56, 'sinav-soru-sil', 'Sınav Sorusu Sil');

-- ----------------------------
-- View structure for view_giris_kontrol
-- ----------------------------
DROP VIEW IF EXISTS `view_giris_kontrol`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_giris_kontrol` AS select `tb_sistem_kullanici`.`id` AS `id`,`tb_sistem_kullanici`.`adi` AS `adi`,`tb_sistem_kullanici`.`soyadi` AS `soyadi`,`tb_sistem_kullanici`.`email` AS `email`,`tb_sistem_kullanici`.`sifre` AS `sifre`,`tb_sistem_kullanici`.`resim` AS `resim`,`tb_sistem_kullanici`.`rol_id` AS `rol_id`,`tb_sistem_kullanici`.`super` AS `super`,`tb_sistem_kullanici`.`universiteler` AS `universite_id`,`tb_sistem_kullanici`.`kullanici_turu` AS `kullanici_turu` from `tb_sistem_kullanici` union select `o`.`id` AS `id`,`o`.`adi` AS `adi`,`o`.`soyadi` AS `soyadi`,`o`.`email` AS `email`,`o`.`sifre` AS `sifre`,`o`.`resim` AS `resim`,`o`.`rol_id` AS `rol_id`,`o`.`super` AS `super`,`o`.`universite_id` AS `universite_id`,`o`.`kullanici_turu` AS `kullanici_turu` from `tb_ogrenciler` `o` union select `tb_ogretim_elemanlari`.`id` AS `id`,`tb_ogretim_elemanlari`.`adi` AS `adi`,`tb_ogretim_elemanlari`.`soyadi` AS `soyadi`,`tb_ogretim_elemanlari`.`email` AS `email`,`tb_ogretim_elemanlari`.`sifre` AS `sifre`,`tb_ogretim_elemanlari`.`resim` AS `resim`,`tb_ogretim_elemanlari`.`rol_id` AS `rol_id`,`tb_ogretim_elemanlari`.`super` AS `super`,`tb_ogretim_elemanlari`.`universite_id` AS `universite_id`,`tb_ogretim_elemanlari`.`kullanici_turu` AS `kullanici_turu` from `tb_ogretim_elemanlari`; ;

SET FOREIGN_KEY_CHECKS = 1;
