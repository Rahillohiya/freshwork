<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('focus', '.datepicker', function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: 'linked',
                todayHighlight: true,
                autoclose: true
            });
        });
        function get_freshworks_currency() {
            var freshworks_currency_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"currency",

            };
            $('#freshworks_currency').select2({
                placeholder: "Select currency",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_currency_query_param;

                    },
                    processResults: function (data, params) {
                        freshworks_currency_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }

        function get_freshworks_items() {
            var freshworks_items_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"items"

            };
            $('#items_list').select2({
                placeholder: "Select service or product",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_items_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_items_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_customers() {
            var freshworks_customers_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"customers"
            };
            $('#customers_list,#update_customer_object').select2({
                placeholder: "Select customers",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_customers_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_customers_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }

        function get_freshworks_payments() {
            var freshworks_payments_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"payments"
            };
            $('#quickbook_payments_list').select2({
                placeholder: "Select payment",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_payments_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_payments_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_payment_methods() {
            var freshworks_payment_methogs_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"payment_methods"
            };
            $('#PaymentMethods').select2({
                placeholder: "Select payment methods",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_payment_methogs_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_payment_methogs_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_departments() {
            var freshworks_departments_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"departments"
            };
            $('#freshworks_department,.freshworks_department').select2({
                placeholder: "Select department",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_departments_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_departments_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_tax_rates() {
            var freshworks_tax_rates_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"tax_rates"
            };
            $('#freshworks_tax_rates').select2({
                placeholder: "Select tax rate",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_tax_rates_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_tax_rates_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_tax_codes() {
            var freshworks_tax_codes_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"tax_codes"
            };
            $('#freshworks_tax_codes,#freshworks_txn_tax_codes').select2({
                placeholder: "Select tax code",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_tax_codes_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_tax_codes_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_vendors() {
            var freshworks_vendors_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"1",
                freshworks_object:"vendors"
            };
            $('#freshworks_vendors').select2({
                placeholder: "Select vendor",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_vendors_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_vendors_query_param.offset = data.offset || "1";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_terms() {
            var freshworks_terms_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"terms"
            };
            $('#freshworks_terms').select2({
                placeholder: "Select term",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_terms_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_terms_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_class() {
            var freshworks_class_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"class"
            };
            $('#freshworks_class,.freshworks_class').select2({
                placeholder: "Select class",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_class_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_class_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }

                        };
                    }
                }
            });
        }
        function get_freshworks_employees() {
            var freshworks_employees_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"employees"
            };
            $('.freshworks_employees').select2({
                placeholder: "Select employee",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_employees_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_employees_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
        }
        function get_freshworks_journal_codes() {
            var freshworks_journal_codes_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"journal_codes"
            };
            $('.freshworks_journal_codes').select2({
                placeholder: "Select journal code",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_journal_codes_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_journal_codes_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
        }

        function get_freshworks_invoices() {
            var freshworks_invoices_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                freshworks_object:"invoices"
            };
            $('#freshworks_invoices').select2({
                placeholder: "Select invoice",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        return freshworks_invoices_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_invoices_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
        }

        function get_freshworks_accounts() {
            var freshworks_accounts_query_param = {
                channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                offset:"",
                search:"",
                freshworks_object:"",
                "AccountType":"",
                "AccountSubType":"",
                "Classification":""
            }
            $('.all_accounts').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        freshworks_accounts_query_param.AccountType="";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
            $('#income_accounts').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        freshworks_accounts_query_param.AccountType="Income";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });

            $('#expense_accounts').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        freshworks_accounts_query_param.AccountType="";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
            $('#credit_card_accounts').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        freshworks_accounts_query_param.AccountType="Credit Card";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
            $('#accounts_with_ExpenseType').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        freshworks_accounts_query_param.AccountType="Expense";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });
            $('#inventory_accounts').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        // freshworks_accounts_query_param.AccountType="Other Current Asset";
                        freshworks_accounts_query_param.AccountType="Bank";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });

            $('#ap_accounts').select2({
                placeholder: "Select accounts",
                minimumResultsForSearch: -1,
                ajax: {
                    url: "{{ route('get_freshworks_resources') }}",
                    minimumInputLength: 1,
                    cache: true,
                    data: function (params) {
                        freshworks_accounts_query_param.freshworks_object="accounts";
                        freshworks_accounts_query_param.Classification="Liability";
                        freshworks_accounts_query_param.AccountSubType="AccountsPayable";
                        return freshworks_accounts_query_param;
                    },
                    processResults: function (data, params) {
                        freshworks_accounts_query_param.offset = data.offset || "";
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination? (data.pagination.more || false):false
                            }
                        };
                    }
                }
            });

        }
        function show_hide_required_fields(){
            var selected_val=$('#itemType').val();
            if(selected_val=="Service" || selected_val=="NonInventory"){
                $('#initial_qty_on_hand_div,#inv_start_date_div,#inventory_asset_account_div,#reorder_point_div').hide();
                $('.inventoryType_required_fields').each(function () {
                    $(this).val('').rules('add', {
                        required: false

                    });
                });
                $( ".inventory_asset_account_id" ).val('').trigger('change');
            }
//               in case of inventory
            else if(selected_val=="Inventory") {
                $('#initial_qty_on_hand_div,#inv_start_date_div,#inventory_asset_account_div,#reorder_point_div').show();
                $('.inventoryType_required_fields').each(function () {
                    $(this).rules('add', {
                        required: true

                    });
                });
            }
        }
        $(document).on('change','.freshworks_class',function(){
            $(this).prev('input.freshworks_class_name').val($('option:selected',this).text());
        });
        $(document).on('change','.freshworks_department',function(){
            $(this).prev('input.freshworks_department_name').val($('option:selected',this).text());
        });
        $(document).on('change','.all_accounts',function(){
            $(this).prev('input.AllSelectedAccountName').val($('option:selected',this).text());
        });
        $(document).on('change','.freshworks_journal_codes',function(){
            $(this).prev('input.freshworks_journal_code_name').val($('option:selected',this).text());
        });
        $(document).on('change','.freshworks_employees',function(){
            $(this).prev('input.freshworks_employee_name').val($('option:selected',this).text());
        });
        $(document).on('change','#accounts_with_ExpenseType',function(){
            $('.accounts_with_ExpenseType').val($("#accounts_with_ExpenseType option:selected").text());
        });
        $(document).on('change','#freshworks_invoices',function(){
            $('.InvoiceRefName').val($("#freshworks_invoices option:selected").text());
        });
        $(document).on('change','#freshworks_currency',function(){
            $('.CurrencyRefname').val($("#freshworks_currency option:selected").text());
        });
        $(document).on('change','#customers_list',function(){
            $('.ParentRefname').val($("#customers_list option:selected").text());
        });

        $(document).on('change','#PaymentMethods',function(){
            $('.PaymentMethodRefname').val($("#PaymentMethods option:selected").text());
        });
        $(document).on('change','#update_customer_object',function(){
            $('.selected_customer_nameto_update').val($("#update_customer_object option:selected").text());
        });
        $(document).on('change','#freshworks_contacts',function(){
            $('.ContactText').val($("#freshworks_contacts option:selected").text());
        });

        $(document).on('change','#income_accounts',function(){
            $('.IncomeAccountRef').val($("#income_accounts option:selected").text());
        });
        $(document).on('change','#expense_accounts',function(){
            $('.ExpenseAccountRef').val($("#expense_accounts option:selected").text());
        });
        $(document).on('change','#credit_card_accounts',function(){
            $('.CreditCardAccounts').val($("#credit_card_accounts option:selected").text());
        });
        $(document).on('change','#inventory_accounts',function(){
            $('.AssetAccountRef').val($("#inventory_accounts option:selected").text());
        });
        $(document).on('change','#items_list',function(){
            $('.ItemRef').val($("#items_list option:selected").text());
        });
        $(document).on('change','#freshworks_department',function(){
            $('.DepartmentRefName').val($("#freshworks_department option:selected").text());
        });
        $(document).on('change','#freshworks_accounts',function(){
            $('.freshworks_accounts').val($("#freshworks_accounts option:selected").text());
        });
        $(document).on('change','#freshworks_tax_codes',function(){
            $('.TaxCodeRef').val($("#freshworks_tax_codes option:selected").text());
        });
        $(document).on('change','#freshworks_txn_tax_codes',function(){
            $('.TXNTaxCodeRef').val($("#freshworks_txn_tax_codes option:selected").text());
        });
        $(document).on('change','#freshworks_terms',function(){
            $('.SalesTermRef').val($("#freshworks_terms option:selected").text());
        });
        $(document).on('change','#freshworks_class',function(){
            $('.ClassRefName').val($("#freshworks_class option:selected").text());
        });
        $(document).on('change','#freshworks_tax_rates',function(){
            $('.TaxRateRef').val($("#freshworks_tax_rates option:selected").text());
        });
        $(document).on('change','#freshworks_vendors',function(){
            $('.vendorRefName').val($("#freshworks_vendors option:selected").text());
        });
        $(document).on('change','#ap_accounts',function(){
            $('.APAccountRef').val($("#ap_accounts option:selected").text());
        });
        $(document).on('change','#itemType',function(){
            show_hide_required_fields();
        });
        var shopify_sample_data = [
                @foreach($shopify_event_request_fields as $shopify_event_request_field_key=>$shopify_event_request_field_value)
            {
                label: '<span class="ui-button ui-state-default ui-widget ui-corner-all ui-button-text-only ui-textarea-dropdown"> <span class="dropdown-shopify-img-span"><div class="shopify-img dropdown-img-size"></div></span> <span class="field-key">{{ $shopify_event_request_field_value }}</span> <span class="field-value"></span> </span>',
                value: {
                    value: '{{ $shopify_event_request_field_key }}',
                    content: '<span contenteditable="false" data-value="{{ $shopify_event_request_field_key }}" class="ui-button ui-state-default ui-widget ui-corner-all ui-button-text-only field-text-parent"> <span class="shopify-img-span"><div class="shopify-img shopify-img-size"></div></span> <span class="field-key">{{ $shopify_event_request_field_value }}</span> <span class="field-value"></span> </span>'
                }
            },
            @endforeach
        ];
        $(document).on('change', '#google_contact_resource_id', function () {
            $('#google_contact_resource_name').val($('#google_contact_resource_id').text());
        });


        $(document).on('change', '#channel_event_id', function () {
            load_freshworks_fields_section();
        });


        function load_freshworks_fields_section(channel_event_setting_id) {
            if (!$('#channel_event_id').val())
                return;
            show_loading_img();
            $.ajax({
                url: "{{ route('load_freshworks_fields_section')}}",
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "<?= Session::token() ?>"
                },
                dataType: "TEXT",
                data: {
                    channel_account_id: "{{ $_GET['channel_account_id']??0 }}",
                    webhook_event_name: $('#webhook_topic_id').data("webhook-event-name"),
                    channel_event_setting_id: channel_event_setting_id,
                    topic_name: $("#webhook_topic_id option:selected").text(),
                    channel_event_id: $('#channel_event_id').val()
                },
                cache: false,
                success: function (response) {
                    $('#channel-fields-section').html(response);
                    $('.rich_textarea').rich_textarea(
                        {
                            shopify_sample_data: shopify_sample_data,
                            triggers: [
                                {
                                    trigger: '@',
                                    callback: function (term, response) {
                                        response($.ui.autocomplete.filter(shopify_sample_data, term));

                                    }	// end of callback
                                }]
                        });
                    hide_loading_img();
                    show_hide_required_fields();
                    get_freshworks_currency();
                    get_freshworks_customers();
                    get_freshworks_items();
                    get_freshworks_payment_methods();
                    get_freshworks_payments();
                    get_freshworks_accounts();
                    get_freshworks_invoices();
                    get_freshworks_journal_codes();
                    get_freshworks_employees();
                    get_freshworks_departments();
                    get_freshworks_tax_codes();
                    get_freshworks_tax_rates();

                    get_freshworks_terms();
                    get_freshworks_vendors();
                    get_freshworks_class();
//              apply validation on dependant fields
                    if($("#channel_event_id option:selected").data('slug')=="create_employee" || $("#channel_event_id option:selected").data('slug')=="create_payment") {
                        apply_dependant_fields_validation();
                    }

                }, error: function (result) {
                    hide_loading_img();
                    toastr.error('Unable to fetch details.Please refresh page');

                },
                timeout: 1000000
            }).fail(function (jqXHR, textStatus) {
                hide_loading_img();
                toastr.error('Unable to fetch details.Please refresh page');
            });
        }


        @if($channel_event_settings && $channel_event_settings->id)
        load_freshworks_fields_section({{ $channel_event_settings->id }})

        @endif
        show_hide_required_fields();
        function apply_dependant_fields_validation(){
            if($("#line_item_transaction_id").length > 0){
                $("#line_item_transaction_id").rules('add', {
                    required: "#line_item_amount:filled",
                    messages: {
                        required: "Transaction ID  is mandatory if line item amount given."

                    }
                });
            }
            if($("#line_item_transaction_type").length > 0){
                $("#line_item_transaction_type").rules('add', {
                    required: "#line_item_amount:filled",
                    messages: {
                        required: "Transaction Type is mandatory if line item amount given"

                    }
                });
            }
            if($("#line_item_amount").length > 0){
                $("#line_item_amount").rules('add', {
                    required: "#line_item_transaction_id:filled",
                    messages: {
                        required: "Amount is mandatory if Transaction Type or ID given"

                    }
                });
            }
            /* if($("#employee_given_name").length > 0){
             $("#employee_given_name").rules('add', {
                 required: "#employee_family_name:blank",
                 messages: {
                     required: "Given name is mandatory if no Family name provided"

                 }
             });
             }
             if($("#employee_family_name").length > 0){
             $("#employee_family_name").rules('add', {
                     required: "#employee_given_name:blank",
                 messages: {
                     required: "Family name is mandatory if no given name provided"

                 }
             });
             }*/
        }
    });
</script>
