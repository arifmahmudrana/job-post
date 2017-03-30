<?php
require_once __DIR__ . '/ExternalLibs/sparrow.php';
$dbConfigs = require_once __DIR__ . '/config/database.php';
$db = new \Sparrow();
$db->setDb($dbConfigs);
$db->sql('DROP TABLE IF EXISTS `jobs`')->execute();
$db->sql('CREATE TABLE `jobs` (
              `id` int(10) UNSIGNED NOT NULL,
              `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `description` text COLLATE utf8_unicode_ci,
              `status` tinyint(1) UNSIGNED DEFAULT \'0\'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci')
    ->execute();
$db->sql('ALTER TABLE `jobs`
              ADD PRIMARY KEY (`id`)')
    ->execute();
$db->sql('ALTER TABLE `jobs`
              MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT')
    ->execute();