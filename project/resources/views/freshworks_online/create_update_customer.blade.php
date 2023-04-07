<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>

    @if($channel_event->slug=="update_customer")
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Customer To Update
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input data-rule-required="true"
                       name="object_text" class="selected_customer_nameto_update" type="hidden"
                       value="{{ old('object_text')?old('object_text'):$channel_event_settings->object_text??'' }}">
                <select id="update_customer_object"
                        name="object_id" class="form-control object_id"   data-rule-required="true" >

                    <option value="{{ old('object_id')?old('object_id'):$channel_event_settings->object_id??'' }}">{{ old('object_text')?old('object_text'):$channel_event_settings->object_text??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                        <span>Choose customer from freshworks to update on shopify webhooks.
                        </span>
            </div>
        </div>
    @endif


    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Display Name
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[DisplayName]')?old('api_fields[DisplayName]'):$api_fields['DisplayName']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[DisplayName]"
                          style="display: none;">{{ old('api_fields[DisplayName]')?old('api_fields[DisplayName]'):$api_fields['DisplayName']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>The name of the person or organization as displayed. Must be unique across all Customer, Vendor, and Employee objects. Cannot be removed with sparse update. If not supplied, the system generates DisplayName by concatenating customer name components supplied in the request from the following list: Title, First Name, MiddleName, Last Name, and Suffix.</span>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Title
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Title]')?old('api_fields[Title]'):$api_fields['Title']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Title]"
                          style="display: none;">{{ old('api_fields[Title]')?old('api_fields[Title]'):$api_fields['Title']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">First Name
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[GivenName]')?old('api_fields[GivenName]'):$api_fields['GivenName']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[GivenName]"
                          style="display: none;">{{ old('api_fields[GivenName]')?old('api_fields[GivenName]'):$api_fields['GivenName']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Last Name
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[FamilyName]')?old('api_fields[FamilyName]'):$api_fields['FamilyName']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[FamilyName]"

                          style="display: none;">{{ old('api_fields[FamilyName]')?old('api_fields[FamilyName]'):$api_fields['FamilyName']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Suffix
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Suffix]')?old('api_fields[Suffix]'):$api_fields['Suffix']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Suffix]"
                          data-msg-required="Please enter Full Name."
                          data-rule-required="true"
                          data-rule-zeroWideSpace="true"
                          style="display: none;">{{ old('api_fields[Suffix]')?old('api_fields[Suffix]'):$api_fields['Suffix']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Company
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[CompanyName]')?old('api_fields[CompanyName]'):$api_fields['CompanyName']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[CompanyName]"
                          style="display: none;">{{ old('api_fields[CompanyName]')?old('api_fields[CompanyName]'):$api_fields['CompanyName']??'' }}</textarea>
            </div>

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
                     contenteditable="true">{{ old('api_fields[PrimaryEmailAddr][Address]')?old('api_fields[PrimaryEmailAddr][Address]'):$api_fields['PrimaryEmailAddr']['Address']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[PrimaryEmailAddr][Address]"
                          style="display: none;">{{ old('api_fields[PrimaryEmailAddr][Address]')?old('api_fields[PrimaryEmailAddr][Address]'):$api_fields['PrimaryEmailAddr']['Address']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Phone
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrimaryPhone][FreeFormNumber]')?old('api_fields[PrimaryPhone][FreeFormNumber]'):$api_fields['PrimaryPhone']['FreeFormNumber']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[PrimaryPhone][FreeFormNumber]"
                          style="display: none;">{{ old('api_fields[PrimaryPhone][FreeFormNumber]')?old('api_fields[PrimaryPhone][FreeFormNumber]'):$api_fields['PrimaryPhone']['FreeFormNumber']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Fax
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Fax]')?old('api_fields[Fax]'):$api_fields['Fax']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Fax]"
                          style="display: none;">{{ old('api_fields[Fax]')?old('api_fields[Fax]'):$api_fields['Fax']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Website
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[WebAddr]')?old('api_fields[WebAddr]'):$api_fields['WebAddr']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[WebAddr]"
                          style="display: none;">{{ old('api_fields[WebAddr]')?old('api_fields[WebAddr]'):$api_fields['WebAddr']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">GST Registration Type
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $GSTRegistrationType=old('api_fields[GSTRegistrationType]')?old('api_fields[GSTRegistrationType]'):$api_fields['GSTRegistrationType']??'';  @endphp
            <select name="api_fields[GSTRegistrationType]" class="form-control ContactId">

                <option
                        @if($GSTRegistrationType=="GST_REG_REG") selected @endif
                value="GST_REG_REG">GST registered- Regular
                </option>

                <option
                        @if($GSTRegistrationType=="GST_REG_COMP") selected @endif
                value="GST_REG_COMP">GST registered- Regular
                </option>

                <option
                        @if($GSTRegistrationType=="GST_UNREG") selected @endif
                value="GST_UNREG">GST registered-Composition
                </option>

                <option
                        @if($GSTRegistrationType=="CONSUMER") selected @endif
                value="CONSUMER">GST Unregistered
                </option>

                <option
                        @if($GSTRegistrationType=="OVERSEAS") selected @endif
                value="OVERSEAS">Overseas
                </option>

                <option
                        @if($GSTRegistrationType=="SEZ") selected @endif
                value="SEZ">SEZ
                </option>
                <option
                        @if($GSTRegistrationType=="DEEMED") selected @endif
                value="DEEMED">Deemed exports- EOU's, STP's EHTP's
                </option>

            </select>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> GSTIN
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[GSTIN]')?old('api_fields[GSTIN]'):$api_fields['GSTIN']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[GSTIN]"
                          style="display: none;">{{ old('api_fields[GSTIN]')?old('api_fields[GSTIN]'):$api_fields['GSTIN']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="billing-address-section">
        <h4 class="connector-heading"> Billing Address </h4>
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
                              name="api_fields[AddressLine1]"
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
                           class="Polaris-Label__Text"> Country
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
    <div class="Shipping-address-section">
        <h4 class="connector-heading"> Shipping Address </h4>
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
                           class="Polaris-Label__Text"> Country
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
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Notes
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Notes]')?old('api_fields[Notes]'):$api_fields['Notes']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Notes]"
                              style="display: none;">{{ old('api_fields[Notes]')?old('api_fields[Notes]'):$api_fields['Notes']??'' }}</textarea>
                </div>

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
                       class="Polaris-Label__Text"> Tax Registration Number
                    <span></span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[SecondaryTaxIdentifier]')?old('api_fields[SecondaryTaxIdentifier]'):$api_fields['DefaultTaxCodeRef']['value']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[SecondaryTaxIdentifier]"
                          style="display: none;">{{ old('api_fields[SecondaryTaxIdentifier]')?old('api_fields[SecondaryTaxIdentifier]'):$api_fields['DefaultTaxCodeRef']['value']??'' }}</textarea>
            </div>

        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Job/Parent Customer
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="ParentRefname"
                   name="api_fields[ParentRef][name]" type="hidden"
                   value="{{ old('api_fields[ParentRef][name]')?old('api_fields[ParentRef][name]'):$api_fields['ParentRef']['name']??'' }}">

            <select id="customers_list"
                    name="api_fields[ParentRef][value]" class="form-control ContactId">
                <option value="{{ old('api_fields[ParentRef][value]')?old('api_fields[ParentRef][value]'):$api_fields['ParentRef']['value']??'' }}">{{ old('[ParentRef][name]')?old('api_fields[ParentRef][name]'):$api_fields['ParentRef']['name']??'' }}</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Choose a Parent Customer if you're creating a Job/sub-customer.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Bill With Parent?
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $BillWithParent=old('api_fields[BillWithParent]')?old('api_fields[BillWithParent]'):$api_fields['BillWithParent']??'';  @endphp
            <select name="api_fields[BillWithParent]" class="form-control ContactId">
                <option
                        @if($BillWithParent=="") selected @endif
                value="">--NONE--</option>
                <option
                        @if($BillWithParent=="true") selected @endif
                value="true">True</option>
                <option
                        @if($BillWithParent=="false") selected @endif
                value="false">False</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>If no, this customer will be billed.</span>
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
                       class="Polaris-Label__Text">Preferred Delivery Method
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $PreferredDeliveryMethod=old('api_fields[PreferredDeliveryMethod]')?old('api_fields[PreferredDeliveryMethod]'):$api_fields['PreferredDeliveryMethod']??'';  @endphp
            <select name="api_fields[PreferredDeliveryMethod]" class="form-control ContactId">
                <option
                        @if($PreferredDeliveryMethod=="None") selected @endif
                value="None">--NONE--</option>
                <option
                        @if($PreferredDeliveryMethod=="Print") selected @endif
                value="Print">Print</option>
                <option
                        @if($PreferredDeliveryMethod=="Email") selected @endif
                value="Email">Email</option>
            </select>
        </div>

    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Sales Terms
                    <span></span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="SalesTermRef"
                   name="api_fields[SalesTermRef][name]" type="hidden"
                   value="{{ old('api_fields[SalesTermRef][name]')?old('api_fields[SalesTermRef][name]'):$api_fields['SalesTermRef']['name']??'' }}">
            <select id="freshworks_terms"
                    name="api_fields[SalesTermRef][value]" class="form-control ContactId">
                <option value="{{ old('api_fields[SalesTermRef][value]')?old('api_fields[SalesTermRef][value]'):$api_fields['SalesTermRef']['value']??'' }}">{{ old('[SalesTermRef][name]')?old('api_fields[SalesTermRef][name]'):$api_fields['SalesTermRef']['name']??'' }}</option>
            </select>
        </div>
    </div>

</div>