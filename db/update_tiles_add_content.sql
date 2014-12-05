ALTER TABLE `cms_tiles` ADD `short_desc` VARCHAR(255) NOT NULL AFTER `new_window`;
ALTER TABLE `cms_tiles` ADD `content` TEXT NOT NULL AFTER `new_window`;
ALTER TABLE `cms_tiles` ADD `feature_image_id` BIGINT NOT NULL COMMENT 'contains upload_id' AFTER `content`;