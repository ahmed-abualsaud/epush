<?php

return [
    [
        "model" => Epush\Auth\User\Infra\Database\Model\User::class,
        "columns" => [
            "first_name"        => "users.first_name",
            "last_name"         => "users.last_name",
            "full_name"         => "users.full_name",
            "username"          => "users.username",
            "phone"             => "users.phone",
            "email"             => "users.email",
            "address"           => "users.address",
            "enabled"           => "users.enabled",
            "created_at"        => "users.created_at"
        ]
    ],
    [
        "model" => Epush\Auth\Role\Infra\Database\Model\Role::class,
        "columns" => [
            "name"              => "roles.name",
            "created_at"        => "roles.created_at"
        ]
    ],
    [
        "model" => Epush\Auth\Permission\Infra\Database\Model\Permission::class,
        "columns" => [
            "name"              => "permissions.name",
            "description"       => "permissions.description",
            "handler_id"        => "permissions.handler_id",
            "created_at"        => "permissions.created_at"
        ]
    ],
    [
        "model" => Epush\Core\Admin\Infra\Database\Model\Admin::class,
        "columns" => [
            "first_name"        => "users.first_name",
            "last_name"         => "users.last_name",
            "full_name"         => "users.full_name",
            "username"          => "users.username",
            "phone"             => "users.phone",
            "email"             => "users.email",
            "address"           => "users.address",
            "enabled"           => "users.enabled",
            "created_at"        => "users.created_at"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "admins.user_id",
                "destination" => "users.id",
            ]
        ]
    ],
    [
        "model" => Epush\Core\Client\Infra\Database\Model\Client::class,
        "columns" => [
            "full_name"         => "users.full_name",
            "username"          => "users.username",
            "phone"             => "users.phone",
            "email"             => "users.email",
            "address"           => "users.address",
            "enabled"           => "users.enabled",
            "created_at"        => "users.created_at",
            "company_name"      => "clients.company_name",
            "notes"             => "clients.notes",
            "balance"           => "clients.balance",
            "partner_id"        => "clients.partner_id",
            "sales"             => "sales.name",
            "business_field"    => "business_fields.name",
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "clients.user_id",
                "destination" => "users.id",
            ],
            [
                "type" => "left",
                "operator" => "=",
                "source" => "clients.sales_id",
                "destination" => "sales.id",
            ],
            [
                "type" => "left",
                "operator" => "=",
                "source" => "clients.business_field_id",
                "destination" => "business_fields.id",
            ]
        ],
        "withs" => [
            "websites",
            "sales",
            "businessField"
        ]
    ],
    [
        "model" => Epush\Core\Pricelist\Infra\Database\Model\Pricelist::class,
        "columns" => [
            "name"              => "pricelists.name",
            "price"             => "pricelists.price",
            "created_at"        => "pricelists.created_at"
        ]
    ],
    [
        "model" => Epush\Core\Sales\Infra\Database\Model\Sales::class,
        "columns" => [
            "name"              => "sales.name",
            "created_at"        => "sales.created_at"
        ]
    ],
    [
        "model" => Epush\Core\BusinessField\Infra\Database\Model\BusinessField::class,
        "columns" => [
            "name"              => "business_fields.name",
            "created_at"        => "business_fields.created_at"
        ]
    ],
    [
        "model" => Epush\Core\Country\Infra\Database\Model\Country::class,
        "columns" => [
            "name"              => "countries.name",
            "code"              => "countries.code",
            "created_at"        => "countries.created_at"
        ]
    ],
    [
        "model" => Epush\Core\Operator\Infra\Database\Model\Operator::class,
        "columns" => [
            "name"              => "operators.name",
            "code"              => "operators.code",
            "created_at"        => "operators.created_at"
        ]
    ],
    [
        "model" => Epush\Core\SMSC\Infra\Database\Model\SMSC::class,
        "columns" => [
            "name"              => "smscs.name",
            "value"             => "smscs.value",
            "created_at"        => "smscs.created_at"
        ]
    ],
    [
        "model" => Epush\Core\SMSCBinding\Infra\Database\Model\SMSCBinding::class,
        "columns" => [
            "default"           => "smsc_bindings.default",
            "created_at"        => "smsc_bindings.created_at",
            "country_name"      => "countries.name",
            "country_code"      => "countries.code",
            "operator_name"     => "operators.name",
            "operator_code"     => "operators.code",
            "smsc_name"         => "smscs.name",
            "smsc_value"        => "smscs.value",
        ],
        "select_as" => [
            "smsc_bindings.id as id",
            "smsc_bindings.default as default",
            "smsc_bindings.created_at as created_at",
            "countries.name as country_name",
            "countries.code as country_code",
            "operators.name as operator_name",
            "operators.code as operator_code",
            "smscs.name as smsc_name",
            "smscs.value as smsc_value"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "smsc_bindings.country_id",
                "destination" => "countries.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "smsc_bindings.operator_id",
                "destination" => "operators.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "smsc_bindings.smsc_id",
                "destination" => "smscs.id",
            ]
        ],
        "withs" => [
            'country',
            'operator',
            'smsc'
        ]
    ],
    [
        "model" => Epush\Core\Sender\Infra\Database\Model\Sender::class,
        "columns" => [
            "user_id"           => "senders.user_id",
            "name"              => "senders.name",
            "approved"          => "senders.approved",
            "created_at"        => "senders.created_at",
            "company_name"      => "clients.company_name"
        ],
        "select_as" => [
            "senders.id as id"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "senders.user_id",
                "destination" => "clients.user_id",
            ]
        ]
    ],
    [
        "model" => Epush\Core\SenderConnection\Infra\Database\Model\SenderConnection::class,
        "columns" => [
            "user_id"           => "clients.user_id",
            "company_name"      => "clients.company_name",
            "approved"          => "senders_connections.approved",
            "created_at"        => "senders_connections.created_at",
            "sender_id"         => "senders.id",
            "sender_name"       => "senders.name",
            "sender_approved"   => "senders.approved",
            "country_name"      => "countries.name",
            "country_code"      => "countries.code",
            "operator_name"     => "operators.name",
            "operator_code"     => "operators.code",
            "smsc_name"         => "smscs.name",
            "smsc_value"        => "smscs.value",
            "default"           => "smsc_bindings.default",
        ],
        "select_as" => [
            "senders_connections.id as id",
            "senders_connections.approved as approved",
            "senders_connections.created_at as created_at",
            "clients.company_name as company_name",
            "senders.id as sender_id",
            "senders.name as sender_name",
            "senders.approved as sender_approved",
            "countries.name as country_name",
            "countries.code as country_code",
            "operators.name as operator_name",
            "operators.code as operator_code",
            "smscs.name as smsc_name",
            "smscs.value as smsc_value"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "senders_connections.sender_id",
                "destination" => "senders.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "senders.user_id",
                "destination" => "clients.user_id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "senders_connections.smsc_id",
                "destination" => "smsc_bindings.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "smsc_bindings.country_id",
                "destination" => "countries.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "smsc_bindings.operator_id",
                "destination" => "operators.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "smsc_bindings.smsc_id",
                "destination" => "smscs.id",
            ]
        ],
        "withs" => [
            'smsc' => [
                'country',
                'operator',
                'smsc'
            ]
        ]
    ],
    [
        "model" => Epush\Core\Message\Infra\Database\Model\Message::class,
        "columns" => [
            "user_id"               => "messages.user_id",
            "content"               => "messages.content",
            "notes"                 => "messages.notes",
            "sent"                  => "messages.sent",
            "length"                => "messages.length",
            "approved"              => "messages.approved",
            "total_cost"            => "messages.total_cost",
            "single_message_cost"   => "messages.single_message_cost",
            "number_of_segments"    => "messages.number_of_segments",
            "number_of_recipients"  => "messages.number_of_recipients",
            "scheduled_at"          => "messages.scheduled_at",
            "created_at"            => "messages.created_at",
            "updated_at"            => "messages.updated_at",
            "language"              => "message_languages.name",
            "company_name"          => "clients.company_name",
            "partner_id"            => "clients.partner_id",
            "sender_name"           => "senders.name",

        ],
        "select_as" => [
            "messages.id as id",
            "messages.content as content",
            "messages.notes as notes",
            "messages.approved as approved",
            "messages.total_cost as total_cost",
            "messages.single_message_cost as single_message_cost",
            "messages.number_of_segments as number_of_segments",
            "messages.number_of_recipients as number_of_recipients",
            "messages.scheduled_at as scheduled_at",
            "messages.created_at as created_at",
            "messages.updated_at as updated_at",
            "clients.company_name as company_name",
            "senders.name as sender_name",
            "message_languages.name as language"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "messages.user_id",
                "destination" => "clients.user_id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "messages.sender_id",
                "destination" => "senders.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "messages.order_id",
                "destination" => "orders.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "messages.message_language_id",
                "destination" => "message_languages.id",
            ],
        ],
        "withs" => [
            "language",
            "segments",
            // "recipients" => [
            //     'messageGroupRecipient'
            // ]
        ],
        "OrderBy" => [
            "messages.created_at" => "DESC",
        ]
    ],
    [
        "model" => Epush\Core\MessageGroup\Infra\Database\Model\MessageGroup::class,
        "columns" => [
            "group_name"        => "message_groups.name",
            "user_id"           => "message_groups.user_id",
            "status"            => "message_groups.status",
            "updated_at"        => "message_groups.updated_at",
            "created_at"        => "message_groups.created_at",
        ],
        "select_as" => [
            "message_groups.id as id",
            "message_groups.name as group_name",
            "message_groups.created_at as created_at",
        ],
        // "withs" => [
        //     "recipients"
        // ]
    ],
    [
        "model" => Epush\Core\MessageGroupRecipient\Infra\Database\Model\MessageGroupRecipient::class,
        "columns" => [
            "number"            => "message_group_recipients.number",
            "attributes"        => "message_group_recipients.attributes",
            "created_at"        => "message_group_recipients.created_at",
            "user_id"           => "message_groups.user_id",
            "group_name"        => "message_groups.name"
        ],
        "select_as" => [
            "message_group_recipients.id as id",
            "message_group_recipients.number as number",
            "message_group_recipients.attributes as attributes",
            "message_group_recipients.created_at as created_at",
            "message_groups.name as group_name",
        ],
        "joins" => [
            [
                "type" => "left",
                "operator" => "=",
                "source" => "message_group_recipients.message_group_id",
                "destination" => "message_groups.id",
            ],
        ],
        "withs" => [
            "messageGroup"
        ]
    ],
    [
        "model" => Epush\Core\MessageSegment\Infra\Database\Model\MessageSegment::class,
        "columns" => [
            "segment_number"    => "message_segments.segment_number",
            "segment_content"   => "message_segments.segment_content",
            "created_at"        => "message_segments.created_at",
            "message"           => "messages.content"
        ],
        "select_as" => [
            "message_segments.id as id",
            "message_segments.segment_number as segment_number",
            "message_segments.segment_content as segment_content",
            "message_segments.created_at as created_at",
            "messages.content as message",
        ],
        "joins" => [
            [
                "type" => "left",
                "operator" => "=",
                "source" => "message_segments.message_id",
                "destination" => "messages.id",
            ],
        ],
        "withs" => [
            "message"
        ]
    ],
    [
        "model" => Epush\Core\MessageRecipient\Infra\Database\Model\MessageRecipient::class,
        "columns" => [
            "status"            => "message_recipients.status",
            "created_at"        => "message_recipients.created_at",
            "message"           => "messages.content",
            "group_name"        => "message_groups.name",
            "number"            => "message_group_recipients.number",
            "attributes"        => "message_group_recipients.attributes",
            "user_id"           => "clients.user_id",
            "company_name"      => "clients.company_name"
        ],
        "select_as" => [
            "message_recipients.id as id",
            "message_recipients.status as status",
            "message_recipients.created_at as created_at",
            "messages.content as message",
            "message_groups.name as group_name",
            "message_group_recipients.number as number",
            "message_group_recipients.attributes as attributes",
            "clients.company_name as company_name",
        ],
        "joins" => [
            [
                "type" => "left",
                "operator" => "=",
                "source" => "message_recipients.message_id",
                "destination" => "messages.id",
            ],
            [
                "type" => "left",
                "operator" => "=",
                "source" => "message_recipients.message_group_recipient_id",
                "destination" => "message_group_recipients.id",
            ],
            [
                "type" => "left",
                "operator" => "=",
                "source" => "message_group_recipients.message_group_id",
                "destination" => "message_groups.id",
            ],
            [
                "type" => "left",
                "operator" => "=",
                "source" => "messages.user_id",
                "destination" => "clients.user_id",
            ]
        ],
        "withs" => [
            "message",
            "messageGroupRecipient"
        ]
    ],
    [
        "model" => Epush\Expense\PaymentMethod\Infra\Database\Model\PaymentMethod::class,
        "columns" => [
            "name"              => "payment_methods.name",
            "created_at"        => "payment_methods.created_at"
        ]
    ],
    [
        "model" => Epush\Expense\Order\Infra\Database\Model\Order::class,
        "columns" => [
            "user_id"            => "orders.user_id",
            "credit"            => "orders.credit",
            "collection_date"   => "orders.collection_date",
            "created_at"        => "orders.created_at",
            "sales_name"        => "sales.name",
            "company_name"      => "clients.company_name",
            "partner_id"        => "clients.partner_id",
            "payment_method"    => "payment_methods.name",
            "pricelist"         => "pricelists.name",
        ],
        "select_as" => [
            "sales.name as sales_name",
            "pricelists.name as pricelist_name",
            "payment_methods.name as payment_method_name"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "orders.user_id",
                "destination" => "clients.user_id",
            ],
            [
                "type" => "left",
                "operator" => "=",
                "source" => "clients.sales_id",
                "destination" => "sales.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "orders.pricelist_id",
                "destination" => "pricelists.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "orders.payment_method_id",
                "destination" => "payment_methods.id",
            ]
        ],
    ],
    [
        "model" => Epush\Settings\Infra\Database\Model\Settings::class,
        "columns" => [
            "name"              => "settings.name",
            "type"              => "settings.type",
            "value"             => "settings.value",
            "description"       => "settings.description",
            "created_at"        => "settings.created_at"
        ]
    ],
    [
        "model" => Epush\Ticket\Infra\Database\Model\Ticket::class,
        "columns" => [
            "user_id"           => "tickets.user_id",
            "first_name"        => "tickets.first_name",
            "last_name"         => "tickets.last_name",
            "email"             => "tickets.email",
            "phone"             => "tickets.phone",
            "company_name"      => "tickets.company_name",
            "sender_name"       => "tickets.sender_name",
            "content"           => "tickets.content",
            "notes"             => "tickets.notes",
            "current_status"    => "tickets.status",
            "created_at"        => "tickets.created_at",
        ]
    ],
    [
        "model" => Epush\File\Infra\Database\Model\File::class,
        "columns" => [
            "url"               => "files.url",
            "type"              => "files.type",
            "file_type"         => "files.type",
            "user_id"           => "files.user_id",
            "folder_id"         => "files.folder_id",
            "created_at"        => "files.created_at",
            "updated_at"        => "files.updated_at",
            "folder_name"       => "folders.name",
            "company_name"      => "clients.company_name",
        ],
        "select_as" => [
            "files.id as id",
            "files.updated_at as updated_at",
            "folders.name as folder_name"
        ],
        "joins" => [
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "files.folder_id",
                "destination" => "folders.id",
            ],
            [
                "type" => "inner",
                "operator" => "=",
                "source" => "files.user_id",
                "destination" => "clients.user_id",
            ]
        ]
    ],
    [
        "model" => Epush\File\Infra\Database\Model\Folder::class,
        "columns" => [
            "name"              => "folders.name",
            "description"       => "folders.description",
            "created_at"        => "folders.created_at",
        ]
    ],
    [
        "model" => Epush\SMS\Infra\Database\Model\SMSTemplate::class,
        "columns" => [
            "subject"           => "sms_templates.subject",
            "template"          => "sms_templates.template"
        ]
    ]
];