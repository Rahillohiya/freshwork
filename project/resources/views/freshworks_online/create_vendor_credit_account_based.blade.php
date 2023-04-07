<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    {{-- required hidden field --}}
    <input type="hidden" name="api_fields[DetailType]" value="AccountBasedExpenseLineDetail">
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
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Expense Account
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="accounts_with_ExpenseType"
                       name="api_fields[AccountBasedExpenseLineDetail][AccountRef][name]" type="hidden"
                       value="{{ old('api_fields[AccountBasedExpenseLineDetail][AccountRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][AccountRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['AccountRef']['name']??'' }}">
                <select id="accounts_with_ExpenseType"
                        name="api_fields[AccountBasedExpenseLineDetail][AccountRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[AccountBasedExpenseLineDetail][AccountRef][value]')?old('api_fields[AccountBasedExpenseLineDetail][AccountRef][value]'):$api_fields['AccountBasedExpenseLineDetail']['AccountRef']['value']??'' }}">{{ old('[AccountBasedExpenseLineDetail][AccountRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][AccountRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['AccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
            <span>
            Reference to the expense account used to pay the vendor for this item. Must be an account with account type of Expense. </span>
            </div>
        </div>

        <div class="fields-wrapper" >
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Tax Amount
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea inv_start_date"
                         contenteditable="true">{{ old('api_fields[AccountBasedExpenseLineDetail][TaxAmount]')?old('api_fields[AccountBasedExpenseLineDetail][TaxAmount]'):$api_fields['AccountBasedExpenseLineDetail']['TaxAmount']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              data-msg-required="Please enter start date."
                              data-rule-required="true"
                              data-rule-zeroWideSpace="true"
                              name="api_fields[AccountBasedExpenseLineDetail][TaxAmount]"
                              style="display: none;">{{ old('api_fields[AccountBasedExpenseLineDetail][TaxAmount]')?old('api_fields[AccountBasedExpenseLineDetail][TaxAmount]'):$api_fields['AccountBasedExpenseLineDetail']['TaxAmount']??'' }}</textarea>
                </div>

            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Sales tax paid as part of the expense..</span>
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
                         contenteditable="true">{{ old('api_fields[AccountBasedExpenseLineDetail][TaxInclusiveAmt]')?old('api_fields[AccountBasedExpenseLineDetail][TaxInclusiveAmt]'):$api_fields['AccountBasedExpenseLineDetail']['TaxInclusiveAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[AccountBasedExpenseLineDetail][TaxInclusiveAmt]"
                              style="display: none;">{{ old('api_fields[AccountBasedExpenseLineDetail][TaxInclusiveAmt]')?old('api_fields[AccountBasedExpenseLineDetail][TaxInclusiveAmt]'):$api_fields['AccountBasedExpenseLineDetail']['TaxInclusiveAmt']??'' }}</textarea>
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
                           class="Polaris-Label__Text">Class
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ClassRefName"
                       name="api_fields[AccountBasedExpenseLineDetail][ClassRef][name]" type="hidden"
                       value="{{ old('api_fields[AccountBasedExpenseLineDetail][ClassRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][ClassRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['ClassRef']['name']??'' }}">
                <select id="freshworks_class"
                        name="api_fields[AccountBasedExpenseLineDetail][ClassRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[AccountBasedExpenseLineDetail][ClassRef][value]')?old('api_fields[AccountBasedExpenseLineDetail][ClassRef][value]'):$api_fields['ClassRef']['value']??'' }}">{{ old('[AccountBasedExpenseLineDetail][ClassRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][ClassRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['ClassRef']['name']??'' }}</option>
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
                       name="api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]" type="hidden"
                       value="{{ old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['TaxCodeRef']['name']??'' }}">
                <select id="freshworks_tax_codes" name="api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][value]')?old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][value]'):$api_fields['AccountBasedExpenseLineDetail']['TaxCodeRef']['value']??'' }}">{{ old('[salesItemLineDetail][TaxCodeRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['TaxCodeRef']['name']??'' }}</option>
                </select>
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
                       name="api_fields[AccountBasedExpenseLineDetail][CustomerRef][name]" type="hidden"
                       value="{{ old('api_fields[AccountBasedExpenseLineDetail][CustomerRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][CustomerRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['CustomerRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[AccountBasedExpenseLineDetail][CustomerRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[AccountBasedExpenseLineDetail][CustomerRef][value]')?old('api_fields[AccountBasedExpenseLineDetail][CustomerRef][value]'):$api_fields['AccountBasedExpenseLineDetail']['CustomerRef']['value']??'' }}">{{ old('[AccountBasedExpenseLineDetail][CustomerRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][CustomerRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['CustomerRef']['name']??'' }}</option>
                </select>
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
                <span>Description.</span>
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