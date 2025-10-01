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
        'integrations_desc' => 'During the pilot we hook chats, spreadsheets, and billing without procurement delays.',
        'integrations' => [
            [
                'icon' => 'slack',
                'title' => 'Slack & Telegram',
                'desc' => 'Real-time alerts on deals, tasks, and incidents in your team chats.',
            ],
            [
                'icon' => 'notion',
                'title' => 'Notion & Confluence',
                'desc' => 'Sync knowledge bases and policies with live nERP processes.',
            ],
            [
                'icon' => 'sheets',
                'title' => 'Google Sheets / Excel',
                'desc' => 'Two-way spreadsheets for finance dashboards and reporting exports.',
            ],
            [
                'icon' => 'crm',
                'title' => '1C, SAP, HubSpot',
                'desc' => 'Ready-made connectors for orders, invoices, and product catalogs.',
            ],
            [
                'icon' => 'github',
                'title' => 'GitHub & Jira',
                'desc' => 'Bring release notes, issues, and automation triggers into the node.',
            ],
        ],
        'footnote' => 'Need something extra? Pilot teams can request custom connectors.',
    ],
    'pricing' => [
        'title' => 'What nERP costs',
        'subtitle' => 'The final token price is still being defined — model different scenarios to understand unit economics.',
        'team_size' => 'Team size',
        'actions_per_day' => 'Actions per person per day',
        'monthly_actions' => 'Actions per month',
        'nerp_total' => 'nERP spend (tokens)',
        'fiat_equivalent' => 'USD equivalent',
        'hint' => 'Mix teams and roles — totals depend on the modules and usage frequency.',
        'locale' => 'en-US',
        'currency' => 'USD',
        'micro_fee' => 'Pay only for actions performed and the underlying network fees.',
        'primary_cta' => 'Talk to the nERP team',
        'token_price_label' => 'Token price',
        'token_price_prefix' => '1 nERP =',
        'token_price_suffix' => '$',
        'token_price_presets_label' => 'Quick price presets',
        'token_price_presets_currency' => '$',
        'token_price_hint' => 'We will finalise the token price together with pilot cohorts. Model different assumptions.',
        'token_price_note' => 'For now we assume 1 nERP = $1 — adjust the value to compare budgets.',
        'token_price_preview_prefix' => '1 nERP ≈',
        'token_price_usd' => 1.0,
        'token_price_min_usd' => 1.0,
        'token_price_step_usd' => 1.0,
        'token_price_decimals' => 2,
        'token_decimals' => 6,
        'fiat_per_usd' => 1.0,
        'operations_title' => 'Base operation costs',
        'operations_suffix' => 'nERP',
        'team_size_hint' => 'From 1 to 1000 people including contractors.',
        'actions_hint' => 'Adjust usage intensity for each department to match reality.',
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
        'brands' => [
            [
                'name' => 'Astra',
                'tagline' => 'fintech · 240 people',
                'quote' => '“We shipped CRM+HR in two days with no server or integrator. Paying per action keeps budgets honest.”',
                'author' => 'Acme LLC',
                'role' => 'COO',
            ],
            [
                'name' => 'Orion',
                'tagline' => 'retail · 80 stores',
                'quote' => '“Inventory and cash discipline now live in nERP while regional leads keep encrypted access.”',
                'author' => 'Orion Retail',
                'role' => 'Operations director',
            ],
            [
                'name' => 'Mercury',
                'tagline' => 'marketplace · 600 sellers',
                'quote' => '“Nodes track every order and shipment. Usage-based billing removed our spreadsheet chaos.”',
                'author' => 'Mercury Market',
                'role' => 'Head of growth',
            ],
            [
                'name' => 'Helix',
                'tagline' => 'engineering · 45 people',
                'quote' => '“Encryption plus the audit trail satisfied security review and fast-tracked procurement.”',
                'author' => 'Helix Engineering',
                'role' => 'CISO',
            ],
            [
                'name' => 'Nord',
                'tagline' => 'logistics · 12 hubs',
                'quote' => '“Badge issuing and request approvals run automatically without extra code.”',
                'author' => 'Nord Logistics',
                'role' => 'HR Director',
            ],
            [
                'name' => 'Sigma',
                'tagline' => 'IT service · distributed team',
                'quote' => '“nERP scenarios power support SLAs and per-action micropayments for partners.”',
                'author' => 'Sigma Support',
                'role' => 'Support lead',
            ],
        ],
        'default' => [
            'quote' => '“We shipped CRM+HR in two days with no server or integrator. Paying per action keeps budgets honest.”',
            'author' => 'Acme LLC',
            'role' => 'COO',
        ],
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
                'answer' => 'Keys and access policies stay local. Nodes only view encrypted chunks.',
            ],
            [
                'question' => 'How is access managed?',
                'answer' => 'Granular policies at block level plus instant revocation without rewriting data.',
            ],
            [
                'question' => 'Is onboarding complex?',
                'answer' => 'Not at all. Pick modules, connect a node, and launch processes. Support lives inside the product.',
            ],
            [
                'question' => 'Do we need an external integrator?',
                'answer' => 'The nERP core team runs the rollout: process map, node deployment, and staff training.',
            ],
            [
                'question' => 'Can we start with a small squad?',
                'answer' => 'Absolutely. Begin with one department and expand across the organisation once ready.',
            ],
            [
                'question' => 'How are fees calculated?',
                'answer' => 'Only real user actions trigger spend. We deliver a live dashboard with forecasts and alerts.',
            ],
            [
                'question' => 'What happens after the pilot?',
                'answer' => 'We promote the nodes into production, sign an SLA, and keep 24/7 chat support online.',
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
            'Dedicated launch squad and product analytics.',
            'Encrypted nodes with contract billing tuned to your workflows.',
            'Process discovery and paperwork automation together with your team.',
            'Access to partner modules and prebuilt playbooks.',
            'Founding pricing — pay only network fees during the pilot.',
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
    ],
];
