<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-journal-entry-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Journal Date
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TxnDate]')?old('api_fields[TxnDate]'):$api_fields['TxnDate']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TxnDate]"
                              style="display: none;">{{ old('api_fields[TxnDate]')?old('api_fields[TxnDate]'):$api_fields['TxnDate']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>The date entered by the user when this transaction occurred. For posting transactions, this is the posting date that affects the financial statements.</span>
            </div>
        </div>
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Journal Number
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[DocNumber]')?old('api_fields[DocNumber]'):$api_fields['DocNumber']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[DocNumber]"
                              style="display: none;">{{ old('api_fields[DocNumber]')?old('api_fields[DocNumber]'):$api_fields['DocNumber']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference number for the transaction. Throws an error when duplicate DocNumber is sent in the request.</span>
            </div>
        </div>

        <div class="interlink-fields">
            <h4 class="connector-heading"> Debits </h4>
            {{-- required hidden field --}}
            <input type="hidden" name="api_fields[Line][0][DetailType]" value="JournalEntryLineDetail">
            <input type="hidden" name="api_fields[Line][0][JournalEntryLineDetail][PostingType]" value="Debit">
            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Journal Code

                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="freshworks_journal_code_name"
                           name="api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][name]')?old('api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][name]'):$api_fields['Line'][0]['JournalEntryLineDetail']['JournalCodeRef']['name']??'' }}">
                    <select class="freshworks_journal_codes form-control" name="api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][value]">
                        <option value="{{ old('api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][value]')?old('api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][value]'):$api_fields['Line'][0]['JournalEntryLineDetail']['JournalCodeRef']['value']??'' }}">{{ old('api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][name]')?old('api_fields[Line][0][JournalEntryLineDetail][JournalCodeRef][name]'):$api_fields['Line'][0]['JournalEntryLineDetail']['JournalCodeRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>For France locales, only. Reference to a JournalCode object. </span>
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
                    <input data-rule-required="true" data-msg-required=" "
                           class="AllSelectedAccountName"
                           name="api_fields[Line][0][JournalEntryLineDetail][AccountRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][0][JournalEntryLineDetail][AccountRef][name]')?old('api_fields[Line][0][JournalEntryLineDetail][AccountRef][name]'):$api_fields['Line'][0]['JournalEntryLineDetail']['AccountRef']['name']??'' }}">
                    <select class="all_accounts form-control"
                            name="api_fields[Line][0][JournalEntryLineDetail][AccountRef][value]"
                            data-rule-required="true">

                        <option value="{{ old('api_fields[Line][0][JournalEntryLineDetail][AccountRef][value]')?old('api_fields[Line][0][JournalEntryLineDetail][AccountRef][value]'):$api_fields['Line'][0]['JournalEntryLineDetail']['AccountRef']['value']??'' }}">{{ old('api_fields[Line][0][JournalEntryLineDetail][AccountRef][name]')?old('api_fields[Line][0][JournalEntryLineDetail][AccountRef][name]'):$api_fields['Line'][0]['JournalEntryLineDetail']['AccountRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Reference to the account associated with this line. </span>
                </div>
            </div>

            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label id="PolarisTextField2Label"
                               for="PolarisTextField2"
                               class="Polaris-Label__Text"> Debit Amount
                            <span>(required)</span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[Line][0][Amount]')?old('api_fields[Line][0][Amount]'):$api_fields['Line'][0]['Amount']??'' }}</div>
                        <textarea class="hidden_rich_textarea"  data-rule-required="true"
                                  name="api_fields[Line][0][Amount]"
                                  style="display: none;">{{ old('api_fields[Line][0][Amount]')?old('api_fields[Line][0][Amount]'):$api_fields['Line'][0]['Amount']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Total amount of "Debits" line items must equal the total amount of "Credits" line items.</span>
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
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[Line][0][Description]')?old('api_fields[Line][0][Description]'):$api_fields['Line'][0]['Description']??'' }}</div>
                        <textarea class="hidden_rich_textarea"
                                  name="api_fields[Line][0][Description]"
                                  style="display: none;">{{ old('api_fields[Line][0][Description]')?old('api_fields[Line][0][Description]'):$api_fields['Line'][0]['Description']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Free form text description of the line item that appears in the printed record.</span>
                </div>
            </div>


            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Department
                            <span>(optional)</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <input class="freshworks_department_name"
                           name="api_fields[Line][0][DepartmentRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][0][DepartmentRef][name]')?old('api_fields[Line][0][DepartmentRef][name]'):$api_fields['Line'][0]['DepartmentRef']['name']??'' }}">
                    <select class="freshworks_department form-control"
                            name="api_fields[Line][0][DepartmentRef][value]" class="freshworks_department form-control ">
                        <option value="{{ old('api_fields[Line][0][DepartmentRef][value]')?old('api_fields[Line][0][DepartmentRef][value]'):$api_fields['Line'][0]['DepartmentRef']['value']??'' }}">{{ old('api_fields[Line][0][DepartmentRef][name]')?old('api_fields[Line][0][DepartmentRef][name]'):$api_fields['Line'][0]['DepartmentRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>A reference to a Department object specifying the location of the transaction.</span>
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
                    <input class="freshworks_class_name"
                           name="api_fields[Line][0][ClassRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][0][ClassRef][name]')?old('api_fields[Line][0][ClassRef][name]'):$api_fields['Line'][0]['ClassRef']['name']??'' }}">
                    <select class="form-control freshworks_class"
                            name="api_fields[Line][0][ClassRef][value]">
                        <option value="{{ old('api_fields[Line][0][ClassRef][value]')?old('api_fields[Line][0][ClassRef][value]'):$api_fields['Line'][0]['ClassRef']['value']??'' }}">{{ old('api_fields[Line][0][ClassRef][name]')?old('api_fields[Line][0][ClassRef][name]'):$api_fields['Line'][0]['ClassRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Reference to the Class associated with the transaction. </span>
                </div>
            </div>

        </div>

        <div class="interlink-fields">
            <h4 class="connector-heading"> Credit </h4>
            {{-- required hidden field --}}
            <input type="hidden" name="api_fields[Line][1][DetailType]" value="JournalEntryLineDetail">
            <input type="hidden" name="api_fields[Line][1][JournalEntryLineDetail][PostingType]" value="Credit">
            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Journal Code
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <input class="freshworks_journal_code_name"
                           name="api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][name]')?old('api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][name]'):$api_fields['Line'][1]['JournalEntryLineDetail']['JournalCodeRef']['name']??'' }}">
                    <select class="form-control freshworks_journal_codes"
                            name="api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][value]">
                        <option value="{{ old('api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][value]')?old('api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][value]'):$api_fields['Line'][1]['JournalEntryLineDetail']['JournalCodeRef']['value']??'' }}">{{ old('api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][name]')?old('api_fields[Line][1][JournalEntryLineDetail][JournalCodeRef][name]'):$api_fields['Line'][1]['JournalEntryLineDetail']['JournalCodeRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>For France Locales, Fill in the Journal Code related to the account. It is essential to add a New Journal Code. You need to use the same Journal Code related to the transaction for debit and credit accounts.</span>
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
                    <input data-rule-required="true" data-msg-required=" "
                           class="AllSelectedAccountName"
                           name="api_fields[Line][1][JournalEntryLineDetail][AccountRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][1][JournalEntryLineDetail][AccountRef][name]')?old('api_fields[Line][1][JournalEntryLineDetail][AccountRef][name]'):$api_fields['Line'][1]['JournalEntryLineDetail']['AccountRef']['name']??'' }}">
                    <select  class="form-control all_accounts"
                            name="api_fields[Line][1][JournalEntryLineDetail][AccountRef][value]"
                            data-rule-required="true">

                        <option value="{{ old('api_fields[Line][1][JournalEntryLineDetail][AccountRef][value]')?old('api_fields[Line][1][JournalEntryLineDetail][AccountRef][value]'):$api_fields['Line'][1]['JournalEntryLineDetail']['AccountRef']['value']??'' }}">{{ old('api_fields[Line][1][JournalEntryLineDetail][AccountRef][name]')?old('api_fields[Line][1][JournalEntryLineDetail][AccountRef][name]'):$api_fields['Line'][1]['JournalEntryLineDetail']['AccountRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Reference to the account associated with this line. </span>
                </div>
            </div>

            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label id="PolarisTextField2Label"
                               for="PolarisTextField2"
                               class="Polaris-Label__Text"> Credit Amount
                            <span>(required)</span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[Line][1][Amount]')?old('api_fields[Line][1][Amount]'):$api_fields['Line'][1]['Amount']??'' }}</div>
                        <textarea class="hidden_rich_textarea"  data-rule-required="true"
                                  name="api_fields[Line][1][Amount]"
                                  style="display: none;">{{ old('api_fields[Line][1][Amount]')?old('api_fields[Line][1][Amount]'):$api_fields['Line'][1]['Amount']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Total amount of "Credits" line items must equal the total amount of "Debits" line items.</span>
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
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[Line][1][Description]')?old('api_fields[Line][1][Description]'):$api_fields['Line'][1]['Description']??'' }}</div>
                        <textarea class="hidden_rich_textarea"
                                  name="api_fields[Line][1][Description]"
                                  style="display: none;">{{ old('api_fields[Line][1][Description]')?old('api_fields[Line][1][Description]'):$api_fields['Line'][1]['Description']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Free form text description of the line item that appears in the printed record.</span>
                </div>
            </div>

            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Department
                            <span>(Optional)</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="freshworks_department_name"
                           name="api_fields[Line][1][DepartmentRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][1][DepartmentRef][name]')?old('api_fields[Line][1][DepartmentRef][name]'):$api_fields['Line'][1]['DepartmentRef']['name']??'' }}">
                    <select class="form-control freshworks_department"
                            name="api_fields[Line][1][DepartmentRef][value]">
                        <option value="{{ old('api_fields[Line][1][DepartmentRef][value]')?old('api_fields[Line][1][DepartmentRef][value]'):$api_fields['Line'][1]['DepartmentRef']['value']??'' }}">{{ old('api_fields[Line][1][DepartmentRef][name]')?old('api_fields[Line][1][DepartmentRef][name]'):$api_fields['Line'][1]['DepartmentRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>A reference to a Department object specifying the location of the transaction.</span>
                </div>
            </div>

            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label for="PolarisTextField2"
                               class="Polaris-Label__Text">Class
                            <span>(Optional)</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="freshworks_class_name"
                           name="api_fields[Line][1][ClassRef][name]" type="hidden"
                           value="{{ old('api_fields[Line][1][ClassRef][name]')?old('api_fields[Line][1][ClassRef][name]'):$api_fields['Line'][1]['ClassRef']['name']??'' }}">
                    <select class="form-control freshworks_class"
                            name="api_fields[Line][1][ClassRef][value]">
                        <option value="{{ old('api_fields[Line][1][ClassRef][value]')?old('api_fields[Line][1][ClassRef][value]'):$api_fields['Line'][1]['ClassRef']['value']??'' }}">{{ old('api_fields[Line][1][ClassRef][name]')?old('api_fields[Line][1][ClassRef][name]'):$api_fields['Line'][1]['ClassRef']['name']??'' }}</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Reference to the Class associated with the transaction. </span>
                </div>
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
    </div>

</div>