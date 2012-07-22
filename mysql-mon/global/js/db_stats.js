$(function () {

    $(document).ready(function () {
        
      
        ////////
		// Mysql Questions
		////////
        var mysqlQuestionsOptions = {
            chart: {
                renderTo: 'mysql-questions-container',
                type: 'spline'
            },
            title: {
                text: '',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'per second'
                }, min: 0
            },
            series: [{
                name: 'Select'
            },{
            	name: 'Insert'
            },{
            	name: 'Replace'
            },{
            	name: 'Update'
            },{
            	name: 'Delete'
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/questions',
            dataType: "json",
            success: function (data) {
                //init series arays
               	select_arr = [];
                insert_arr = [];
                replace_arr = [];
                update_arr = [];
                delete_arr =[];
                for (i in data) {
                    //build
                    var r = data[i];
                    select_arr.push([r.ts, r.Select_per_second]);
                    insert_arr.push([r.ts, r.Insert_per_second]);
                    replace_arr.push([r.ts, r.Replace_per_second]);
                    update_arr.push([r.ts, r.Update_per_second]);
                    delete_arr.push([r.ts, r.Delete_per_second]);
                }
                //save series
				mysqlQuestionsOptions.series[0].data = select_arr;
				mysqlQuestionsOptions.series[1].data = insert_arr;
				mysqlQuestionsOptions.series[2].data = replace_arr;
				mysqlQuestionsOptions.series[3].data = update_arr;
				mysqlQuestionsOptions.series[4].data = delete_arr;
                
                
                var chart = new Highcharts.Chart(mysqlQuestionsOptions);

            },
            cache: false
        });
        
        
        ////////
		// Mysql Select Sort
		////////
        var mysqlSelectSortOptions = {
            chart: {
                renderTo: 'mysql-select-sort-container',
                type: 'spline'
            },
            title: {
                text: '',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'per second'
                }, min: 0
            },
            series: [{
                name: 'Select Scan'
            },{
            	name: 'Select Range'
            },{
            	name: 'Select Full Join'
            },{
            	name: 'Select Range Check'
            },{
            	name: 'Select Full Range Join'
            },{
            	name: 'Sort Scan'
            },{
            	name: 'Sort Range'
            },{
            	name: 'Sort Merge Passes'
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/select_sort',
            dataType: "json",
            success: function (data) {
                //init series arays
               	select_scan_arr = [];
                select_range_arr = [];
                select_full_join_arr = [];
                select_range_check_arr = [];
                select_full_range_join_arr =[];
				sort_scan_arr =[];
				sort_range_arr =[];
				sort_merge_passes_arr =[];
                for (i in data) {
                    //build
                    var r = data[i];
					select_scan_arr.push([r.ts, r.Select_scan_per_sec]);
					select_range_arr.push([r.ts, r.Select_range_per_sec]);
					select_full_join_arr.push([r.ts, r.Select_full_join_per_sec]);
					select_range_check_arr.push([r.ts, r.Select_range_check_per_sec]);
					select_full_range_join_arr.push([r.ts, r.Select_full_range_join_per_sec]);
					sort_scan_arr.push([r.ts, r.Sort_scan_per_sec]);
					sort_range_arr.push([r.ts, r.Sort_range_per_sec]);
					sort_merge_passes_arr.push([r.ts, r.Sort_merge_passes_per_sec]);
				
                  
                }
                //save series
				mysqlSelectSortOptions.series[0].data = select_scan_arr;
				mysqlSelectSortOptions.series[1].data = select_range_arr;
				mysqlSelectSortOptions.series[2].data = select_full_join_arr;
				mysqlSelectSortOptions.series[3].data = select_range_check_arr;
				mysqlSelectSortOptions.series[4].data = select_full_range_join_arr;
				mysqlSelectSortOptions.series[5].data = sort_scan_arr;
				mysqlSelectSortOptions.series[6].data = sort_range_arr;
				mysqlSelectSortOptions.series[7].data = sort_merge_passes_arr;
			
                var chart = new Highcharts.Chart(mysqlSelectSortOptions);

            },
            cache: false
        });
        
        
        ////////
		// Mysql Connections
		////////
        var mysqlConnectionsOptions = {
            chart: {
                renderTo: 'mysql-connections-container',
                type: 'spline'
            },
            title: {
                text: '',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: [{
                title: {
                    text: 'per second'
                }, min: 0
            },{
                title: {
                    text: 'count'
                }, min: 0,
                opposite: true
            }],
            series: [{
            	name: 'Max Connections',
            	yAxis : 1, type: 'area'
            },{
            	name: 'Max Used Connections',
            	yAxis : 1,  type: 'area'
            },{
            	name: 'Process Count',
            	yAxis : 1,  type: 'area'
            },{
            	name: 'Running Process Count',
            	yAxis : 1
            },{
                name: 'Connection Rate',
                yAxis : 0
            },{
            	name: 'Aborted connects Rate',
            	yAxis : 0
            },{
            	name: 'Aborted clients Rate',
            	yAxis : 0
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/connections',
            dataType: "json",
            success: function (data) {
                //init series arays
               	connections_arr = [];
                aborted_connects_arr = [];
                aborted_clients_arr = [];
                max_used_connections_arr = [];
                max_connections_arr =[];
                process_count_arr = [];
               	running_process_count_arr =[];
                for (i in data) {
                    //build
                    var r = data[i];
                    connections_arr.push([r.ts, r.Connections_per_second]);
		            aborted_connects_arr.push([r.ts, r.Aborted_connects_per_second]);
		            aborted_clients_arr.push([r.ts, r.Aborted_clients_per_second]);
		            max_used_connections_arr.push([r.ts, r.max_used_connections]);
		            max_connections_arr.push([r.ts, r.max_connections]);
		            process_count_arr.push([r.ts, r.process_count]);
		           	running_process_count_arr.push([r.ts, r.process_count_non_sleep]);                
                }
                //save series
				mysqlConnectionsOptions.series[4].data = connections_arr;
				mysqlConnectionsOptions.series[5].data = aborted_connects_arr;
				mysqlConnectionsOptions.series[6].data = aborted_clients_arr;
				mysqlConnectionsOptions.series[0].data = max_connections_arr;
				mysqlConnectionsOptions.series[1].data = max_used_connections_arr;
                mysqlConnectionsOptions.series[2].data = process_count_arr;
				mysqlConnectionsOptions.series[3].data = running_process_count_arr;
                
                var chart = new Highcharts.Chart(mysqlConnectionsOptions);

            },
            cache: false
        });
        
        ////////
		// Mysql Bytes
		////////
        var mysqlBytesOptions = {
            chart: {
                renderTo: 'mysql-bytes-container',
                type: 'spline'
            },
            title: {
                text: '',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'kBps'
                }, min: 0
            },
            series: [{
                name: 'Sent'
            },{
            	name: 'Recieved'
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/bytes',
            dataType: "json",
            success: function (data) {
                //init series arays
               	sent = [];
                recieved =[];
                for (i in data) {
                    //build
                    var r = data[i];
                    sent.push([r.ts, r.kBps_sent]);
                    recieved.push([r.ts, r.kBps_recieved]);
                }
                //save series
                mysqlBytesOptions.series[0].data = sent;
                mysqlBytesOptions.series[1].data = recieved;
                var chart = new Highcharts.Chart(mysqlBytesOptions);

            },
            cache: false
        });
        
        ////////
		// Mysql Temp
		////////
        var mysqlTempOptions = {
            chart: {
                renderTo: 'mysql-temp-container',
                type: 'spline'
            },
            title: {
                text: '',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'per minute'
                }, min: 0
            },
            series: [{
                name: 'Created Tmp Disk Tables'
            },{
            	name: 'Created Tmp Tables'
            },{
            	name: 'Created Tmp Files'
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/temp',
            dataType: "json",
            success: function (data) {
                //init series arays
               	tmp_disk_tables = [];
                tmp_tables = [];
                tmp_files = [];
                for (i in data) {
                    //build
                    var r = data[i];
                    tmp_disk_tables.push([r.ts, r.Created_tmp_disk_tables_per_min]);
                    tmp_tables.push([r.ts, r.Created_tmp_tables_per_min]);
                    tmp_files.push([r.ts, r.Created_tmp_files_per_min]);
                
                }
                //save series
                mysqlTempOptions.series[0].data = tmp_disk_tables;
                mysqlTempOptions.series[1].data = tmp_tables;
                mysqlTempOptions.series[2].data = tmp_files;
                var chart = new Highcharts.Chart(mysqlTempOptions);

            },
            cache: false
        });
        
        ////////
		// Mysql Table Locks
		////////
        var mysqlTableLocksOptions = {
            chart: {
                renderTo: 'mysql-table-locks-container',
                type: 'spline'
            },
            title: {
                text: '',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'per second'
                }, min: 0
            },
            series: [{
                name: 'Table locks wait'
            },{
            	name: 'Table locks immediate'
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/table_locks',
            dataType: "json",
            success: function (data) {
                //init series arays
               	wait = [];
                immediate = [];
                for (i in data) {
                    //build
                    var r = data[i];
                    wait.push([r.ts, r.Table_locks_wait_per_sec]);
                    immediate.push([r.ts, r.Table_locks_immediate_per_sec]);
                }
                //save series
                mysqlTableLocksOptions.series[0].data = wait;
                mysqlTableLocksOptions.series[1].data = immediate;
                var chart = new Highcharts.Chart(mysqlTableLocksOptions);

            },
            cache: false
        });
        
        ////////
		// Mysql Innodb Buffer Pool Usage
		////////
        var mysqlInnoDBBPOptions = {
            chart: {
                renderTo: 'mysql-innodb-bp-container',
                type: 'area'
            },
            title: {
                text: 'Buffer Pool Usage',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: [{
                title: {
                    text: 'MBytes'
                }, min: 0
            },{
             title: {
                    text: 'Hit Rate %'
                }, min: 0,  max: 100, opposite: true
            }],
            series: [{
                name: 'Buffer Pool Total'
            },{
            	name: 'Buffer Pool Used'
            },{
            	name: 'Read Hit Rate', type: 'spline', yAxis: 1
            }]
        };
        
        
        ////////
		// Mysql Innodb 
		////////
        var mysqlInnoDBOptions = {
            chart: {
                renderTo: 'mysql-innodb-container',
                type: 'spline'
            },
            title: {
                text: 'InnoDB Stats',
                x: -20 //center
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'per second'
                }, min: 0
            },
            series: [{
                name: 'Buffer Pool Read Request'
            },{
            	name: 'Buffer Pool Reads'
            },{
            	name: 'Buffer Pool Read Ahead Rnd'
            },{
            	name: 'Buffer Pool Read Ahead Seq'
            },{
            	name: 'Buffer Pool Write Request'
            },{
            	name: 'Buffer Pool Pages Flushed'
            },{
            	name: 'Buffer Pool Wait Free'
            },{
            	name: 'Row Lock Waits'
            },{
            	name: 'Data Reads'
            },{
            	name: 'Data Writes'
            },{
            	name: 'Data Fsyncs'
            },{
            	name: 'Pages Created'
            },{
            	name: 'Pages Read'
            },{
            	name: 'Pages Written'
            },{
            	name: 'Rows Deleted'
            },{
            	name: 'Rows Inserted'
            },{
            	name: 'Rows Read'
            },{
            	name: 'Rows Updated'
            }]
        };
        
        $.ajax({
            url: 'stats/mysql/innodb',
            dataType: "json",
            success: function (data) {
                //init series arays
                bp_used = [];
                bp_total = [];
                bp_read_ratio = [];
                bp_read_requests = [];
                bp_reads = []
                bp_read_rnd = [];
                bp_read_seq = [];
                bp_write_req = [];
                bp_pages_flush = [];
                bp_wait_free = [];
                row_lock_waits = [];
                data_reads = [];
                data_write = [];
                data_fsyncs = [];
                pages_created = [];
                pages_read = [];
                pages_written = [];
                rows_deleted = [];
                rows_inserted = [];
                rows_read = [];
                rows_updated = [];

                for (i in data) {
                    //build
                    var r = data[i];
                    bp_used.push([r.ts, r.Innodb_buffer_pool_used_mb]);
			        bp_total.push([r.ts, r.Innodb_buffer_pool_total_mb]);
			        bp_read_ratio.push([r.ts, r.Innodb_buffer_pool_read_ratio]);
			        bp_read_requests.push([r.ts, r.Innodb_buffer_pool_read_requests_per_second]);
			        bp_reads.push([r.ts, r.Innodb_buffer_pool_reads_per_second]);
			        bp_read_rnd.push([r.ts, r.Innodb_buffer_pool_read_ahead_rnd_per_second]);
			        bp_read_seq.push([r.ts, r.Innodb_buffer_pool_read_ahead_seq_per_second]);
			        bp_write_req.push([r.ts, r.Innodb_buffer_pool_write_requests_per_second]);
			        bp_pages_flush.push([r.ts, r.Innodb_buffer_pool_pages_flushed_per_second]);
			        bp_wait_free.push([r.ts, r.Innodb_buffer_pool_wait_free_per_second]);
			        row_lock_waits.push([r.ts, r.Innodb_row_lock_waits_per_second]);
			        data_reads.push([r.ts, r.Innodb_data_reads_per_second]);
			        data_write.push([r.ts, r.Innodb_data_writes_per_second]);
			        data_fsyncs.push([r.ts, r.Innodb_data_fsyncs_per_second]);
			        pages_created.push([r.ts, r.Innodb_pages_created_per_second]);
			        pages_read.push([r.ts, r.Innodb_pages_read_per_second]);
			        pages_written.push([r.ts, r.Innodb_pages_written_per_second]);
			        rows_deleted.push([r.ts, r.Innodb_rows_deleted_per_second]);
			        rows_inserted.push([r.ts, r.Innodb_rows_inserted_per_second]);
			        rows_read.push([r.ts, r.Innodb_rows_read_per_second]);
			        rows_updated.push([r.ts, r.Innodb_rows_updated_per_second]);
                   
                }
                //save series
                mysqlInnoDBBPOptions.series[1].data = bp_used;
                mysqlInnoDBBPOptions.series[0].data = bp_total;
                mysqlInnoDBBPOptions.series[2].data =  bp_read_ratio;
                
                mysqlInnoDBOptions.series[0].data = bp_read_requests;
                mysqlInnoDBOptions.series[1].data = bp_reads;
                mysqlInnoDBOptions.series[2].data = bp_read_rnd;
                mysqlInnoDBOptions.series[3].data = bp_read_seq;
                mysqlInnoDBOptions.series[4].data = bp_write_req;
                mysqlInnoDBOptions.series[5].data = bp_pages_flush;
                mysqlInnoDBOptions.series[6].data = bp_wait_free;
                mysqlInnoDBOptions.series[7].data = row_lock_waits;
                mysqlInnoDBOptions.series[8].data = data_reads;
                mysqlInnoDBOptions.series[9].data = data_write;
                mysqlInnoDBOptions.series[10].data = data_fsyncs;
                mysqlInnoDBOptions.series[11].data = pages_created;
                mysqlInnoDBOptions.series[12].data = pages_read;
                mysqlInnoDBOptions.series[13].data = pages_written;
                mysqlInnoDBOptions.series[14].data = rows_deleted;
                mysqlInnoDBOptions.series[15].data = rows_inserted;
                mysqlInnoDBOptions.series[16].data = rows_updated;
                
                var chart = new Highcharts.Chart(mysqlInnoDBBPOptions);
				chart = new Highcharts.Chart(mysqlInnoDBOptions);
            },
            cache: false
        });
	});
});


$(document).scroll(function(){
    // If has not activated (has no attribute "data-top"
    if (!$('.subnav').attr('data-top')) {
        // If already fixed, then do nothing
        if ($('.subnav').hasClass('subnav-fixed')) return;
        // Remember top position
        var offset = $('.subnav').offset();
        $('.subnav').attr('data-top', offset.top);
    }

    if ($('.subnav').attr('data-top') - $('.subnav').outerHeight() <= $(this).scrollTop())
        $('.subnav').addClass('subnav-fixed');
    else
        $('.subnav').removeClass('subnav-fixed');
});

