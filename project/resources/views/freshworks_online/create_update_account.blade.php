<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>

    <div class=" create-update-account-parent-div">

        <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Name
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter Class Name."
                          data-rule-required="true"
                          name="api_fields[Name]"
                          style="display: none;">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>User recognizable name for the Account.</span>
        </div>
    </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Account Number
                        <span>optional</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[AcctNum]')?old('api_fields[AcctNum]'):$api_fields['AcctNum']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[AcctNum]"
                              style="display: none;">{{ old('api_fields[AcctNum]')?old('api_fields[AcctNum]'):$api_fields['AcctNum']??'' }}</textarea>
                </div>

            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>User-defined account number to help the user in identifying the account within the chart-of-accounts and in deciding what should be posted to the account. </span>
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
                       name="api_fields[TaxCodeRef][name]" type="hidden"
                       value="{{ old('api_fields[TaxCodeRef][name]')?old('api_fields[TaxCodeRef][name]'):$api_fields['TaxCodeRef']['name']??'' }}">
                <select id="freshworks_txn_tax_codes" name="api_fields[TaxCodeRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[TaxCodeRef][value]')?old('api_fields[TaxCodeRef][value]'):$api_fields['TaxCodeRef']['value']??'' }}">{{ old('[salesItemLineDetail][TaxCodeRef][name]')?old('api_fields[TaxCodeRef][name]'):$api_fields['TaxCodeRef']['name']??'' }}</option>
                </select>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Account Type
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[AcctNum]')?old('api_fields[AcctNum]'):$api_fields['AcctNum']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[AcctNum]"
                              style="display: none;">{{ old('api_fields[AcctNum]')?old('api_fields[AcctNum]'):$api_fields['AcctNum']??'' }}</textarea>
                </div>

            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>User-defined account number to help the user in identifying the account within the chart-of-accounts and in deciding what should be posted to the account. </span>
            </div>
        </div>

    </div>
</div>