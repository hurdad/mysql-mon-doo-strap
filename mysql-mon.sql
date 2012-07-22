SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `mysql-mon` ;

CREATE SCHEMA IF NOT EXISTS `mysql-mon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

USE `mysql-mon`;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_questions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Com_select` BIGINT(20) NOT NULL ,
  `Com_insert` BIGINT(20) NOT NULL ,
  `Com_insert_select` BIGINT(20) NOT NULL ,
  `Com_replace` BIGINT(20) NOT NULL ,
  `Com_replace_select` BIGINT(20) NOT NULL ,
  `Com_update` BIGINT(20) NOT NULL ,
  `Com_update_multi` BIGINT(20) NOT NULL ,
  `Com_delete` BIGINT(20) NOT NULL ,
  `Com_delete_multi` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_Unique` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_innodb` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Innodb_page_size` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_data` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_dirty` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_latched` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_free` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_misc` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_total` BIGINT(20) NOT NULL ,
  `Innodb_row_lock_time` BIGINT(20) NOT NULL ,
  `Innodb_row_lock_current_waits` BIGINT(20) NOT NULL ,
  `Innodb_row_lock_time_avg` BIGINT(20) NOT NULL ,
  `Innodb_row_lock_time_max` BIGINT(20) NOT NULL ,
  `Innodb_row_lock_waits` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_read_requests` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_reads` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_read_ahead_rnd` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_read_ahead_seq` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_write_requests` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_pages_flushed` BIGINT(20) NOT NULL ,
  `Innodb_buffer_pool_wait_free` BIGINT(20) NOT NULL ,
  `Innodb_pages_created` BIGINT(20) NOT NULL ,
  `Innodb_pages_read` BIGINT(20) NOT NULL ,
  `Innodb_pages_written` BIGINT(20) NOT NULL ,
  `Innodb_rows_deleted` BIGINT(20) NOT NULL ,
  `Innodb_rows_inserted` BIGINT(20) NOT NULL ,
  `Innodb_rows_read` BIGINT(20) NOT NULL ,
  `Innodb_rows_updated` BIGINT(20) NOT NULL ,
  `Innodb_data_reads` BIGINT(20) NOT NULL ,
  `Innodb_data_writes` BIGINT(20) NOT NULL ,
  `Innodb_data_fsyncs` BIGINT(20) NOT NULL ,
  `Innodb_data_pending_reads` BIGINT(20) NOT NULL ,
  `Innodb_data_pending_writes` BIGINT(20) NOT NULL ,
  `Innodb_data_pending_fsyncs` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_Unique` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_connections` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Max_used_connections` BIGINT(20) NOT NULL ,
  `Connections` BIGINT(20) NOT NULL ,
  `Aborted_connects` BIGINT(20) NOT NULL ,
  `Aborted_clients` BIGINT(20) NOT NULL ,
  `max_connections` BIGINT(20) NOT NULL ,
  `process_count` BIGINT(20) NOT NULL ,
  `process_count_non_sleep` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_Unique` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_temp` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Created_tmp_disk_tables` BIGINT(20) NOT NULL ,
  `Created_tmp_tables` BIGINT(20) NOT NULL ,
  `Created_tmp_files` BIGINT(20) NOT NULL ,
  `tmp_table_size` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_Unique` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_select_sort` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Select_scan` BIGINT(20) NOT NULL ,
  `Select_range` BIGINT(20) NOT NULL ,
  `Select_full_join` BIGINT(20) NOT NULL ,
  `Select_range_check` BIGINT(20) NOT NULL ,
  `Select_full_range_join` BIGINT(20) NOT NULL ,
  `Sort_scan` BIGINT(20) NOT NULL ,
  `Sort_range` BIGINT(20) NOT NULL ,
  `Sort_merge_passes` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_Unique` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_bytes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Bytes_sent` BIGINT(20) NOT NULL ,
  `Bytes_received` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_UNIQUE` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

CREATE  TABLE IF NOT EXISTS `mysql-mon`.`mysql_table_locks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `Table_locks_waited` BIGINT(20) NOT NULL ,
  `Table_locks_immediate` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `timestamp_UNIQUE` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

