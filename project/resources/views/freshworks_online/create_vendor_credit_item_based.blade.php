<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    {{-- required hidden field --}}
    <input type="hidden" name="api_fields[DetailType]" value="ItemBasedExpenseLineDetail">
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
                       class="Polaris-Label__Text">Currency
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="CurrencyRefname"
                   name="api_fields[CurrencyRef][name]" type="hidden"
                   value="{{ old('api_fields[CurrencyRef][name]')?old('api_fields[CurrencyRef][name]'):$api_fields['CurrencyRef']['name']??'' }}">
            <select id="freshworks_currency"
                    name="api_fields[CurrencyRef][value]" class="form-control ContactId">
                <option value="{{ old('api_fields[CurrencyRef][value]')?old('api_fields[CurrencyRef][value]'):$api_fields['CurrencyRef']['value']??'' }}">{{ old('[CurrencyRef][name]')?old('api_fields[CurrencyRef][name]'):$api_fields['CurrencyRef']['name']??'' }}</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Provide currency value only if <a href="https://freshworks.intuit.com/learn-support/en-us/multi-currency/turn-on-and-use-multicurrency/00/186395">multicurrency</a> is enabled in your Freshworks CRM.</span>
        </div>
    </div>

    <div class="interlink-fields">
        <h4 class="connector-heading"> Line Item </h4>
        <p>Multiple line items will be inserted into connector for all shopify webhooks which contain multiple line items in them e-g Order,Cart ,Checkout and Refund Line Items.If an order has 3 items in it you can choose line item properties like
            quantity,price and amount from shopify variables by searching them by @name in the input fields</p>
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
                <input class="ItemRef"
                       name="api_fields[ItemBasedExpenseLineDetail][ItemRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemBasedExpenseLineDetail][ItemRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][ItemRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['ItemRef']['name']??'' }}">

                <select id="items_list"
                        data-rule-required="true"
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
                           class="Polaris-Label__Text"> Tax inclusive amount
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ItemBasedExpenseLineDetail][TaxInclusiveAmt]')?old('api_fields[ItemBasedExpenseLineDetail][TaxInclusiveAmt]'):$api_fields['ItemBasedExpenseLineDetail']['TaxInclusiveAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ItemBasedExpenseLineDetail][TaxInclusiveAmt]"
                              style="display: none;">{{ old('api_fields[ItemBasedExpenseLineDetail][TaxInclusiveAmt]')?old('api_fields[ItemBasedExpenseLineDetail][TaxInclusiveAmt]'):$api_fields['ItemBasedExpenseLineDetail']['TaxInclusiveAmt']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>The total amount of the line item including tax.</span>
            </div>
        </div>



        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Customer
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ParentRefname"
                       name="api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['CustomerRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[ItemBasedExpenseLineDetail][CustomerRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][value]')?old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][value]'):$api_fields['ItemBasedExpenseLineDetail']['CustomerRef']['value']??'' }}">{{ old('[ItemBasedExpenseLineDetail][CustomerRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][CustomerRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['CustomerRef']['name']??'' }}</option>
                </select>
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
                       name="api_fields[ItemBasedExpenseLineDetail][ClassRef][name]" type="hidden"
                       value="{{ old('api_fields[ItemBasedExpenseLineDetail][ClassRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][ClassRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['ClassRef']['name']??'' }}">
                <select id="freshworks_class"
                        name="api_fields[ItemBasedExpenseLineDetail][ClassRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[ItemBasedExpenseLineDetail][ClassRef][value]')?old('api_fields[ItemBasedExpenseLineDetail][ClassRef][value]'):$api_fields['ClassRef']['value']??'' }}">{{ old('[ItemBasedExpenseLineDetail][ClassRef][name]')?old('api_fields[ItemBasedExpenseLineDetail][ClassRef][name]'):$api_fields['ItemBasedExpenseLineDetail']['ClassRef']['name']??'' }}</option>
                </select>
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
                    <textarea class="hidden_rich_textarea"
                              data-msg-required="Please enter amount."
                              data-rule-required="true"
                              data-rule-zeroWideSpace="true"
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
                           class="Polaris-Label__Text">Description
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
            <div class="Polaris-Labelled__HelpText">
                <span>Description of line item.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Line Number
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[LineNum]')?old('api_fields[LineNum]'):$api_fields['LineNum']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[LineNum]"
                              style="display: none;">{{ old('api_fields[LineNum]')?old('api_fields[LineNum]'):$api_fields['LineNum']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Specifies the position of the line in the collection of transaction lines. Positive Integer.</span>
            </div>
        </div>
    </div>



</div>