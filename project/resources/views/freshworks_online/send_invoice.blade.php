<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Select Invoice to send
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input data-rule-required="true" data-msg-required=" "
                   class="InvoiceRefName"
                   name="api_fields[invoice][name]" type="hidden"
                   value="{{ old('api_fields[invoice][name]')?old('api_fields[invoice][name]'):$api_fields['invoice']['name']??'' }}">
            <select id="freshworks_invoices"
                    name="api_fields[invoice][Id]" class="form-control ContactId"
                    data-rule-required="true">

                <option value="{{ old('api_fields[invoice][Id]')?old('api_fields[invoice][Id]'):$api_fields['invoice']['Id']??'' }}">{{ old('api_fields[invoice][name]')?old('api_fields[invoice][name]'):$api_fields['invoice']['name']??'' }}</option>
            </select>
        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> Email
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[email_address]')?old('api_fields[email_address]'):$api_fields['email_address']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[email_address]"
                          style="display: none;">{{ old('api_fields[email_address]')?old('api_fields[email_address]'):$api_fields['email_address']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Send to an explicit email address instead of the invoice billing one, and updates the one on the invoice to this.</span>
        </div>
    </div>

</div>