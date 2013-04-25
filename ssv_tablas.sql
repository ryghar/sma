CREATE TABLE IF NOT EXISTS `ads_users_web` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `id_language` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `commercial` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_country` int(3) NOT NULL,
  `zip` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `taxid` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` enum('1','2','3','4','5') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'administrador, afiliado, publisher, network, media',
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `conCode` varchar(32) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Para la confirmaciÃ³n.',
  `revenue` decimal(10,10) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ssv_groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `budget` decimal(10,2) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_group`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ssv_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name_eng` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `name_esp` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

INSERT INTO `ssv_status` (`id_status`, `name_eng`, `name_esp`, `description`) VALUES
(1, 'Active', 'Activo', NULL),
(2, 'Hold', 'En Pausa', NULL),
(3, 'Draft', 'Borrador', NULL),
(4, 'Expired', 'Expirada', NULL),
(5, 'Archived', 'Archivado', NULL);

CREATE TABLE `ssv_campaigns_banners` (
  `id_campaign_banner` int(11) NOT NULL auto_increment,
  `id_campaign` int(11) NOT NULL default '0',
  `id_banner` int(11) NOT NULL default '0',
  `extension` varchar(4) character set utf8 collate utf8_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`id_campaign_banner`),
  KEY `id_campaign` (`id_campaign`),
  KEY `id_banner_size` (`id_banner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ssv_banners` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `extension` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ssv_campaigns` (
  `id_campaign` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `id_cat_theme` int(11) NOT NULL,
  `model_rate` enum('1','2','3') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'cpa. cpc, cpm',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `bid` decimal(10,4) NOT NULL,
  `cap` decimal(10,2) NOT NULL,
  `status` enum('1','2','3','4','5') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '3' COMMENT 'activo, pausada, borrador, expirada, archivada',
  `id_brand` int(11) NOT NULL DEFAULT '0',
  `id_model` int(11) NOT NULL DEFAULT '0',
  `date_start` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_campaign`),
  KEY `id_user` (`id_user`),
  KEY `id_country` (`id_country`),
  KEY `id_cat_theme` (`id_cat_theme`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

