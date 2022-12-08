/*
 Navicat Premium Data Transfer

 Source Server         : db_b
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : seafood

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 08/12/2022 20:40:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_aktif` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (2, 'yoki', 'yokihidayaturr13@gmail.com', '$2y$10$YODblF7yAt8E8uwfF9G3pOAgq2ZzFWq2yMhqVwUAHj4y2TN76eNc.', 1, NULL, '2022-05-23 20:25:49', '2022-05-23 20:25:49', 1);
INSERT INTO `admins` VALUES (4, '', 'bambang@gmail.com', '$2y$10$YODblF7yAt8E8uwfF9G3pOAgq2ZzFWq2yMhqVwUAHj4y2TN76eNc.', 0, NULL, '2022-05-23 23:36:00', '2022-05-23 23:36:00', 1);
INSERT INTO `admins` VALUES (5, 'yoki', 'toko@gmail.com', '$2y$10$YODblF7yAt8E8uwfF9G3pOAgq2ZzFWq2yMhqVwUAHj4y2TN76eNc.', 0, NULL, '2022-05-23 23:45:44', '2022-05-23 23:45:44', 1);
INSERT INTO `admins` VALUES (6, 'toko ika laut', 'laut@gmail.com', '$2y$10$YODblF7yAt8E8uwfF9G3pOAgq2ZzFWq2yMhqVwUAHj4y2TN76eNc.', 0, NULL, '2022-05-24 15:19:01', '2022-05-24 15:19:01', 1);
INSERT INTO `admins` VALUES (7, 'toko ikan putra', 'laut1@gmail.com', '$2y$10$YODblF7yAt8E8uwfF9G3pOAgq2ZzFWq2yMhqVwUAHj4y2TN76eNc.', 0, NULL, '2022-05-24 17:13:55', '2022-05-24 17:13:55', 1);

-- ----------------------------
-- Table structure for data_supplier
-- ----------------------------
DROP TABLE IF EXISTS `data_supplier`;
CREATE TABLE `data_supplier`  (
  `id_data_supplier` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_supplier` int NOT NULL,
  `nama_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_rek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_wa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_data_supplier`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data_supplier
-- ----------------------------
INSERT INTO `data_supplier` VALUES (1, 9, NULL, NULL, NULL, NULL, NULL, '2022-06-05 15:15:57', '2022-06-05 15:15:57');

-- ----------------------------
-- Table structure for data_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `data_transaksi`;
CREATE TABLE `data_transaksi`  (
  `id_data_transaksi` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `nama` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kota` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat_lengkap` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `catatan` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nomor_hp` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_data_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data_transaksi
-- ----------------------------
INSERT INTO `data_transaksi` VALUES (1, 37, 'wwer', 'fasfas', 'fasfasf', 'asfasfasf', 'pembayaran-1670504894_PEMBELIAN-20221208(11)', 876213123, '2022-12-08 12:53:10', '2022-12-08 12:53:10', 'admin@sangahli.com');
INSERT INTO `data_transaksi` VALUES (2, 38, 'wwer', 'Lamongan', 'lamongan Lamongan', 'Lamongandgad', 'pembayaran-1670505594_PEMBELIAN-20221208(17)', 988090909, '2022-12-08 13:19:14', '2022-12-08 13:19:14', 'yokihidayaturr13@gmail.com');

-- ----------------------------
-- Table structure for detail_barang
-- ----------------------------
DROP TABLE IF EXISTS `detail_barang`;
CREATE TABLE `detail_barang`  (
  `id_detail_barang` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_barang` int NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_barang
-- ----------------------------
INSERT INTO `detail_barang` VALUES (6, 4, '1653411253_040813300_1623815066-shutterstock_1659922546__1_.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (7, 5, '1653411282_picture-1548209177.jpeg', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (9, 3, '1653411253_040813300_1623815066-shutterstock_1659922546__1_.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (10, 6, '1653412141_salmon-g61e90d457_1920-1024x681.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (11, 7, '1653412460_pexels-rachel-claire-5491014-1024x683.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (12, 8, '1653412488_Layar-Seafood-Surabaya.png', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (13, 9, '1653412613_images.jpeg', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);
INSERT INTO `detail_barang` VALUES (14, 10, '1653412631_seafood-ambyar-topping-keju-leleh-1.png', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL);

-- ----------------------------
-- Table structure for detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi`  (
  `id_detail_transaksi` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_barang` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `qty` decimal(8, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `harga` decimal(8, 2) NOT NULL,
  PRIMARY KEY (`id_detail_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------
INSERT INTO `detail_transaksi` VALUES (10, 4, 10, 12.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (11, 5, 11, 56.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (12, 6, 12, 1.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (13, 7, 13, 12.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (14, 8, 14, 12.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (15, 8, 15, 12.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (16, 9, 16, 12.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (17, 10, 17, 15.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (18, 10, 18, 19.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (19, 64, 19, 19.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (20, 62, 20, 19.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (21, 42, 21, 19.00, '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0.00);
INSERT INTO `detail_transaksi` VALUES (24, 5, 33, -6.00, '2022-05-28 00:04:24', '2022-05-28 00:04:24', NULL, 90000.00);
INSERT INTO `detail_transaksi` VALUES (25, 10, 33, -4.00, '2022-05-28 00:04:24', '2022-05-28 00:04:24', NULL, 56000.00);
INSERT INTO `detail_transaksi` VALUES (26, 8, 34, -10.00, '2022-05-28 01:33:27', '2022-05-28 01:33:27', NULL, 140000.00);
INSERT INTO `detail_transaksi` VALUES (27, 42, 35, -5.00, '2022-05-28 01:34:56', '2022-05-28 01:34:56', NULL, 75000.00);
INSERT INTO `detail_transaksi` VALUES (28, 4, 38, -1.00, '2022-12-08 13:19:14', '2022-12-08 13:19:14', NULL, 12000.00);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for gambar_dashboard
-- ----------------------------
DROP TABLE IF EXISTS `gambar_dashboard`;
CREATE TABLE `gambar_dashboard`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_jenis_kontent` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gambar_t1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gambar_t2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gambar_dashboard
-- ----------------------------
INSERT INTO `gambar_dashboard` VALUES (1, '1670503396_032068100_1602238087-pexels-photo-1766604.jpeg', 'Serba Serbi Ujung Pangkah', '<span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">ual Beli Online di&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">Shopee</span><span style=\"colo', 1, '2022-12-08 12:43:16', '2022-12-08 12:43:16', '1670503396_050112900_1546499867-alexa-mazzarello-457546-unsplash.jpg', '1670503396_059893400_1597736972-corinne-kutz-tMI2_-r5Nfo-unsplash.jpg');

-- ----------------------------
-- Table structure for jenis_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `jenis_transaksi`;
CREATE TABLE `jenis_transaksi`  (
  `id_jenis_transaksi` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for keranjang_temporary
-- ----------------------------
DROP TABLE IF EXISTS `keranjang_temporary`;
CREATE TABLE `keranjang_temporary`  (
  `id_temporary` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_barang` int NOT NULL,
  `id_user` int NOT NULL,
  `qty` decimal(8, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_temporary`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keranjang_temporary
-- ----------------------------

-- ----------------------------
-- Table structure for komentar_produk
-- ----------------------------
DROP TABLE IF EXISTS `komentar_produk`;
CREATE TABLE `komentar_produk`  (
  `id_komentar` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_barang` int NOT NULL,
  `id_user` int NOT NULL,
  `komentar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_komentar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of komentar_produk
-- ----------------------------
INSERT INTO `komentar_produk` VALUES (15, 8, 1, '<p>Komentar barang</p>', '2022-05-26 09:56:01', '2022-05-26 09:56:01', NULL);
INSERT INTO `komentar_produk` VALUES (16, 8, 1, '<p>tes</p>', '2022-05-26 09:56:05', '2022-05-26 09:56:05', NULL);
INSERT INTO `komentar_produk` VALUES (17, 10, 1, '<p>Testing Komentar Barang</p>', '2022-05-26 12:49:32', '2022-05-26 12:49:32', NULL);
INSERT INTO `komentar_produk` VALUES (18, 10, 2, '<p>Test momentarily User lain</p>', '2022-05-26 12:58:59', '2022-05-26 12:58:59', NULL);
INSERT INTO `komentar_produk` VALUES (20, 6, 1, '<p>produk komentar</p>', '2022-05-26 15:45:39', '2022-05-26 15:45:39', NULL);
INSERT INTO `komentar_produk` VALUES (21, 316, 1, '<p>produknya bagus</p>', '2022-05-26 17:44:20', '2022-05-26 17:44:20', NULL);
INSERT INTO `komentar_produk` VALUES (22, 316, 1, '<p>produknya keren</p>', '2022-05-26 17:44:27', '2022-05-26 17:44:27', NULL);
INSERT INTO `komentar_produk` VALUES (25, 5, 1, '<p>tes produk</p>', '2022-05-28 00:07:30', '2022-05-28 00:07:30', NULL);
INSERT INTO `komentar_produk` VALUES (26, 6, 3, '<p>test</p>', '2022-12-08 13:24:09', '2022-12-08 13:24:09', '0');
INSERT INTO `komentar_produk` VALUES (27, 6, 3, '<p><br></p>', '2022-12-08 13:25:29', '2022-12-08 13:25:29', '5');

-- ----------------------------
-- Table structure for master_barang
-- ----------------------------
DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE `master_barang`  (
  `id_barang` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_supplier` int NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` decimal(8, 2) NOT NULL,
  `satuan_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_kategori` int NOT NULL,
  `file_sampul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1590 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_barang
-- ----------------------------
INSERT INTO `master_barang` VALUES (3, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (4, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (5, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (6, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (7, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (8, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (9, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (10, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (11, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (12, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (13, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (14, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (15, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (16, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (17, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (18, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (19, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (20, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (27, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (28, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (29, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (30, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (31, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (32, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (33, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (34, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (35, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (36, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (37, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (38, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (39, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (40, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (41, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (42, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (43, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (44, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1474, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1475, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1476, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1477, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1478, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1479, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1480, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1481, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1482, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1483, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1484, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1485, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1486, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1487, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1488, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1489, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1490, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1491, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1492, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1493, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1494, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1495, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1496, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1497, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1498, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1499, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1500, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1501, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1502, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1503, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1504, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1505, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1506, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1507, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1508, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1509, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1510, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1511, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1512, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1513, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1514, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1515, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1516, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1517, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1518, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1519, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1520, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1521, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1522, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1523, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1524, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1525, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1526, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1527, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1528, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1529, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1530, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1531, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1532, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1533, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1534, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1535, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1536, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1537, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1538, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1539, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1540, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1541, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1542, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1543, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1544, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1545, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1546, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1547, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1548, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1549, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1550, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1551, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1552, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1553, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1554, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1555, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1556, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1557, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1558, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1559, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1560, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1561, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1562, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1563, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1564, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1565, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1566, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1567, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1568, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1569, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1570, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1571, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1572, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1573, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1574, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1575, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1576, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_9.jpeg');
INSERT INTO `master_barang` VALUES (1577, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_10.jpeg');
INSERT INTO `master_barang` VALUES (1578, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_12.jpeg');
INSERT INTO `master_barang` VALUES (1579, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_13.jpeg');
INSERT INTO `master_barang` VALUES (1580, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_14.jpeg');
INSERT INTO `master_barang` VALUES (1581, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_1.jpeg');
INSERT INTO `master_barang` VALUES (1582, 6, 'Barang-0001', 'Kerang Nusantara', 12000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_2.jpeg');
INSERT INTO `master_barang` VALUES (1583, 6, 'Barang-0002', 'Udang Sumatra', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_3.jpeg');
INSERT INTO `master_barang` VALUES (1584, 6, 'Barang-0003', 'Tunas', 20000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 4, 'File_4.jpeg');
INSERT INTO `master_barang` VALUES (1585, 7, 'Barang-0001', 'Bandeng', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 6, 'File_5.jpeg');
INSERT INTO `master_barang` VALUES (1586, 7, 'Barang-0002', 'Tunas', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_6.jpeg');
INSERT INTO `master_barang` VALUES (1587, 7, 'Barang-0003', 'Ikan Tongkol', 15000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 5, 'File_7.jpeg');
INSERT INTO `master_barang` VALUES (1588, 7, 'Barang-0004', 'Kepiting Crab', 14000.00, 'Satuan', 'test', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_8.jpeg');
INSERT INTO `master_barang` VALUES (1589, 5, 'Barang-0002', 'Bandeng', 20000.00, 'Satuan', 'testing', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 3, 'File_9.jpeg');

-- ----------------------------
-- Table structure for master_contact_us
-- ----------------------------
DROP TABLE IF EXISTS `master_contact_us`;
CREATE TABLE `master_contact_us`  (
  `id_contact_us` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_center` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telp_center` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat_center` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_contact_us`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of master_contact_us
-- ----------------------------
INSERT INTO `master_contact_us` VALUES (1, 'Test', 'sfsdf', 'foto-1670503872_Test', '2022-12-08 12:51:12', '2022-12-08 12:51:12', 'serbaserbi@gmail.com', '43534534', 'Ujungangkah', '1234566', 'Munip', 'Mandiri');

-- ----------------------------
-- Table structure for master_kategori_seafood
-- ----------------------------
DROP TABLE IF EXISTS `master_kategori_seafood`;
CREATE TABLE `master_kategori_seafood`  (
  `id_kategori_seafood` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_seafood`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_kategori_seafood
-- ----------------------------
INSERT INTO `master_kategori_seafood` VALUES (1, 'Sarden', '1653408517_picture-1548209177.jpeg', '2022-05-24 00:00:00', '2022-05-24 00:00:00');
INSERT INTO `master_kategori_seafood` VALUES (2, 'Rumput Laut', '1653409421_food-g3a60baa25_1280-1024x710.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00');
INSERT INTO `master_kategori_seafood` VALUES (3, 'Kepiting', '1653409441_uk-ged79a3854_1920-1024x576.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00');
INSERT INTO `master_kategori_seafood` VALUES (4, 'Cumi-Cumi', '1653409460_pexels-naim-benjelloun-1618925-1024x683.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00');
INSERT INTO `master_kategori_seafood` VALUES (5, 'Kerang', '1653409482_pexels-rachel-claire-5491014-1024x683.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00');
INSERT INTO `master_kategori_seafood` VALUES (6, 'Ikan Salmon', '1653409505_salmon-g61e90d457_1920-1024x681.webp', '2022-05-24 00:00:00', '2022-05-24 00:00:00');
INSERT INTO `master_kategori_seafood` VALUES (7, 'Kerang Darah', '1653410117_seafood-segar-yang-ramah-lingkungan-4.jpeg', '2022-05-24 00:00:00', '2022-05-24 00:00:00');

-- ----------------------------
-- Table structure for master_status_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `master_status_pembelian`;
CREATE TABLE `master_status_pembelian`  (
  `id_status_pembelian` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status_pembelian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_status_pembelian
-- ----------------------------
INSERT INTO `master_status_pembelian` VALUES (1, 'Menunggu Pembayaran', NULL, NULL);
INSERT INTO `master_status_pembelian` VALUES (2, 'Pembayaran Berhasil', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_05_23_200823_create_admins_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_05_23_130329_add_table_master_barang', 2);
INSERT INTO `migrations` VALUES (7, '2022_05_23_131236_add_table_transaksi_barang', 2);
INSERT INTO `migrations` VALUES (8, '2022_05_23_131337_add_table_detail_transaksi_barang', 2);
INSERT INTO `migrations` VALUES (9, '2022_05_23_135210_add_table_detail_barang', 2);
INSERT INTO `migrations` VALUES (10, '2022_05_23_194123_create_suppliers_table', 2);
INSERT INTO `migrations` VALUES (11, '2022_05_24_155158_add_table_master_kategori', 3);
INSERT INTO `migrations` VALUES (12, '2022_05_24_165125_add_id_kategori_to_master_barang_table', 4);
INSERT INTO `migrations` VALUES (14, '2022_05_24_175057_add_table_keranjang_temporary', 5);
INSERT INTO `migrations` VALUES (15, '2022_05_26_090102_add_table_komentar_produk', 6);
INSERT INTO `migrations` VALUES (16, '2022_05_26_124553_add_file_sampul_to_master_barang_table', 7);
INSERT INTO `migrations` VALUES (17, '2022_05_27_233624_add_harga_to_detail_transaksi_table', 8);
INSERT INTO `migrations` VALUES (18, '2022_05_27_235502_add_id_status_to_transaksi_table', 9);
INSERT INTO `migrations` VALUES (19, '2022_05_28_012633_add_table_master_status_pembelian', 10);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id_supplier` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_supplier`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (3, '', '', '', '', 'adm@gmail.com', '$2y$10$yAwkPDO7Usxa2MbLm7/xieiz7pRBw9VbJVOBGIqH5YOxGnLf2y1Jq', NULL, '2022-05-23 23:16:39', '2022-05-23 23:16:39');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id_transaksi` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user_pembeli` int NOT NULL,
  `id_supplier` int NOT NULL,
  `id_jenis_transaksi` int NOT NULL,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_status` int NOT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (1, 0, 5, 2, 'TAMBAH_QTY_656', '2022-05-23', '2022-05-23 00:00:00', '2022-05-23 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (2, 0, 5, 2, 'TAMBAH_QTY_56', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (3, 0, 5, 2, 'TAMBAH_QTY_858', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (4, 0, 5, 2, 'TAMBAH_QTY_428', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (5, 0, 7, 2, 'TAMBAH_QTY_592', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (6, 0, 7, 2, 'TAMBAH_QTY_788', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (7, 0, 7, 2, 'TAMBAH_QTY_652', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (8, 0, 7, 2, 'TAMBAH_QTY_740', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (9, 0, 7, 2, 'TAMBAH_QTY_246', '2022-05-24', '2022-05-24 00:00:00', '2022-05-24 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (10, 0, 6, 2, 'TAMBAH_QTY_250', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (11, 0, 6, 2, 'TAMBAH_QTY_63', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (12, 0, 6, 2, 'TAMBAH_QTY_187', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (13, 0, 7, 2, 'TAMBAH_QTY_773', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (14, 0, 7, 2, 'TAMBAH_QTY_940', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (15, 0, 7, 2, 'TAMBAH_QTY_782', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (16, 0, 7, 2, 'TAMBAH_QTY_458', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (17, 0, 7, 2, 'TAMBAH_QTY_793', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (18, 0, 7, 2, 'TAMBAH_QTY_68', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (19, 0, 7, 2, 'TAMBAH_QTY_445', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (20, 0, 7, 2, 'TAMBAH_QTY_162', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (21, 0, 7, 2, 'TAMBAH_QTY_695', '2022-05-26', '2022-05-26 00:00:00', '2022-05-26 00:00:00', NULL, 0);
INSERT INTO `transaksi` VALUES (33, 1, 0, 1, 'PEMBELIAN-20220528', '2022-05-28', '2022-05-28 00:04:24', '2022-05-28 00:04:24', NULL, 1);
INSERT INTO `transaksi` VALUES (34, 1, 0, 1, 'PEMBELIAN-20220528', '2022-05-28', '2022-05-28 01:33:27', '2022-05-28 01:33:27', NULL, 1);
INSERT INTO `transaksi` VALUES (35, 1, 0, 1, 'PEMBELIAN-20220528(79)', '2022-05-28', '2022-05-28 01:34:56', '2022-05-28 01:34:56', NULL, 1);
INSERT INTO `transaksi` VALUES (37, 3, 0, 1, 'PEMBELIAN-20221208(11)', '2022-12-08', '2022-12-08 12:53:10', '2022-12-08 12:53:10', NULL, 2);
INSERT INTO `transaksi` VALUES (38, 3, 0, 1, 'PEMBELIAN-20221208(17)', '2022-12-08', '2022-12-08 13:19:14', '2022-12-08 13:19:14', NULL, 2);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'user', 'yokihidayaturr13@gmail.com', NULL, '$2y$10$txKMSEgTFn.tFuDQL2sO7eROfF/RdcRlOJKe9gcaYobJbLEdcnzSC', NULL, '2022-05-24 17:45:36', '2022-05-24 17:45:36');
INSERT INTO `users` VALUES (2, 'yoki', 'yokihr@gmail.com', NULL, '$2y$10$VdhQZ2sZflBRnMo.RrBbY.mxYL1cctwoJH5VV3nijJn25zr3Uhcc2', NULL, '2022-05-26 12:58:12', '2022-05-26 12:58:12');
INSERT INTO `users` VALUES (3, 'index.php', 'peserta1@sangahli.com', NULL, '$2y$10$pTyXcPW3zJ7fRN8jfUacDuscfS2u9rKK7PfNsziIvJi7hMwxWUyna', NULL, '2022-12-08 12:52:24', '2022-12-08 12:52:24');

SET FOREIGN_KEY_CHECKS = 1;
