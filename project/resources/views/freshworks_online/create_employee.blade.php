<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Given Name
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[GivenName]')?old('api_fields[GivenName]'):$api_fields['GivenName']??'' }}</div>
                <textarea class="hidden_rich_textarea" id="employee_given_name"
                          data-rule-required="true"
                          data-rule-zeroWideSpace="true"

                          name="api_fields[GivenName]"
                          style="display: none;">{{ old('api_fields[GivenName]')?old('api_fields[GivenName]'):$api_fields['GivenName']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Given name or family name of a person. At least one of GivenName or FamilyName attributes is required.Given name must be unique.Try to included dynamic values from shopify variables to avoid duplicates.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Family Name
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[FamilyName]')?old('api_fields[FamilyName]'):$api_fields['FamilyName']??'' }}</div>
                <textarea id="employee_family_name" class="hidden_rich_textarea"
                          name="api_fields[FamilyName]"
                          data-rule-required="true"
                          style="display: none;">{{ old('api_fields[FamilyName]')?old('api_fields[FamilyName]'):$api_fields['FamilyName']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Family name or the last name of the person. At least one of GivenName or FamilyName attributes is required.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Primary Address
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrimaryAddr][Line1]')?old('api_fields[PrimaryAddr][Line1]'):$api_fields['PrimaryAddr']['Line1']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter Primary Address"
                          data-rule-required="true"
                          name="api_fields[PrimaryAddr][Line1]"
                          style="display: none;">{{ old('api_fields[PrimaryAddr][Line1]')?old('api_fields[PrimaryAddr][Line1]'):$api_fields['PrimaryAddr']['Line1']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Represents the physical street address for this employee.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Phone
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrimaryPhone][FreeFormNumber]')?old('api_fields[PrimaryPhone][FreeFormNumber]'):$api_fields['PrimaryPhone']['FreeFormNumber']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter Phone Number"
                          data-rule-required="true"
                          name="api_fields[PrimaryPhone][FreeFormNumber]"
                          style="display: none;">{{ old('api_fields[PrimaryPhone][FreeFormNumber]')?old('api_fields[PrimaryPhone][FreeFormNumber]'):$api_fields['PrimaryPhone']['FreeFormNumber']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Specifies the telephone number in free form.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">City
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrimaryAddr][City]')?old('api_fields[PrimaryAddr][City]'):$api_fields['PrimaryAddr']['City']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter City"
                          data-rule-required="true"
                          name="api_fields[PrimaryAddr][City]"
                          style="display: none;">{{ old('api_fields[PrimaryAddr][City]')?old('api_fields[PrimaryAddr][City]'):$api_fields['PrimaryAddr']['City']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span> The following PhysicalAddress fields are required.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Postal Code
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrimaryAddr][PostalCode]')?old('api_fields[PrimaryAddr][PostalCode]'):$api_fields['PrimaryAddr']['PostalCode']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter Postal Code."
                          data-rule-required="true"
                          name="api_fields[PrimaryAddr][PostalCode]"
                          style="display: none;">{{ old('api_fields[PrimaryAddr][PostalCode]')?old('api_fields[PrimaryAddr][PostalCode]'):$api_fields['PrimaryAddr']['PostalCode']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span> The following PhysicalAddress fields are required.</span>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Country Sub Division Code
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PrimaryAddr][CountrySubDivisionCode]')?old('api_fields[PrimaryAddr][CountrySubDivisionCode]'):$api_fields['PrimaryAddr']['CountrySubDivisionCode']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter Country Sub Division Code."
                          data-rule-required="true"
                          name="api_fields[PrimaryAddr][CountrySubDivisionCode]"
                          style="display: none;">{{ old('api_fields[PrimaryAddr][CountrySubDivisionCode]')?old('api_fields[PrimaryAddr][CountrySubDivisionCode]'):$api_fields['PrimaryAddr']['CountrySubDivisionCode']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span> The following PhysicalAddress fields are required.</span>
        </div>
    </div>

</div>