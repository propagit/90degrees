--
-- Triggers `upload_objects`
--
DROP TRIGGER IF EXISTS `insert_order_object`;
DELIMITER //
CREATE TRIGGER `insert_order_object` BEFORE INSERT ON `upload_objects`
 FOR EACH ROW SET NEW.object_order = (SELECT max(object_order) FROM upload_objects WHERE object_name = NEW.object_name AND object_id = NEW.object_id)
//
DELIMITER ;


CREATE TRIGGER `delete_upload_object` AFTER DELETE ON `uploads`
 FOR EACH ROW DELETE FROM upload_objects WHERE upload_id = OLD.upload_id


 CREATE TRIGGER `insert_order_url` BEFORE INSERT ON `cms_menu_urls`
 FOR EACH ROW SET NEW.url_order = (SELECT max(url_order) FROM cms_menu_urls WHERE menu_id = NEW.menu_id)


--
-- Triggers `cms_menu_urls`
--
DROP TRIGGER IF EXISTS `insert_order_url`;
DELIMITER //
CREATE TRIGGER `insert_order_url` BEFORE INSERT ON `cms_menu_urls`
 FOR EACH ROW SET NEW.url_order = (SELECT max(url_order) FROM cms_menu_urls WHERE menu_id = NEW.menu_id)
//
DELIMITER ;



--
-- Triggers `uploads`
--
DROP TRIGGER IF EXISTS `delete_upload_object`;
DELIMITER //
CREATE TRIGGER `delete_upload_object` AFTER DELETE ON `uploads`
 FOR EACH ROW DELETE FROM upload_objects WHERE upload_id = OLD.upload_id
//
DELIMITER ;


--
-- Triggers `upload_objects`
--
DROP TRIGGER IF EXISTS `insert_order_object`;
DELIMITER //
CREATE TRIGGER `insert_order_object` BEFORE INSERT ON `upload_objects`
 FOR EACH ROW SET NEW.object_order = (SELECT max(object_order) FROM upload_objects WHERE object_name = NEW.object_name AND object_id = NEW.object_id)
//
DELIMITER ;
