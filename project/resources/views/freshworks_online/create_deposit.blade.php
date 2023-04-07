<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-deposit-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Deposit To Account
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="AssetAccountRef"
                       name="api_fields[DepositToAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}">
                <select id="inventory_accounts"
                        name="api_fields[DepositToAccountRef][value]" class="form-control ContactId" data-rule-required="true">
                    <option value="{{ old('api_fields[DepositToAccountRef][value]')?old('api_fields[DepositToAccountRef][value]'):$api_fields['DepositToAccountRef']['value']??'' }}">{{ old('[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Identifies the account to be used for this deposit.</span>
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
                           class="Polaris-Label__Text"> Exchange Rate
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[ExchangeRate]')?old('api_fields[ExchangeRate]'):$api_fields['ExchangeRate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[ExchangeRate]"
                              style="display: none;">{{ old('api_fields[ExchangeRate]')?old('api_fields[ExchangeRate]'):$api_fields['ExchangeRate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>The number of home currency units it takes to equal one unit of currency specified by Currency Reference. Applicable if multicurrency is enabled for the company.</span>
            </div>
        </div>


        {{--hidden input field for Taxline object--}}
        <input type="hidden" name="api_fields[DetailType]" value="DepositLineDetail">
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
                    <textarea class="hidden_rich_textarea"
                              data-msg-required="Please enter amount."
                              data-rule-required="true"
                              name="api_fields[Amount]"
                              style="display: none;">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Should not include tax.Amount is calculated by this formula (Unit Price*Qty)</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Account
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="AllSelectedAccountName"
                       name="api_fields[DepositLineDetail][AccountRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositLineDetail][AccountRef][name]')?old('api_fields[DepositLineDetail][AccountRef][name]'):$api_fields['DepositLineDetail']['AccountRef']['name']??'' }}">
                <select name="api_fields[DepositLineDetail][AccountRef][value]" class="form-control all_accounts" data-rule-required="true">
                    <option value="{{ old('api_fields[DepositLineDetail][AccountRef][value]')?old('api_fields[DepositLineDetail][AccountRef][value]'):$api_fields['DepositLineDetail']['AccountRef']['value']??'' }}">{{ old('[DepositLineDetail][AccountRef][name]')?old('api_fields[DepositLineDetail][AccountRef][name]'):$api_fields['DepositLineDetail']['AccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Account where the funds are deposited.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Payment Method
                        <span>(Optional)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input data-rule-required="false" data-msg-required=" "
                       class="PaymentMethodRefname"
                       name="api_fields[DepositLineDetail][PaymentMethodRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositLineDetail][PaymentMethodRef][name]')?old('api_fields[DepositLineDetail][PaymentMethodRef][name]'):$api_fields['DepositLineDetail']['PaymentMethodRef']['name']??'' }}">
                <select id="PaymentMethods"
                        name="api_fields[DepositLineDetail][PaymentMethodRef][value]" class="form-control" >

                    <option value="{{ old('api_fields[DepositLineDetail][PaymentMethodRef][value]')?old('api_fields[DepositLineDetail][PaymentMethodRef][value]'):$api_fields['DepositLineDetail']['PaymentMethodRef']['value']??'' }}">{{ old('api_fields[DepositLineDetail][PaymentMethodRef][name]')?old('api_fields[DepositLineDetail][PaymentMethodRef][name]'):$api_fields['DepositLineDetail']['PaymentMethodRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference to a PaymentMethod associated with this transaction.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Class
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ClassRefName"
                       name="api_fields[DepositLineDetail][ClassRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositLineDetail][ClassRef][name]')?old('api_fields[DepositLineDetail][ClassRef][name]'):$api_fields['DepositLineDetail']['ClassRef']['name']??'' }}">
                <select id="freshworks_class"
                        name="api_fields[DepositLineDetail][ClassRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[DepositLineDetail][ClassRef][value]')?old('api_fields[DepositLineDetail][ClassRef][value]'):$api_fields['DepositLineDetail']['ClassRef']['value']??'' }}">{{ old('[DepositLineDetail][ClassRef][name]')?old('api_fields[DepositLineDetail][ClassRef][name]'):$api_fields['DepositLineDetail']['ClassRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference to the Class associated with the transaction.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Check Number
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[DepositLineDetail][CheckNum]')?old('api_fields[DepositLineDetail][CheckNum]'):$api_fields['DepositLineDetail']['CheckNum']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[DepositLineDetail][CheckNum]"
                              style="display: none;">{{ old('api_fields[DepositLineDetail][CheckNum]')?old('api_fields[DepositLineDetail][CheckNum]'):$api_fields['DepositLineDetail']['CheckNum']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Check number for the desposit.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Tax Code
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="TaxCodeRef"
                       name="api_fields[DepositLineDetail][TaxCodeRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositLineDetail][TaxCodeRef][name]')?old('api_fields[DepositLineDetail][TaxCodeRef][name]'):$api_fields['DepositLineDetail']['TaxCodeRef']['name']??'' }}">
                <select id="freshworks_tax_codes" name="api_fields[DepositLineDetail][TaxCodeRef][value]"
                        class="form-control ContactId">
                    <option value="{{ old('api_fields[DepositLineDetail][TaxCodeRef][value]')?old('api_fields[DepositLineDetail][TaxCodeRef][value]'):$api_fields['DepositLineDetail']['TaxCodeRef']['value']??'' }}">{{ old('[DepositLineDetail][TaxCodeRef][name]')?old('api_fields[DepositLineDetail][TaxCodeRef][name]'):$api_fields['DepositLineDetail']['TaxCodeRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Sales/Purchase tax code associated with the Line. For Non US Companies.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Entity
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ParentRefname"
                       name="api_fields[DepositLineDetail][Entity][name]" type="hidden"
                       value="{{ old('api_fields[DepositLineDetail][Entity][name]')?old('api_fields[DepositLineDetail][Entity][name]'):$api_fields['DepositLineDetail']['Entity']['name']??'' }}">
                <select id="customers_list"
                        name="api_fields[DepositLineDetail][Entity][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[DepositLineDetail][Entity][value]')?old('api_fields[DepositLineDetail][Entity][value]'):$api_fields['DepositLineDetail']['Entity']['value']??'' }}">{{ old('[DepositLineDetail][Entity][name]')?old('api_fields[DepositLineDetail][Entity][name]'):$api_fields['DepositLineDetail']['Entity']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference to a customer from which deposit was received.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Description
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary ">
                    <div class="input-field-selection-textarea rich_textarea msg-body-style"
                         contenteditable="true">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[Description]"
                              style="display: none;">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Free form text description of the line item that appears in the printed record.</span>
            </div>
        </div>
    </div>
</div>