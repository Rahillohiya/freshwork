<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    {{-- required hidden field --}}
    <input type="hidden" name="api_fields[DetailType]" value="AccountBasedExpenseLineDetail">
    <div class="create-bill-accountBase-parent-div">

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
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Transaction Date
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
                <span>The date entered by the user when this transaction occurred. For posting transactions, this is the posting date that affects the financial statements. If the date is not supplied, the current date on the server is used.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Due Date
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[DueDate]')?old('api_fields[DueDate]'):$api_fields['DueDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[DueDate]"
                              style="display: none;">{{ old('api_fields[DueDate]')?old('api_fields[DueDate]'):$api_fields['DueDate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Date when the payment of the transaction is due.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Bill or Document Number
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
            <div class="Polaris-Labelled__HelpText">
                <span>Reference number for the transaction. If not explicitly provided at create time, a custom value can be provided.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Department
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="DepartmentRefName"
                       name="api_fields[DepartmentRef][name]" type="hidden"
                       value="{{ old('api_fields[DepartmentRef][name]')?old('api_fields[DepartmentRef][name]'):$api_fields['DepartmentRef']['name']??'' }}">
                <select id="freshworks_department"
                        name="api_fields[DepartmentRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[DepartmentRef][value]')?old('api_fields[DepartmentRef][value]'):$api_fields['DepartmentRef']['value']??'' }}">{{ old('[DepartmentRef][name]')?old('api_fields[DepartmentRef][name]'):$api_fields['DepartmentRef']['name']??'' }}--None--</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Only available if your preferences allow tracking of department.</span>
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

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Global Tax Calculation
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                @php $globalTaxCalculation=old('api_fields[GlobalTaxCalculation]')?old('api_fields[GlobalTaxCalculation]'):$api_fields['GlobalTaxCalculation']??'';  @endphp
                <select name="api_fields[GlobalTaxCalculation]" class="form-control">
                    <option
                            @if($globalTaxCalculation=="") selected @endif
                    value="">--NONE--</option>
                    <option
                            @if($globalTaxCalculation=="TaxExcluded") selected @endif
                    value="TaxExcluded">Tax Excluded</option>
                    <option
                            @if($globalTaxCalculation=="TaxInclusive") selected @endif
                    value="TaxInclusive">Tax Inclusive</option>
                    <option
                            @if($globalTaxCalculation=="NotApplicable") selected @endif
                    value="NotApplicable">Not Applicable</option>
                </select>
            </div>

            <div class="Polaris-Labelled__HelpText">
                <span>Method in which tax is applied. </span>
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
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea inv_start_date"
                             contenteditable="true">{{ old('api_fields[AccountBasedExpenseLineDetail][TaxAmount]')?old('api_fields[AccountBasedExpenseLineDetail][TaxAmount]'):$api_fields['AccountBasedExpenseLineDetail']['TaxAmount']??'' }}</div>
                        <textarea class="hidden_rich_textarea"
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
                    <input class="TXNTaxCodeRef"
                           name="api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]" type="hidden"
                           value="{{ old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]')?old('api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][name]'):$api_fields['AccountBasedExpenseLineDetail']['TaxCodeRef']['name']??'' }}">
                    <select id="freshworks_txn_tax_codes" name="api_fields[AccountBasedExpenseLineDetail][TaxCodeRef][value]"
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

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Account Payable
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ExpenseAccountRef"
                       name="api_fields[APAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[APAccountRef][name]')?old('api_fields[APAccountRef][name]'):$api_fields['APAccountRef']['name']??'' }}">
                <select id="expense_accounts"
                        name="api_fields[APAccountRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[APAccountRef][value]')?old('api_fields[APAccountRef][value]'):$api_fields['APAccountRef']['value']??'' }}">{{ old('[APAccountRef][name]')?old('api_fields[APAccountRef][name]'):$api_fields['APAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
            <span>
        Specifies to which AP account the bill is credited.</span>
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
                    <select id="freshworks_tax_rates" name="api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][value]"
                            class="form-control ContactId">
                        <option value="{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][value]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][value]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxRateRef']['value']??'' }}">{{ old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]')?old('api_fields[TxnTaxDetail][TaxLine][0][TaxLineDetail][TaxRateRef][name]'):$api_fields['TxnTaxDetail']['TaxLine'][0]['TaxLineDetail']['TaxRateRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Select tax rate  matches with this entry</span>
                </div>
            </div>
        </div>


    </div>

</div>