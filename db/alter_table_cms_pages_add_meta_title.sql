ALTER TABLE `cms_pages` ADD `meta_title` VARCHAR(255) NOT NULL AFTER `title`;


ALTER TABLE `cms_tiles` ADD `meta_title` VARCHAR(255) NOT NULL AFTER `tile_order`, ADD `meta_description` TEXT NOT NULL AFTER `meta_title`;
