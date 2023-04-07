<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-update-class-parent-div">


        @if($channel_event->slug=="update_class")
            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Select Class to update
                            <span>(required)</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input data-rule-required="true" data-msg-required=" "
                           class="freshworks_class_name"
                           name="object_text" type="hidden"
                           value="{{ old('object_text')?old('object_text'):$channel_event_settings->object_text??'' }}">
                    <select name="object_id" class="form-control freshworks_class"
                            data-rule-required="true">
                        <option value="{{ old('object_id')?old('object_id'):$channel_event_settings->object_id??'' }}">{{ old('object_text')?old('object_text'):$channel_event_settings->object_text??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                <span>Select Class to update</span>
                </div>
            </div>
        @endif
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
                <span>User recognizable name for the Class.</span>
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
                <input class="freshworks_class_name"
                       name="api_fields[ParentRef][name]" type="hidden"
                       value="{{ old('api_fields[ParentRef][name]')?old('api_fields[ParentRef][name]'):$api_fields['ParentRef']['name']??'' }}">
                <select id="freshworks_class"
                        name="api_fields[ParentRef][value]" class="form-control">
                    <option value="{{ old('api_fields[ParentRef][value]')?old('api_fields[ParentRef][value]'):$api_fields['ParentRef']['value']??'' }}">{{ old('api_fields[ParentRef][name]')?old('api_fields[ParentRef][name]'):$api_fields['ParentRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>For class objects that are sub-classes: the immediate parent of this object. Required if this object is a subclass.</span>
            </div>
        </div>
    </div>
</div>