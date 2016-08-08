-- MySQL dump 10.13  Distrib 5.5.46, for Linux (x86_64)
--
-- Host: localhost    Database: adaypake_db
-- ------------------------------------------------------
-- Server version	5.5.46-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Devir_Kodu`
--

DROP TABLE IF EXISTS `Devir_Kodu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Devir_Kodu` (
  `devir_kodu` int(11) NOT NULL AUTO_INCREMENT,
  `Aciklama` text NOT NULL,
  PRIMARY KEY (`devir_kodu`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Devir_Kodu`
--

LOCK TABLES `Devir_Kodu` WRITE;
/*!40000 ALTER TABLE `Devir_Kodu` DISABLE KEYS */;
INSERT INTO `Devir_Kodu` (`devir_kodu`, `Aciklama`) VALUES (5,'MÜŞTERİ KABUL ETMİYOR'),(10,'ADRES YANLIŞ /YETERSİZ'),(11,'1.UĞRAMA NOTU BIRAKILDI'),(12,'MOBİL ALAN KARGOSU'),(14,'İŞYERİ BUGÜN KAPALI'),(15,'ALICI HABERLİ KARGO'),(16,'TELEFON İHBARLI KARGO'),(17,'AT DIŞI ALAN KARGOSU'),(18,'AT YETİŞMEDİ'),(20,'ALICI TANINMIYOR'),(21,'YETKİLİ YOK/YETKİ BELGESİ '),(22,'HASARLI KARGO'),(23,'MÜŞTERİ KENDİ ALACAK'),(24,'KARGOSU GELMEDİ'),(25,'SMS İHBARLI'),(26,'KARGO GÜMRÜKTE'),(27,'ALICI ADRESTEN TAŞINMIŞ'),(28,'ALICI TATİLDE/SEYAHATTE'),(29,'KÖTÜ HAVA ŞARTLARI'),(30,'RESMİ TATİL'),(31,'DOĞAL AFET/KARGAŞA NEDENİYLE TESLİM EDİLEMEDİ'),(32,'PRATİK 7/24'),(33,'ÜCRETİNDEN DOLAYI'),(34,'SİPARİŞ DIŞI ÜRÜN'),(35,'ALICI KİMLİK VERMEYİ VE İMZAYI REDDETTİ'),(36,'MÜŞTERİ KARGO TESLİM ALMA SAATİ SINIRLI'),(37,'TERCİHLİ TESLİMAT'),(38,'ÜRÜN BEDELİ TAHSİL EDİLEMEDİ'),(39,'MÜŞTERİ FATURASI İRSALİYESİ EKSİK'),(40,'PARÇALI TESLİMAT'),(41,'İADE GELDİ'),(42,'2.UĞRAMA NOTU BIRAKILDI');
/*!40000 ALTER TABLE `Devir_Kodu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Kargolar`
--

DROP TABLE IF EXISTS `Kargolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Kargolar` (
  `kargo_id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis_id` int(11) NOT NULL,
  `ad_soyad` varchar(225) NOT NULL,
  `TelefonNo` varchar(225) NOT NULL,
  `satis_yapan` varchar(225) NOT NULL,
  `satis_yapan_id` int(11) NOT NULL,
  `urun_adi` varchar(225) NOT NULL,
  `urunun_id` int(11) NOT NULL,
  `fiyat` decimal(10,2) NOT NULL,
  `siparis_durumu` int(11) NOT NULL,
  `kargo_durumu` int(11) NOT NULL,
  `satis_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `son_islem_tarihi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `add_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `renk_code` varchar(225) NOT NULL,
  `SUBE_ADI` varchar(225) NOT NULL,
  `son_not` text NOT NULL,
  `DEVIR_KODU` int(11) NOT NULL,
  `DEVIR_NEDENI` text NOT NULL,
  `KARGO_KODU` varchar(225) NOT NULL,
  PRIMARY KEY (`kargo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Kargolar`
--

LOCK TABLES `Kargolar` WRITE;
/*!40000 ALTER TABLE `Kargolar` DISABLE KEYS */;
/*!40000 ALTER TABLE `Kargolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(225) NOT NULL,
  `name_surname` varchar(225) NOT NULL,
  `telefon` varchar(225) NOT NULL,
  `adres` text NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_type` int(11) NOT NULL,
  `login_case` int(1) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sip_type` int(1) NOT NULL,
  `agent` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `yetki` varchar(225) NOT NULL,
  `extra_yetki` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`admin_id`, `mail`, `name_surname`, `telefon`, `adres`, `password`, `user_type`, `login_case`, `login_date`, `sip_type`, `agent`, `photo`, `yetki`, `extra_yetki`) VALUES (109,'admin@kuzeydagitim.com','Kuzeydağıtım Admin','(555) 555-5555','','21232f297a57a5a743894a0e4a801fc3',1,0,'2015-08-22 14:49:48',1,0,NULL,'',''),(117,'ahmet@ahmet.com','ahmet mehmet','(531) 212-3212','','d41d8cd98f00b204e9800998ecf8427e',0,0,'2015-11-30 10:29:58',1,11,NULL,'','');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `affiliate`
--

DROP TABLE IF EXISTS `affiliate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `affiliate` (
  `affiliate_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_surname` varchar(225) NOT NULL,
  `mail` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `affiliate_name` varchar(225) NOT NULL,
  `affiliate_key` varchar(225) NOT NULL,
  `affile_type` int(1) NOT NULL,
  `login_case` int(1) NOT NULL,
  `total_money` decimal(10,2) NOT NULL,
  `ex_money` decimal(10,2) NOT NULL,
  PRIMARY KEY (`affiliate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affiliate`
--

LOCK TABLES `affiliate` WRITE;
/*!40000 ALTER TABLE `affiliate` DISABLE KEYS */;
INSERT INTO `affiliate` (`affiliate_id`, `name_surname`, `mail`, `password`, `affiliate_name`, `affiliate_key`, `affile_type`, `login_case`, `total_money`, `ex_money`) VALUES (101,'ctrgo','ctr@gointeraktif.com','771261c9d6328782e61b58d69379fb4c','ctrgo','249761853',1,0,0.00,0.00),(102,'ctrgo','ctrs@gointeraktif.com','771261c9d6328782e61b58d69379fb4c','ctrgo','254696838s',1,0,0.00,0.00),(103,'Samet Ata','samet@gointeraktif.com','7279629704968263322c2f7f5e4c3aff','Samet Ata','24569696',2,0,0.00,0.00),(104,'idris DAVARCI','admin@admin.com','74881eaf4ce0237bfddecc88cb6d722e','Samet Ata','24569696',2,0,0.00,0.00);
/*!40000 ALTER TABLE `affiliate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alt_siparis_durumlari`
--

DROP TABLE IF EXISTS `alt_siparis_durumlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alt_siparis_durumlari` (
  `alt_durum_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `ingname` varchar(225) NOT NULL,
  `alt_durum` int(11) NOT NULL,
  PRIMARY KEY (`alt_durum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alt_siparis_durumlari`
--

LOCK TABLES `alt_siparis_durumlari` WRITE;
/*!40000 ALTER TABLE `alt_siparis_durumlari` DISABLE KEYS */;
INSERT INTO `alt_siparis_durumlari` (`alt_durum_id`, `name`, `ingname`, `alt_durum`) VALUES (1,'Geçersiz Bilgi','Invalid Info',4),(2,'Yanlış Numara','Wrong Number',4),(3,'Sahte Sipariş','Fake Order',4),(4,'Çoklu Kayıt','Duplicate Order',4),(5,'İstemiyor','İstemiyor',5),(6,'Yurtdışı','Out of Turkey',5),(7,'Bilgi Aldı','Asked info / not buy',5),(8,'Vazgeçti','Canceled after return',5);
/*!40000 ALTER TABLE `alt_siparis_durumlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `errors_list`
--

DROP TABLE IF EXISTS `errors_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errors_list` (
  `errors_id` int(11) NOT NULL AUTO_INCREMENT,
  `errors_name` varchar(225) NOT NULL,
  `errors_type` int(1) NOT NULL,
  `errors_group` int(11) NOT NULL,
  `renkcode` varchar(225) NOT NULL,
  PRIMARY KEY (`errors_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `errors_list`
--

LOCK TABLES `errors_list` WRITE;
/*!40000 ALTER TABLE `errors_list` DISABLE KEYS */;
INSERT INTO `errors_list` (`errors_id`, `errors_name`, `errors_type`, `errors_group`, `renkcode`) VALUES (1,'2.Dağıtım Yapılmamış',1,11,''),(2,'Kargo İndirim Hatası',1,11,''),(3,'Bilgi Mesajı Gitmemiş',1,11,''),(4,'Yanlış Ürün Gitmiş',1,13,''),(5,'Hediye Eklenmemiş',1,13,''),(6,'Eksik Ürün Gitmiş',1,13,''),(7,'Hologram Eklenmemiş',1,13,''),(8,'Eş Problemi',1,14,''),(9,'Ödeme problemi',1,14,''),(10,'Kötü Yorum',1,14,''),(11,'Kargo',0,0,'primary'),(12,'Agent',0,0,'success'),(13,'Depo',0,0,'info'),(14,'Müşteri',0,0,'warning'),(15,'Müşteriye ulaşılamıyor',1,14,''),(16,'Müşteri Vazgeçti',1,14,''),(17,'Yanlış Bilgi',1,12,''),(18,'Sahte Satış',1,12,''),(19,'Tarih Hatası',1,12,''),(20,'Yanlış Ürün Seçimi',1,12,''),(21,'Yanlış Hediye Seçimi',1,12,''),(22,'İndirim Yapılmamış',1,12,''),(23,'Sağlık',1,14,'');
/*!40000 ALTER TABLE `errors_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `il`
--

DROP TABLE IF EXISTS `il`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `il` (
  `il_id` int(11) NOT NULL AUTO_INCREMENT,
  `il_adi` varchar(225) NOT NULL,
  `sira` int(11) NOT NULL,
  PRIMARY KEY (`il_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `il`
--

LOCK TABLES `il` WRITE;
/*!40000 ALTER TABLE `il` DISABLE KEYS */;
INSERT INTO `il` (`il_id`, `il_adi`, `sira`) VALUES (1,'ADANA                         ',0),(2,'ADIYAMAN                      ',0),(3,'AFYONKARAHİSAR                ',0),(4,'AĞRI                          ',0),(5,'AKSARAY                       ',0),(6,'AMASYA                        ',0),(7,'ANKARA                        ',0),(8,'ANTALYA                       ',0),(9,'ARDAHAN                       ',0),(10,'ARTVİN                        ',0),(11,'AYDIN                         ',0),(12,'BALIKESİR                     ',0),(13,'BARTIN                        ',0),(14,'BATMAN                        ',0),(15,'BAYBURT                       ',0),(16,'BİLECİK                       ',0),(17,'BİNGÖL                        ',0),(18,'BİTLİS                        ',0),(19,'BOLU                          ',0),(20,'BURDUR                        ',0),(21,'BURSA                         ',0),(22,'ÇANAKKALE                     ',0),(23,'ÇANKIRI                       ',0),(24,'ÇORUM                         ',0),(25,'DENİZLİ                       ',0),(26,'DİYARBAKIR                    ',0),(27,'DÜZCE                         ',0),(28,'EDİRNE                        ',0),(29,'ELAZIĞ                        ',0),(30,'ERZİNCAN                      ',0),(31,'ERZURUM                       ',0),(32,'ESKİŞEHİR                     ',0),(33,'GAZİANTEP                     ',0),(34,'GİRESUN                       ',0),(35,'GÜMÜŞHANE                     ',0),(36,'HAKKARİ                       ',0),(37,'HATAY                         ',0),(38,'IĞDIR                         ',0),(39,'ISPARTA                       ',0),(40,'İSTANBUL                      ',0),(41,'İZMİR                         ',0),(42,'KAHRAMANMARAŞ                 ',0),(43,'KARABÜK                       ',0),(44,'KARAMAN                       ',0),(45,'KARS                          ',0),(46,'KASTAMONU                     ',0),(47,'KAYSERİ                       ',0),(48,'KIRIKKALE                     ',0),(49,'KIRKLARELİ                    ',0),(50,'KIRŞEHİR                      ',0),(51,'KİLİS                         ',0),(52,'KOCAELİ                       ',0),(53,'KONYA                         ',0),(54,'KÜTAHYA                       ',0),(55,'MALATYA                       ',0),(56,'MANİSA                        ',0),(57,'MARDİN                        ',0),(58,'MERSİN                        ',0),(59,'MUĞLA                         ',0),(60,'MUŞ                           ',0),(61,'NEVŞEHİR                      ',0),(62,'NİĞDE                         ',0),(63,'ORDU                          ',0),(64,'OSMANİYE                      ',0),(65,'RİZE                          ',0),(66,'SAKARYA                       ',0),(67,'SAMSUN                        ',0),(68,'SİİRT                         ',0),(69,'SİNOP                         ',0),(70,'SİVAS                         ',0),(71,'ŞANLIURFA                     ',0),(72,'ŞIRNAK                        ',0),(73,'TEKİRDAĞ                      ',0),(74,'TOKAT                         ',0),(75,'TRABZON                       ',0),(76,'TUNCELİ                       ',0),(77,'UŞAK                          ',0),(78,'VAN                           ',0),(79,'YALOVA                        ',0),(80,'YOZGAT                        ',0),(81,'ZONGULDAK                     ',0);
/*!40000 ALTER TABLE `il` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ilce`
--

DROP TABLE IF EXISTS `ilce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ilce` (
  `ilce_id` int(11) NOT NULL AUTO_INCREMENT,
  `il_id` int(11) NOT NULL,
  `ilce_adi` varchar(225) NOT NULL,
  PRIMARY KEY (`ilce_id`)
) ENGINE=InnoDB AUTO_INCREMENT=971 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ilce`
--

LOCK TABLES `ilce` WRITE;
/*!40000 ALTER TABLE `ilce` DISABLE KEYS */;
INSERT INTO `ilce` (`ilce_id`, `il_id`, `ilce_adi`) VALUES (1,1,'CEYHAN                        '),(2,1,'ÇUKUROVA                      '),(3,1,'FEKE                          '),(4,1,'İMAMOĞLU                      '),(5,1,'KARAİSALI                     '),(6,1,'KARATAŞ                       '),(7,1,'KOZAN                         '),(8,1,'POZANTI                       '),(9,1,'SAİMBEYLİ                     '),(10,1,'SARIÇAM                       '),(11,1,'SEYHAN                        '),(12,1,'TUFANBEYLİ                    '),(13,1,'YUMURTALIK                    '),(14,1,'YÜREĞİR                       '),(15,2,'BESNİ                         '),(16,2,'ÇELİKHAN                      '),(17,2,'GERGER                        '),(18,2,'GÖLBAŞI                       '),(19,2,'KAHTA                         '),(20,2,'MERKEZ                        '),(21,2,'SAMSAT                        '),(22,2,'SİNCİK                        '),(23,2,'TUT                           '),(24,3,'BAŞMAKÇI                      '),(25,3,'BAYAT                         '),(26,3,'BOLVADİN                      '),(27,3,'ÇAY                           '),(28,3,'ÇOBANLAR                      '),(29,3,'DAZKIRI                       '),(30,3,'DİNAR                         '),(31,3,'EMİRDAĞ                       '),(32,3,'EVCİLER                       '),(33,3,'HOCALAR                       '),(34,3,'İHSANİYE                      '),(35,3,'İSCEHİSAR                     '),(36,3,'KIZILÖREN                     '),(37,3,'MERKEZ                        '),(38,3,'SANDIKLI                      '),(39,3,'SİNANPAŞA                     '),(40,3,'SULTANDAĞI                    '),(41,3,'ŞUHUT                         '),(42,4,'DİYADİN                       '),(43,4,'DOĞUBAYAZIT                   '),(44,4,'ELEŞKİRT                      '),(45,4,'HAMUR                         '),(46,4,'MERKEZ                        '),(47,4,'PATNOS                        '),(48,4,'TAŞLIÇAY                      '),(49,4,'TUTAK                         '),(50,5,'AĞAÇÖREN                      '),(51,5,'ESKİL                         '),(52,5,'GÜLAĞAÇ                       '),(53,5,'GÜZELYURT                     '),(54,5,'MERKEZ                        '),(55,5,'ORTAKÖY                       '),(56,5,'SARIYAHŞİ                     '),(57,6,'GÖYNÜCEK                      '),(58,6,'GÜMÜŞHACIKÖY                  '),(59,6,'HAMAMÖZÜ                      '),(60,6,'MERKEZ                        '),(61,6,'MERZİFON                      '),(62,6,'SULUOVA                       '),(63,6,'TAŞOVA                        '),(64,7,'AKYURT                        '),(65,7,'ALTINDAĞ                      '),(66,7,'AYAŞ                          '),(67,7,'BALA                          '),(68,7,'BEYPAZARI                     '),(69,7,'ÇAMLIDERE                     '),(70,7,'ÇANKAYA                       '),(71,7,'ÇUBUK                         '),(72,7,'ELMADAĞ                       '),(73,7,'ETİMESGUT                     '),(74,7,'EVREN                         '),(75,7,'GÖLBAŞI                       '),(76,7,'GÜDÜL                         '),(77,7,'HAYMANA                       '),(78,7,'KALECİK                       '),(79,7,'KAZAN                         '),(80,7,'KEÇİÖREN                      '),(81,7,'KIZILCAHAMAM                  '),(82,7,'MAMAK                         '),(83,7,'NALLIHAN                      '),(84,7,'POLATLI                       '),(85,7,'PURSAKLAR                     '),(86,7,'SİNCAN                        '),(87,7,'ŞEREFLİKOÇHİSAR               '),(88,7,'YENİMAHALLE                   '),(89,8,'AKSEKİ                        '),(90,8,'AKSU                          '),(91,8,'ALANYA                        '),(92,8,'DEMRE                         '),(93,8,'DÖŞEMEALTI                    '),(94,8,'ELMALI                        '),(95,8,'FİNİKE                        '),(96,8,'GAZİPAŞA                      '),(97,8,'GÜNDOĞMUŞ                     '),(98,8,'İBRADI                        '),(99,8,'KAŞ                           '),(100,8,'KEMER                         '),(101,8,'KEPEZ                         '),(102,8,'KONYAALTI                     '),(103,8,'KORKUTELİ                     '),(104,8,'KUMLUCA                       '),(105,8,'MANAVGAT                      '),(106,8,'MURATPAŞA                     '),(107,8,'SERİK                         '),(108,9,'ÇILDIR                        '),(109,9,'DAMAL                         '),(110,9,'GÖLE                          '),(111,9,'HANAK                         '),(112,9,'MERKEZ                        '),(113,9,'POSOF                         '),(114,10,'ARDANUÇ                       '),(115,10,'ARHAVİ                        '),(116,10,'BORÇKA                        '),(117,10,'HOPA                          '),(118,10,'MERKEZ                        '),(119,10,'MURGUL                        '),(120,10,'ŞAVŞAT                        '),(121,10,'YUSUFELİ                      '),(122,11,'BOZDOĞAN                      '),(123,11,'BUHARKENT                     '),(124,11,'ÇİNE                          '),(125,11,'DİDİM                         '),(126,11,'EFELER                        '),(127,11,'GERMENCİK                     '),(128,11,'İNCİRLİOVA                    '),(129,11,'KARACASU                      '),(130,11,'KARPUZLU                      '),(131,11,'KOÇARLI                       '),(132,11,'KÖŞK                          '),(133,11,'KUŞADASI                      '),(134,11,'KUYUCAK                       '),(135,11,'NAZİLLİ                       '),(136,11,'SÖKE                          '),(137,11,'SULTANHİSAR                   '),(138,11,'YENİPAZAR                     '),(139,12,'ALTIEYLÜL                     '),(140,12,'AYVALIK                       '),(141,12,'BALYA                         '),(142,12,'BANDIRMA                      '),(143,12,'BİGADİÇ                       '),(144,12,'BURHANİYE                     '),(145,12,'DURSUNBEY                     '),(146,12,'EDREMİT                       '),(147,12,'ERDEK                         '),(148,12,'GÖMEÇ                         '),(149,12,'GÖNEN                         '),(150,12,'HAVRAN                        '),(151,12,'İVRİNDİ                       '),(152,12,'KARESİ                        '),(153,12,'KEPSUT                        '),(154,12,'MANYAS                        '),(155,12,'MARMARA                       '),(156,12,'SAVAŞTEPE                     '),(157,12,'SINDIRGI                      '),(158,12,'SUSURLUK                      '),(159,13,'AMASRA                        '),(160,13,'KURUCAŞİLE                    '),(161,13,'MERKEZ                        '),(162,13,'ULUS                          '),(163,14,'BEŞİRİ                        '),(164,14,'GERCÜŞ                        '),(165,14,'HASANKEYF                     '),(166,14,'KOZLUK                        '),(167,14,'MERKEZ                        '),(168,14,'SASON                         '),(169,15,'AYDINTEPE                     '),(170,15,'DEMİRÖZÜ                      '),(171,15,'MERKEZ                        '),(172,16,'BOZÜYÜK                       '),(173,16,'GÖLPAZARI                     '),(174,16,'İNHİSAR                       '),(175,16,'MERKEZ                        '),(176,16,'OSMANELİ                      '),(177,16,'PAZARYERİ                     '),(178,16,'SÖĞÜT                         '),(179,16,'YENİPAZAR                     '),(180,17,'ADAKLI                        '),(181,17,'GENÇ                          '),(182,17,'KARLIOVA                      '),(183,17,'KİĞI                          '),(184,17,'MERKEZ                        '),(185,17,'SOLHAN                        '),(186,17,'YAYLADERE                     '),(187,17,'YEDİSU                        '),(188,18,'ADİLCEVAZ                     '),(189,18,'AHLAT                         '),(190,18,'GÜROYMAK                      '),(191,18,'HİZAN                         '),(192,18,'MERKEZ                        '),(193,18,'MUTKİ                         '),(194,18,'TATVAN                        '),(195,19,'DÖRTDİVAN                     '),(196,19,'GEREDE                        '),(197,19,'GÖYNÜK                        '),(198,19,'KIBRISCIK                     '),(199,19,'MENGEN                        '),(200,19,'MERKEZ                        '),(201,19,'MUDURNU                       '),(202,19,'SEBEN                         '),(203,19,'YENİÇAĞA                      '),(204,20,'AĞLASUN                       '),(205,20,'ALTINYAYLA                    '),(206,20,'BUCAK                         '),(207,20,'ÇAVDIR                        '),(208,20,'ÇELTİKÇİ                      '),(209,20,'GÖLHİSAR                      '),(210,20,'KARAMANLI                     '),(211,20,'KEMER                         '),(212,20,'MERKEZ                        '),(213,20,'TEFENNİ                       '),(214,20,'YEŞİLOVA                      '),(215,21,'BÜYÜKORHAN                    '),(216,21,'GEMLİK                        '),(217,21,'GÜRSU                         '),(218,21,'HARMANCIK                     '),(219,21,'İNEGÖL                        '),(220,21,'İZNİK                         '),(221,21,'KARACABEY                     '),(222,21,'KELES                         '),(223,21,'KESTEL                        '),(224,21,'MUDANYA                       '),(225,21,'MUSTAFAKEMALPAŞA              '),(226,21,'NİLÜFER                       '),(227,21,'ORHANELİ                      '),(228,21,'ORHANGAZİ                     '),(229,21,'OSMANGAZİ                     '),(230,21,'YENİŞEHİR                     '),(231,21,'YILDIRIM                      '),(232,22,'AYVACIK                       '),(233,22,'BAYRAMİÇ                      '),(234,22,'BİGA                          '),(235,22,'BOZCAADA                      '),(236,22,'ÇAN                           '),(237,22,'ECEABAT                       '),(238,22,'EZİNE                         '),(239,22,'GELİBOLU                      '),(240,22,'GÖKÇEADA                      '),(241,22,'LAPSEKİ                       '),(242,22,'MERKEZ                        '),(243,22,'YENİCE                        '),(244,23,'ATKARACALAR                   '),(245,23,'BAYRAMÖREN                    '),(246,23,'ÇERKEŞ                        '),(247,23,'ELDİVAN                       '),(248,23,'ILGAZ                         '),(249,23,'KIZILIRMAK                    '),(250,23,'KORGUN                        '),(251,23,'KURŞUNLU                      '),(252,23,'MERKEZ                        '),(253,23,'ORTA                          '),(254,23,'ŞABANÖZÜ                      '),(255,23,'YAPRAKLI                      '),(256,24,'ALACA                         '),(257,24,'BAYAT                         '),(258,24,'BOĞAZKALE                     '),(259,24,'DODURGA                       '),(260,24,'İSKİLİP                       '),(261,24,'KARGI                         '),(262,24,'LAÇİN                         '),(263,24,'MECİTÖZÜ                      '),(264,24,'MERKEZ                        '),(265,24,'OĞUZLAR                       '),(266,24,'ORTAKÖY                       '),(267,24,'OSMANCIK                      '),(268,24,'SUNGURLU                      '),(269,24,'UĞURLUDAĞ                     '),(270,25,'ACIPAYAM                      '),(271,25,'BABADAĞ                       '),(272,25,'BAKLAN                        '),(273,25,'BEKİLLİ                       '),(274,25,'BEYAĞAÇ                       '),(275,25,'BOZKURT                       '),(276,25,'BULDAN                        '),(277,25,'ÇAL                           '),(278,25,'ÇAMELİ                        '),(279,25,'ÇARDAK                        '),(280,25,'ÇİVRİL                        '),(281,25,'GÜNEY                         '),(282,25,'HONAZ                         '),(283,25,'KALE                          '),(284,25,'MERKEZEFENDİ                  '),(285,25,'PAMUKKALE                     '),(286,25,'SARAYKÖY                      '),(287,25,'SERİNHİSAR                    '),(288,25,'TAVAS                         '),(289,26,'BAĞLAR                        '),(290,26,'BİSMİL                        '),(291,26,'ÇERMİK                        '),(292,26,'ÇINAR                         '),(293,26,'ÇÜNGÜŞ                        '),(294,26,'DİCLE                         '),(295,26,'EĞİL                          '),(296,26,'ERGANİ                        '),(297,26,'HANİ                          '),(298,26,'HAZRO                         '),(299,26,'KAYAPINAR                     '),(300,26,'KOCAKÖY                       '),(301,26,'KULP                          '),(302,26,'LİCE                          '),(303,26,'SİLVAN                        '),(304,26,'SUR                           '),(305,26,'YENİŞEHİR                     '),(306,27,'AKÇAKOCA                      '),(307,27,'CUMAYERİ                      '),(308,27,'ÇİLİMLİ                       '),(309,27,'GÖLYAKA                       '),(310,27,'GÜMÜŞOVA                      '),(311,27,'KAYNAŞLI                      '),(312,27,'MERKEZ                        '),(313,27,'YIĞILCA                       '),(314,28,'ENEZ                          '),(315,28,'HAVSA                         '),(316,28,'İPSALA                        '),(317,28,'KEŞAN                         '),(318,28,'LALAPAŞA                      '),(319,28,'MERİÇ                         '),(320,28,'MERKEZ                        '),(321,28,'SÜLOĞLU                       '),(322,28,'UZUNKÖPRÜ                     '),(323,29,'AĞIN                          '),(324,29,'ALACAKAYA                     '),(325,29,'ARICAK                        '),(326,29,'BASKİL                        '),(327,29,'KARAKOÇAN                     '),(328,29,'KEBAN                         '),(329,29,'KOVANCILAR                    '),(330,29,'MADEN                         '),(331,29,'MERKEZ                        '),(332,29,'PALU                          '),(333,29,'SİVRİCE                       '),(334,30,'ÇAYIRLI                       '),(335,30,'İLİÇ                          '),(336,30,'KEMAH                         '),(337,30,'KEMALİYE                      '),(338,30,'MERKEZ                        '),(339,30,'OTLUKBELİ                     '),(340,30,'REFAHİYE                      '),(341,30,'TERCAN                        '),(342,30,'ÜZÜMLÜ                        '),(343,31,'AŞKALE                        '),(344,31,'AZİZİYE                       '),(345,31,'ÇAT                           '),(346,31,'HINIS                         '),(347,31,'HORASAN                       '),(348,31,'İSPİR                         '),(349,31,'KARAÇOBAN                     '),(350,31,'KARAYAZI                      '),(351,31,'KÖPRÜKÖY                      '),(352,31,'NARMAN                        '),(353,31,'OLTU                          '),(354,31,'OLUR                          '),(355,31,'PALANDÖKEN                    '),(356,31,'PASİNLER                      '),(357,31,'PAZARYOLU                     '),(358,31,'ŞENKAYA                       '),(359,31,'TEKMAN                        '),(360,31,'TORTUM                        '),(361,31,'UZUNDERE                      '),(362,31,'YAKUTİYE                      '),(363,32,'ALPU                          '),(364,32,'BEYLİKOVA                     '),(365,32,'ÇİFTELER                      '),(366,32,'GÜNYÜZÜ                       '),(367,32,'HAN                           '),(368,32,'İNÖNÜ                         '),(369,32,'MAHMUDİYE                     '),(370,32,'MİHALGAZİ                     '),(371,32,'MİHALIÇÇIK                    '),(372,32,'ODUNPAZARI                    '),(373,32,'SARICAKAYA                    '),(374,32,'SEYİTGAZİ                     '),(375,32,'SİVRİHİSAR                    '),(376,32,'TEPEBAŞI                      '),(377,33,'ARABAN                        '),(378,33,'İSLAHİYE                      '),(379,33,'KARKAMIŞ                      '),(380,33,'NİZİP                         '),(381,33,'NURDAĞI                       '),(382,33,'OĞUZELİ                       '),(383,33,'ŞAHİNBEY                      '),(384,33,'ŞEHİTKAMİL                    '),(385,33,'YAVUZELİ                      '),(386,34,'ALUCRA                        '),(387,34,'BULANCAK                      '),(388,34,'ÇAMOLUK                       '),(389,34,'ÇANAKÇI                       '),(390,34,'DERELİ                        '),(391,34,'DOĞANKENT                     '),(392,34,'ESPİYE                        '),(393,34,'EYNESİL                       '),(394,34,'GÖRELE                        '),(395,34,'GÜCE                          '),(396,34,'KEŞAP                         '),(397,34,'MERKEZ                        '),(398,34,'PİRAZİZ                       '),(399,34,'ŞEBİNKARAHİSAR                '),(400,34,'TİREBOLU                      '),(401,34,'YAĞLIDERE                     '),(402,35,'KELKİT                        '),(403,35,'KÖSE                          '),(404,35,'KÜRTÜN                        '),(405,35,'MERKEZ                        '),(406,35,'ŞİRAN                         '),(407,35,'TORUL                         '),(408,36,'ÇUKURCA                       '),(409,36,'MERKEZ                        '),(410,36,'ŞEMDİNLİ                      '),(411,36,'YÜKSEKOVA                     '),(412,37,'ALTINÖZÜ                      '),(413,37,'ANTAKYA                       '),(414,37,'ARSUZ                         '),(415,37,'BELEN                         '),(416,37,'DEFNE                         '),(417,37,'DÖRTYOL                       '),(418,37,'ERZİN                         '),(419,37,'HASSA                         '),(420,37,'İSKENDERUN                    '),(421,37,'KIRIKHAN                      '),(422,37,'KUMLU                         '),(423,37,'PAYAS                         '),(424,37,'REYHANLI                      '),(425,37,'SAMANDAĞ                      '),(426,37,'YAYLADAĞI                     '),(427,38,'ARALIK                        '),(428,38,'KARAKOYUNLU                   '),(429,38,'MERKEZ                        '),(430,38,'TUZLUCA                       '),(431,39,'AKSU                          '),(432,39,'ATABEY                        '),(433,39,'EĞİRDİR                       '),(434,39,'GELENDOST                     '),(435,39,'GÖNEN                         '),(436,39,'KEÇİBORLU                     '),(437,39,'MERKEZ                        '),(438,39,'SENİRKENT                     '),(439,39,'SÜTÇÜLER                      '),(440,39,'ŞARKİKARAAĞAÇ                 '),(441,39,'ULUBORLU                      '),(442,39,'YALVAÇ                        '),(443,39,'YENİŞARBADEMLİ                '),(444,40,'ADALAR                        '),(445,40,'ARNAVUTKÖY                    '),(446,40,'ATAŞEHİR                      '),(447,40,'AVCILAR                       '),(448,40,'BAĞCILAR                      '),(449,40,'BAHÇELİEVLER                  '),(450,40,'BAKIRKÖY                      '),(451,40,'BAŞAKŞEHİR                    '),(452,40,'BAYRAMPAŞA                    '),(453,40,'BEŞİKTAŞ                      '),(454,40,'BEYKOZ                        '),(455,40,'BEYLİKDÜZÜ                    '),(456,40,'BEYOĞLU                       '),(457,40,'BÜYÜKÇEKMECE                  '),(458,40,'ÇATALCA                       '),(459,40,'ÇEKMEKÖY                      '),(460,40,'ESENLER                       '),(461,40,'ESENYURT                      '),(462,40,'EYÜP                          '),(463,40,'FATİH                         '),(464,40,'GAZİOSMANPAŞA                 '),(465,40,'GÜNGÖREN                      '),(466,40,'KADIKÖY                       '),(467,40,'KAĞITHANE                     '),(468,40,'KARTAL                        '),(469,40,'KÜÇÜKÇEKMECE                  '),(470,40,'MALTEPE                       '),(471,40,'PENDİK                        '),(472,40,'SANCAKTEPE                    '),(473,40,'SARIYER                       '),(474,40,'SİLİVRİ                       '),(475,40,'SULTANBEYLİ                   '),(476,40,'SULTANGAZİ                    '),(477,40,'ŞİLE                          '),(478,40,'ŞİŞLİ                         '),(479,40,'TUZLA                         '),(480,40,'ÜMRANİYE                      '),(481,40,'ÜSKÜDAR                       '),(482,40,'ZEYTİNBURNU                   '),(483,41,'ALİAĞA                        '),(484,41,'BALÇOVA                       '),(485,41,'BAYINDIR                      '),(486,41,'BAYRAKLI                      '),(487,41,'BERGAMA                       '),(488,41,'BEYDAĞ                        '),(489,41,'BORNOVA                       '),(490,41,'BUCA                          '),(491,41,'ÇEŞME                         '),(492,41,'ÇİĞLİ                         '),(493,41,'DİKİLİ                        '),(494,41,'FOÇA                          '),(495,41,'GAZİEMİR                      '),(496,41,'GÜZELBAHÇE                    '),(497,41,'KARABAĞLAR                    '),(498,41,'KARABURUN                     '),(499,41,'KARŞIYAKA                     '),(500,41,'KEMALPAŞA                     '),(501,41,'KINIK                         '),(502,41,'KİRAZ                         '),(503,41,'KONAK                         '),(504,41,'MENDERES                      '),(505,41,'MENEMEN                       '),(506,41,'NARLIDERE                     '),(507,41,'ÖDEMİŞ                        '),(508,41,'SEFERİHİSAR                   '),(509,41,'SELÇUK                        '),(510,41,'TİRE                          '),(511,41,'TORBALI                       '),(512,41,'URLA                          '),(513,42,'AFŞİN                         '),(514,42,'ANDIRIN                       '),(515,42,'ÇAĞLAYANCERİT                 '),(516,42,'DULKADİROĞLU                  '),(517,42,'EKİNÖZÜ                       '),(518,42,'ELBİSTAN                      '),(519,42,'GÖKSUN                        '),(520,42,'NURHAK                        '),(521,42,'ONİKİŞUBAT                    '),(522,42,'PAZARCIK                      '),(523,42,'TÜRKOĞLU                      '),(524,43,'EFLANİ                        '),(525,43,'ESKİPAZAR                     '),(526,43,'MERKEZ                        '),(527,43,'OVACIK                        '),(528,43,'SAFRANBOLU                    '),(529,43,'YENİCE                        '),(530,44,'AYRANCI                       '),(531,44,'BAŞYAYLA                      '),(532,44,'ERMENEK                       '),(533,44,'KAZIMKARABEKİR                '),(534,44,'MERKEZ                        '),(535,44,'SARIVELİLER                   '),(536,45,'AKYAKA                        '),(537,45,'ARPAÇAY                       '),(538,45,'DİGOR                         '),(539,45,'KAĞIZMAN                      '),(540,45,'MERKEZ                        '),(541,45,'SARIKAMIŞ                     '),(542,45,'SELİM                         '),(543,45,'SUSUZ                         '),(544,46,'ABANA                         '),(545,46,'AĞLI                          '),(546,46,'ARAÇ                          '),(547,46,'AZDAVAY                       '),(548,46,'BOZKURT                       '),(549,46,'CİDE                          '),(550,46,'ÇATALZEYTİN                   '),(551,46,'DADAY                         '),(552,46,'DEVREKANİ                     '),(553,46,'DOĞANYURT                     '),(554,46,'HANÖNÜ                        '),(555,46,'İHSANGAZİ                     '),(556,46,'İNEBOLU                       '),(557,46,'KÜRE                          '),(558,46,'MERKEZ                        '),(559,46,'PINARBAŞI                     '),(560,46,'SEYDİLER                      '),(561,46,'ŞENPAZAR                      '),(562,46,'TAŞKÖPRÜ                      '),(563,46,'TOSYA                         '),(564,47,'AKKIŞLA                       '),(565,47,'BÜNYAN                        '),(566,47,'DEVELİ                        '),(567,47,'FELAHİYE                      '),(568,47,'HACILAR                       '),(569,47,'İNCESU                        '),(570,47,'KOCASİNAN                     '),(571,47,'MELİKGAZİ                     '),(572,47,'ÖZVATAN                       '),(573,47,'PINARBAŞI                     '),(574,47,'SARIOĞLAN                     '),(575,47,'SARIZ                         '),(576,47,'TALAS                         '),(577,47,'TOMARZA                       '),(578,47,'YAHYALI                       '),(579,47,'YEŞİLHİSAR                    '),(580,48,'BAHŞİLİ                       '),(581,48,'BALIŞEYH                      '),(582,48,'ÇELEBİ                        '),(583,48,'DELİCE                        '),(584,48,'KARAKEÇİLİ                    '),(585,48,'KESKİN                        '),(586,48,'MERKEZ                        '),(587,48,'SULAKYURT                     '),(588,48,'YAHŞİHAN                      '),(589,49,'BABAESKİ                      '),(590,49,'DEMİRKÖY                      '),(591,49,'KOFÇAZ                        '),(592,49,'LÜLEBURGAZ                    '),(593,49,'MERKEZ                        '),(594,49,'PEHLİVANKÖY                   '),(595,49,'PINARHİSAR                    '),(596,49,'VİZE                          '),(597,50,'AKÇAKENT                      '),(598,50,'AKPINAR                       '),(599,50,'BOZTEPE                       '),(600,50,'ÇİÇEKDAĞI                     '),(601,50,'KAMAN                         '),(602,50,'MERKEZ                        '),(603,50,'MUCUR                         '),(604,51,'ELBEYLİ                       '),(605,51,'MERKEZ                        '),(606,51,'MUSABEYLİ                     '),(607,51,'POLATELİ                      '),(608,52,'BAŞİSKELE                     '),(609,52,'ÇAYIROVA                      '),(610,52,'DARICA                        '),(611,52,'DERİNCE                       '),(612,52,'DİLOVASI                      '),(613,52,'GEBZE                         '),(614,52,'GÖLCÜK                        '),(615,52,'İZMİT                         '),(616,52,'KANDIRA                       '),(617,52,'KARAMÜRSEL                    '),(618,52,'KARTEPE                       '),(619,52,'KÖRFEZ                        '),(620,53,'AHIRLI                        '),(621,53,'AKÖREN                        '),(622,53,'AKŞEHİR                       '),(623,53,'ALTINEKİN                     '),(624,53,'BEYŞEHİR                      '),(625,53,'BOZKIR                        '),(626,53,'CİHANBEYLİ                    '),(627,53,'ÇELTİK                        '),(628,53,'ÇUMRA                         '),(629,53,'DERBENT                       '),(630,53,'DEREBUCAK                     '),(631,53,'DOĞANHİSAR                    '),(632,53,'EMİRGAZİ                      '),(633,53,'EREĞLİ                        '),(634,53,'GÜNEYSINIR                    '),(635,53,'HADİM                         '),(636,53,'HALKAPINAR                    '),(637,53,'HÜYÜK                         '),(638,53,'ILGIN                         '),(639,53,'KADINHANI                     '),(640,53,'KARAPINAR                     '),(641,53,'KARATAY                       '),(642,53,'KULU                          '),(643,53,'MERAM                         '),(644,53,'SARAYÖNÜ                      '),(645,53,'SELÇUKLU                      '),(646,53,'SEYDİŞEHİR                    '),(647,53,'TAŞKENT                       '),(648,53,'TUZLUKÇU                      '),(649,53,'YALIHÜYÜK                     '),(650,53,'YUNAK                         '),(651,54,'ALTINTAŞ                      '),(652,54,'ASLANAPA                      '),(653,54,'ÇAVDARHİSAR                   '),(654,54,'DOMANİÇ                       '),(655,54,'DUMLUPINAR                    '),(656,54,'EMET                          '),(657,54,'GEDİZ                         '),(658,54,'HİSARCIK                      '),(659,54,'MERKEZ                        '),(660,54,'PAZARLAR                      '),(661,54,'SİMAV                         '),(662,54,'ŞAPHANE                       '),(663,54,'TAVŞANLI                      '),(664,55,'AKÇADAĞ                       '),(665,55,'ARAPGİR                       '),(666,55,'ARGUVAN                       '),(667,55,'BATTALGAZİ                    '),(668,55,'DARENDE                       '),(669,55,'DOĞANŞEHİR                    '),(670,55,'DOĞANYOL                      '),(671,55,'HEKİMHAN                      '),(672,55,'KALE                          '),(673,55,'KULUNCAK                      '),(674,55,'PÜTÜRGE                       '),(675,55,'YAZIHAN                       '),(676,55,'YEŞİLYURT                     '),(677,56,'AHMETLİ                       '),(678,56,'AKHİSAR                       '),(679,56,'ALAŞEHİR                      '),(680,56,'DEMİRCİ                       '),(681,56,'GÖLMARMARA                    '),(682,56,'GÖRDES                        '),(683,56,'KIRKAĞAÇ                      '),(684,56,'KÖPRÜBAŞI                     '),(685,56,'KULA                          '),(686,56,'SALİHLİ                       '),(687,56,'SARIGÖL                       '),(688,56,'SARUHANLI                     '),(689,56,'SELENDİ                       '),(690,56,'SOMA                          '),(691,56,'ŞEHZADELER                    '),(692,56,'TURGUTLU                      '),(693,56,'YUNUSEMRE                     '),(694,57,'ARTUKLU                       '),(695,57,'DARGEÇİT                      '),(696,57,'DERİK                         '),(697,57,'KIZILTEPE                     '),(698,57,'MAZIDAĞI                      '),(699,57,'MİDYAT                        '),(700,57,'NUSAYBİN                      '),(701,57,'ÖMERLİ                        '),(702,57,'SAVUR                         '),(703,57,'YEŞİLLİ                       '),(704,58,'AKDENİZ                       '),(705,58,'ANAMUR                        '),(706,58,'AYDINCIK                      '),(707,58,'BOZYAZI                       '),(708,58,'ÇAMLIYAYLA                    '),(709,58,'ERDEMLİ                       '),(710,58,'GÜLNAR                        '),(711,58,'MEZİTLİ                       '),(712,58,'MUT                           '),(713,58,'SİLİFKE                       '),(714,58,'TARSUS                        '),(715,58,'TOROSLAR                      '),(716,58,'YENİŞEHİR                     '),(717,59,'BODRUM                        '),(718,59,'DALAMAN                       '),(719,59,'DATÇA                         '),(720,59,'FETHİYE                       '),(721,59,'KAVAKLIDERE                   '),(722,59,'KÖYCEĞİZ                      '),(723,59,'MARMARİS                      '),(724,59,'MENTEŞE                       '),(725,59,'MİLAS                         '),(726,59,'ORTACA                        '),(727,59,'SEYDİKEMER                    '),(728,59,'ULA                           '),(729,59,'YATAĞAN                       '),(730,60,'BULANIK                       '),(731,60,'HASKÖY                        '),(732,60,'KORKUT                        '),(733,60,'MALAZGİRT                     '),(734,60,'MERKEZ                        '),(735,60,'VARTO                         '),(736,61,'ACIGÖL                        '),(737,61,'AVANOS                        '),(738,61,'DERİNKUYU                     '),(739,61,'GÜLŞEHİR                      '),(740,61,'HACIBEKTAŞ                    '),(741,61,'KOZAKLI                       '),(742,61,'MERKEZ                        '),(743,61,'ÜRGÜP                         '),(744,62,'ALTUNHİSAR                    '),(745,62,'BOR                           '),(746,62,'ÇAMARDI                       '),(747,62,'ÇİFTLİK                       '),(748,62,'MERKEZ                        '),(749,62,'ULUKIŞLA                      '),(750,63,'AKKUŞ                         '),(751,63,'ALTINORDU                     '),(752,63,'AYBASTI                       '),(753,63,'ÇAMAŞ                         '),(754,63,'ÇATALPINAR                    '),(755,63,'ÇAYBAŞI                       '),(756,63,'FATSA                         '),(757,63,'GÖLKÖY                        '),(758,63,'GÜLYALI                       '),(759,63,'GÜRGENTEPE                    '),(760,63,'İKİZCE                        '),(761,63,'KABADÜZ                       '),(762,63,'KABATAŞ                       '),(763,63,'KORGAN                        '),(764,63,'KUMRU                         '),(765,63,'MESUDİYE                      '),(766,63,'PERŞEMBE                      '),(767,63,'ULUBEY                        '),(768,63,'ÜNYE                          '),(769,64,'BAHÇE                         '),(770,64,'DÜZİÇİ                        '),(771,64,'HASANBEYLİ                    '),(772,64,'KADİRLİ                       '),(773,64,'MERKEZ                        '),(774,64,'SUMBAS                        '),(775,64,'TOPRAKKALE                    '),(776,65,'ARDEŞEN                       '),(777,65,'ÇAMLIHEMŞİN                   '),(778,65,'ÇAYELİ                        '),(779,65,'DEREPAZARI                    '),(780,65,'FINDIKLI                      '),(781,65,'GÜNEYSU                       '),(782,65,'HEMŞİN                        '),(783,65,'İKİZDERE                      '),(784,65,'İYİDERE                       '),(785,65,'KALKANDERE                    '),(786,65,'MERKEZ                        '),(787,65,'PAZAR                         '),(788,66,'ADAPAZARI                     '),(789,66,'AKYAZI                        '),(790,66,'ARİFİYE                       '),(791,66,'ERENLER                       '),(792,66,'FERİZLİ                       '),(793,66,'GEYVE                         '),(794,66,'HENDEK                        '),(795,66,'KARAPÜRÇEK                    '),(796,66,'KARASU                        '),(797,66,'KAYNARCA                      '),(798,66,'KOCAALİ                       '),(799,66,'PAMUKOVA                      '),(800,66,'SAPANCA                       '),(801,66,'SERDİVAN                      '),(802,66,'SÖĞÜTLÜ                       '),(803,66,'TARAKLI                       '),(804,67,'19.May'),(805,67,'ALAÇAM                        '),(806,67,'ASARCIK                       '),(807,67,'ATAKUM                        '),(808,67,'AYVACIK                       '),(809,67,'BAFRA                         '),(810,67,'CANİK                         '),(811,67,'ÇARŞAMBA                      '),(812,67,'HAVZA                         '),(813,67,'İLKADIM                       '),(814,67,'KAVAK                         '),(815,67,'LADİK                         '),(816,67,'SALIPAZARI                    '),(817,67,'TEKKEKÖY                      '),(818,67,'TERME                         '),(819,67,'VEZİRKÖPRÜ                    '),(820,67,'YAKAKENT                      '),(821,68,'BAYKAN                        '),(822,68,'ERUH                          '),(823,68,'KURTALAN                      '),(824,68,'MERKEZ                        '),(825,68,'PERVARİ                       '),(826,68,'ŞİRVAN                        '),(827,68,'TİLLO                         '),(828,69,'AYANCIK                       '),(829,69,'BOYABAT                       '),(830,69,'DİKMEN                        '),(831,69,'DURAĞAN                       '),(832,69,'ERFELEK                       '),(833,69,'GERZE                         '),(834,69,'MERKEZ                        '),(835,69,'SARAYDÜZÜ                     '),(836,69,'TÜRKELİ                       '),(837,70,'AKINCILAR                     '),(838,70,'ALTINYAYLA                    '),(839,70,'DİVRİĞİ                       '),(840,70,'DOĞANŞAR                      '),(841,70,'GEMEREK                       '),(842,70,'GÖLOVA                        '),(843,70,'GÜRÜN                         '),(844,70,'HAFİK                         '),(845,70,'İMRANLI                       '),(846,70,'KANGAL                        '),(847,70,'KOYULHİSAR                    '),(848,70,'MERKEZ                        '),(849,70,'SUŞEHRİ                       '),(850,70,'ŞARKIŞLA                      '),(851,70,'ULAŞ                          '),(852,70,'YILDIZELİ                     '),(853,70,'ZARA                          '),(854,71,'AKÇAKALE                      '),(855,71,'BİRECİK                       '),(856,71,'BOZOVA                        '),(857,71,'CEYLANPINAR                   '),(858,71,'EYYÜBİYE                      '),(859,71,'HALFETİ                       '),(860,71,'HALİLİYE                      '),(861,71,'HARRAN                        '),(862,71,'HİLVAN                        '),(863,71,'KARAKÖPRÜ                     '),(864,71,'SİVEREK                       '),(865,71,'SURUÇ                         '),(866,71,'VİRANŞEHİR                    '),(867,72,'BEYTÜŞŞEBAP                   '),(868,72,'CİZRE                         '),(869,72,'GÜÇLÜKONAK                    '),(870,72,'İDİL                          '),(871,72,'MERKEZ                        '),(872,72,'SİLOPİ                        '),(873,72,'ULUDERE                       '),(874,73,'ÇERKEZKÖY                     '),(875,73,'ÇORLU                         '),(876,73,'ERGENE                        '),(877,73,'HAYRABOLU                     '),(878,73,'KAPAKLI                       '),(879,73,'MALKARA                       '),(880,73,'MARMARAEREĞLİSİ               '),(881,73,'MURATLI                       '),(882,73,'SARAY                         '),(883,73,'SÜLEYMANPAŞA                  '),(884,73,'ŞARKÖY                        '),(885,74,'ALMUS                         '),(886,74,'ARTOVA                        '),(887,74,'BAŞÇİFTLİK                    '),(888,74,'ERBAA                         '),(889,74,'MERKEZ                        '),(890,74,'NİKSAR                        '),(891,74,'PAZAR                         '),(892,74,'REŞADİYE                      '),(893,74,'SULUSARAY                     '),(894,74,'TURHAL                        '),(895,74,'YEŞİLYURT                     '),(896,74,'ZİLE                          '),(897,75,'AKÇAABAT                      '),(898,75,'ARAKLI                        '),(899,75,'ARSİN                         '),(900,75,'BEŞİKDÜZÜ                     '),(901,75,'ÇARŞIBAŞI                     '),(902,75,'ÇAYKARA                       '),(903,75,'DERNEKPAZARI                  '),(904,75,'DÜZKÖY                        '),(905,75,'HAYRAT                        '),(906,75,'KÖPRÜBAŞI                     '),(907,75,'MAÇKA                         '),(908,75,'OF                            '),(909,75,'ORTAHİSAR                     '),(910,75,'SÜRMENE                       '),(911,75,'ŞALPAZARI                     '),(912,75,'TONYA                         '),(913,75,'VAKFIKEBİR                    '),(914,75,'YOMRA                         '),(915,76,'ÇEMİŞGEZEK                    '),(916,76,'HOZAT                         '),(917,76,'MAZGİRT                       '),(918,76,'MERKEZ                        '),(919,76,'NAZIMİYE                      '),(920,76,'OVACIK                        '),(921,76,'PERTEK                        '),(922,76,'PÜLÜMÜR                       '),(923,77,'BANAZ                         '),(924,77,'EŞME                          '),(925,77,'KARAHALLI                     '),(926,77,'MERKEZ                        '),(927,77,'SİVASLI                       '),(928,77,'ULUBEY                        '),(929,78,'BAHÇESARAY                    '),(930,78,'BAŞKALE                       '),(931,78,'ÇALDIRAN                      '),(932,78,'ÇATAK                         '),(933,78,'EDREMİT                       '),(934,78,'ERCİŞ                         '),(935,78,'GEVAŞ                         '),(936,78,'GÜRPINAR                      '),(937,78,'İPEKYOLU                      '),(938,78,'MURADİYE                      '),(939,78,'ÖZALP                         '),(940,78,'SARAY                         '),(941,78,'TUŞBA                         '),(942,79,'ALTINOVA                      '),(943,79,'ARMUTLU                       '),(944,79,'ÇINARCIK                      '),(945,79,'ÇİFTLİKKÖY                    '),(946,79,'MERKEZ                        '),(947,79,'TERMAL                        '),(948,80,'AKDAĞMADENİ                   '),(949,80,'AYDINCIK                      '),(950,80,'BOĞAZLIYAN                    '),(951,80,'ÇANDIR                        '),(952,80,'ÇAYIRALAN                     '),(953,80,'ÇEKEREK                       '),(954,80,'KADIŞEHRİ                     '),(955,80,'MERKEZ                        '),(956,80,'SARAYKENT                     '),(957,80,'SARIKAYA                      '),(958,80,'SORGUN                        '),(959,80,'ŞEFAATLİ                      '),(960,80,'YENİFAKILI                    '),(961,80,'YERKÖY                        '),(962,81,'ALAPLI                        '),(963,81,'ÇAYCUMA                       '),(964,81,'DEVREK                        '),(965,81,'EREĞLİ                        '),(966,81,'GÖKÇEBEY                      '),(967,81,'KİLİMLİ                       '),(968,81,'KOZLU                         '),(969,81,'MERKEZ                        '),(970,1,'ALADAĞ');
/*!40000 ALTER TABLE `ilce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manuel_faturalar`
--

DROP TABLE IF EXISTS `manuel_faturalar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manuel_faturalar` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `sip_No` int(255) NOT NULL,
  `isim` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `duz_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sevk_tarih` datetime NOT NULL,
  `urun_id` int(255) NOT NULL,
  `adet` int(55) NOT NULL,
  `kdv` varchar(25) NOT NULL DEFAULT '0,08',
  `fiyat` double NOT NULL,
  `indirim` float NOT NULL,
  `personel` int(255) NOT NULL,
  `fatura_No` int(255) NOT NULL,
  `faturaPrint` int(255) NOT NULL DEFAULT '0' COMMENT '0: False, 1: True',
  `faturaPrinter_personel` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manuel_faturalar`
--

LOCK TABLES `manuel_faturalar` WRITE;
/*!40000 ALTER TABLE `manuel_faturalar` DISABLE KEYS */;
INSERT INTO `manuel_faturalar` (`id`, `sip_No`, `isim`, `adres`, `telefon`, `duz_tarih`, `sevk_tarih`, `urun_id`, `adet`, `kdv`, `fiyat`, `indirim`, `personel`, `fatura_No`, `faturaPrint`, `faturaPrinter_personel`) VALUES (1,1439948414,'Musa ATLAY','Deneme Adres','(555) 555-5555','2015-08-19 00:09:54','2015-08-30 00:00:00',2,353,'0.08',70000,1000,107,123456789,1,107),(2,5555555,'fndsjnf adf jdsn','gadjngjk jadsfjas fjdsjfbas ','(055) 555-5555','2015-08-19 08:39:44','2015-08-19 00:00:00',6468,4,'2',50000,-0.08,47,156654,1,47);
/*!40000 ALTER TABLE `manuel_faturalar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odeme_tipi`
--

DROP TABLE IF EXISTS `odeme_tipi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odeme_tipi` (
  `odeme_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '0: false, 1: true',
  PRIMARY KEY (`odeme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odeme_tipi`
--

LOCK TABLES `odeme_tipi` WRITE;
/*!40000 ALTER TABLE `odeme_tipi` DISABLE KEYS */;
INSERT INTO `odeme_tipi` (`odeme_id`, `name`, `active`) VALUES (1,'Kapıda Nakit Ödeme',0),(2,'Kredi Kartıyla Ödeme',1),(3,'Banka Havalesiyle Ödeme',1);
/*!40000 ALTER TABLE `odeme_tipi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ozel_yetkiler`
--

DROP TABLE IF EXISTS `ozel_yetkiler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ozel_yetkiler` (
  `yt_id` int(11) NOT NULL AUTO_INCREMENT,
  `yetki_adi` varchar(225) NOT NULL,
  PRIMARY KEY (`yt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ozel_yetkiler`
--

LOCK TABLES `ozel_yetkiler` WRITE;
/*!40000 ALTER TABLE `ozel_yetkiler` DISABLE KEYS */;
INSERT INTO `ozel_yetkiler` (`yt_id`, `yetki_adi`) VALUES (1,'İleri Tarihli Aranacaklar Listesi');
/*!40000 ALTER TABLE `ozel_yetkiler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `affilate_id` int(11) NOT NULL,
  `payment_bank` varchar(225) NOT NULL,
  `payment_money` decimal(10,2) NOT NULL,
  `payment_swift` text NOT NULL,
  `payment_messages` text NOT NULL,
  `payment_date` date NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` (`payment_id`, `affilate_id`, `payment_bank`, `payment_money`, `payment_swift`, `payment_messages`, `payment_date`, `add_date`) VALUES (1,101,'idris Bank',250.00,'<a href=\"\">document</a>','Merhaba acı Enmi','2015-04-23','2015-04-22 21:00:00'),(2,101,'ido Bank',250.00,'<a href=\"docs/895873.jpg\">document</a>','merhasbdsad','2015-04-23','2015-04-22 21:00:00'),(3,101,'agabank',400.00,'<a href=\"../affilate/docs/746153.jpg\">document</a>','Merhaba','2015-04-22','2015-04-22 21:00:00'),(4,101,'adasdsad',250.00,'<a href=\"http://affilate.gointeraktif.com/docs/245061.jpg\" target=\"_blank\">document</a>','asdasdasdas','2015-04-05','2015-04-22 21:00:00');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renkler`
--

DROP TABLE IF EXISTS `renkler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renkler` (
  `renk_id` int(11) NOT NULL AUTO_INCREMENT,
  `renk_adi` varchar(225) NOT NULL,
  PRIMARY KEY (`renk_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renkler`
--

LOCK TABLES `renkler` WRITE;
/*!40000 ALTER TABLE `renkler` DISABLE KEYS */;
INSERT INTO `renkler` (`renk_id`, `renk_adi`) VALUES (1,'Mavi'),(2,'Kırmızı'),(3,'Siyah');
/*!40000 ALTER TABLE `renkler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siparis_durumlari`
--

DROP TABLE IF EXISTS `siparis_durumlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siparis_durumlari` (
  `durum_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `ingname` varchar(225) NOT NULL,
  `i_case` int(1) NOT NULL,
  `toto` int(11) NOT NULL,
  `renk` varchar(225) NOT NULL,
  `label` varchar(255) NOT NULL,
  `donusum` varchar(225) NOT NULL,
  `guruplar` int(11) NOT NULL,
  `active` int(12) NOT NULL DEFAULT '1',
  PRIMARY KEY (`durum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siparis_durumlari`
--

LOCK TABLES `siparis_durumlari` WRITE;
/*!40000 ALTER TABLE `siparis_durumlari` DISABLE KEYS */;
INSERT INTO `siparis_durumlari` (`durum_id`, `name`, `ingname`, `i_case`, `toto`, `renk`, `label`, `donusum`, `guruplar`, `active`) VALUES (1,'Yeni ','',1,1,'alert alert-default','label label-default','hold',1,1),(2,'Ulaşılamayan','',0,1,'alert alert-warning','label label-warning','hold',1,1),(3,'İleri Tarihte ara','',0,1,'alert alert-info','label label-info','hold',1,1),(4,'Geçersiz\r\n','',0,0,'alert alert-danger','label label-danger','trash',3,1),(5,'iptal','',0,0,'alert alert-warning','label label-warning','cancelled',4,1),(6,'Geri dönen','',2,0,'alert alert-primary','label label-primary','confirmed',2,1),(7,'Onaylandı','',0,0,'alert alert-success','label label-success','confirmed',2,1),(8,'Sonuçlandı\r\n','',3,0,'alert alert-success','label label-success','confirmed',2,1),(88,'Fazla Kayıt','',0,0,'alert alert-success','label label-success','trash',3,1),(9,'İleri Tarihli Satış','',0,0,'alert alert-success','label label-success','confirmed',2,0),(99,'Çağrıda','',0,0,'alert alert-default','label label-default','hold',1,1),(100,'Direk Onay','',4,0,'alert alert-success','label label-success','confirmed',5,1);
/*!40000 ALTER TABLE `siparis_durumlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siparis_notlari`
--

DROP TABLE IF EXISTS `siparis_notlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siparis_notlari` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `siparis_id` int(11) NOT NULL,
  `personel_id` int(11) NOT NULL,
  `siparis_notu` text NOT NULL,
  `islem` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siparis_notlari`
--

LOCK TABLES `siparis_notlari` WRITE;
/*!40000 ALTER TABLE `siparis_notlari` DISABLE KEYS */;
INSERT INTO `siparis_notlari` (`not_id`, `siparis_id`, `personel_id`, `siparis_notu`, `islem`, `add_date`) VALUES (1,1,109,'wgdggdgd dgdg',4,'2015-12-07 19:37:06');
/*!40000 ALTER TABLE `siparis_notlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siparis_tipleri`
--

DROP TABLE IF EXISTS `siparis_tipleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siparis_tipleri` (
  `siparis_tipi` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  PRIMARY KEY (`siparis_tipi`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siparis_tipleri`
--

LOCK TABLES `siparis_tipleri` WRITE;
/*!40000 ALTER TABLE `siparis_tipleri` DISABLE KEYS */;
INSERT INTO `siparis_tipleri` (`siparis_tipi`, `name`) VALUES (1,'Sipariş'),(2,'Arama Talebi\r\n'),(3,'Yarım Form'),(4,'Danışmanlık'),(5,'Tele Satış\r\n'),(6,'Yetişkin Ürünleri');
/*!40000 ALTER TABLE `siparis_tipleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siparisler`
--

DROP TABLE IF EXISTS `siparisler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siparisler` (
  `siparis_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `siparis_tipi` int(11) NOT NULL,
  `hediye_urun` int(255) NOT NULL COMMENT 'Hediye ürün ID',
  `urun_id` int(11) NOT NULL,
  `ilk_urun_id` int(11) NOT NULL,
  `urun_adeti` int(11) NOT NULL,
  `ilk_urun_adeti` int(11) NOT NULL,
  `urunun_adi` varchar(225) NOT NULL,
  `fiyat` decimal(10,2) NOT NULL,
  `ilk_fiyat` decimal(10,2) NOT NULL,
  `indirim` decimal(10,2) NOT NULL,
  `renk` int(11) NOT NULL,
  `odeme_id` int(11) NOT NULL,
  `ad_soyad` varchar(225) NOT NULL,
  `Telefon_no` varchar(225) NOT NULL,
  `u_age` text NOT NULL,
  `kullanim` text NOT NULL,
  `il` varchar(225) NOT NULL,
  `ilce` varchar(225) NOT NULL,
  `adres` text NOT NULL,
  `siparis_durumu` int(11) NOT NULL DEFAULT '1',
  `kayit_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `islem_tarihi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `satis_tarihi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `toto_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `kilit_pers` int(11) NOT NULL,
  `ip_adres` varchar(225) NOT NULL,
  `personel` int(11) NOT NULL,
  `kilit` int(1) NOT NULL,
  `iptal_user` int(11) NOT NULL,
  `add_user` int(11) NOT NULL,
  `affiliate` int(11) NOT NULL,
  `api_key` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `affilate_money` decimal(10,2) NOT NULL,
  `Kal_onay_user` int(1) NOT NULL,
  `kal_kontrol` int(1) NOT NULL,
  `iptal_nedeni` int(11) NOT NULL,
  `iptal_tarihi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cargoPrint` int(1) NOT NULL,
  `kalite_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fatura_no` int(255) NOT NULL,
  `paket_user_id` int(255) NOT NULL,
  `paket_datetime` date NOT NULL,
  `kargo_post` tinyint(10) NOT NULL DEFAULT '0' COMMENT '0: false; 1: true',
  `cargoKey` int(255) NOT NULL,
  `alt_durum_id` int(11) NOT NULL,
  `musteri_notu` text NOT NULL,
  PRIMARY KEY (`siparis_id`),
  KEY `Telefon_no` (`Telefon_no`),
  KEY `siparis_id` (`siparis_id`),
  KEY `Telefon_no_2` (`Telefon_no`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siparisler`
--

LOCK TABLES `siparisler` WRITE;
/*!40000 ALTER TABLE `siparisler` DISABLE KEYS */;
INSERT INTO `siparisler` (`siparis_id`, `order_id`, `site_id`, `siparis_tipi`, `hediye_urun`, `urun_id`, `ilk_urun_id`, `urun_adeti`, `ilk_urun_adeti`, `urunun_adi`, `fiyat`, `ilk_fiyat`, `indirim`, `renk`, `odeme_id`, `ad_soyad`, `Telefon_no`, `u_age`, `kullanim`, `il`, `ilce`, `adres`, `siparis_durumu`, `kayit_tarihi`, `islem_tarihi`, `update_date`, `satis_tarihi`, `toto_date`, `kilit_pers`, `ip_adres`, `personel`, `kilit`, `iptal_user`, `add_user`, `affiliate`, `api_key`, `group_id`, `affilate_money`, `Kal_onay_user`, `kal_kontrol`, `iptal_nedeni`, `iptal_tarihi`, `cargoPrint`, `kalite_date`, `fatura_no`, `paket_user_id`, `paket_datetime`, `kargo_post`, `cargoKey`, `alt_durum_id`, `musteri_notu`) VALUES (1,1449513748,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,2,'Samet ata','5322134455','','','ADANA                         ','CEYHAN                        ','',4,'2015-12-07 18:42:05','2015-12-07 19:37:06','2015-12-07 20:37:06','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',109,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,1,''),(2,1449513861,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'ilahe Quliyeva','+9940703101909','','','','','',1,'2015-12-07 18:42:46','2015-12-07 18:42:46','2015-12-07 18:42:46','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(3,1449515428,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Gunel','0553438400','','','','','',1,'2015-12-07 19:09:39','2015-12-07 19:09:39','2015-12-07 19:09:39','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(4,1449515795,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Shefa Eldarova','0559502203','','','','','',1,'2015-12-07 19:15:15','2015-12-07 19:15:15','2015-12-07 19:15:15','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(5,1449518860,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Nargiz Mehdiyevs','0553293329','','','','','',1,'2015-12-07 20:06:53','2015-12-07 20:06:53','2015-12-07 20:06:53','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(6,1449520562,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Insaf','0503393787','','','','','',1,'2015-12-07 20:35:05','2015-12-07 20:35:05','2015-12-07 20:35:05','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(7,1449521023,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Talisli sevinc','0503116119','','','','','',1,'2015-12-07 20:42:49','2015-12-07 20:42:49','2015-12-07 20:42:49','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(8,1449521634,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'chinare alishova','0508527467','','','','','',1,'2015-12-07 20:53:05','2015-12-07 20:53:05','2015-12-07 20:53:05','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(9,1449522717,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Gulnar','+994506265999','','','','','',1,'2015-12-07 21:11:13','2015-12-07 21:11:13','2015-12-07 21:11:13','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(10,1449529456,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Aliyeva Parvin ','0556174380','','','','','',1,'2015-12-07 23:03:49','2015-12-07 23:03:49','2015-12-07 23:03:49','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(11,1449529451,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Aliyeva Parvin ','0556174380','','','','','',1,'2015-12-07 23:04:09','2015-12-07 23:04:09','2015-12-07 23:04:09','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(12,1449549698,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Dadaşova Sevinc','0554048464','','','','','',1,'2015-12-08 04:40:39','2015-12-08 04:40:39','2015-12-08 04:40:39','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(13,1449549733,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Dadaşova Sevinc','0554048464','','','','','',1,'2015-12-08 04:40:39','2015-12-08 04:40:39','2015-12-08 04:40:39','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(14,1449549781,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Sevinc Dadaşova','0554048464','','','','','',1,'2015-12-08 04:41:51','2015-12-08 04:41:51','2015-12-08 04:41:51','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(15,1449551133,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Azizova Rena','0555889494','','','','','',1,'2015-12-08 05:04:58','2015-12-08 05:04:58','2015-12-08 05:04:58','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(16,1449554743,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Səadət  Əlizadə','0508602535','','','','','',1,'2015-12-08 06:04:20','2015-12-08 06:04:20','2015-12-08 06:04:20','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(17,1449556774,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'aysel mamadova','0559266996','','','','','',1,'2015-12-08 06:39:24','2015-12-08 06:39:24','2015-12-08 06:39:24','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(18,1449558847,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'dilwad huseynova azerbaycanli','0503129442','','','','','',1,'2015-12-08 07:12:58','2015-12-08 07:12:58','2015-12-08 07:12:58','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(19,1449558863,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'dilwad huseynova azerbaycanli','0503129442','','','','','',1,'2015-12-08 07:13:53','2015-12-08 07:13:53','2015-12-08 07:13:53','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(20,1449570466,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'aynur.ziloyeva@mail.ru','0554098325','','','','','',1,'2015-12-08 10:26:38','2015-12-08 10:26:38','2015-12-08 10:26:38','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,''),(21,1449660744,1,1,0,6501,0,1,0,'Tibet Goji',39.00,0.00,0.00,0,0,'Metanet Tağıyeva','0505092125','','','','','',1,'2015-12-09 11:31:33','2015-12-09 11:31:33','2015-12-09 11:31:33','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'',0,0,0,0,0,'',0,0.00,0,0,0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0,0,'0000-00-00',0,0,0,'');
/*!40000 ALTER TABLE `siparisler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siteler`
--

DROP TABLE IF EXISTS `siteler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siteler` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_adi` varchar(225) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siteler`
--

LOCK TABLES `siteler` WRITE;
/*!40000 ALTER TABLE `siteler` DISABLE KEYS */;
INSERT INTO `siteler` (`site_id`, `site_adi`) VALUES (1,'gojiuzumu.org');
/*!40000 ALTER TABLE `siteler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urun_gruplari`
--

DROP TABLE IF EXISTS `urun_gruplari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urun_gruplari` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(225) NOT NULL,
  `prince_money` decimal(10,2) NOT NULL,
  `group_img` varchar(225) NOT NULL,
  `gr_case` int(1) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urun_gruplari`
--

LOCK TABLES `urun_gruplari` WRITE;
/*!40000 ALTER TABLE `urun_gruplari` DISABLE KEYS */;
INSERT INTO `urun_gruplari` (`group_id`, `group_name`, `prince_money`, `group_img`, `gr_case`) VALUES (1,'Goji Berry',9.00,'goji.png',0),(2,'Sigara son',9.00,'sigarason',1);
/*!40000 ALTER TABLE `urun_gruplari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urunler`
--

DROP TABLE IF EXISTS `urunler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_adi` varchar(225) NOT NULL,
  `urun_fiyati` decimal(10,2) NOT NULL,
  `adet` int(11) NOT NULL,
  `urun_alis_fiyati` decimal(10,2) NOT NULL,
  `urun_kargo` decimal(10,2) NOT NULL,
  `Durumu` int(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `kuyruk` int(11) DEFAULT NULL,
  PRIMARY KEY (`urun_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6502 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urunler`
--

LOCK TABLES `urunler` WRITE;
/*!40000 ALTER TABLE `urunler` DISABLE KEYS */;
INSERT INTO `urunler` (`urun_id`, `urun_adi`, `urun_fiyati`, `adet`, `urun_alis_fiyati`, `urun_kargo`, `Durumu`, `group_id`, `kuyruk`) VALUES (6501,'Tibet Goji',39.00,1,0.00,0.00,0,0,1);
/*!40000 ALTER TABLE `urunler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'adaypake_db'
--

--
-- Dumping routines for database 'adaypake_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-15 16:46:30
