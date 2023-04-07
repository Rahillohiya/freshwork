<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-credit-payemnt-pareent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Transaction Date
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnDate]')?old('api_fields[TxnDate]'):$api_fields['TxnDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea" data-rule-required="true"
                              name="api_fields[TxnDate]"
                              style="display: none;">{{ old('api_fields[TxnDate]')?old('api_fields[TxnDate]'):$api_fields['TxnDate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>The date entered by the user when this transaction occurred.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Amount
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</div>
                    <textarea class="hidden_rich_textarea"  data-rule-required="true"
                              name="api_fields[Amount]"
                              style="display: none;">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Total amount of the payment. Denominated in the currency of the credit card account.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Bank Account
                        <span>(required)</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="AllSelectedAccountName"
                       name="api_fields[BankAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[BankAccountRef][name]')?old('api_fields[BankAccountRef][name]'):$api_fields['BankAccountRef']['name']??'' }}">
                <select name="api_fields[BankAccountRef][value]" class="form-control all_accounts"
                        data-rule-required="true">
                    <option value="{{ old('api_fields[BankAccountRef][value]')?old('api_fields[BankAccountRef][value]'):$api_fields['BankAccountRef']['value']??'' }}">{{ old('api_fields[BankAccountRef][name]')?old('api_fields[BankAccountRef][name]'):$api_fields['BankAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Must be a bank Account tyoe e-g Savings,checking.Using any non related account will throw business exception</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Credit Card Account
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="CreditCardAccounts"
                       name="api_fields[CreditCardAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[CreditCardAccountRef][name]')?old('api_fields[CreditCardAccountRef][name]'):$api_fields['CreditCardAccountRef']['name']??'' }}">
                <select id="credit_card_accounts"
                        name="api_fields[CreditCardAccountRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[CreditCardAccountRef][value]')?old('api_fields[CreditCardAccountRef][value]'):$api_fields['CreditCardAccountRef']['value']??'' }}">{{ old('api_fields[CreditCardAccountRef][name]')?old('api_fields[CreditCardAccountRef][name]'):$api_fields['CreditCardAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Credit Card account for which a payment is being entered. Must be a Credit Card account.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Currency
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="CurrencyRefname"
                       name="api_fields[CurrencyRef][name]" type="hidden"
                       value="{{ old('api_fields[CurrencyRef][name]')?old('api_fields[CurrencyRef][name]'):$api_fields['CurrencyRef']['name']??'' }}">
                <select id="freshworks_currency"
                        name="api_fields[CurrencyRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[CurrencyRef][value]')?old('api_fields[CurrencyRef][value]'):$api_fields['CurrencyRef']['value']??'' }}">{{ old('[CurrencyRef][name]')?old('api_fields[CurrencyRef][name]'):$api_fields['CurrencyRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Provide currency value only if <a href="https://freshworks.intuit.com/learn-support/en-us/multi-currency/turn-on-and-use-multicurrency/00/186395">multicurrency</a> is enabled in your Freshworks CRM.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Private Note
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary ">
                    <div class="input-field-selection-textarea rich_textarea msg-body-style"
                         contenteditable="true">{{ old('api_fields[PrivateNote]')?old('api_fields[PrivateNote]'):$api_fields['PrivateNote']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[PrivateNote]"
                              style="display: none;">{{ old('api_fields[PrivateNote]')?old('api_fields[PrivateNote]'):$api_fields['PrivateNote']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>User entered, organization-private note about the transaction.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Print Status
                        <span>(optional)</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                @php $PrintStatus=old('api_fields[PrintStatus]')?old('api_fields[PrintStatus]'):$api_fields['PrintStatus']??'';  @endphp
                <select name="api_fields[PrintStatus]" class="form-control">

                    <option
                            @if($PrintStatus=="NotSet") selected @endif
                    value="NotSet">Not Set</option>
                    <option
                            @if($PrintStatus=="NeedToPrint") selected @endif
                    value="NeedToPrint"> Need To Print</option>
                    <option
                            @if($PrintStatus=="PrintComplete") selected @endif
                    value="PrintComplete">Print Complete</option>
                </select>
            </div>

        </div>
    </div>
</div>