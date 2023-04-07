<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-time-activity-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Time Activity Type
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                @php $time_activity_type=old('api_fields[NameOf]')?old('api_fields[NameOf]'):$api_fields['NameOf']??'';  @endphp
                <select name="api_fields[NameOf]" class="form-control " id="time_activity_type">
                    <option @if($time_activity_type=="Employee") selected @endif value="Employee">Employee</option>
                    <option @if($time_activity_type=="Vendor") selected @endif value="Vendor">Vendor</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Is this for an Employee or Vendor?.Please select either vendor or employee from respective dropdowns and choose type here.Don't select values for both at a time.</span>
            </div>
        </div>
        <div class="fields-wrapper" id="time_activity_vendor_div">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Vendor Name
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="vendorRefName"
                       name="api_fields[VendorRef][name]" type="hidden"
                       value="{{ old('api_fields[VendorRef][name]')?old('api_fields[VendorRef][name]'):$api_fields['VendorRef']['name']??'' }}">
                <select id="freshworks_vendors"
                        name="api_fields[VendorRef][value]" class="form-control">
                    <option value="{{ old('api_fields[VendorRef][value]')?old('api_fields[VendorRef][value]'):$api_fields['VendorRef']['value']??'' }}">{{ old('api_fields[VendorRef][name]')?old('api_fields[VendorRef][name]'):$api_fields['VendorRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Enumeration of time activity types.if you choose this value,then select Vendor from "Time Activity Type" dropdown.</span>
            </div>
        </div>
        <div class="fields-wrapper" id="time_activity_employee_div">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Employee
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="freshworks_employee_name"
                       name="api_fields[EmployeeRef][name]" type="hidden"
                       value="{{ old('api_fields[EmployeeRef][name]')?old('api_fields[EmployeeRef][name]'):$api_fields['EmployeeRef']['name']??'' }}">
                <select name="api_fields[EmployeeRef][value]" class="form-control freshworks_employees" >
                    <option value="{{ old('api_fields[EmployeeRef][value]')?old('api_fields[EmployeeRef][value]'):$api_fields['EmployeeRef']['value']??'' }}">{{ old('api_fields[EmployeeRef][name]')?old('api_fields[EmployeeRef][name]'):$api_fields['EmployeeRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Specifies the employee whose time is being recorded.if you choose this value,then select Vendor from "Time Activity Type" dropdown.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Hourly Rate
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[HourlyRate]')?old('api_fields[HourlyRate]'):$api_fields['HourlyRate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[HourlyRate]"
                              style="display: none;">{{ old('api_fields[HourlyRate]')?old('api_fields[HourlyRate]'):$api_fields['HourlyRate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Hourly bill rate of the employee or vendor for this time activity.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Start Time
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[StartTime]')?old('api_fields[StartTime]'):$api_fields['StartTime']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              data-msg-required="Please enter Time."
                              data-rule-required="true"
                              name="api_fields[StartTime]"
                              style="display: none;">{{ old('api_fields[StartTime]')?old('api_fields[StartTime]'):$api_fields['StartTime']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Time that work starts. Required if Hours and Minutes not specified. Note: Kindly consider only the Hours without including the timeZone offset as it does not impact time activity hours calculation. Can use shopfify time stamp format e-g created_at or updated_at fields of shopify</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> End Time
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[EndTime]')?old('api_fields[EndTime]'):$api_fields['EndTime']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              data-msg-required="Please enter Time."
                              data-rule-required="true"
                              name="api_fields[EndTime]"
                              style="display: none;">{{ old('api_fields[EndTime]')?old('api_fields[EndTime]'):$api_fields['EndTime']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Time that work starts. Required if Hours and Minutes not specified. Note: Kindly consider only the Hours without including the timeZone offset as it does not impact time activity hours calculation. Can use shopfify time stamp format e-g created_at or updated_at fields of shopify</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Date
                        <span>(Optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnDate]')?old('api_fields[TxnDate]'):$api_fields['TxnDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnDate]"
                              style="display: none;">{{ old('api_fields[TxnDate]')?old('api_fields[TxnDate]'):$api_fields['TxnDate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Defaults to today's date if not specified.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Description
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea msg-body-style"
                         contenteditable="true">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Description]"
                              style="display: none;">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Description of work completed during time activity.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Class
                        <span>(Optional)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ClassRef"
                       name="api_fields[ClassRef][name]" type="hidden"
                       value="{{ old('api_fields[ClassRef][name]')?old('api_fields[ClassRef][name]'):$api_fields['ClassRef']['name']??'' }}">
                <select id="freshworks_class"
                        name="api_fields[ClassRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[ClassRef][value]')?old('api_fields[ClassRef][value]'):$api_fields['ClassRef']['value']??'' }}">{{ old('api_fields[ClassRef][name]')?old('api_fields[ClassRef][name]'):$api_fields['ClassRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Only available if class tracking is enabled and assigned using the "one to entire transaction" option.</span>
            </div>
        </div>



        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Customer
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="ParentRefname"
                       name="api_fields[CustomerRef][name]" type="hidden"
                       value="{{ old('api_fields[CustomerRef][name]')?old('api_fields[CustomerRef][name]'):$api_fields['CustomerRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[CustomerRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[CustomerRef][value]')?old('api_fields[CustomerRef][value]'):$api_fields['CustomerRef']['value']??'' }}">{{ old('api_fields[CustomerRef][name]')?old('api_fields[CustomerRef][name]'):$api_fields['CustomerRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference to a customer or job. Query the Customer name list resource to determine the appropriate Customer object for this reference.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Service
                        <span>(required)</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="ItemRef"
                       name="api_fields[ItemRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemRef][name]')?old('api_fields[ItemRef][name]'):$api_fields['ItemRef']['name']??'' }}">
                <select id="items_list"
                        name="api_fields[ItemRef][value]" class="form-control"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[ItemRef][value]')?old('api_fields[ItemRef][value]'):$api_fields['ItemRef']['value']??'' }}">{{ old('api_fields[ItemRef][name]')?old('api_fields[ItemRef][name]'):$api_fields['ItemRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference to the service item associated with this object. </span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label class="Polaris-Label__Text">Billable Status
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                @php $BillableStatus=old('api_fields[BillableStatus]')?old('api_fields[BillableStatus]'):$api_fields['BillableStatus']??'';  @endphp
                <select name="api_fields[BillableStatus]" class="form-control ">
                    <option @if($BillableStatus=="Billable") selected @endif value="Billable ">Billable</option>
                    <option @if($BillableStatus=="NotBillable") selected @endif value="NotBillable">NotBillable</option>
                    <option @if($BillableStatus=="HasBeenBilled") selected @endif value="HasBeenBilled">HasBeenBilled</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Billable status of the time recorded.</span>
            </div>
        </div>



    </div>
</div>

<script>
    $(document).ready(function(){
        $('#time_activity_type').on('change', function(){
            let type_value = $(this).val();
            if(type_value.localeCompare("Employee") == 0){
                $("#time_activity_vendor_div").hide();
                $("#time_activity_employee_div").show();
            }
            else{
                $("#time_activity_employee_div").hide();
                $("#time_activity_vendor_div").show();
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        let type_value = $("#time_activity_type").val();
        if(type_value.localeCompare("Employee") == 0){
            $("#time_activity_vendor_div").hide();
            $("#time_activity_employee_div").show();
        }
        else{
            $("#time_activity_employee_div").hide();
            $("#time_activity_vendor_div").show();
        }
    });
</script>