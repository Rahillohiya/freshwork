<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>


    @if($fields)
        @foreach($fields as $key => $field)
            @if($field['required'] != 0)

            @else
                <div class="fields-wrapper">
                    <div class="Polaris-Labelled__LabelWrapper">
                        <div class="Polaris-Label right-required-text-label">
                            <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">{{ $field['label'] }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="Polaris-Connected">
                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                            <div class="input-field-selection-textarea rich_textarea"
                                 contenteditable="true">{{ old('api_fields[$key]')?old('api_fields[$key]'):$api_fields[$key]??'' }}</div>
                            <textarea class="hidden_rich_textarea"
                                      name="api_fields[{{ $key }}]"
                                      style="display: none;">{{ old('api_fields[$key]')?old('api_fields[$key]'):$api_fields[$key]??'' }}</textarea>
                        </div>

                    </div>
                </div>
            @endif
        @endforeach
    @endif


</div>