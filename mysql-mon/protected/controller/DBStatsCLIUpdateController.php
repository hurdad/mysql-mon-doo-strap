<?php

class DBStatsCLIUpdateController extends DooCliController {

	function mysql(){

		//build stats hash
		foreach(Doo::db()->fetchAll("SHOW GLOBAL STATUS") as $stat){
			$variable_name = $stat["Variable_name"];
			$value 	  	   = $stat["Value"];
			$stats[	$variable_name ] = $value;
		}
		
		//build vars hash
		foreach(Doo::db()->fetchAll("SHOW VARIABLES") as $var){
			$variable_name = $var["Variable_name"];
			$value 	  	   = $var["Value"];
			$vars[	$variable_name ] = $value;
		}
		
		//process
		$proc_non_sleep = Doo::db()->fetchRow("SELECT 
			COUNT(*) as count
		FROM
			INFORMATION_SCHEMA.PROCESSLIST
		WHERE
			COMMAND <> 'Sleep'");
		$proc = Doo::db()->fetchRow("SELECT COUNT(*) as count FROM INFORMATION_SCHEMA.PROCESSLIST");
		//counts
		$process_count_non_sleep = $proc_non_sleep["count"];
		$process_count = $proc["count"];
		
		//start transaction
		Doo::db()->beginTransaction();
	
		//Questions
		$Com_select = $stats["Com_select"];
		$Com_insert = $stats["Com_insert"];
		$Com_insert_select = $stats["Com_insert_select"]; 
		$Com_replace = $stats["Com_replace"];
		$Com_replace_select = $stats["Com_replace_select"];
		$Com_update = $stats["Com_update"];
		$Com_update_multi = $stats["Com_update_multi"];
		$Com_delete = $stats["Com_delete"];
		$Com_delete_multi = $stats["Com_delete_multi"];
		Doo::db()->query("INSERT INTO mysql_questions ( Com_select, Com_insert, Com_insert_select, Com_replace, Com_replace_select, Com_update, Com_update_multi, Com_delete, Com_delete_multi ) VALUES( $Com_select, $Com_insert, $Com_insert_select, $Com_replace, $Com_replace_select, $Com_update, $Com_update_multi, $Com_delete, $Com_delete_multi)");

		//Connections
		$Max_used_connections = $stats["Max_used_connections"];
		$Connections  = $stats["Connections"];
		$Aborted_connects  = $stats["Aborted_connects"];
		$Aborted_clients = $stats["Aborted_clients"];
		$max_connections = $vars["max_connections"];
		
		Doo::db()->query("INSERT INTO mysql_connections ( Max_used_connections, Connections, Aborted_connects, Aborted_clients, max_connections, process_count, process_count_non_sleep ) VALUES ( $Max_used_connections, $Connections, $Aborted_connects, $Aborted_clients, $max_connections, $process_count, $process_count_non_sleep )");

		//Bytes
		$Bytes_sent 	= $stats["Bytes_sent"]; 
		$Bytes_received = $stats["Bytes_received"]; 
		Doo::db()->query("INSERT INTO mysql_bytes ( Bytes_sent, Bytes_received ) VALUES ( $Bytes_sent, $Bytes_received )");

		//Temp
		$Created_tmp_disk_tables = $stats["Created_tmp_disk_tables"]; 
		$Created_tmp_tables = $stats["Created_tmp_tables"];
		$Created_tmp_files  = $stats["Created_tmp_files"]; 
		$tmp_table_size = $vars["tmp_table_size"];
		Doo::db()->query("INSERT INTO mysql_temp ( Created_tmp_disk_tables, Created_tmp_tables, Created_tmp_files, tmp_table_size ) VALUES ( $Created_tmp_disk_tables, $Created_tmp_tables, $Created_tmp_files, $tmp_table_size )");

		//Table Locks
		$Table_locks_waited = $stats["Table_locks_waited"];
		$Table_locks_immediate = $stats["Table_locks_immediate"];
		Doo::db()->query("INSERT INTO mysql_table_locks ( Table_locks_waited, Table_locks_immediate ) VALUES ( $Table_locks_waited, $Table_locks_immediate )");
		
		//Select Sort
		$Select_scan = $stats["Select_scan"]; 
		$Select_range  = $stats["Select_range"];
		$Select_full_join  = $stats["Select_full_join"];
		$Select_range_check  = $stats["Select_range_check"];
		$Select_full_range_join  = $stats["Select_full_range_join"];
		$Sort_scan  = $stats["Sort_scan"];
		$Sort_range = $stats["Sort_range"];
		$Sort_merge_passes  = $stats["Sort_merge_passes"]; 
		Doo::db()->query("INSERT INTO mysql_select_sort ( Select_scan, Select_range, Select_full_join, Select_range_check, Select_full_range_join, Sort_scan, Sort_range, Sort_merge_passes )
VALUES ( $Select_scan, $Select_range, $Select_full_join, $Select_range_check, $Select_full_range_join, $Sort_scan, $Sort_range, $Sort_merge_passes )");

		//InnoDB
		$Innodb_page_size = $stats["Innodb_page_size"]; 
		$Innodb_buffer_pool_pages_data = $stats["Innodb_buffer_pool_pages_data"]; 
		$Innodb_buffer_pool_pages_dirty = $stats["Innodb_buffer_pool_pages_dirty"];  
		$Innodb_buffer_pool_pages_latched = isset($stats["Innodb_buffer_pool_pages_latched"]) ? $stats["Innodb_buffer_pool_pages_latched"] : 0 ; 
		$Innodb_buffer_pool_pages_free = $stats["Innodb_buffer_pool_pages_free"];
		$Innodb_buffer_pool_pages_misc = $stats["Innodb_buffer_pool_pages_misc"];
		$Innodb_buffer_pool_pages_total = $stats["Innodb_buffer_pool_pages_total"];
		$Innodb_row_lock_current_waits = $stats["Innodb_row_lock_current_waits"];
		$Innodb_row_lock_time_avg = $stats["Innodb_row_lock_time_avg"];
		$Innodb_row_lock_time_max = $stats["Innodb_row_lock_time_max"]; 
		
		$Innodb_row_lock_time = $stats["Innodb_row_lock_time"]; 
		$Innodb_row_lock_waits = $stats["Innodb_row_lock_waits"]; 
		
		$Innodb_buffer_pool_read_requests = $stats["Innodb_buffer_pool_read_requests"]; 
		$Innodb_buffer_pool_reads = $stats["Innodb_buffer_pool_reads"];
		$Innodb_buffer_pool_read_ahead_rnd = $stats["Innodb_buffer_pool_read_ahead_rnd"]; 
		$Innodb_buffer_pool_read_ahead_seq = isset($stats["Innodb_buffer_pool_read_ahead_seq"]) ? $stats["Innodb_buffer_pool_read_ahead_seq"] : 0 ;
		$Innodb_buffer_pool_write_requests = $stats["Innodb_buffer_pool_write_requests"];
		$Innodb_buffer_pool_pages_flushed = $stats["Innodb_buffer_pool_pages_flushed"];
		$Innodb_buffer_pool_wait_free = $stats["Innodb_buffer_pool_wait_free"];
		$Innodb_pages_created = $stats["Innodb_pages_created"];
		$Innodb_pages_read = $stats["Innodb_pages_read"];
		$Innodb_pages_written = $stats["Innodb_pages_written"]; 
		$Innodb_rows_deleted = $stats["Innodb_rows_deleted"]; 
		$Innodb_rows_inserted = $stats["Innodb_rows_inserted"];
		$Innodb_rows_read = $stats["Innodb_rows_read"];
		$Innodb_rows_updated = $stats["Innodb_rows_updated"]; 
		$Innodb_data_reads = $stats["Innodb_data_reads"];
		$Innodb_data_writes = $stats["Innodb_data_writes"]; 
		$Innodb_data_fsyncs = $stats["Innodb_data_fsyncs"]; 
		$Innodb_data_pending_reads = $stats["Innodb_data_pending_reads"];
		$Innodb_data_pending_writes = $stats["Innodb_data_pending_writes"]; 
		$Innodb_data_pending_fsyncs = $stats["Innodb_data_pending_fsyncs"];
		Doo::db()->query("INSERT INTO mysql_innodb 
( Innodb_page_size, Innodb_buffer_pool_pages_data, Innodb_buffer_pool_pages_dirty, Innodb_buffer_pool_pages_latched, Innodb_buffer_pool_pages_free, Innodb_buffer_pool_pages_misc, Innodb_buffer_pool_pages_total, Innodb_row_lock_current_waits, Innodb_row_lock_time_avg, Innodb_row_lock_time_max, Innodb_row_lock_time, Innodb_row_lock_waits, Innodb_buffer_pool_read_requests, Innodb_buffer_pool_reads, Innodb_buffer_pool_read_ahead_rnd, Innodb_buffer_pool_read_ahead_seq, Innodb_buffer_pool_write_requests, Innodb_buffer_pool_pages_flushed, Innodb_buffer_pool_wait_free, Innodb_pages_created, Innodb_pages_read, Innodb_pages_written, Innodb_rows_deleted, Innodb_rows_inserted, Innodb_rows_read, Innodb_rows_updated, Innodb_data_reads, Innodb_data_writes, Innodb_data_fsyncs, Innodb_data_pending_reads, Innodb_data_pending_writes, Innodb_data_pending_fsyncs ) VALUES ($Innodb_page_size, $Innodb_buffer_pool_pages_data, $Innodb_buffer_pool_pages_dirty, $Innodb_buffer_pool_pages_latched, $Innodb_buffer_pool_pages_free, $Innodb_buffer_pool_pages_misc, $Innodb_buffer_pool_pages_total, $Innodb_row_lock_current_waits, $Innodb_row_lock_time_avg, $Innodb_row_lock_time_max, $Innodb_row_lock_time, $Innodb_row_lock_waits, $Innodb_buffer_pool_read_requests, $Innodb_buffer_pool_reads, $Innodb_buffer_pool_read_ahead_rnd, $Innodb_buffer_pool_read_ahead_seq, $Innodb_buffer_pool_write_requests, $Innodb_buffer_pool_pages_flushed, $Innodb_buffer_pool_wait_free, $Innodb_pages_created, $Innodb_pages_read, $Innodb_pages_written, $Innodb_rows_deleted, $Innodb_rows_inserted, $Innodb_rows_read, $Innodb_rows_updated, $Innodb_data_reads, $Innodb_data_writes, $Innodb_data_fsyncs, $Innodb_data_pending_reads, $Innodb_data_pending_writes, $Innodb_data_pending_fsyncs )");

		//commit updates
		Doo::db()->commit();

	}
}
?>
