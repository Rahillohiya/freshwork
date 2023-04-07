<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="voide-a-payment-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Total Amount
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Payment][TotalAmt]')?old('api_fields[Payment][TotalAmt]'):$api_fields['Payment']['TotalAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Payment][TotalAmt]"
                              style="display: none;">{{ old('api_fields[Payment][TotalAmt]')?old('api_fields[Payment][TotalAmt]'):$api_fields['Payment']['TotalAmt']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Indicates the total amount of the transaction. This includes the total of all the charges, allowances, and taxes. </span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Customer
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            {{-- required hidden field --}}
            <input type="hidden" name="api_fields[DetailType]" value="SalesItemLineDetail">
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="ParentRefname"
                       name="api_fields[CustomerRef][name]" type="hidden"
                       value="{{ old('api_fields[CustomerRef][name]')?old('api_fields[CustomerRef][name]'):$api_fields['CustomerRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[CustomerRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[CustomerRef][value]')?old('api_fields[CustomerRef][value]'):$api_fields['CustomerRef']['value']??'' }}">{{ old('api_fields[CustomerRef][name]')?old('api_fields[CustomerRef][name]'):$api_fields['CustomerRef']['name']??'' }}</option>
                </select>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Payment Method
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            {{-- required hidden field --}}
            <input type="hidden" name="api_fields[DetailType]" value="SalesItemLineDetail">
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="PaymentMethodRef"
                       name="api_fields[PaymentMethodRef][name]" type="hidden"
                       value="{{ old('api_fields[PaymentMethodRef][name]')?old('api_fields[PaymentMethodRef][name]'):$api_fields['PaymentMethodRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[PaymentMethodRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[PaymentMethodRef][value]')?old('api_fields[PaymentMethodRef][value]'):$api_fields['PaymentMethodRef']['value']??'' }}">{{ old('api_fields[PaymentMethodRef][name]')?old('api_fields[PaymentMethodRef][name]'):$api_fields['PaymentMethodRef']['name']??'' }}</option>
                </select>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Unapplied Amount
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Payment][UnappliedAmt]')?old('api_fields[Payment][UnappliedAmt]'):$api_fields['Payment']['UnappliedAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Payment][UnappliedAmt]"
                              style="display: none;">{{ old('api_fields[Payment][UnappliedAmt]')?old('api_fields[Payment][UnappliedAmt]'):$api_fields['Payment']['UnappliedAmt']??'' }}</textarea>
                </div>
            </div>

            <div class="Polaris-Labelled__HelpText">
                <span>Indicates the amount that has not been applied to pay amounts owed for sales transactions. </span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Deposit To Account
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            {{-- required hidden field --}}
            <input type="hidden" name="api_fields[DetailType]" value="SalesItemLineDetail">
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="DepositToAccountRef"
                       name="api_fields[DepositToAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[DepositToAccountRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[DepositToAccountRef][value]')?old('api_fields[DepositToAccountRef][value]'):$api_fields['DepositToAccountRef']['value']??'' }}">{{ old('api_fields[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}</option>
                </select>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Transaction Date
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Payment][TxnDate]')?old('api_fields[Payment][TxnDate]'):$api_fields['Payment']['TxnDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Payment][TxnDate]"
                              style="display: none;">{{ old('api_fields[Payment][TxnDate]')?old('api_fields[Payment][TxnDate]'):$api_fields['Payment']['TxnDate']??'' }}</textarea>
                </div>
            </div>

            <div class="Polaris-Labelled__HelpText">
                <span>The date entered by the user when this transaction occurred.</span>
            </div>
        </div>
    </div>
</div>