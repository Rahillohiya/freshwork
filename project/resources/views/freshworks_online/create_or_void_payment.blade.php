<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    @if($channel_event->slug=="void_payment")
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Select Payment from Id
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <select id="quickbook_payments_list" data-mgs-required="Select payment to void"
                        name="object_id" class="form-control" data-rule-required="true">
                    <option value="{{ old('object_id')?old('object_id'):$channel_event_settings->object_id??'' }}">{{ old('object_id')?old('object_id'):$channel_event_settings->object_id??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Select payment from its Id to void.</span>
            </div>
        </div>
    @endif
    <div class="create-payment-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Customer
                        <span>(required)</span>
                    </label>
                </div>
            </div>
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
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Total Amount
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[TotalAmt]')?old('api_fields[TotalAmt]'):$api_fields['TotalAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[TotalAmt]"
                              data-rule-required="true"
                              style="display: none;">{{ old('api_fields[TotalAmt]')?old('api_fields[TotalAmt]'):$api_fields['TotalAmt']??'' }}</textarea>
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
                <span>Provide currency value only if <a
                            href="https://freshworks.intuit.com/learn-support/en-us/multi-currency/turn-on-and-use-multicurrency/00/186395">multicurrency</a> is enabled in your Freshworks CRM.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Unapplied Amount
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[UnappliedAmt]')?old('api_fields[UnappliedAmt]'):$api_fields['UnappliedAmt']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[UnappliedAmt]"
                              style="display: none;">{{ old('api_fields[UnappliedAmt]')?old('api_fields[UnappliedAmt]'):$api_fields['UnappliedAmt']??'' }}</textarea>
                </div>
            </div>

            <div class="Polaris-Labelled__HelpText">
                <span>Indicates the amount that has not been applied to pay amounts owed for sales transactions. </span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Transaction Date
                        <span></span>
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
                <span>The date entered by the user when this transaction occurred.</span>
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
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="PaymentMethodRefname"
                       name="api_fields[PaymentMethodRef][name]" type="hidden"
                       value="{{ old('api_fields[PaymentMethodRef][name]')?old('api_fields[PaymentMethodRef][name]'):$api_fields['PaymentMethodRef']['name']??'' }}">
                <select id="PaymentMethods"
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
                           class="Polaris-Label__Text">Payment Reference Number
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[PaymentRefNum]')?old('api_fields[PaymentRefNum]'):$api_fields['PaymentRefNum']??'' }}</div>
                    <textarea class="hidden_rich_textarea"
                              name="api_fields[PaymentRefNum]"
                              style="display: none;">{{ old('api_fields[PaymentRefNum]')?old('api_fields[PaymentRefNum]'):$api_fields['PaymentRefNum']??'' }}</textarea>
                </div>
            </div>

            <div class="Polaris-Labelled__HelpText">
                <span>The reference number for the payment received. For example, Â Check # for a check, envelope # for a cash donation.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Deposit To Account
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input class="ExpenseAccountRef"
                       name="api_fields[DepositToAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}">
                <select id="expense_accounts"
                        name="api_fields[DepositToAccountRef][value]" class="form-control ContactId">
                    <option value="{{ old('api_fields[DepositToAccountRef][value]')?old('api_fields[DepositToAccountRef][value]'):$api_fields['DepositToAccountRef']['value']??'' }}">{{ old('[DepositToAccountRef][name]')?old('api_fields[DepositToAccountRef][name]'):$api_fields['DepositToAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
            <span>
          Specifies the account reference. Check must specify bank account, AccountType must be Other Current Asset or Bank.e-g Prepaid Expenses </span>
            </div>
        </div>

        <div class="interlink-fields">
            <h4 class="connector-heading"> Line Item </h4>
            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label id="PolarisTextField2Label"
                               for="PolarisTextField2"
                               class="Polaris-Label__Text">Line Amount
                            <span>(optionaly required)</span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="input-field-selection-textarea rich_textarea"
                             contenteditable="true">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</div>
                        <textarea class="hidden_rich_textarea" id="line_item_amount"
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
                        <label id="PolarisTextField2Label"
                               for="PolarisTextField2"
                               class="Polaris-Label__Text"> Transaction ID
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="Polaris-Connected">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary ">
                        <div class="input-field-selection-textarea rich_textarea msg-body-style"
                             contenteditable="true">{{ old('api_fields[LinkedTxn][0][TxnId]')?old('api_fields[LinkedTxn][0][TxnId]'):$api_fields['LinkedTxn'][0]['TxnId']??'' }}</div>
                        <textarea class="hidden_rich_textarea" id="line_item_transaction_id"
                                  name="api_fields[LinkedTxn][0][TxnId]"
                                  style="display: none;">{{ old('api_fields[LinkedTxn][0][TxnId]')?old('api_fields[LinkedTxn][0][TxnId]'):$api_fields['LinkedTxn'][0]['TxnId']??'' }}</textarea>
                    </div>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Transaction Id of the related transaction.</span>
                </div>
            </div>
            <div class="fields-wrapper">
                <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label right-required-text-label">
                        <label id="PolarisTextField2Label"
                               for="PolarisTextField2"
                               class="Polaris-Label__Text"> Transaction Type
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    @php $txnType=old('api_fields[LinkedTxn][0][TxnType]')?old('api_fields[LinkedTxn][0][TxnType]'):$api_fields['LinkedTxn'][0]['TxnType']??'';  @endphp
                    <select id="line_item_transaction_type" name="api_fields[LinkedTxn][0][TxnType]" class="form-control">
                        <option
                                @if($txnType=="") selected @endif
                        value="">--NONE</option>
                        <option
                                @if($txnType=="Expense") selected @endif
                        value="Expense">Expense</option>
                        <option
                                @if($txnType=="Check") selected @endif
                        value="Check"> Check</option>
                        <option
                                @if($txnType=="CreditCardCredit") selected @endif
                        value="CreditCardCredit">Credit Card Credit</option>
                        <option
                                @if($txnType=="JournalEntry") selected @endif
                        value="JournalEntry">Journal Entry</option>
                        <option
                                @if($txnType=="CreditMemo") selected @endif
                        value="CreditMemo">Credit Memo</option>
                        <option
                                @if($txnType=="Invoice") selected @endif
                        value="Invoice">Invoice</option>
                    </select>
                </div>
                <div class="Polaris-Labelled__HelpText">
                    <span>Transaction type of the linked object.</span>
                </div>

            </div>



        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Private Note
                        <span></span>
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

    </div>
</div>
