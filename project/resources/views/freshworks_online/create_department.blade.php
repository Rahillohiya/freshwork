<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-department-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Department Name
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              data-rule-zeroWideSpace="true"
                              name="api_fields[Name]"
                              style="display: none;">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>User recognizable name for the department.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">parent Reference
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="freshworks_department_name"
                       name="api_fields[ParentRef][name]" type="hidden"
                       value="{{ old('api_fields[ParentRef][name]')?old('api_fields[ParentRef][name]'):$api_fields['ParentRef']['name']??'' }}">
                <select name="api_fields[ParentRef][value]" class="form-control freshworks_department">
                    <option value="{{ old('api_fields[ParentRef][value]')?old('api_fields[ParentRef][value]'):$api_fields['ParentRef']['value']??'' }}">{{ old('api_fields[ParentRef][name]')?old('api_fields[ParentRef][name]'):$api_fields['ParentRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>The immediate parent of the SubDepartment. Required for the create operation if this object is a SubDepartment. Required if this object is a subdepartment</span>
            </div>
        </div>
        
    </div>
</div>