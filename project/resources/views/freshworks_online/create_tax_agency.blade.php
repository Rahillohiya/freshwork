<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text"> DisplayName
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[DisplayName]')?old('api_fields[DisplayName]'):$api_fields['DisplayName']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          data-msg-required="Please enter name."
                          data-rule-required="true"
                          data-rule-zeroWideSpace="true"
                          name="api_fields[DisplayName]"
                          style="display: none;">{{ old('api_fields[DisplayName]')?old('api_fields[DisplayName]'):$api_fields['DisplayName']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Name of the agency.</span>
        </div>
    </div>
</div>