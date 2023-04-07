<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="create-bill-payment-parent-div">
        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Vendor
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="vendorRefName"
                       name="api_fields[VendorRef][name]" type="hidden"
                       value="{{ old('api_fields[VendorRef][name]')?old('api_fields[VendorRef][name]'):$api_fields['VendorRef']['name']??'' }}">
                <select id="freshworks_vendors"
                        name="api_fields[VendorRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[VendorRef][value]')?old('api_fields[VendorRef][value]'):$api_fields['VendorRef']['value']??'' }}">{{ old('[VendorRef][name]')?old('api_fields[VendorRef][name]'):$api_fields['VendorRef']['name']??'' }}</option>
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
                              data-msg-required="Please enter total amount."
                              data-rule-required="true"
                              data-rule-zeroWideSpace="true"
                              name="api_fields[TotalAmt]"
                              style="display: none;">{{ old('api_fields[TotalAmt]')?old('api_fields[TotalAmt]'):$api_fields['TotalAmt']??'' }}</textarea>
                </div>
            </div>

            <div class="Polaris-Labelled__HelpText">
                <span>Indicates the total amount of the associated with this payment. This includes the total of all the payments from the BillPayment Details.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text">Line Amount
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
                              data-rule-zeroWideSpace="true"
                              name="api_fields[Amount]"
                              style="display: none;">{{ old('api_fields[Amount]')?old('api_fields[Amount]'):$api_fields['Amount']??'' }}</textarea>
                </div>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>The amount of the line item.</span>
            </div>
        </div>

        <div class="fields-wrapper">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label right-required-text-label">
                    <label id="PolarisTextField2Label"
                           for="PolarisTextField2"
                           class="Polaris-Label__Text"> Transaction ID
                        <span>(optional)</span>
                    </label>
                </div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary ">
                    <div class="input-field-selection-textarea rich_textarea"
                         contenteditable="true">{{ old('api_fields[LinkedTxn][0][TxnId]')?old('api_fields[LinkedTxn][0][TxnId]'):$api_fields['LinkedTxn'][0]['TxnId']??'' }}</div>
                    <textarea class="hidden_rich_textarea" id="line_item_transaction_id"
                              data-msg-required="Please enter transaction."
                              data-rule-required="true"
                              data-rule-zeroWideSpace="true"
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
                        <span>(optional)</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                @php $txnType=old('api_fields[LinkedTxn][0][TxnType]')?old('api_fields[LinkedTxn][0][TxnType]'):$api_fields['LinkedTxn'][0]['TxnType']??'';  @endphp
                <select data-msg-required="Please enter tax type."  id="line_item_transaction_type" name="api_fields[LinkedTxn][0][TxnType]" class="form-control">
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
                           class="Polaris-Label__Text">Credit Card Payment
                        <span>(required)</span>
                    </label>
                </div>
            </div>
            {{-- required hidden field --}}
            <input type="hidden" name="api_fields[CreditCardPayment]" value="SalesItemLineDetail">
            <div class="form-group">
                <input data-rule-required="true" data-msg-required=" "
                       class="CreditCardAccounts"
                       name="api_fields[CreditCardPayment][CCAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[CreditCardPayment][CCAccountRef][name]')?old('api_fields[CreditCardPayment][CCAccountRef][name]'):$api_fields['CreditCardPayment']['CCAccountRef']['name']??'' }}">
                <select id="credit_card_accounts"
                        name="api_fields[CreditCardPayment][CCAccountRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[CreditCardPayment][CCAccountRef][value]')?old('api_fields[CreditCardPayment][CCAccountRef][value]'):$api_fields['CreditCardPayment']['CCAccountRef']['value']??'' }}">{{ old('api_fields[CreditCardPayment][CCAccountRef][name]')?old('api_fields[CreditCardPayment][CCAccountRef][name]'):$api_fields['CreditCardPayment']['CCAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Information about a credit card payment for the transaction. </span>
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
                       class="ExpenseAccountRef"
                       name="api_fields[CheckPayment][BankAccountRef][name]" type="hidden"
                       value="{{ old('api_fields[CheckPayment][BankAccountRef][name]')?old('api_fields[CheckPayment][BankAccountRef][name]'):$api_fields['CheckPayment']['BankAccountRef']['name']??'' }}">
                <select id="expense_accounts"
                        name="api_fields[CheckPayment][BankAccountRef][value]" class="form-control ContactId"
                        data-rule-required="true">

                    <option value="{{ old('api_fields[CheckPayment][BankAccountRef][value]')?old('api_fields[CheckPayment][BankAccountRef][value]'):$api_fields['CheckPayment']['BankAccountRef']['value']??'' }}">{{ old('api_fields[CheckPayment][BankAccountRef][name]')?old('api_fields[CheckPayment][BankAccountRef][name]'):$api_fields['CheckPayment']['BankAccountRef']['name']??'' }}</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Reference to the bank account.</span>
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
                    <label for="PolarisTextField2"
                           class="Polaris-Label__Text">Pay Type
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                @php $PayType=old('api_fields[PayType]')?old('api_fields[PayType]'):$api_fields['PayType']??'';  @endphp
                <select name="api_fields[PayType]" class="form-control ">
                    <option  @if($PayType=="") selected @endif value=""></option>
                    <option  @if($PayType=="Check") selected @endif value="Check">Check</option>
                    <option @if($PayType=="CreditCard") selected @endif value="CreditCard ">Credit Card</option>
                </select>
            </div>
            <div class="Polaris-Labelled__HelpText">
                <span>Payment type of the bill.</span>
            </div>
        </div>
    </div>
</div>