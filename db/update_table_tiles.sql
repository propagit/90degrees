ALTER TABLE `cms_tiles` ADD `home_page` TINYINT NOT NULL DEFAULT '0' COMMENT '0: not published on homepage, 1 published on home page' AFTER `status`;