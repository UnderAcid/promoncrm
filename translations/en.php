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
        'og_image_alt' => 'nERP hero illustration with encrypted node and connected modules',
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
        'integrations_title' => 'What’s ready in the MVP',
        'integrations_desc' => 'The MVP already covers the core workflows so we can plug into your pilot fast.',
        'integrations_core' => 'Core modules',
        'integrations_core_desc' => 'Activity ledger, role-based access, reporting, and usage-based billing ship out of the box.',
        'integrations' => [
            ['name' => 'Activity ledger', 'tag' => 'MVP', 'status' => 'Live', 'icon' => 'check'],
            ['name' => 'Role-based access', 'tag' => 'MVP', 'status' => 'Live', 'icon' => 'shield'],
            ['name' => 'Ops reporting', 'tag' => 'MVP', 'status' => 'Live', 'icon' => 'bar-chart'],
        ],
        'footnote' => 'Need more connectors? We scope them together during the pilot brief.',
    ],
    'outcomes' => [
        'title' => 'Pilot outcomes you can pitch internally',
        'subtitle' => 'Every cohort finishes with tangible metrics so founders, ops, and finance teams see the ROI.',
        'metrics' => [
            [
                'value' => '4 weeks',
                'title' => 'To the first automated process',
                'desc' => 'We map the workflow, configure access, and ship dashboards before week five.',
            ],
            [
                'value' => '↓ 38%',
                'title' => 'Manual steps removed',
                'desc' => 'Operators cut routine actions thanks to scripted approvals and contract bots.',
            ],
            [
                'value' => '24/7',
                'title' => 'Support during the pilot',
                'desc' => 'Core engineers stay in touch in chat, join syncs, and help escalate blockers fast.',
            ],
        ],
        'footnote' => 'Numbers are based on the 2024 enterprise pilot cohort — we adapt targets to your industry.',
    ],
    'enablement' => [
        'title' => 'Co-pilot enablement program',
        'subtitle' => 'Marketing, ops, and IT get one playbook so the pilot doesn’t stall.',
        'stages' => [
            [
                'title' => 'Kick-off brief',
                'desc' => 'We outline use cases, access rules, and KPIs with your core team in one workshop.',
            ],
            [
                'title' => 'Solution blueprint',
                'desc' => 'Architects assemble integrations, dashboards, and alerts mapped to your stack.',
            ],
            [
                'title' => 'Launch & coaching',
                'desc' => 'Operators run the workflow with us on-call, iterate weekly, and capture success stories.',
            ],
        ],
        'cta' => 'Book an enablement call',
    ],
    'pricing' => [
        'title' => 'What nERP costs',
        'subtitle' => 'Only pay for actions performed. Token pricing will be finalised together with pilot teams.',
        'notice' => 'The token price is not set yet — the calculator assumes $1 per nERP. Adjust the value to model your scenario.',
        'team_size' => 'Team size',
        'actions_per_day' => 'Actions per person per day',
        'monthly_actions' => 'Actions per month',
        'nerp_total' => 'nERP spend (tokens)',
        'fiat_equivalent' => 'USD equivalent',
        'hint' => 'Team range goes from 1 to 1000 people. Numbers are indicative and depend on the modules you activate.',
        'locale' => 'en-US',
        'currency' => 'USD',
        'micro_fee' => 'Pay only for actions performed.',
        'primary_cta' => 'Talk to the nERP team',
        'token_price_label' => 'Token price',
        'token_price_prefix' => '1 nERP =',
        'token_price_suffix' => '$',
        'token_price_presets_label' => 'Quick price presets',
        'token_price_presets_currency' => '$',
        'token_price_hint' => 'We start with $1 per nERP. Tweak the value to reflect your own assumptions.',
        'token_price_preview_prefix' => '1 nERP ≈',
        'token_price_usd' => 1.0,
        'token_price_min_usd' => 0.1,
        'token_price_max_usd' => 2.0,
        'token_price_step_usd' => 0.1,
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
        'comparison' => [
            'title' => 'Cost comparison with popular ERP/CRM tools',
            'subtitle' => 'Tweak the calculator above — we’ll recalculate how much mainstream licences cost for the same workload.',
            'nerp_label' => 'nERP',
            'competitor_label' => 'Tool',
            'our_price_label' => 'nERP',
            'their_price_label' => 'Licences',
            'nerp_pros_title' => 'Why teams pick nERP',
            'nerp_cons_title' => 'Where we need alignment',
            'competitor_pros_title' => 'Strengths of the tool',
            'competitor_cons_title' => 'Trade-offs to keep in mind',
            'note_label' => 'Assumptions',
            'cards' => [
                [
                    'id' => 'google-sheets',
                    'name' => 'Google Sheets',
                    'description' => 'The default starting point when processes live in manual spreadsheets.',
                    'pricing' => [
                        'base' => 0,
                        'per_user' => 12,
                        'per_action' => 0,
                        'badge' => 'Business Standard',
                        'note' => 'Google Workspace Business Standard ≈ $12 per user/month.',
                    ],
                    'nerp' => [
                        'pros' => [
                            'Automated audit trail and granular roles.',
                            'Usage-based billing — pay only for recorded actions.',
                        ],
                        'cons' => [
                            'MVP launch requires a joint pilot with our team.',
                        ],
                    ],
                    'competitor' => [
                        'pros' => [
                            'Almost zero entry cost.',
                            'Flexible formulas and custom scripts.',
                        ],
                        'cons' => [
                            'No role model or immutable history.',
                            'Heavy manual upkeep to keep data fresh.',
                        ],
                    ],
                ],
                [
                    'id' => '1c',
                    'name' => '1C',
                    'description' => 'A classic ERP stack that expects customisation and server infrastructure.',
                    'pricing' => [
                        'base' => 45,
                        'per_user' => 19,
                        'per_action' => 0,
                        'badge' => 'Cloud subscription',
                        'note' => 'Hosting + licence ≈ $19 per user/month on average.',
                    ],
                    'nerp' => [
                        'pros' => [
                            'Ready-made core — no servers to procure.',
                            'Transparent audit and access management out of the box.',
                        ],
                        'cons' => [
                            'Additional integrations are scoped together during the pilot.',
                        ],
                    ],
                    'competitor' => [
                        'pros' => [
                            'Large ecosystem of modules and implementers.',
                            'Familiar UI for finance and accounting teams.',
                        ],
                        'cons' => [
                            'High total cost of ownership and maintenance.',
                            'Flexible processes usually need an external integrator.',
                        ],
                    ],
                ],
                [
                    'id' => 'amocrm',
                    'name' => 'amoCRM',
                    'description' => 'Sales-first CRM that needs tweaks for operational workflows.',
                    'pricing' => [
                        'base' => 0,
                        'per_user' => 39,
                        'per_action' => 0,
                        'badge' => 'Professional plan',
                        'note' => 'Professional tier ≈ $39 per user/month.',
                    ],
                    'nerp' => [
                        'pros' => [
                            'Action-based billing scales with real usage.',
                            'Dashboards for ops — not only the sales funnel.',
                        ],
                        'cons' => [
                            'We need a pilot brief to map the right scenarios.',
                        ],
                    ],
                    'competitor' => [
                        'pros' => [
                            'Strong tooling for sales pipelines.',
                            'Rich integration marketplace.',
                        ],
                        'cons' => [
                            'Pay per seat regardless of activity.',
                            'Operational records still require manual work.',
                        ],
                    ],
                ],
                [
                    'id' => 'bitrix24',
                    'name' => 'Bitrix24',
                    'description' => 'An all-in-one suite for CRM, tasks, and automation — powerful but heavy to maintain.',
                    'pricing' => [
                        'base' => 0,
                        'per_user' => 49,
                        'per_action' => 0,
                        'badge' => 'Enterprise plan',
                        'note' => 'Enterprise plan ≈ $49 per user/month with module caps.',
                    ],
                    'nerp' => [
                        'pros' => [
                            'Encryption and audit baked into the core.',
                            'See process economics thanks to action-linked billing.',
                        ],
                        'cons' => [
                            'Limited set of prebuilt integrations in the MVP.',
                        ],
                    ],
                    'competitor' => [
                        'pros' => [
                            'Many modules available out of the box.',
                            'Large integrator community.',
                        ],
                        'cons' => [
                            'Seat-based pricing regardless of usage.',
                            'Setup and ongoing support take a lot of effort.',
                        ],
                    ],
                ],
            ],
        ],
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
        'intro' => 'Tap a pilot story to see how teams run nERP today.',
        'default' => 'astra-retail',
        'pilots' => [
            [
                'id' => 'astra-retail',
                'label' => 'Astra Retail',
                'company' => 'Acme LLC',
                'quote' => 'We assembled CRM+HR in two days with no server or integrator required. Paying per action keeps budgets transparent.',
                'role' => 'COO',
                'metric' => '2 days → launch',
            ],
            [
                'id' => 'orion-logistics',
                'label' => 'Orion Logistics',
                'company' => 'Orion Freight',
                'quote' => 'Hooked the node into 1C and barcode scanners. Dispatch sees live statuses and SLA went up 18%.',
                'role' => 'Head of Ops',
                'metric' => '+18% SLA',
            ],
            [
                'id' => 'mercury-fintech',
                'label' => 'Mercury Fintech',
                'company' => 'Mercury Labs',
                'quote' => 'Usage-based billing went live without new code. Finance dashboards refresh every five minutes.',
                'role' => 'CFO',
                'metric' => '5 min refresh',
            ],
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
                'answer' => 'Keys and access policies stay with your team. Nodes only process encrypted chunks and metadata.',
            ],
            [
                'question' => 'How is access managed?',
                'answer' => 'Granular roles and block-level policies. Revoke permissions instantly without rewriting data.',
            ],
            [
                'question' => 'How long does a pilot take?',
                'answer' => 'Two weeks on average: the first week covers migrations and integrations, the second focuses on training and metrics.',
            ],
            [
                'question' => 'What if the integration we need is missing?',
                'answer' => 'We co-develop the connector with you. Most APIs go live within 3–5 days using our ready-made templates.',
            ],
            [
                'question' => 'Do we need our own DevOps team?',
                'answer' => 'No. An internal admin is enough. We deploy the node together with your team and provide 24/7 support in chat.',
            ],
            [
                'question' => 'Can we scale after the pilot?',
                'answer' => 'Absolutely. Move the node into production, add teams and contracts, sign an SLA, and expand integrations with us.',
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
        'label' => 'Interface language',
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
            'Process architects help map infrastructure and integrations.',
            'We train key operators and hand over ready-to-use playbooks.',
            'You receive a pilot report with metrics and a rollout roadmap.',
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
            'rate' => 'Comfortable rate per token',
            'rate_placeholder' => 'e.g. 0.70 $',
            'message' => 'What do you plan to automate first?',
            'message_placeholder' => 'Share current tools, pain points, integrations…',
            'consent' => 'By submitting you agree to personal data processing and to receive onboarding updates from nerp.app.',
            'submit' => 'Send application',
            'success' => 'Thanks! We will contact you within 24 hours.',
            'error' => 'Unable to send. Please write to pilot@nerp.app.',
        ],
    ],
];
