@extends('layouts.master')
<?php
$asset_controls = [
    'datatable', 'sweetalert'
];
?>
@section('head')
    <style>
        @media screen and (max-width: 680px){
            .registered-webhook-table tbody tr td:first-child {
                padding: 6px 0 0 30px !important;
                text-align: left !important;
            }
            #sample_2 th, #sample_2 td{
                text-align: center;
            }
            .table-scroll{
                /*width: 100%;*/
                /*overflow-x: auto;*/
            }
            #sample_2 tr.child td ul li{
                display: block !important;
            }
            .table-scroll .dataTables_paginate{
                display: flex;
                justify-content: center;
            }
        }
    </style>
    <link href="{{ URL::asset('css/datatable.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div  class="section-main-heading" style="--top-bar-background:#00848e; --top-bar-color:#f9fafb; --top-bar-background-lighter:#1d9ba4;">
                <h4>Payouts</h4>
            </div>
            <div class="reg-webhooks-page table-scroll">
                <table class="registered-webhook-table responsive table table-hover table-checkable order-column dataTable no-footer dtr-inline"
                       id="sample_2" >
                    <thead>
                    <tr class="">
                        <th> Date</th>
                        <th> Payout</th>
                        <th> Payment Gateway</th>
                        <th> Status</th>
                        <th> Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('last_scripts')

    <script type="text/javascript">

        $(document).ready(function () {

            var table = $('#sample_2').DataTable(
                {
                    processing: true,
                    serverSide: true,
                    "searching": true,
                    "paging": true,
                    'bSortable': true,
                    "bInfo": true,
                    iDisplayLength: 10,
                    "lengthChange": true,
                    "autoWidth": false,
                    responsive: true,
                    sAjaxSource: '{{ route('payouts') }}',
                    "columnDefs": [
                        { "width": "120px", "targets": 0 },
                        { "width": "120px", "targets": 1 },
                        { "width": "120px", "targets": 2 },
                        { "width": "60px", "targets": 3 },
                        { "width": "60px", "targets": 4 },
                        { "width": "60px", "targets": 5 },
                        { "width": "60px", "targets": 6 }


                    ],
                    "columns": [
                        {
                            "data": "date",
                            "orderable": true,

                        },
                        {
                            "data": "payout"
                            , "orderable": true
                        },
                        {
                            "data": "payment_gateway"
                            , "orderable": true
                        },
                        {
                            "data": "status"
                            , "orderable": true,

                        },
                        {
                            "data": "action"
                            , "orderable": false,
                        },


                    ],

                    order: [[3, "desc"]],
                    language: {
                        paginate: {
                            next: '&#85943;', // or '→'
                            previous: '&#8592;' // or '←'
                        },
                        "emptyTable": "No webhooks have been registered yet. Click <a href='{{ route('automate') }}' >Register webhooks</a> to get started.",
                        "sSearch": '',
                        searchPlaceholder: 'Search',
                        processing: "<small>Loading webhooks...</small>",
                        "sLengthMenu": '<span class="per-page-label cc">per page</span><select class="per_page_length form-control input-sm input-xsmall input-inline">' +
                            '<option value="10">10</option>' +
                            '<option value="30">30</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select>'
                    },
                    drawCallback: function () {
                        var pageInfo = this.api().page.info();
                        var multiPage = pageInfo.pages > 1;
                        $('#sample_2_paginate').toggle(multiPage);
                        if (!multiPage && pageInfo.recordsTotal == pageInfo.recordsDisplay) {
                            $('#sample_2_info').text('Showing all ' + pageInfo.recordsTotal + ' entries');
                        }
                        if (pageInfo.recordsTotal == 0) {
                            $('#sample_2_info').text('');
                        }
                    },
                    // highlight ordered column

                    "oSearch": {"sSearch": "{{session('sSearch_hooks')}}"},
                    "fnServerData": function (sSource, aoData, fnCallback) {
                        $.getJSON(sSource, aoData, function (json) {
                            $('#sample_2').show();
                            fnCallback(json)
                        });
                    },
                    "dom": ' <"search-filter"f><"length-dropdown"l>rt<"bottom"ip><"clear">'

                });

        });
    </script>
@endsection