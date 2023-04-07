<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Select Payment ID to send
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <select id="quickbook_payments_list"
                    name="api_fields[payment_id]" class="form-control" data-rule-required="true">
                <option value="{{ old('api_fields[payment_id]')?old('api_fields[payment_id]'):$api_fields['payment_id']??'' }}">{{ old('api_fields[payment_id]')?old('api_fields[payment_id]'):$api_fields['payment_id']??'' }}</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Select payment from its Id to send it to customer email.</span>
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
                <textarea class="hidden_rich_textarea" data-rule-required="true"
                          name="api_fields[email_address]"
                          style="display: none;">{{ old('api_fields[email_address]')?old('api_fields[email_address]'):$api_fields['email_address']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Send to an explicit email address.</span>
        </div>
    </div>

</div>