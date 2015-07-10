<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
-- DROP TABLE IF EXISTS {$this->getTable('massmail')};
CREATE TABLE {$this->getTable('massmail')} (
  `massmail_id` int(11) unsigned NOT NULL auto_increment,
  `template_id` varchar(255) NOT NULL default '',
  `template_name` varchar(255) NOT NULL default '',
  `fromemail` varchar(255) NOT NULL default '',
  `reply` varchar(255) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',  
  `description` text NOT NULL default '',  
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`massmail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
    ");
 
$installer->endSetup();