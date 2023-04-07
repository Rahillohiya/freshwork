<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Vendor
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input data-rule-required="true" data-msg-required=" "
                   class="vendorRefName"
                   name="api_fields[VendorRef][name]" type="hidden"
                   value="{{ old('api_fields[VendorRef][name]')?old('api_fields[VendorRef][name]'):$api_fields['VendorRef']['name']??'' }}">
            <select id="freshworks_vendors"
                    name="api_fields[VendorRef][value]" class="form-control ContactId"
                    data-rule-required="true">

                <option value="{{ old('api_fields[VendorRef][value]')?old('api_fields[VendorRef][value]'):$api_fields['VendorRef']['value']??'' }}">{{ old('[VendorRef][name]')?old('api_fields[VendorRef][name]'):$api_fields['VendorRef']['name']??'' }}</option>
            </select>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Puchase Order Status
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $pOStatus=old('api_fields[POStatus]')?old('api_fields[POStatus]'):$api_fields['POStatus']??'';  @endphp
            <select name="api_fields[POStatus]" class="form-control ">
                <option  @if($pOStatus=="") selected @endif value=""></option>
                <option  @if($pOStatus=="Open") selected @endif value="Open">Open</option>
                <option @if($pOStatus=="Closed") selected @endif value="Closed ">Closed</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Email status of the receipt. </span>
        </div>
    </div>
    <div class="interlink-fields">
        <h4 class="connector-heading">Vendor Address </h4>
        <p>Address to which the payment should be sent.
            If a physical address is updated from within the transaction object, the Freshworks Online API flows individual address components differently into the Line elements of the transaction response then when the transaction was first created.</p>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line1
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[VendorAddr][Line1]')?old('api_fields[VendorAddr][Line1]'):$api_fields['VendorAddr']['Line1']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[VendorAddr][Line1]"
                              style="display: none;">{{ old('api_fields[VendorAddr][Line1]')?old('api_fields[VendorAddr][Line1]'):$api_fields['VendorAddr']['Line1']??'' }}</textarea>
                </div>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">City
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[VendorAddr][City]')?old('api_fields[VendorAddr][City]'):$api_fields['VendorAddr']['City']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[VendorAddr][City]"
                              style="display: none;">{{ old('api_fields[VendorAddr][City]')?old('api_fields[VendorAddr][City]'):$api_fields['VendorAddr']['City']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Postal Code
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[VendorAddr][PostalCode]')?old('api_fields[VendorAddr][PostalCode]'):$api_fields['VendorAddr']['PostalCode']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[VendorAddr][PostalCode]"
                              style="display: none;">{{ old('api_fields[VendorAddr][PostalCode]')?old('api_fields[VendorAddr][PostalCode]'):$api_fields['VendorAddr']['PostalCode']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Country
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[VendorAddr][Country]')?old('api_fields[VendorAddr][Country]'):$api_fields['VendorAddr']['Country']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[VendorAddr][Country]"
                              style="display: none;">{{ old('api_fields[VendorAddr][Country]')?old('api_fields[VendorAddr][Country]'):$api_fields['VendorAddr']['Country']??'' }}</textarea>
                </div>

            </div>
        </div>
    </div>

    <div class="interlink-fields">
        <h4 class="connector-heading">Shipping Address </h4>
        <p>Identifies the address where the goods must be shipped. If Ship Address not specified, and a default Customer:ShippingAddr is specified in Freshworks for this customer, the default ship-to address will be used by Freshworks.
            For international addresses - countries should be passed as 3 ISO alpha-3 characters or the full name of the country.</p>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line1
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ShipAddr][Line1]')?old('api_fields[ShipAddr][Line1]'):$api_fields['ShipAddr']['Line1']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipAddr][Line1]"
                              style="display: none;">{{ old('api_fields[ShipAddr][Line1]')?old('api_fields[ShipAddr][Line1]'):$api_fields['ShipAddr']['Line1']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">City
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ShipAddr][City]')?old('api_fields[ShipAddr][City]'):$api_fields['ShipAddr']['City']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipAddr][City]"
                              style="display: none;">{{ old('api_fields[ShipAddr][City]')?old('api_fields[ShipAddr][City]'):$api_fields['ShipAddr']['City']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Postal Code
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ShipAddr][PostalCode]')?old('api_fields[ShipAddr][PostalCode]'):$api_fields['ShipAddr']['PostalCode']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipAddr][PostalCode]"
                              style="display: none;">{{ old('api_fields[ShipAddr][PostalCode]')?old('api_fields[ShipAddr][PostalCode]'):$api_fields['ShipAddr']['PostalCode']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Country
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ShipAddr][Country]')?old('api_fields[ShipAddr][Country]'):$api_fields['ShipAddr']['Country']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipAddr][Country]"
                              style="display: none;">{{ old('api_fields[ShipAddr][Country]')?old('api_fields[ShipAddr][Country]'):$api_fields['ShipAddr']['Country']??'' }}</textarea>
                </div>

            </div>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Purchase Order/Transaction Date
                    <span></span>
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
            <span>The date entered by the user when this transaction occurred.yyyy/MM/dd is the valid date format.For posting transactions, this is the posting date that affects the financial statements. If the date is not supplied, the current date on the server is used.
</span>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Purchase Order/Document Number
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[DocNumber]')?old('api_fields[DocNumber]'):$api_fields['DocNumber']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[DocNumber]"
                          style="display: none;">{{ old('api_fields[DocNumber]')?old('api_fields[DocNumber]'):$api_fields['DocNumber']??'' }}</textarea>
            </div>
        </div>
    </div>

    <div class="interlink-fields">
        <h4 class="connector-heading">Account Details </h4>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">AP  Account
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="APAccountRef"
                       name="api_fields[APAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[APAccountRef][name]')?old('api_fields[APAccountRef][name]'):$api_fields['APAccountRef']['name']??'' }}">
                <select id="ap_accounts" name="api_fields[APAccountRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[APAccountRef][value]')?old('api_fields[APAccountRef][value]'):$api_fields['APAccountRef']['value']??'' }}">{{ old('[APAccountRef][name]')?old('api_fields[APAccountRef][name]'):$api_fields['APAccountRef']['name']??'' }}</option>

                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>AP Account.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Total Amount
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TotalAmt]')?old('api_fields[TotalAmt]'):$api_fields['TotalAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TotalAmt]"
                              style="display: none;">{{ old('api_fields[TotalAmt]')?old('api_fields[TotalAmt]'):$api_fields['TotalAmt']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Class
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ClassRefName"
                       name="api_fields[ClassRef][name]" type="hidden"
                       value="{{ old('api_fields[ClassRef][name]')?old('api_fields[ClassRef][name]'):$api_fields['ClassRef']['name']??'' }}">
                <select id="freshworks_class"
                        name="api_fields[ClassRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[ClassRef][value]')?old('api_fields[ClassRef][value]'):$api_fields['ClassRef']['value']??'' }}">{{ old('[ClassRef][name]')?old('api_fields[ClassRef][name]'):$api_fields['ClassRef']['name']??'' }}</option>
                </select>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Sales Term Reference
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="SalesTermRef"
                       name="api_fields[SalesTermRef][name]" type="hidden"
                       value="{{ old('api_fields[SalesTermRef][name]')?old('api_fields[SalesTermRef][name]'):$api_fields['SalesTermRef']['name']??'' }}">
                <select id="freshworks_terms"
                        name="api_fields[SalesTermRef][value]" class="form-control">
                    <option value="{{ old('api_fields[SalesTermRef][value]')?old('api_fields[SalesTermRef][value]'):$api_fields['SalesTermRef']['value']??'' }}">{{ old('[SalesTermRef][name]')?old('api_fields[SalesTermRef][name]'):$api_fields['SalesTermRef']['name']??'' }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="interlink-fields">
        <h4 class="connector-heading"> Line Item </h4>
        <p>Multiple line items will be inserted into connector for all shopify webhooks which contain multiple line items in them e-g Order,Cart ,Checkout and Refund Line Items.If an order has 3 items in it you can choose line item properties like
            quantity,price and amount from shopify variables by searching them by @name in the input fields</p>
        {{-- required hidden field --}}
        <input type="hidden" name="api_fields[DetailType]" value="ItemBasedExpenseLineDetail">

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Product/Service
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ItemRef" data-rule-required="true" data-rule-msg=" "
                       name="api_fields[ItemBasedExpenseLineDetail][ItemRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemBasedExpenseLineDetail][ItemRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][ItemRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['ItemRef']['name']??'' }}">

                <select id="items_list" data-rule-required="true"
                        name="api_fields[ItemBasedExpenseLineDetail][ItemRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[ItemBasedExpenseLineDetail][ItemRef][value]')?old('api_fields[ItemBasedExpenseLineDetail][ItemRef][value]'):$api_fields['ItemBasedExpenseLineDetail']['ItemRef']['value']??'' }}">{{ old('[ItemBasedExpenseLineDetail][ItemRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][ItemRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['ItemRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Choose a service or product for item.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line Item Quantity
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ItemBasedExpenseLineDetail][Qty]')?old('api_fields[ItemBasedExpenseLineDetail][Qty]'):$api_fields['ItemBasedExpenseLineDetail']['Qty']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              name="api_fields[ItemBasedExpenseLineDetail][Qty]"
                              style="display: none;">{{ old('api_fields[ItemBasedExpenseLineDetail][Qty]')?old('api_fields[ItemBasedExpenseLineDetail][Qty]'):$api_fields['ItemBasedExpenseLineDetail']['Qty']??'' }}</textarea>
                </div>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line Item Unit Price/Rate
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ItemBasedExpenseLineDetail][UnitPrice]')?old('api_fields[ItemBasedExpenseLineDetail][UnitPrice]'):$api_fields['ItemBasedExpenseLineDetail']['UnitPrice']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              name="api_fields[ItemBasedExpenseLineDetail][UnitPrice]"
                              style="display: none;">{{ old('api_fields[ItemBasedExpenseLineDetail][UnitPrice]')?old('api_fields[ItemBasedExpenseLineDetail][UnitPrice]'):$api_fields['ItemBasedExpenseLineDetail']['UnitPrice']??'' }}</textarea>
                </div>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line Amount
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              name="api_fields[Amount]"
                              style="display: none;">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Should not include tax.Amount is calculated by this formula (Unit Price*Qty)</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line Description
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Description]"
                              style="display: none;">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</textarea>
                </div>
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
                <input class="ParentRefname"
                       name="api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['CustomerRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[ItemBasedExpenseLineDetail][CustomerRef][value]" class="form-control ContactId">

                    <option value="{{ old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][value]')?old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][value]'):$api_fields['ItemBasedExpenseLineDetail']['CustomerRef']['value']??'' }}">{{ old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['CustomerRef']['name']??'' }}</option>
                </select>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text"> Tax Code
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="TaxCodeRef"
                       name="api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['TaxCodeRef']['name']??'' }}">
                <select id="freshworks_tax_codes" name="api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][value]')?old('api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][value]'):$api_fields['ItemBasedExpenseLineDetail']['TaxCodeRef']['value']??'' }}">{{ old('[salesItemLineDetail][TaxCodeRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][TaxCodeRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['TaxCodeRef']['name']??'' }}</option>
                </select>
            </div>
        </div>



    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Memo
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Memo]')?old('api_fields[Memo]'):$api_fields['Memo']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Memo]"
                          style="display: none;">{{ old('api_fields[Memo]')?old('api_fields[Memo]'):$api_fields['Memo']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>A message for the vendor. This text appears on the Purchase Order object sent to the vendor.</span>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Private Note
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrivateNote]')?old('api_fields[PrivateNote]'):$api_fields['PrivateNote']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[PrivateNote]"
                          style="display: none;">{{ old('api_fields[PrivateNote]')?old('api_fields[PrivateNote]'):$api_fields['PrivateNote']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>User entered, organization-private note about the transaction. This note does not appear on the transaction form to the customer. This field maps to the Memo field on the Sales Receipt form.</span>
        </div>
    </div>
    <div class="interlink-fields">
        <h4 class="connector-heading"> Transaction Tax Setup </h4>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text"> Tax Code
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="TXNTaxCodeRef"
                       name="api_fields[TxnTaxDetail][TxnTaxCodeRef][name]" type="hidden"
                       value="{{ old('api_fields[TxnTaxDetail][TxnTaxCodeRef][name]')?old('api_fields[TxnTaxDetail][TxnTaxCodeRef][name]'):$api_fields['TxnTaxDetail']['TxnTaxCodeRef']['name']??'' }}">
                <select id="freshworks_txn_tax_codes" name="api_fields[TxnTaxDetail][TxnTaxCodeRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[TxnTaxDetail][TxnTaxCodeRef][value]')?old('api_fields[TxnTaxDetail][TxnTaxCodeRef][value]'):$api_fields['TxnTaxDetail']['TxnTaxCodeRef']['value']??'' }}">{{ old('[salesItemLineDetail][TxnTaxCodeRef][name]')?old('api_fields[TxnTaxDetail][TxnTaxCodeRef][name]'):$api_fields['TxnTaxDetail']['TxnTaxCodeRef']['name']??'' }}</option>
                </select>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Total Tax
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnTaxDetail][TotalTax]')?old('api_fields[TxnTaxDetail][TotalTax]'):$api_fields['TxnTaxDetail']['TotalTax']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnTaxDetail][TotalTax]"
                              style="display: none;">{{ old('api_fields[TxnTaxDetail][TotalTax]')?old('api_fields[TxnTaxDetail][TotalTax]'):$api_fields['TxnTaxDetail']['TotalTax']??'' }}</textarea>
                </div>
            </div>
        </div>

        {{--hidden input field for Taxline object--}}
        <input type="hidden" name="api_fields[TxnTaxDetail][TaxLine][0][DetailType]" value="TaxLineDetail" >

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Discount Value/Net Amount Taxable
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][NetAmountTaxable]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][NetAmountTaxable]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['NetAmountTaxable']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][NetAmountTaxable]"
                              style="display: none;">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][NetAmountTaxable]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][NetAmountTaxable]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['NetAmountTaxable']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>This is the taxable amount on the total of the applicable tax rates. If TaxRate is applicable on two lines, this attribute represents the total of the two lines for which this rate is applied. This is different from the Line.Amount , which represents the final tax amount after the tax has been applied.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Tax Percent
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxPercent]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxPercent]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxPercent']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxPercent]"
                              style="display: none;">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxPercent]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxPercent]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxPercent']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Numerical expression of the sales tax percent. For example, use "8.5" not "0.085".</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text"> Tax Rate
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="TaxRateRef"
                       name="api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]" type="hidden"
                       value="{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxRateRef']['name']??'' }}">
                <select id="freshworks_tax_rates" name="api_fields[TaxLineDetail][TaxRateRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][value]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][value]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxRateRef']['value']??'' }}">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxRateRef']['name']??'' }}</option>
                </select>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Tax Inclusive Amount
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxInclusiveAmount]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxInclusiveAmount]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxInclusiveAmount']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxInclusiveAmount]"
                              style="display: none;">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxInclusiveAmount]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxInclusiveAmount]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxInclusiveAmount']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>This is the total amount, including tax..</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Override Delta Amount
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][OverrideDeltaAmount]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][OverrideDeltaAmount]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['OverrideDeltaAmount']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][OverrideDeltaAmount]"
                              style="display: none;">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][OverrideDeltaAmount]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][OverrideDeltaAmount]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['OverrideDeltaAmount']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Numerical expression of the sales tax percent. For example, use "8.5" not "0.085".</span>
            </div>
        </div>


    </div>

</div>