<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-estimate-paent-div">
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
                <span>Provide currency value only if <a
                            href="https://freshworks.intuit.com/learn-support/en-us/multi-currency/turn-on-and-use-multicurrency/00/186395">multicurrency</a> is enabled in your Freshworks CRM.</span>
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
                           class="Polaris-Label__Text">Doc Number
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
            <span>Max of 21 characters. If empty, Freshworks will generate one by incrementing the last number, but only if you have custom transaction numbers disabled. number automatically. Max of 21 characters.
</span>
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
                               class="Polaris-Label__Text"> Discount Amount
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[SalesItemLineDetail][DiscountAmt]')?old('api_fields[SalesItemLineDetail][DiscountAmt]'):$api_fields['SalesItemLineDetail']['DiscountAmt']??'' }}</div>
                        <textarea class="hidden_rich_textarea"
                                  name="api_fields[SalesItemLineDetail][DiscountAmt]"
                                  style="display: none;">{{ old('api_fields[SalesItemLineDetail][DiscountAmt]')?old('api_fields[SalesItemLineDetail][DiscountAmt]'):$api_fields['SalesItemLineDetail']['DiscountAmt']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>The total amount of the line item including tax.</span>
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
                             contenteditable="true">{{ old('api_fields[SalesItemLineDetail][TaxInclusiveAmt]')?old('api_fields[SalesItemLineDetail][TaxInclusiveAmt]'):$api_fields['SalesItemLineDetail']['TaxInclusiveAmt']??'' }}</div>
                        <textarea class="hidden_rich_textarea"
                                  name="api_fields[SalesItemLineDetail][TaxInclusiveAmt]"
                                  style="display: none;">{{ old('api_fields[SalesItemLineDetail][TaxInclusiveAmt]')?old('api_fields[SalesItemLineDetail][TaxInclusiveAmt]'):$api_fields['SalesItemLineDetail']['TaxInclusiveAmt']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>The total amount of the line item including tax.</span>
                </div>
            </div>
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
                        <label id="PolarisTextField2Label"
                               for="PolarisTextField2"
                               class="Polaris-Label__Text"> Discount Rate
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[SalesItemLineDetail][DiscountRate]')?old('api_fields[SalesItemLineDetail][DiscountRate]'):$api_fields['SalesItemLineDetail']['DiscountRate']??'' }}</div>
                        <textarea class="hidden_rich_textarea"
                                  name="api_fields[SalesItemLineDetail][DiscountRate]"
                                  style="display: none;">{{ old('api_fields[SalesItemLineDetail][DiscountRate]')?old('api_fields[SalesItemLineDetail][DiscountRate]'):$api_fields['SalesItemLineDetail']['DiscountRate']??'' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Line Item/Product
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
                               class="Polaris-Label__Text"> Line Amount
                            <span>(required)</span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</div>
                        <textarea class="hidden_rich_textarea" data-rule-required="true"
                                  name="api_fields[Amount]"
                                  style="display: none;">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Should not include tax.</span>
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
                        <textarea class="hidden_rich_textarea" data-rule-required="true"
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
                               class="Polaris-Label__Text">Rate
                            <span>(required)</span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[SalesItemLineDetail][UnitPrice]')?old('api_fields[SalesItemLineDetail][UnitPrice]'):$api_fields['SalesItemLineDetail']['UnitPrice']??'' }}</div>
                        <textarea class="hidden_rich_textarea" data-rule-required="true"
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
                               class="Polaris-Label__Text"> Line Description
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary ">
                        <div class="input-field-selection-textarea rich_textarea msg-body-style"
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
                               class="Polaris-Label__Text">Class
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="ClassRefName"
                           name="api_fields[SalesItemLineDetail][ClassRef][name]" type="hidden"
                           value="{{ old('api_fields[SalesItemLineDetail][ClassRef][name]')?old('api_fields[SalesItemLineDetail][ClassRef][name]'):$api_fields['SalesItemLineDetail']['ClassRef']['name']??'' }}">
                    <select id="freshworks_class"
                            name="api_fields[SalesItemLineDetail][ClassRef][value]" class="form-control ContactId">
                        <option value="{{ old('api_fields[SalesItemLineDetail][ClassRef][value]')?old('api_fields[SalesItemLineDetail][ClassRef][value]'):$api_fields['SalesItemLineDetail']['ClassRef']['value']??'' }}">{{ old('[SalesItemLineDetail][ClassRef][name]')?old('api_fields[SalesItemLineDetail][ClassRef][name]'):$api_fields['SalesItemLineDetail']['ClassRef']['name']??'' }}</option>
                    </select>
                </div>

                <div class="Polaris-Labelled__HelpText">
                    <span>Only available if class tracking is enabled and assigned using the "one to each row in transaction" option.</span>
                </div>
            </div>


            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text"> Line Item Tax Code
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
        <div class="interlink-fields">
            <h4 class="connector-heading">Shipping Address </h4>
            <p>Identifies the address where the goods must be shipped. If Ship Address not specified, and a default
                Customer:ShippingAddr is specified in Freshworks for this customer, the default ship-to address will be
                used by Freshworks.
                For international addresses - countries should be passed as 3 ISO alpha-3 characters or the full name of
                the country.</p>
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
                           class="Polaris-Label__Text">Expiration Date
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ExpirationDate]')?old('api_fields[ExpirationDate]'):$api_fields['ExpirationDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ExpirationDate]"
                              style="display: none;">{{ old('api_fields[ExpirationDate]')?old('api_fields[ExpirationDate]'):$api_fields['ExpirationDate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
            <span> Local timezone: YYYY-MM-DD UTC: YYYY-MM-DDZ Specific time zone: YYYY-MM-DD+/-HH:MM</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Customer Memo
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary ">
                    <div class="input-field-selection-textarea rich_textarea msg-body-style"
                         contenteditable="true">{{ old('api_fields[CustomerMemo][value]')?old('api_fields[CustomerMemo][value]'):$api_fields['CustomerMemo']['value']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[CustomerMemo][value]"
                              style="display: none;">{{ old('api_fields[CustomerMemo][value]')?old('api_fields[CustomerMemo][value]'):$api_fields['CustomerMemo']['value']??'' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>