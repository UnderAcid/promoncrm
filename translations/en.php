<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'nERP',
        'locale_code' => 'en-US',
        'language_label' => 'Language',
        'theme' => [
            'toggle' => 'Toggle theme',
            'label' => 'Theme',
            'light' => 'Light',
            'dark' => 'Dark',
        ],
        'noscript' => 'JavaScript is disabled. Some functionality may be limited.',
    ],
    'meta' => [
        'title' => 'nERP — Web3 ERP Builder | nerp.app',
        'description' => 'Build CRM, HR, and inventory workflows in one day at nerp.app. The nERP Web3 ERP builder keeps data encrypted locally, scales via nodes, and charges only for real actions.',
        'keywords' => 'nerp.app, Web3 ERP, CRM builder, HR automation, decentralized inventory, encrypted data, micropayments',
        'og_title' => 'nERP — Web3 ERP Builder | nerp.app',
        'og_description' => 'Launch CRM, HR, and inventory with encrypted nodes at nerp.app. Your data stays yours, payments track real usage.',
    ],
    'nav' => [
        'for' => 'Who it is for',
        'why' => 'Why nERP',
        'pricing' => 'Pricing',
        'pilots' => 'Pilots',
        'toggle' => 'Menu',
    ],
    'hero' => [
        'tags' => ['Web3.0', 'Encryption', 'nerp.app'],
        'title' => 'Web3.0 ERP builder',
        'lead' => 'Build CRM, HR, and inventory in one day at nerp.app. Data is encrypted locally and stays with you. Scale the node network and only pay for the actions performed.',
        'primary_cta' => 'Join the pilot',
        'secondary_cta' => 'Watch demo',
        'feature_cards' => [
            [
                'icon' => 'zap',
                'title' => 'Up and running in a day',
                'desc' => 'Modular blocks, no heavy integrations required.',
            ],
            [
                'icon' => 'lock',
                'title' => 'Zero vendor lock-in',
                'desc' => 'Secrets and keys always stay on your side.',
            ],
            [
                'icon' => 'wallet',
                'title' => 'No subscription tiers',
                'desc' => 'Micropayments only for actual operations.',
            ],
        ],
    ],
    'audience' => [
        'title' => 'Who nERP is for',
        'subtitle' => 'Pick a profile — content and examples will adapt.',
        'options' => [
            'business' => [
                'icon' => 'building',
                'title' => 'Businesses',
                'desc' => 'Launch CRM/HR/Inventory fast without long integrations.',
            ],
            'integrator' => [
                'icon' => 'plug',
                'title' => 'Integrators',
                'desc' => 'Embed and earn a share from every transaction.',
            ],
            'dev' => [
                'icon' => 'code',
                'title' => 'Developers',
                'desc' => 'Ship modules and monetise real usage.',
            ],
        ],
        'pitches' => [
            'business' => [
                'icon' => 'shield',
                'title' => 'Launch processes in hours',
                'desc' => 'Ready-made CRM/HR/Inventory blocks plus automated access policies. No server procurement.',
            ],
            'integrator' => [
                'icon' => 'coins',
                'title' => 'Share in transactions',
                'desc' => 'Connect clients to the network and earn up to 30% from micropayments per action.',
            ],
            'dev' => [
                'icon' => 'boxes',
                'title' => 'Module marketplace',
                'desc' => 'Publish features and get paid automatically based on usage.',
            ],
        ],
        'cta' => 'Book a pilot call',
    ],
    'why' => [
        'title' => 'Why teams choose nERP',
        'blocks' => [
            [
                'icon' => 'layers',
                'title' => 'Blocks like LEGO®',
                'desc' => 'Mix CRM, HR, inventory, and custom workflows together.',
            ],
            [
                'icon' => 'shield',
                'title' => 'Encryption by default',
                'desc' => 'Keys stay with you. Nodes only see encrypted blocks.',
            ],
            [
                'icon' => 'cpu',
                'title' => 'Automated actions',
                'desc' => 'Microservices react to events and eliminate manual work.',
            ],
        ],
    ],
    'how' => [
        'title' => 'How it works',
        'items' => [
            [
                'title' => 'Connect an nERP node',
                'desc' => 'Deploy on your hardware or in the cloud. Data stays fully under your control.',
            ],
            [
                'title' => 'Select modules and roles',
                'desc' => 'Activate CRM, HR, inventory, then extend with custom blocks. Manage granular access.',
            ],
            [
                'title' => 'Launch your workflows',
                'desc' => 'Automation handles operations while you only pay for user actions.',
            ],
        ],
    ],
    'stack' => [
        'title' => 'nERP architecture & security',
        'subtitle' => 'Map the platform quickly so security, ops, and founders stay aligned during the pilot.',
        'highlights' => [
            [
                'icon' => 'nodes',
                'title' => 'Node in your infrastructure',
                'desc' => 'Deploy on-prem or in the cloud. Data and keys remain inside your perimeter.',
            ],
            [
                'icon' => 'ledger',
                'title' => 'Encryption and audit trail',
                'desc' => 'Keys stay with the owner, every access is logged and verified on smart contracts.',
            ],
            [
                'icon' => 'workflow',
                'title' => 'Automation without heavy code',
                'desc' => 'Prebuilt playbooks connect CRM, HR, and inventory without lengthy integrations.',
            ],
            [
                'icon' => 'api',
                'title' => 'Open APIs',
                'desc' => 'REST and webhooks to plug in your services and third-party modules.',
            ],
        ],
        'integrations_title' => 'Default integrations',
        'integrations_desc' => 'We ship popular tools from day one of the pilot — no endless procurement cycles.',
        'integrations' => [
            [
                'icon' => 'slack',
                'name' => 'Slack Webhooks',
                'desc' => 'Channel alerts and automation triggers out of the box.',
                'status' => 'Live',
            ],
            [
                'icon' => 'database',
                'name' => '1C gateway',
                'desc' => 'Sync catalogues and transactions with 1C.',
                'status' => 'Beta',
            ],
            [
                'icon' => 'sheets',
                'name' => 'Google Sheets',
                'desc' => 'Two-way spreadsheets for analytics teams.',
                'status' => 'Live',
            ],
            [
                'icon' => 'notion',
                'name' => 'Notion Sync',
                'desc' => 'Push tasks and wiki updates without manual copy-paste.',
                'status' => 'Live',
            ],
            [
                'icon' => 'postgres',
                'name' => 'PostgreSQL',
                'desc' => 'Stream changes into your own data warehouse.',
                'status' => 'Soon',
            ],
        ],
        'footnote' => 'Need something else? Pilot teams can request new connectors.',
    ],
    'pricing' => [
        'title' => 'What nERP costs',
        'subtitle' => 'Only pay for actions performed. Use the calculator to explore different workload scenarios.',
        'token_notice_title' => 'Token price is being finalised',
        'token_notice' => 'We are aligning the nERP token economics with pilot teams. For now model with 1 nERP ≈ $1 to keep estimates straightforward.',
        'team_size' => 'Team size (1–1000)',
        'actions_per_day' => 'Actions per person per day',
        'monthly_actions' => 'Actions per month',
        'nerp_total' => 'nERP spend (tokens)',
        'fiat_equivalent' => 'USD equivalent',
        'hint' => 'The calculator is indicative — actual pricing depends on modules and data volume.',
        'locale' => 'en-US',
        'currency' => 'USD',
        'micro_fee' => 'Pay only for actions performed.',
        'primary_cta' => 'Talk to the nERP team',
        'token_price_label' => 'Token price',
        'token_price_prefix' => '1 nERP =',
        'token_price_suffix' => '$',
        'token_price_presets_label' => 'Quick price presets',
        'token_price_presets_currency' => '$',
        'token_price_hint' => 'Pick an expected token price. We currently assume $1 for 1 nERP.',
        'token_price_preview_prefix' => '1 nERP ≈',
        'token_price_usd' => 1.0,
        'token_price_min_usd' => 1.0,
        'token_price_step_usd' => 1.0,
        'token_price_decimals' => 2,
        'token_decimals' => 6,
        'fiat_per_usd' => 1.0,
        'operations_title' => 'Base operation costs',
        'operations_suffix' => 'nERP',
        'operations' => [
            [
                'title' => 'Read a block',
                'cost' => 0.000010,
            ],
            [
                'title' => 'Write a block',
                'cost' => 0.000100,
            ],
            [
                'title' => 'Store a block',
                'cost' => 0.000010,
                'postfix' => '· day⁻¹',
            ],
        ],
        'operation_fiat_prefix' => '≈',
    ],
    'partners' => [
        'title' => 'For partners and module authors',
        'cards' => [
            [
                'icon' => 'percent',
                'title' => '30% from transactions',
                'desc' => 'Lifetime revenue share from client activity.',
            ],
            [
                'icon' => 'boxes',
                'title' => 'Module marketplace',
                'desc' => 'Monetise features based on actual usage.',
            ],
            [
                'icon' => 'plug',
                'title' => 'Plug-and-play rollout',
                'desc' => 'Plug & play instead of lengthy integrations.',
            ],
        ],
    ],
    'logos' => [
        'eyebrow' => 'Pilots and integrations',
        'brands' => ['Astra', 'Orion', 'Mercury', 'Helix', 'Nord', 'Sigma'],
        'selector_title' => 'Pilot success stories',
        'selector_hint' => 'Pick a pilot to read their feedback.',
    ],
    'cta' => [
        'title' => 'Ready to try it?',
        'subtitle' => 'Spin up an ERP in minutes and run your first workflow today.',
        'primary_cta' => 'Apply for pilot access',
        'secondary_cta' => 'Watch demo',
    ],
    'faq' => [
        'title' => 'Frequently asked questions',
        'items' => [
            [
                'question' => 'Who can see my data?',
                'answer' => 'Keys and policies stay with you. Nodes store encrypted chunks and never access raw content.',
            ],
            [
                'question' => 'How long does the pilot take?',
                'answer' => 'A typical rollout is 10–14 days: one week to migrate processes and another to validate with your team.',
            ],
            [
                'question' => 'Can we plug in existing systems?',
                'answer' => 'Yes. We rely on prebuilt connectors (Slack, 1C, Google Sheets) and craft bespoke adapters together with your engineers.',
            ],
            [
                'question' => 'What about security reviews?',
                'answer' => 'We prepare threat models, encryption overviews, and audit logs so your security team can greenlight the pilot faster.',
            ],
            [
                'question' => 'How do we pay?',
                'answer' => 'During the pilot you only cover network fees. Post-pilot we settle in tokenised micro-payments per action or via corporate invoicing.',
            ],
            [
                'question' => 'Can we scale to multiple nodes?',
                'answer' => 'Absolutely. Deploy additional nodes on-prem or in the cloud with shared smart-contract governance and audit.',
            ],
        ],
    ],
    'footer' => [
        'copyright' => '© :year nERP. All rights reserved.',
        'links' => [
            ['label' => 'Privacy', 'href' => 'https://nerp.app/privacy'],
            ['label' => 'Docs', 'href' => 'https://nerp.app/docs'],
            ['label' => 'Contact', 'href' => 'mailto:pilot@nerp.app'],
        ],
    ],
    'language_switcher' => [
        'label' => 'Switch language',
    ],
    'floating_cta' => 'Apply for pilot access',
    'pilots' => [
        'eyebrow' => 'Pilot cohorts 2024',
        'title' => 'Join the nERP pilot program',
        'subtitle' => 'Deploy encrypted ERP nodes with the core team guiding you at nerp.app.',
        'points' => [
            'Implementation support from the nERP core team.',
            'Encrypted nodes with contract billing tuned to your workflows.',
            'Founding pricing — pay only network fees during the pilot.',
            'Dedicated success manager and shared Slack channel.',
            'Prebuilt integrations plus custom connectors for your stack.',
            'Security documentation and billing simulations before go-live.',
        ],
        'form' => [
            'title' => 'Apply for pilot access',
            'subtitle' => 'Tell us about your team so we can prepare the onboarding kit.',
            'action' => 'https://nerp.app/api/pilot-request',
            'name' => 'Full name',
            'name_placeholder' => 'Jane Doe',
            'email' => 'Work email',
            'email_placeholder' => 'you@company.com',
            'company' => 'Company',
            'company_placeholder' => 'Acme Inc.',
            'role' => 'Role / focus',
            'role_placeholder' => 'Operations lead',
            'message' => 'What do you plan to automate first?',
            'message_placeholder' => 'Share current tools, pain points, integrations…',
            'consent' => 'By submitting you agree to personal data processing and to receive onboarding updates from nerp.app.',
            'submit' => 'Send application',
            'success' => 'Thanks! We will contact you within 24 hours.',
            'error' => 'Unable to send. Please write to pilot@nerp.app.',
        ],
        'cases' => [
            [
                'id' => 'pilot-example',
                'label' => 'Acme LLC',
                'industry' => 'Fintech · 45 people',
                'result' => 'CRM + HR in 2 days',
                'quote' => '“We assembled CRM+HR in two days with no server or integrator required. Paying per action keeps budgets transparent.”',
                'author' => 'Acme LLC',
            ],
            [
                'id' => 'pilot-logistics',
                'label' => 'LogiChain',
                'industry' => 'Logistics · 120 people',
                'result' => 'Inventory & tracking in 1 week',
                'quote' => '“nERP connected warehouse and finance without a custom bus. We just enabled the blocks and gained action-based billing.”',
                'author' => 'LogiChain',
            ],
            [
                'id' => 'pilot-marketplace',
                'label' => 'MarketHub',
                'industry' => 'Marketplace · 300 sellers',
                'result' => 'Partner data exchange',
                'quote' => '“We built an order data mart and automated paperwork. Nodes stay in sync and partners only pay for executed actions.”',
                'author' => 'MarketHub',
            ],
            [
                'id' => 'pilot-production',
                'label' => 'Factory Five',
                'industry' => 'Manufacturing · 80 people',
                'result' => 'Quality & supply chain control',
                'quote' => '“nERP bridged 1C and equipment telemetry. The team tracks every change and can pause workflows instantly.”',
                'author' => 'Factory Five',
            ],
        ],
    ],
];
