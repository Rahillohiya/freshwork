@extends('layouts.master')
<?php
$asset_controls = [
    'datatable', 'sweetalert', 'select2'
];
?>

@section('head')
    <style>
        #sample_1 tr td:first-child {
            padding-right: 0;
        }

        #sample_1 .Polaris-Choice__Control {
            margin: 0 !important;
        }

        @media only screen and (max-width: 768px) {

            .table-scroll {
                width: 100%;
                overflow-x: auto;
            }

            table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before, table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
                top: 28px;
                left: -1px;
            }
        }

        @media only screen and (max-width: 680px) {

            #sample_1 th:first-child, #sample_1 td:first-child {
                padding-left: 4px;
            }
        }

        @media only screen and (max-width: 580px) {
            /*.channel_icon{margin-left: 15px;}*/
        }

        @media only screen and (max-width: 380px) {
            #sample_1 th, #sample_1 td {
                /*padding-left: 0px !important;*/
            }
        }


    </style>
    <link href="{{ URL::asset('css/datatable.css?v=1') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="section-main-heading"
                 style="--top-bar-background:#00848e; --top-bar-color:#f9fafb; --top-bar-background-lighter:#1d9ba4;">
                <h4>Webhook Logs</h4>
            </div>

            <form>
                <div class="row flex-wrap">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Status </label>
                            <select class="form-control select2 webhook_status" id="webhook_status"
                                    name="webhook_status">
                                <option value="">Select status</option>
                                <option value="success">Success</option>
                                <option value="failure">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Triggered At </label>
                            <input type="date" dateformat="yyyy-mm-dd" name="trigger_at" class="form-control"
                                   id="trigger_at" placeholder="Trigger At">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="padding-top: 24px">
                            <button type="button" style="background: #008060 !important;" class="btn btn-success"
                                    onclick="clearLogFilters();">Clear Filters
                            </button>
                        </div>
                    </div>
                </div>

            </form>

            <div>

                @include('partials.top_bar_action_list')
            </div>
            <div class="">
                <div class="">
                    <div class="logs-page table-scroll">
                        <table class="registered-webhook-table responsive table table-hover table-checkable order-column dataTable no-footer dtr-inline"
                               id="sample_1">
                            <thead>
                            <tr class="">
                                <th class="selectAll"></th>
                                <th> Channel</th>
                                <th> Topic Name</th>
                                <th> Status</th>
                                <th> Message</th>
                                <th> Triggered At</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('last_scripts')
    <script type="text/template" id="checkbox-template">
        <label class="Polaris-Choice" for="PolarisCheckbox_@id" style="display:inline-block">
            <span class="Polaris-Choice__Control">
                <span class="Polaris-Checkbox">
                    <input id="PolarisCheckbox_@id" value="@id" type="checkbox" class="Polaris-Checkbox__Input"
                           aria-invalid="false" role="checkbox" aria-checked="false"><span
                            class="Polaris-Checkbox__Backdrop"></span>
                    <span class="Polaris-Checkbox__Icon">
                        <span class="Polaris-Icon">
                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                            </svg>
                        </span></span></span></span>
        </label></script>
    <script type="text/javascript">
        function clearLogFilters() {
            $('#webhook_status').val('');
            $('#trigger_at').val('');
            table.search("").draw();
        }

        $(document).on('click', '.retry-failed-job-button', function () {
            let action_obj = $(this);
            action_obj.attr('disabled', true);
            var url = action_obj.data('retry-action');
            show_loading_img();
            $("#test-action-response").html('');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "<?= Session::token() ?>"
                },
                dataType: "JSON",
                data: [],
                cache: false,
                success: function (response) {
                    hide_loading_img();
                    if (response.retries_left <= 0) {
                        action_obj.hide();
                    }

                    action_obj.attr('disabled', false);
                    if (response.status == "error" || response.status == false) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                    }

                }, error: function (result) {
                    hide_loading_img();
                    toastr.error('Unable to re-trigger webhook.');
                    $('.test-action-response').hide();
                    action_obj.attr('disabled', false);
                },
                timeout: 1000000
            }).fail(function (jqXHR, textStatus) {
                hide_loading_img();
                toastr.error('Unable to re-trigger webhook.');
                $('.test-action-response').hide();
                action_obj.attr('disabled', false);

            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '#delete-logs', function () {
            let log_ids = [];

            if (table.rows('.selected').data().length == 0) {
                toastr.error('Please select the log(s) to delete first.');
            } else {
                let snippet_ids = [];
                $.each(table.rows('.selected').data(), function (key, value) {
                    log_ids.push(value.id);
//
                });

                show_loading_img();
                $.ajax({
                    url: '{{ route('delete_logs') }}',
                    type: 'POST',
                    data: {
                        _method: 'POST',
                        _token: "<?= Session::token() ?>",
                        log_ids: log_ids,

                    },
                    cache: false,
                    success: function (result) {
                        if (result && result.status == 'success') {
                            swal(result.status, result.message, 'success');
                            $('th.selectAll input').prop("checked", false);
                            $("div.top-bar-action-list").toggleClass("hidden");
                            table.draw();
                        } else {

                            swal(result.status, result.message, 'error');

                        }
                        hide_loading_img();
                    }, error: function (response) {
                        swal('Warning', 'Failed to update . Try again !!', 'warning');

                        hide_loading_img();
                    },
                    timeout: 15000
                }).fail(function (jqXHR, textStatus) {
                    if (textStatus === 'timeout') {
                        swal("Sorry", 'Please Wait... Slow connection!', "error");

                    }
                    hide_loading_img();
                });

            }

        });


        $(document).on('click', '.top-bar-action-button', function () {
            $("div.top-bar-action-list").toggleClass("hidden");
        });

        function getExt(filename) {
            return filename.split('.').pop().split("?")[0].split("#")[0];
        }

        var checkboxTemplate = $('#checkbox-template').text();

        function getPolarisCheckbox(id) {
            return checkboxTemplate.replace(/@id/g, id);
        }

        function getFormattedDate() {
            var date = new Date();
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var hour = date.getHours();
            var min = date.getMinutes();
            var sec = date.getSeconds();

            month = (month < 10 ? "0" : "") + month;
            day = (day < 10 ? "0" : "") + day;
            hour = (hour < 10 ? "0" : "") + hour;
            min = (min < 10 ? "0" : "") + min;
            sec = (sec < 10 ? "0" : "") + sec;

            return date.getFullYear() + "-" + month + "-" + day + "_" + hour + ":" + min + ":" + sec;
        }

        $('th.selectAll').html(getPolarisCheckbox('selectAll'))
        var table = $('#sample_1').DataTable(
            {
                processing: true,
                serverSide: true,
                "searching": true,
                "paging": true,
                'bSortable': true,
                "bInfo": true,
                iDisplayLength: 10,
                "lengthChange": true,
//                    dom: 'fBlrtip',
                "autoWidth": false,
                responsive: true,
//                    "dom":' <"search-filter"f><"length-dropdown"l>Brt<"bottom"ip><"clear">',
//                    dom: 'lrtip',
                dom: "Bftlrtip",
                "columnDefs": [
                    {"width": "10px", "targets": 0},
                    {"width": "120px", "targets": 1},
                    {"width": "60px", "targets": 2},
                    {"width": "40px", "targets": 3},
                    {"width": "100px", "targets": 4},
                    {"width": "70px", "targets": 5},
                    {"width": "70px", "targets": 6}
                ],

                buttons: [
                    {
                        extend: 'csv',
                        // title: 'log-report-',
                        filename: function () {
                            return 'log-report-' + getFormattedDate();
                        },
                        text: 'Csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5],
                            modifier: {
                                selected: true
                            }
                        },
                        action: function (e, dt, button, config) {
                            var count = table.rows({selected: true}).count();
                            if (count == 0) {
                                toastr.error('Please select the log(s) to export.');
                                return;
                            }
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                        }
                    },

                    {
                        extend: 'excel',
                        filename: function () {
                            return 'log-report-' + getFormattedDate();
                        },
                        text: 'Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5],
                            modifier: {
                                selected: true,

                            }

                        },
                        action: function (e, dt, button, config) {
                            var count = table.rows({selected: true}).count();
                            if (count == 0) {
                                toastr.error('Please select the log(s) to export.');
                                return;
                            }
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
                        }

                    },
                    {
                        extend: 'pdf',
                        filename: function () {
                            return 'log-report-' + getFormattedDate();
                        },
                        text: 'PDF',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5],
                            modifier: {
                                selected: true
                            }
                        },
                        action: function (e, dt, button, config) {
                            var count = table.rows({selected: true}).count();
                            if (count == 0) {
                                toastr.error('Please select the log(s) to export.');
                                return;
                            }
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5],
                            modifier: {
                                selected: true
                            }
                        },
                        action: function (e, dt, button, config) {
                            var count = table.rows({selected: true}).count();
                            if (count == 0) {
                                toastr.error('Please select the log(s) to export.');
                                return;
                            }
                            $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                        }
                    }

                ],

                sAjaxSource: '{{ route('store_logs') }}',
                "columns": [
                    {
                        "data": "id",
                        orderable: false,
                        targets: 0,
                        'render': function (data, type, row) {
                            return getPolarisCheckbox(row.id);
                        }
                    },
                    {
                        "data": "channel_name",
                        "orderable": true,
                        'render': function (data, type, row) {
                            return '<div class="channel_icon"> <img alt="' + row.channel_name + '"  src="' + row.icon_path + '"  class=""/><a style="text-decoration: none;"  href="javascript:">' + row.channel_name + '</a></div> ' + (row.edit_route ? '<div class="editDell_btn"> <a onclick="show_loading_img()" href="' + row.edit_route + '"  class="snippet-action-btns">Edit Setup</a> </div>' : "");
                        }
                    },
                    {
                        "data": "topic_name"
                        , "orderable": true
                    },

                    {
                        "data": "status"
                        , "orderable": true,
                        'render': function (data, type, row) {
                            return '<span class="Polaris-Badge' + (row.status == false ? ' Polaris-Badge--statusAttention' : ' Polaris-Badge--statusSuccess') + '"> ' + (row.status == false ? ' Failed' : ' Success') + ' </span>'
                        }
                    },
                    {
                        "data": "message"
                        , "orderable": false
                    },

                    {
                        "data": "created_at"
                        , "orderable": true
                    },

                    {
                        "data": "Retry"
                        , "orderable": false,
                        'render': function (data, type, row) {
                            // return row.status == false ? '<button class="btn btn-primary" onclick="retry_failed_webhook('+row.id+')">Retry</button>' : ''
                            // return row.status == false ? '<button class="btn btn-primary retry-failed-job-button" data-retry-action='+row.retry_action+' >Retry</button>' : ''
                            return row.status == false && row.retries_left > 0 ? '<a style="background: #008060 !important;" class="btn btn-success" href=' + row.retry_action + ' >Retry</a>' : ''
                        }
                    }
                ],
                order: [[5, "desc"]],
                language: {
                    paginate: {
                        next: '&#8594;', // or '→'
                        previous: '&#8592;' // or '←'
                    },
                    "emptyTable": "No Logs available.",
                    "sSearch": '<i class="fa fa-search icon-class" aria-hidden="true"></i>',
                    searchPlaceholder: 'Search by name, description or tag',
                    processing: "<small>Loading Logs...</small>",
                    "sLengthMenu": '<span class="per-page-label cc">Per Page</span><select class="per_page_length form-control input-sm input-xsmall input-inline">' +
                        '<option value="10">10</option>' +
                        '<option value="30">30</option>' +
                        '<option value="50">50</option>' +
                        //                        '<option value="-1">All</option>'+
                        '</select>'
                },
                drawCallback: function () {
                    var pageInfo = this.api().page.info();
                    var multiPage = pageInfo.pages > 1;
                    $('#sample_1_paginate').toggle(multiPage);
                    if (!multiPage && pageInfo.recordsTotal == pageInfo.recordsDisplay) {
                        $('#sample_1_info').text('Showing all ' + pageInfo.recordsTotal + ' entries');
                    }
                    if (pageInfo.recordsTotal == 0) {
                        $('#sample_1_info').text('');
                    }
                },
                // highlight ordered column
                orderClasses: false,
                "oSearch": {"sSearch": "{{session('sSearch')}}"},
                "fnServerData": function (sSource, aoData, fnCallback) {
                    $.getJSON(sSource, aoData, function (json) {
                        $('#sample_1').show();
                        fnCallback(json)
                    });
                }, "fnServerParams": function (aoData) {
                    aoData.push(
                        {"name": "webhook_status", "value": $('#webhook_status :selected').val()},
                        {"name": "trigger_at", "value": $('#trigger_at').val()}
                    )
                }
                //                    "dom":' <"search-filter"f><"length-dropdown"l>rt<"bottom"ip><"clear">'
            });

        table.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');


        $("th.selectAll .Polaris-Checkbox__Input").on("click", function (e) {
            if ($(this).is(":checked")) {
                table.rows().select();
                $('#sample_1 tbody .Polaris-Checkbox__Input').prop('checked', true)

            } else {
                table.rows().deselect();
                $('#sample_1 tbody .Polaris-Checkbox__Input').prop('checked', false)
            }
        });


        $(".per_page_length").on("change", function (e) {
            $('th.selectAll input').prop("checked", false);
        });
        $('#sample_1 tbody').on('click', 'input', function (e) {
            var checked = $(this).prop('checked');
            var row = table.rows($(this).closest('tr').get()[0]);
            if (checked) {
                row.select()
            } else {
                $("th.selectAll input").prop('checked', false);
                row.deselect()
            }
            e.stopPropagation();
        });

        var channel_query_param = {
            offset: "",
            search: "",
        }


        $('#webhook_status,#trigger_at').on('change', function () {
            table.draw();
        });



    </script>
@endsection