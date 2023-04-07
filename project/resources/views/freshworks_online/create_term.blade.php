<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="term-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Name
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              data-msg-required="Please enter Name."
                              data-rule-required="true"
                              name="api_fields[Name]"
                              style="display: none;">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>User recognizable name for the term.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Due Days
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[DueDays]')?old('api_fields[DueDays]'):$api_fields['DueDays']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[DueDays]"
                              data-msg-required="Due Days"
                              data-rule-required="true"
                              style="display: none;">{{ old('api_fields[DueDays]')?old('api_fields[DueDays]'):$api_fields['DueDays']??'' }}</textarea>
                </div>

            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Number of days from delivery of goods or services until the payment is due.</span>
            </div>
        </div>
    </div>
</div>