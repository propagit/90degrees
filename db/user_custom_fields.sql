-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--
DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `required` tinyint(4) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT '',
  `inline` enum('true','false') NOT NULL DEFAULT 'false',
  `multiple` enum('true','false') NOT NULL DEFAULT 'false',
  `attributes` text NOT NULL,
  `field_order` tinyint(4) NOT NULL COMMENT 'order of the form',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`field_id`, `type`, `required`, `label`, `placeholder`, `inline`, `multiple`, `attributes`, `field_order`, `created`) VALUES
(1, 'select', 1, 'How did you hear about us?', '', 'false', 'false', '["Google","Facebook","Friends","Advertisements"]', 1, '2014-08-19 14:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_fields`
--
DROP TABLE IF EXISTS `user_custom_fields`;
CREATE TABLE IF NOT EXISTS `user_custom_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `field_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_custom_fields`
--

INSERT INTO `user_custom_fields` (`id`, `user_id`, `field_id`, `value`) VALUES
(1, 2, 1, 'Facebook');
