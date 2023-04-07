<div class="connector-setup-page-section">
    <h4 class="connector-heading"> Set up action </h4>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Type
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $type=old('api_fields[Type]')?old('api_fields[Type]'):$api_fields['Type']??'';  @endphp
            <select id="itemType"
                    name="api_fields[Type]" class="form-control ContactId"
                    data-rule-required="true">
                <option
                        @if($type=="Inventory") selected @endif
                value="Inventory">Inventory
                </option>
                <option
                        @if($type=="Service") selected @endif
                value="Service">Service
                </option>
                <option
                        @if($type=="NonInventory") selected @endif
                value="NonInventory">Non Inventory
                </option>
            </select>
        </div>
    </div>
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
                <textarea class="hidden_rich_textarea"  name="api_fields[Name]"
                          data-msg-required="Please enter Item Name."
                          data-rule-required="true"
                          data-rule-zeroWideSpace="true"
                          style="display: none;">{{ old('api_fields[Name]')?old('api_fields[Name]'):$api_fields['Name']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Name of the item. This value is unique.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Income Account
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input data-rule-required="true" data-msg-required=" "
                   class="IncomeAccountRef"
                   name="api_fields[IncomeAccountRef][name]" type="hidden"
                   value="{{ old('api_fields[IncomeAccountRef][name]')?old('api_fields[IncomeAccountRef][name]'):$api_fields['IncomeAccountRef']['name']??'' }}">
            <select id="income_accounts"
                    name="api_fields[IncomeAccountRef][value]" class="form-control ContactId"
                    data-msg-required="Please enter Item Name."
                    data-rule-required="true"
                    data-rule-zeroWideSpace="true">
                <option value="{{ old('api_fields[IncomeAccountRef][value]')?old('api_fields[IncomeAccountRef][value]'):$api_fields['IncomeAccountRef']['value']??'' }}">{{ old('[IncomeAccountRef][name]')?old('api_fields[IncomeAccountRef][name]'):$api_fields['IncomeAccountRef']['name']??'' }}</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Reference to the posting account, that is, the account that records the proceeds from the sale of this item. Must be an account with account type of Sales of Product Income.Required if "Expense Account" field is empty.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Expense Account
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="ExpenseAccountRef"
                   name="api_fields[ExpenseAccountRef][name]" type="hidden"
                   value="{{ old('api_fields[ExpenseAccountRef][name]')?old('api_fields[ExpenseAccountRef][name]'):$api_fields['ExpenseAccountRef']['name']??'' }}">
            <select id="expense_accounts"
                    name="api_fields[ExpenseAccountRef][value]" class="form-control ContactId"
                    data-rule-required="true">

                <option value="{{ old('api_fields[ExpenseAccountRef][value]')?old('api_fields[ExpenseAccountRef][value]'):$api_fields['ExpenseAccountRef']['value']??'' }}">{{ old('[ExpenseAccountRef][name]')?old('api_fields[ExpenseAccountRef][name]'):$api_fields['ExpenseAccountRef']['name']??'' }}</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Required if "Income Account" field is empty.
            Reference to the expense account used to pay the vendor for this item. Must be an account with account type of Cost of Goods Sold. </span>
        </div>
    </div>

    <div class="fields-wrapper" id="initial_qty_on_hand_div">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Initial Qty On Hand
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea initial_qty_on_hand"
                     contenteditable="true">{{ old('api_fields[QtyOnHand]')?old('api_fields[QtyOnHand]'):$api_fields['QtyOnHand']??'' }}</div>
                <textarea  class="hidden_rich_textarea initial_qty_on_hand inventoryType_required_fields"
                          data-msg-required="Please enter Qty."
                          data-rule-required="true"
                          data-rule-zeroWideSpace="true"
                          name="api_fields[QtyOnHand]"
                          style="display: none;">{{ old('api_fields[QtyOnHand]')?old('api_fields[QtyOnHand]'):$api_fields['QtyOnHand']??'' }}</textarea>
            </div>

        </div>
    </div>

    <div class="fields-wrapper" id="inv_start_date_div">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Invoice Start Date
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea inv_start_date"
                     contenteditable="true">{{ old('api_fields[InvStartDate]')?old('api_fields[InvStartDate]'):$api_fields['InvStartDate']??'' }}</div>
                <textarea class="hidden_rich_textarea inv_start_date inventoryType_required_fields"
                          data-msg-required="Please enter start date."
                          data-rule-required="true"
                          data-rule-zeroWideSpace="true"
                          name="api_fields[InvStartDate]"
                          style="display: none;">{{ old('api_fields[InvStartDate]')?old('api_fields[InvStartDate]'):$api_fields['InvStartDate']??'' }}</textarea>
            </div>

        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Local timezone: YYYY-MM-DD UTC: YYYY-MM-DDZ Specific time zone: YYYY-MM-DD+/-HH:MM.</span>
        </div>
    </div>

    <div class="fields-wrapper" id="inventory_asset_account_div">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Inventory Asset Account
                    <span>(required)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <input data-rule-required="true" data-msg-required=" "
                   class="AssetAccountRef inventory_asset_account_text inventoryType_required_fields"
                   name="api_fields[AssetAccountRef][name]" type="hidden"
                   value="{{ old('api_fields[AssetAccountRef][name]')?old('api_fields[AssetAccountRef][name]'):$api_fields['AssetAccountRef']['name']??'' }}">
            <select id="inventory_accounts"
                    name="api_fields[AssetAccountRef][value]" class="form-control ContactId inventoryType_required_fields"
                    data-rule-required="true">

                <option value="{{ old('api_fields[AssetAccountRef][value]')?old('api_fields[AssetAccountRef][value]'):$api_fields['AssetAccountRef']['value']??'' }}">{{ old('[AssetAccountRef][name]')?old('api_fields[AssetAccountRef][name]'):$api_fields['AssetAccountRef']['name']??'' }}</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Reference to the Inventory Asset account that tracks the current value of the inventory. If the same account is used for all inventory items, the current balance of this account will represent the current total value of the inventory</span>
        </div>
    </div>

    <div class="fields-wrapper" id="reorder_point_div">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Reorder Point
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[ReorderPoint]')?old('api_fields[ReorderPoint]'):$api_fields['ReorderPoint']??'' }}</div>
                <textarea class="hidden_rich_textarea reorder_point"
                          name="api_fields[ReorderPoint]"
                          style="display: none;">{{ old('api_fields[ReorderPoint]')?old('api_fields[ReorderPoint]'):$api_fields['ReorderPoint']??'' }}</textarea>
            </div>

        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Description on sales forms
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Description]"
                          style="display: none;">{{ old('api_fields[Description]')?old('api_fields[Description]'):$api_fields['Description']??'' }}</textarea>
            </div>

        </div>
    </div>
    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Sales Price/Rate
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[UnitPrice]')?old('api_fields[UnitPrice]'):$api_fields['UnitPrice']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[UnitPrice]"
                          style="display: none;">{{ old('api_fields[UnitPrice]')?old('api_fields[UnitPrice]'):$api_fields['UnitPrice']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Corresponds to the Price/Rate column on the Freshworks Online UI to specify either unit price, a discount, or a tax rate for item. If used for unit price, the monetary value of the service or product, as expressed in the home currency. If used for a discount or tax rate, express the percentage as a fraction. For example, specify 0.4 for 40% tax</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Description On Purchase Forms
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PurchaseDesc]')?old('api_fields[PurchaseDesc]'):$api_fields['PurchaseDesc']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[PurchaseDesc]"
                          style="display: none;">{{ old('api_fields[PurchaseDesc]')?old('api_fields[PurchaseDesc]'):$api_fields['PurchaseDesc']??'' }}</textarea>
            </div>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Purchase Cost
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[PurchaseCost]')?old('api_fields[PurchaseCost]'):$api_fields['PurchaseCost']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[PurchaseCost]"
                          style="display: none;">{{ old('api_fields[PurchaseCost]')?old('api_fields[PurchaseCost]'):$api_fields['PurchaseCost']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Amount paid when buying or ordering the item, as expressed in the home currency.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label id="PolarisTextField2Label"
                       for="PolarisTextField2"
                       class="Polaris-Label__Text">Sku
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="Polaris-Connected">
            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="input-field-selection-textarea rich_textarea"
                     contenteditable="true">{{ old('api_fields[Sku]')?old('api_fields[Sku]'):$api_fields['Sku']??'' }}</div>
                <textarea class="hidden_rich_textarea"
                          name="api_fields[Sku]"
                          style="display: none;">{{ old('api_fields[Sku]')?old('api_fields[Sku]'):$api_fields['Sku']??'' }}</textarea>
            </div>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Amount paid when buying or ordering the item, as expressed in the home currency.</span>
        </div>
    </div>


    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Item Category Type
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $itemCategoryType=old('api_fields[ItemCategoryType]')?old('api_fields[ItemCategoryType]'):$api_fields['ItemCategoryType']??'';  @endphp
            <select name="api_fields[ItemCategoryType]" class="form-control ContactId">

                <option
                        @if($itemCategoryType=="Product") selected @endif
                value="Product">Product
                </option>
                <option
                        @if($itemCategoryType=="Service") selected @endif
                value="Service">Service
                </option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>Classification that specifies the use of this item. Applicable for France companies, only. Available when endpoint is evoked with the minorversion=3 query parameter. Read-only after object is created. Valid values include: Product and Service.</span>
        </div>
    </div>

    <div class="fields-wrapper">
        <div class="Polaris-Labelled__LabelWrapper">
            <div class="Polaris-Label right-required-text-label">
                <label for="PolarisTextField2"
                       class="Polaris-Label__Text">Is Taxable?
                    <span>(optional)</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            @php $taxable=old('api_fields[Taxable]')?old('api_fields[Taxable]'):$api_fields['Taxable']??'';  @endphp
            <select name="api_fields[Taxable]" class="form-control" >
                <option @if($taxable=="") selected @endif value="">--NONE--</option>
                <option @if($taxable=="true") selected @endif value="true">True</option>
                <option @if($taxable=="false") selected @endif value="false">False</option>
            </select>
        </div>
        <div class="Polaris-Labelled__HelpText">
            <span>If true, transactions for this item are taxable. Applicable to US companies, only.</span>
        </div>
    </div>
</div>