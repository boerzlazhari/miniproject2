/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.1.0.0:3306
Source Database       : miniproject2

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-05-28 10:32:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dosen
-- ----------------------------

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `program_studi` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jurusan
-- ----------------------------

-- ----------------------------
-- Table structure for kategori_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `kategori_penilaian`;
CREATE TABLE `kategori_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kategori_penilaian
-- ----------------------------

-- ----------------------------
-- Table structure for kp_bimbingan
-- ----------------------------
DROP TABLE IF EXISTS `kp_bimbingan`;
CREATE TABLE `kp_bimbingan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kp_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `notes` text,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kp_bimbingan
-- ----------------------------

-- ----------------------------
-- Table structure for kp_pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `kp_pengajuan`;
CREATE TABLE `kp_pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `nama_tempat` varchar(255) DEFAULT NULL,
  `alamat_tempat` text,
  `tanggal_wawancara` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `unapproved_reason` text,
  `dosen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kp_pengajuan
-- ----------------------------

-- ----------------------------
-- Table structure for kp_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `kp_penilaian`;
CREATE TABLE `kp_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kp_id` int(11) DEFAULT NULL,
  `sub_kategori_penilaian_id` int(11) DEFAULT NULL,
  `nilai` varchar(10) DEFAULT NULL,
  `nilai_huruf` varchar(50) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kp_penilaian
-- ----------------------------

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `nim` varchar(7) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenkel` varchar(20) DEFAULT NULL,
  `status_kp` tinyint(1) DEFAULT NULL,
  `status_skripsi` tinyint(1) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------

-- ----------------------------
-- Table structure for pra_sk_pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `pra_sk_pengajuan`;
CREATE TABLE `pra_sk_pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sk_pengajuan_id` int(11) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `notes` text,
  `status` tinyint(4) DEFAULT NULL,
  `unapproved_reason` text,
  `dosen_id_unapproved` int(11) DEFAULT NULL,
  `tanggal_sidang` datetime DEFAULT NULL,
  `tanggal_approved` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pra_sk_pengajuan
-- ----------------------------

-- ----------------------------
-- Table structure for prodi
-- ----------------------------
DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of prodi
-- ----------------------------

-- ----------------------------
-- Table structure for skp_ba
-- ----------------------------
DROP TABLE IF EXISTS `skp_ba`;
CREATE TABLE `skp_ba` (
  `id` int(11) NOT NULL,
  `day` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status_d1` varchar(255) DEFAULT NULL,
  `status_d2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skp_ba
-- ----------------------------

-- ----------------------------
-- Table structure for skp_pendaftaran
-- ----------------------------
DROP TABLE IF EXISTS `skp_pendaftaran`;
CREATE TABLE `skp_pendaftaran` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `another_notes` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skp_pendaftaran
-- ----------------------------

-- ----------------------------
-- Table structure for skp_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `skp_penilaian`;
CREATE TABLE `skp_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skp_penilaian
-- ----------------------------

-- ----------------------------
-- Table structure for skp_penilaian_detail
-- ----------------------------
DROP TABLE IF EXISTS `skp_penilaian_detail`;
CREATE TABLE `skp_penilaian_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kp_penilaian_id` int(11) DEFAULT NULL,
  `kp_mahasiswa_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `nilai` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skp_penilaian_detail
-- ----------------------------

-- ----------------------------
-- Table structure for sk_bimbingan
-- ----------------------------
DROP TABLE IF EXISTS `sk_bimbingan`;
CREATE TABLE `sk_bimbingan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sk_pengajuan_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `notes` text,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sk_bimbingan
-- ----------------------------

-- ----------------------------
-- Table structure for sk_pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `sk_pengajuan`;
CREATE TABLE `sk_pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `transkrip_nilai` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `tanggal_approved` datetime DEFAULT NULL,
  `tanggal_wawancara` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sk_pengajuan
-- ----------------------------

-- ----------------------------
-- Table structure for sub_kategori_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `sub_kategori_penilaian`;
CREATE TABLE `sub_kategori_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sub_kategori_penilaian
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Desta', 'desta', 'e10adc3949ba59abbe56e057f20f883e', '1');
