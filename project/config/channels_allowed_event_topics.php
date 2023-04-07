<?php

return [

    "freshworks_online" => [
        "Location" => [
            "locations/create",
            "locations/update",

        ],
        "ShopAlternateLocale" => [
            "locales/create",
            "locales/update"

        ],
        "OrderEdit" => [
            "orders/edited"

        ],
        "Theme" => [
            "themes/create",
            "themes/update"

        ],
        "TenderTransaction" => [
            "tender_transactions/create"

        ],
        "Shop" => [
            "shop/update"

        ],
        "Refund" => [
            "refunds/create"

        ],
        "Product" => [
            "products/create",
            "products/update"

        ],
        "OrderTransaction" => [
            "order_transactions/create"

        ],
        "Order" => [
            "orders/create",
            "orders/cancelled",
            "orders/fulfilled",
            "orders/paid",
            "orders/updated",
            "orders/partially_fulfilled",

        ],
        "Cart" => [
            "carts/create",
            "carts/update"

        ],
        "InventoryLevel" => [
            "inventory_levels/connect",
            "inventory_levels/update",
            "inventory_levels/disconnect",

        ],
        "InventoryItem" => [
            "inventory_items/create",
            "inventory_items/update",

        ],
        "FulfillmentEvent" => [
            "fulfillment_events/create"

        ],
        "Fulfillment" => [
            "fulfillments/create",
            "fulfillments/update",

        ],
        "DraftOrder" => [
            "draft_orders/create",
            "draft_orders/update"

        ],
        "CustomerSavedSearch" => [
            "customer_groups/create"

        ],
        "Customer" => [
            "customers/create",
            "customers/disable",
            "customers/enable",
            "customers/update"

        ],
        "Collection" => [
            "collections/create",
            "collections/update"

        ]
        ,
        "Checkout" => [
            "checkouts/create",
            "checkouts/update"
        ],
        "Dispute" => [
            "disputes/create",
            "disputes/update"
        ],
        "SubscriptionContract" => [
            "subscription_contracts/create",
            "subscription_contracts/update"
        ]
    ],

];

