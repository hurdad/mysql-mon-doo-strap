<?php

class DBStatsRESTController extends DooController {
	


	function mysql_questions(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts, 
			ROUND(Com_select / secondsDelta, 2) as Select_per_second,
			ROUND((Com_insert + Com_insert_select) / secondsDelta, 2) as Insert_per_second,
			ROUND((Com_replace + Com_replace_select) / secondsDelta, 2) as Replace_per_second,  
			ROUND((Com_update + Com_update_multi) / secondsDelta, 2) as Update_per_second, 
			ROUND((Com_delete + Com_delete_multi) / secondsDelta, 2) as Delete_per_second
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(SECOND, a.timestamp, b.timestamp) AS secondsDelta,
				b.Com_select - a.Com_select as Com_select,
				b.Com_insert - a.Com_insert as Com_insert,
				b.Com_insert_select - a.Com_insert_select as Com_insert_select,
				b.Com_replace - a.Com_replace as Com_replace,
				b.Com_replace_select - a.Com_replace_select as Com_replace_select,
				b.Com_update - a.Com_update as Com_update,
				b.Com_update_multi - a.Com_update_multi as Com_update_multi,
				b.Com_delete - a.Com_delete as Com_delete,
				b.Com_delete_multi - a.Com_delete_multi as Com_delete_multi
			FROM
				mysql_questions a
			INNER JOIN mysql_questions b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);
	}

	function mysql_bytes(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts,
			ROUND(kBytes_sent / secondsDelta, 2) AS kBps_sent,
			ROUND(kBytes_recieved / secondsDelta, 2) AS kBps_recieved
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(SECOND, a.timestamp, b.timestamp) AS secondsDelta,
				(b.Bytes_sent - a.Bytes_sent) / 1024 as kBytes_sent,
				(b.Bytes_received - a.Bytes_received) / 1024 as kBytes_recieved
			FROM
				mysql_bytes a
			INNER JOIN mysql_bytes b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);
	}

	function mysql_connections(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts,
			ROUND(Connections / secondsDelta, 2) AS Connections_per_second,
			ROUND(Aborted_connects / secondsDelta, 2) AS Aborted_connects_per_second,
			ROUND(Aborted_clients / secondsDelta, 2) AS Aborted_clients_per_second,
			max_used_connections, max_connections, process_count, process_count_non_sleep
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(SECOND, a.timestamp, b.timestamp) AS secondsDelta,
				b.max_used_connections, b.max_connections, b.process_count, b.process_count_non_sleep,
				b.Connections - a.Connections as Connections,
				b.Aborted_connects - a.Aborted_connects as Aborted_connects,
				b.Aborted_clients - a.Aborted_clients as Aborted_clients
			FROM
				mysql_connections a
			INNER JOIN mysql_connections b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);
	}

	function mysql_select_sort(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts,
			ROUND(Select_scan / secondsDelta, 2) AS Select_scan_per_sec,
			ROUND(Select_range / secondsDelta, 2) AS Select_range_per_sec,
			ROUND(Select_full_join / secondsDelta, 2) AS Select_full_join_per_sec,
			ROUND(Select_range_check / secondsDelta, 2) AS Select_range_check_per_sec,
			ROUND(Select_full_range_join / secondsDelta, 2) AS Select_full_range_join_per_sec,
			ROUND(Sort_scan / secondsDelta, 2) AS Sort_scan_per_sec,
			ROUND(Sort_range / secondsDelta, 2) AS Sort_range_per_sec,
			ROUND(Sort_merge_passes / secondsDelta, 2) AS Sort_merge_passes_per_sec
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(SECOND, a.timestamp, b.timestamp) AS secondsDelta,
				TIMESTAMPDIFF(MINUTE, a.timestamp, b.timestamp) AS minutesDelta,
				b.Select_scan - a.Select_scan as Select_scan,
				b.Select_range - a.Select_range as Select_range,
				b.Select_full_join - a.Select_full_join as Select_full_join,
				b.Select_range_check - a.Select_range_check as Select_range_check,
				b.Select_full_range_join - a.Select_full_range_join as Select_full_range_join,
				b.Sort_scan - a.Sort_scan as Sort_scan,
				b.Sort_range - a.Sort_range As Sort_range,
				b.Sort_merge_passes - a.Sort_merge_passes as Sort_merge_passes
			FROM
				mysql_select_sort a
			INNER JOIN mysql_select_sort b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);
	}
	
	function mysql_table_locks(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts,
			ROUND(Table_locks_waited / secondsDelta, 2) AS Table_locks_wait_per_sec,
			ROUND(Table_locks_immediate / secondsDelta, 2) AS Table_locks_immediate_per_sec
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(SECOND, a.timestamp, b.timestamp) AS secondsDelta,
				b.Table_locks_waited - a.Table_locks_waited as Table_locks_waited,
				b.Table_locks_immediate - a.Table_locks_immediate as Table_locks_immediate
			FROM
				mysql_table_locks a
			INNER JOIN mysql_table_locks b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);
	}

	function mysql_temp(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts,
			ROUND(Created_tmp_disk_tables / minutesDelta, 2) AS Created_tmp_disk_tables_per_min,
			ROUND(Created_tmp_tables / minutesDelta, 2) AS Created_tmp_tables_per_min,
			ROUND(Created_tmp_files / minutesDelta, 2) AS Created_tmp_files_per_min
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(MINUTE, a.timestamp, b.timestamp) AS minutesDelta,
				b.Created_tmp_disk_tables - a.Created_tmp_disk_tables as Created_tmp_disk_tables,
				b.Created_tmp_tables - a.Created_tmp_tables as Created_tmp_tables,
				b.Created_tmp_files - a.Created_tmp_files as Created_tmp_files

			FROM
				mysql_temp a
			INNER JOIN mysql_temp b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);
	}
	
	function mysql_innodb(){
		$sql = "SELECT 
			UNIX_TIMESTAMP(timestamp) * 1000 AS ts,
			ROUND((Innodb_buffer_pool_pages_total - Innodb_buffer_pool_pages_free) * Innodb_page_size / 1024 / 1024, 2) as Innodb_buffer_pool_used_mb,
			ROUND(Innodb_buffer_pool_pages_total * Innodb_page_size / 1024 / 1024, 2) as Innodb_buffer_pool_total_mb,
			ROUND(100 - (Innodb_buffer_pool_reads / Innodb_buffer_pool_read_requests) * 100, 2) as Innodb_buffer_pool_read_ratio,
			ROUND(Innodb_buffer_pool_read_requests / secondsDelta, 2) AS Innodb_buffer_pool_read_requests_per_second,
			ROUND(Innodb_buffer_pool_reads / secondsDelta, 2) AS Innodb_buffer_pool_reads_per_second,
			ROUND(Innodb_buffer_pool_read_ahead_rnd / secondsDelta, 2) AS Innodb_buffer_pool_read_ahead_rnd_per_second,
			ROUND(Innodb_buffer_pool_read_ahead_seq / secondsDelta, 2) AS Innodb_buffer_pool_read_ahead_seq_per_second,
			ROUND(Innodb_buffer_pool_write_requests / secondsDelta, 2) AS Innodb_buffer_pool_write_requests_per_second,
			ROUND(Innodb_buffer_pool_pages_flushed / secondsDelta, 2)  AS Innodb_buffer_pool_pages_flushed_per_second,
			ROUND(Innodb_buffer_pool_wait_free / secondsDelta, 2) AS Innodb_buffer_pool_wait_free_per_second,
			ROUND(Innodb_row_lock_waits / secondsDelta, 2) as Innodb_row_lock_waits_per_second,
			ROUND(Innodb_data_reads / secondsDelta, 2) as Innodb_data_reads_per_second,
			ROUND(Innodb_data_writes / secondsDelta, 2) as Innodb_data_writes_per_second,
			ROUND(Innodb_data_fsyncs / secondsDelta, 2) as Innodb_data_fsyncs_per_second,
			ROUND(Innodb_pages_created / secondsDelta, 2) as Innodb_pages_created_per_second,
			ROUND(Innodb_pages_read / secondsDelta, 2) as Innodb_pages_read_per_second,
			ROUND(Innodb_pages_written / secondsDelta, 2) as Innodb_pages_written_per_second,
			ROUND(Innodb_rows_deleted / secondsDelta, 2) as Innodb_rows_deleted_per_second,
			ROUND(Innodb_rows_inserted / secondsDelta, 2) as Innodb_rows_inserted_per_second,
			ROUND(Innodb_rows_read / secondsDelta, 2) as Innodb_rows_read_per_second,
			ROUND(Innodb_rows_updated / secondsDelta, 2) as Innodb_rows_updated_per_second
		FROM
			(SELECT 
				b.timestamp,
				TIMESTAMPDIFF(SECOND, a.timestamp, b.timestamp) AS secondsDelta,
				TIMESTAMPDIFF(MINUTE, a.timestamp, b.timestamp) AS minutesDelta,
				b.Innodb_buffer_pool_pages_total, b.Innodb_buffer_pool_pages_free, b.Innodb_page_size,
				b.Innodb_buffer_pool_read_requests - a.Innodb_buffer_pool_read_requests as Innodb_buffer_pool_read_requests,
				b.Innodb_buffer_pool_reads - a.Innodb_buffer_pool_reads as Innodb_buffer_pool_reads,
				b.Innodb_buffer_pool_read_ahead_rnd - a.Innodb_buffer_pool_read_ahead_rnd as Innodb_buffer_pool_read_ahead_rnd,
				b.Innodb_buffer_pool_read_ahead_seq - a.Innodb_buffer_pool_read_ahead_seq as Innodb_buffer_pool_read_ahead_seq,
				b.Innodb_buffer_pool_write_requests - a.Innodb_buffer_pool_write_requests as Innodb_buffer_pool_write_requests,
				b.Innodb_buffer_pool_pages_flushed - a.Innodb_buffer_pool_pages_flushed as Innodb_buffer_pool_pages_flushed,
				b.Innodb_buffer_pool_wait_free - a.Innodb_buffer_pool_wait_free as Innodb_buffer_pool_wait_free,
				b.Innodb_row_lock_waits - a.Innodb_row_lock_waits as Innodb_row_lock_waits,
				b.Innodb_data_reads - a.Innodb_data_reads as Innodb_data_reads,
				b.Innodb_data_writes - a.Innodb_data_writes as Innodb_data_writes,
				b.Innodb_data_fsyncs - a.Innodb_data_fsyncs as Innodb_data_fsyncs,
				b.Innodb_pages_created - a.Innodb_pages_created as Innodb_pages_created,
				b.Innodb_pages_read - a.Innodb_pages_read as Innodb_pages_read,
				b.Innodb_pages_written - a.Innodb_pages_written as Innodb_pages_written,
				b.Innodb_rows_deleted - a.Innodb_rows_deleted as Innodb_rows_deleted,
				b.Innodb_rows_inserted - a.Innodb_rows_inserted as Innodb_rows_inserted,
				b.Innodb_rows_read - a.Innodb_rows_read as Innodb_rows_read,
				b.Innodb_rows_updated - a.Innodb_rows_updated as Innodb_rows_updated
		FROM
				mysql_innodb a
			INNER JOIN mysql_innodb b ON a.id = b.id - 1
			WHERE
				b.id > 0 AND b.timestamp BETWEEN NOW() - INTERVAL 6 HOUR AND NOW()
			ORDER BY b.id ASC) a";
		$res = Doo::db()->fetchAll($sql);
		$this->contentType('json');
		echo json_encode($res,  JSON_NUMERIC_CHECK);	
	}
}
