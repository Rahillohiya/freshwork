<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    @if($channel_event->slug=="update_invoice")
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Select Invoice to update
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input data-rule-required="true" data-msg-required=" "
                   class="InvoiceRefName"
                   name="object_text" type="hidden"
                   value="{{ old('object_text')?old('object_text'):$channel_event_settings->object_text??'' }}">
            <select id="freshworks_invoices"
                    name="object_id" class="form-control ContactId"
                    data-rule-required="true">
                <option value="{{ old('object_id')?old('object_id'):$channel_event_settings->object_id??'' }}">{{ old('object_text')?old('object_text'):$channel_event_settings->object_text??'' }}</option>
            </select>
        </div>
        {{--<div class="Polaris-Labelled__HelpText">--}}
            {{--<span>Select Invoice to update</span>--}}
        {{--</div>--}}
    </div>
    @endif
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Customer
                    <span>(required)</span>
                </label>
            </div>
        </div>
        {{-- required hidden field --}}
        <input type="hidden" name="api_fields[DetailType]" value="SalesItemLineDetail">
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
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Cc
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[BillEmailCc][Address]')?old('api_fields[BillEmailCc][Address]'):$api_fields['BillEmailCc']['Address']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillEmailCc][Address]"
                          style="display: none;">{{ old('api_fields[BillEmailCc][Address]')?old('api_fields[BillEmailCc][Address]'):$api_fields['BillEmailCc']['Address']??'' }}</textarea>
        </div>

        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Bcc
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[BillEmailBcc][Address]')?old('api_fields[BillEmailBcc][Address]'):$api_fields['BillEmailBcc']['Address']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[BillEmailBcc][Address]"
                          style="display: none;">{{ old('api_fields[BillEmailBcc][Address]')?old('api_fields[BillEmailBcc][Address]'):$api_fields['BillEmailBcc']['Address']??'' }}</textarea>
            </div>
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
    <div class="interlink-fields">
        <h4 class="connector-heading"> Line Items </h4>
        <p>Multiple line items will be inserted into connector for all shopify webhooks which contain multiple line items in them e-g Order,Cart ,Checkout and Refund Line Items.If an order has 3 items in it you can choose line item properties like
            quantity,price and amount from shopify variables by searching them by @name in the input fields</p>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Service Date
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[SalesItemLineDetail][ServiceDate]')?old('api_fields[SalesItemLineDetail][ServiceDate]'):$api_fields['SalesItemLineDetail']['ServiceDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[SalesItemLineDetail][ServiceDate]"
                              style="display: none;">{{ old('api_fields[SalesItemLineDetail][ServiceDate]')?old('api_fields[SalesItemLineDetail][ServiceDate]'):$api_fields['SalesItemLineDetail']['ServiceDate']??'' }}</textarea>
                </div>
            </div>
        </div>

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
                       name="api_fields[SalesItemLineDetail][ItemRef][name]" type="hidden"
                       value="{{ old('api_fields[SalesItemLineDetail][ItemRef][name]')?old('api_fields[SalesItemLineDetail][ItemRef][name]'):$api_fields['SalesItemLineDetail']['ItemRef']['name']??'' }}">

                <select id="items_list" data-rule-required="true"
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
                           class="Polaris-Label__Text"> Line Item Unit Price/Rate
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

    </div>
    <div class="interlink-fields">
        <h4 class="connector-heading">Billing Address </h4>
        <p>Bill-to address of the Invoice. If BillAddris not specified, and a default Customer:BillingAddr is specified in Freshworks for this customer, the default bill-to address is used by Freshworks.
            For international addresses - countries should be passed as 3 ISO alpha-3 characters or the full name of the country.</p>
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
    </div>

    <div class="interlink-fields">
        <h4 class="connector-heading">Shipping Address </h4>
    <p>Identifies the address where the goods must be shipped. If ShipAddris not specified, and a default Customer:ShippingAddr is specified in Freshworks for this customer, the default ship-to address will be used by Freshworks.
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

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Invoice/Transaction Date
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
                       class="Polaris-Label__Text"> Due Date
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
            <span>Date when the payment of the transaction is due. If date is not provided, the number of days specified in SalesTermRef added the transaction date will be used.Local timezone: YYYY-MM-DD UTC: YYYY-MM-DDZ Specific time zone: YYYY-MM-DD+/-HH:MM</span>
        </div>
    </div>

    <div class="interlink-fields">
        <h4 class="connector-heading"> Ship From Address </h4>
    <p>Identifies the address where the goods are shipped from. For transactions without shipping, it represents the address where the sale took place.
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
                         contenteditable="true">{{ old('api_fields[ShipFromAddr][Line1]')?old('api_fields[ShipFromAddr][Line1]'):$api_fields['ShipFromAddr']['Line1']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipFromAddr][Line1]"
                              style="display: none;">{{ old('api_fields[ShipFromAddr][Line1]')?old('api_fields[ShipFromAddr][Line1]'):$api_fields['ShipFromAddr']['Line1']??'' }}</textarea>
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
                         contenteditable="true">{{ old('api_fields[ShipFromAddr][City]')?old('api_fields[ShipFromAddr][City]'):$api_fields['ShipFromAddr']['City']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipFromAddr][City]"
                              style="display: none;">{{ old('api_fields[ShipFromAddr][City]')?old('api_fields[ShipFromAddr][City]'):$api_fields['ShipFromAddr']['City']??'' }}</textarea>
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
                         contenteditable="true">{{ old('api_fields[ShipFromAddr][PostalCode]')?old('api_fields[ShipFromAddr][PostalCode]'):$api_fields['ShipFromAddr']['PostalCode']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipFromAddr][PostalCode]"
                              style="display: none;">{{ old('api_fields[ShipFromAddr][PostalCode]')?old('api_fields[ShipFromAddr][PostalCode]'):$api_fields['ShipFromAddr']['PostalCode']??'' }}</textarea>
                </div>

            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Country
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ShipFromAddr][Country]')?old('api_fields[ShipFromAddr][Country]'):$api_fields['ShipFromAddr']['Country']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ShipFromAddr][Country]"
                              style="display: none;">{{ old('api_fields[ShipFromAddr][Country]')?old('api_fields[ShipFromAddr][Country]'):$api_fields['ShipFromAddr']['Country']??'' }}</textarea>
                </div>

            </div>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Shipping Date
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[ShipDate]')?old('api_fields[ShipDate]'):$api_fields['ShipDate']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[ShipDate]"
                          style="display: none;">{{ old('api_fields[ShipDate]')?old('api_fields[ShipDate]'):$api_fields['ShipDate']??'' }}</textarea>
            </div>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Tracking Number
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[TrackingNum]')?old('api_fields[TrackingNum]'):$api_fields['TrackingNum']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[TrackingNum]"
                          style="display: none;">{{ old('api_fields[TrackingNum]')?old('api_fields[TrackingNum]'):$api_fields['TrackingNum']??'' }}</textarea>
            </div>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Invoice/Document Number
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
                       class="Polaris-Label__Text"> Message Memo
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
            <span>User entered, organization-private note about the transaction. This note does not appear on the invoice to the customer. This field maps to the Statement Memo field on the Invoice form in the Freshworks Online UI.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Accept Payment Via Bank Transfer
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $allowOnlineACHPayment=old('api_fields[AllowOnlineACHPayment]')?old('api_fields[AllowOnlineACHPayment]'):$api_fields['AllowOnlineACHPayment']??'';  @endphp
            <select name="api_fields[AllowOnlineACHPayment]" class="form-control">
                <option
                        @if($allowOnlineACHPayment=="") selected @endif
                value="">--NONE--</option>
                <option
                        @if($allowOnlineACHPayment=="true") selected @endif
                value="true">True</option>
                <option
                        @if($allowOnlineACHPayment=="false") selected @endif
                value="false">False</option>
            </select>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Accept Payment Via Credit Card
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $allowOnlineCreditCardPayment=old('api_fields[AllowOnlineCreditCardPayment]')?old('api_fields[AllowOnlineCreditCardPayment]'):$api_fields['AllowOnlineCreditCardPayment']??'';  @endphp
            <select name="api_fields[AllowOnlineCreditCardPayment]" class="form-control">
                <option
                        @if($allowOnlineCreditCardPayment=="") selected @endif
                value="">--NONE--</option>
                <option
                        @if($allowOnlineCreditCardPayment=="true") selected @endif
                value="true">True</option>
                <option
                        @if($allowOnlineCreditCardPayment=="false") selected @endif
                value="false">False</option>
            </select>
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
                       class="Polaris-Label__Text">Apply Tax After Discount??
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $applyTaxAfterDiscount=old('api_fields[ApplyTaxAfterDiscount]')?old('api_fields[ApplyTaxAfterDiscount]'):$api_fields['ApplyTaxAfterDiscount']??'';  @endphp
            <select name="api_fields[ApplyTaxAfterDiscount]" class="form-control">
                <option
                        @if($applyTaxAfterDiscount=="") selected @endif
                value="">--NONE--</option>
                <option
                        @if($applyTaxAfterDiscount=="true") selected @endif
                value="true">True</option>
                <option
                        @if($applyTaxAfterDiscount=="false") selected @endif
                value="false">False</option>
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
    </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Deposit
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Deposit]')?old('api_fields[Deposit]'):$api_fields['Deposit']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Deposit]"
                          style="display: none;">{{ old('api_fields[Deposit]')?old('api_fields[Deposit]'):$api_fields['Deposit']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span> The deposit made towards this invoice.Make sure if you have enabled correct settings in freshworks for this field.</span>
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
                       class="Polaris-Label__Text">Location
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $transactionLocationType=old('api_fields[TransactionLocationType]')?old('api_fields[TransactionLocationType]'):$api_fields['TransactionLocationType']??'';  @endphp
            <select name="api_fields[TransactionLocationType]" class="form-control">
                <option
                        @if($transactionLocationType=="") selected @endif
                value="">--NONE--</option>
                <option
                        @if($transactionLocationType=="WithinFrance") selected @endif
                value="WithinFrance">Within the France</option>
                <option
                        @if($transactionLocationType=="FranceOverseas") selected @endif
                value="FranceOverseas">France Overseas</option>
                <option
                        @if($transactionLocationType=="OutsideFranceWithEU") selected @endif
                value="OutsideFranceWithEU">Outside France With Europe</option>
                <option
                        @if($transactionLocationType=="OutsideEU") selected @endif
                value="OutsideEU">Outside Europe</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Only available for France locales.</span>
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
</div>