<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
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
            <input type="hidden" name="api_fields[DetailType]" value="SalesItemLineDetail">

            <input data-rule-required="true" data-msg-required=" "
                   class="ParentRefname"
                   name="api_fields[CustomerRef][name]" type="hidden"
                   value="{{ old('api_fields[CustomerRef][name]')?old('api_fields[CustomerRef][name]'):$api_fields['CustomerRef']['name']??'' }}">
            <select id="customers_list"
                    name="api_fields[CustomerRef][value]" class="form-control ContactId"
                    data-rule-required="true">

                <option value="{{ old('api_fields[CustomerRef][value]')?old('api_fields[CustomerRef][value]'):$api_fields['CustomerRef']['value']??'' }}">{{ old('[CustomerRef][name]')?old('api_fields[CustomerRef][name]'):$api_fields['CustomerRef']['name']??'' }}</option>
            </select>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Email
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[BillEmail][Address]')?old('api_fields[BillEmail][Address]'):$api_fields['BillEmail']['Address']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillEmail][Address]"
                          style="display: none;">{{ old('api_fields[BillEmail][Address]')?old('api_fields[BillEmail][Address]'):$api_fields['BillEmail']['Address']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Identifies the e-mail address where the invoice is sent. Required if Email Status=NeedToSend</span>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Email Status
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $emailStatus=old('api_fields[EmailStatus]')?old('api_fields[EmailStatus]'):$api_fields['EmailStatus']??'';  @endphp
            <select name="api_fields[EmailStatus]" class="form-control ">
                <option  @if($emailStatus=="") selected @endif value=""></option>
                <option  @if($emailStatus=="NotSet") selected @endif value="NotSet">Not Set</option>
                <option @if($emailStatus=="EmailSent") selected @endif value="EmailSent ">Email Sent </option>
                <option @if($emailStatus=="NeedToSend") selected @endif value="NeedToSend">Need To Send</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Email status of the receipt. </span>
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

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Message
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[CustomerMemo][value]')?old('api_fields[CustomerMemo][value]'):$api_fields['CustomerMemo']['value']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[CustomerMemo][value]"
                          style="display: none;">{{ old('api_fields[CustomerMemo][value]')?old('api_fields[CustomerMemo][value]'):$api_fields['CustomerMemo']['value']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>User-entered message to the customer; this message is visible to end user on their transactions..</span>
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
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ItemRef"
                       name="api_fields[SalesItemLineDetail][ItemRef][name]" type="hidden"
                       value="{{ old('api_fields[SalesItemLineDetail][ItemRef][name]')?old('api_fields[SalesItemLineDetail][ItemRef][name]'):$api_fields['SalesItemLineDetail']['ItemRef']['name']??'' }}">

                <select id="items_list"
                        name="api_fields[SalesItemLineDetail][ItemRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[SalesItemLineDetail][ItemRef][value]')?old('api_fields[SalesItemLineDetail][ItemRef][value]'):$api_fields['SalesItemLineDetail']['ItemRef']['value']??'' }}">{{ old('[SalesItemLineDetail][ItemRef][name]')?old('api_fields[SalesItemLineDetail][ItemRef][name]'):$api_fields['SalesItemLineDetail']['ItemRef']['name']??'' }}</option>
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
                           class="Polaris-Label__Text">Transaction  Date
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
                <span>Local timezone: YYYY-MM-DD UTC: YYYY-MM-DDZ Specific time zone: YYYY-MM-DD+/-HH:MM.</span>
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
                         contenteditable="true">{{ old('api_fields[SalesItemLineDetail][Qty]')?old('api_fields[SalesItemLineDetail][Qty]'):$api_fields['SalesItemLineDetail']['Qty']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              name="api_fields[SalesItemLineDetail][Qty]"
                              style="display: none;">{{ old('api_fields[SalesItemLineDetail][Qty]')?old('api_fields[SalesItemLineDetail][Qty]'):$api_fields['SalesItemLineDetail']['Qty']??'' }}</textarea>
                </div>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Line Item Unit Price
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[SalesItemLineDetail][UnitPrice]')?old('api_fields[SalesItemLineDetail][UnitPrice]'):$api_fields['SalesItemLineDetail']['UnitPrice']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              name="api_fields[SalesItemLineDetail][UnitPrice]"
                              style="display: none;">{{ old('api_fields[SalesItemLineDetail][UnitPrice]')?old('api_fields[SalesItemLineDetail][UnitPrice]'):$api_fields['SalesItemLineDetail']['UnitPrice']??'' }}</textarea>
                </div>
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
                       name="api_fields[SalesItemLineDetail][TaxCodeRef][name]" type="hidden"
                       value="{{ old('api_fields[SalesItemLineDetail][TaxCodeRef][name]')?old('api_fields[SalesItemLineDetail][TaxCodeRef][name]'):$api_fields['SalesItemLineDetail']['TaxCodeRef']['name']??'' }}">
                <select id="freshworks_tax_codes" name="api_fields[SalesItemLineDetail][TaxCodeRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[SalesItemLineDetail][TaxCodeRef][value]')?old('api_fields[SalesItemLineDetail][TaxCodeRef][value]'):$api_fields['SalesItemLineDetail']['TaxCodeRef']['value']??'' }}">{{ old('[salesItemLineDetail][TaxCodeRef][name]')?old('api_fields[SalesItemLineDetail][TaxCodeRef][name]'):$api_fields['SalesItemLineDetail']['TaxCodeRef']['name']??'' }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Payment Reference Number
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PaymentRefNum]')?old('api_fields[PaymentRefNum]'):$api_fields['PaymentRefNum']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[PaymentRefNum]"
                          style="display: none;">{{ old('api_fields[PaymentRefNum]')?old('api_fields[PaymentRefNum]'):$api_fields['PaymentRefNum']??'' }}</textarea>
            </div>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Preferred Payment Method
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="PaymentMethodRefname"
                   name="api_fields[PaymentMethodRef][name]" type="hidden"
                   value="{{ old('api_fields[PaymentMethodRef][name]')?old('api_fields[PaymentMethodRef][name]'):$api_fields['PaymentMethodRef']['name']??'' }}">
            <select id="PaymentMethods"
                    name="api_fields[PaymentMethodRef][value]" class="form-control ContactId" >
                <option value="{{ old('api_fields[PaymentMethodRef][value]')?old('api_fields[PaymentMethodRef][value]'):$api_fields['PaymentMethodRef']['value']??'' }}">{{ old('[PaymentMethodRef][name]')?old('api_fields[PaymentMethodRef][name]'):$api_fields['PaymentMethodRef']['name']??'' }}</option>
            </select>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Deposit To Account
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="AssetAccountRef"
                   name="api_fields[DepositToAccountRef][name]" type="hidden"
                   value="{{ old('api_fields[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}">
            <select id="inventory_accounts" name="api_fields[DepositToAccountRef][value]" class="form-control ContactId">
                <option value="{{ old('api_fields[DepositToAccountRef][value]')?old('api_fields[DepositToAccountRef][value]'):$api_fields['DepositToAccountRef']['value']??'' }}">{{ old('[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}</option>

            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Income Account.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Doc  Number
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
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Address Line1
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[BillAddr][Line1]')?old('api_fields[BillAddr][Line1]'):$api_fields['BillAddr']['Line1']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillAddr][Line1]"
                          style="display: none;">{{ old('api_fields[BillAddr][Line1]')?old('api_fields[BillAddr][Line1]'):$api_fields['BillAddr']['Line1']??'' }}</textarea>
            </div>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Address City
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[BillAddr][City]')?old('api_fields[BillAddr][City]'):$api_fields['BillAddr']['City']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillAddr][City]"
                          style="display: none;">{{ old('api_fields[BillAddr][City]')?old('api_fields[BillAddr][City]'):$api_fields['BillAddr']['City']??'' }}</textarea>
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
                     contenteditable="true">{{ old('api_fields[BillAddr][PostalCode]')?old('api_fields[BillAddr][PostalCode]'):$api_fields['BillAddr']['PostalCode']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillAddr][PostalCode]"
                          style="display: none;">{{ old('api_fields[BillAddr][PostalCode]')?old('api_fields[BillAddr][PostalCode]'):$api_fields['BillAddr']['PostalCode']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Address Country
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[BillAddr][Country]')?old('api_fields[BillAddr][Country]'):$api_fields['BillAddr']['Country']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillAddr][Country]"
                          style="display: none;">{{ old('api_fields[BillAddr][Country]')?old('api_fields[BillAddr][Country]'):$api_fields['BillAddr']['Country']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Shipping Address Line1
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
                       class="Polaris-Label__Text"> Shipping Address City
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
                       class="Polaris-Label__Text"> Shipping Address Country
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
                       class="Polaris-Label__Text"> Exchange Rate
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[ExchangeRate]')?old('api_fields[ExchangeRate]'):$api_fields['ExchangeRate']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[ExchangeRate]"
                          style="display: none;">{{ old('api_fields[ExchangeRate]')?old('api_fields[ExchangeRate]'):$api_fields['ExchangeRate']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>The number of home currency units it takes to equal one unit of currency specified by CurrencyRef. Applicable if multicurrency is enabled for the company.</span>
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
                          style="display: none;">{{ old('api_fields[TxnTaxDetail][TotalTax]')?old('api_fields[TxnTaxDetail][TotalTax]'):$api_fieldsTxnTaxDetail['TxnTaxDetail']['TotalTax']??'' }}</textarea>
            </div>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Tax Calculation
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $globalTaxCalculation=old('api_fields[GlobalTaxCalculation]')?old('api_fields[GlobalTaxCalculation]'):$api_fields['GlobalTaxCalculation']??'';  @endphp
            <select name="api_fields[GlobalTaxCalculation]" class="form-control ContactId">
                <option
                        @if($globalTaxCalculation=="") selected @endif
                value="">
                </option>
                <option
                        @if($globalTaxCalculation=="TaxExcluded") selected @endif
                value="TaxExcluded">Tax Excluded
                </option>
                <option
                        @if($globalTaxCalculation=="TaxInclusive") selected @endif
                value="TaxInclusive">Tax Inclusive
                </option>
                <option
                        @if($globalTaxCalculation=="NotApplicable") selected @endif
                value="NotApplicable">Not Applicable
                </option>

            </select>
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
</div>