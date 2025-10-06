<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'nERP',
        'tagline' => 'Web3 ERP without servers',
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
        'title' => 'nERP — Web3 ERP without servers | Pilot program',
        'description' => 'Build an ERP in one day. Web3 infrastructure, encryption, and pay-per-action pricing for 10 pilot teams.',
        'keywords' => 'nERP, Web3 ERP, serverless ERP, encryption, pay per action, pilot program',
        'og_title' => 'nERP — Web3 ERP without servers | Pilot program',
        'og_description' => 'Launch nERP in one day with encrypted Web3 nodes and pay only for user actions.',
        'og_image_alt' => 'Diagram of nERP nodes with CRM, HR, and inventory modules',
    ],
    'schema' => [
        'webpage_name' => 'nERP — Web3 ERP without servers',
        'webpage_description' => 'Launch a Web3 ERP in one day with encrypted nodes and pay-per-action billing.',
        'faq' => [
            [
                'question' => 'What is nERP?',
                'answer' => 'A Web3 ERP builder with local encryption, micropayments per action, and ready CRM/HR/inventory modules.',
            ],
            [
                'question' => 'How fast can we launch?',
                'answer' => 'A pilot launches in one day on managed nERP nodes with roles, statuses, and dashboards preconfigured.',
            ],
            [
                'question' => 'Where is the data stored?',
                'answer' => 'Data is encrypted locally, keys stay with your team, and nodes only see encrypted blocks and metadata.',
            ],
            [
                'question' => 'Who is nERP for?',
                'answer' => 'SMBs, integrators, and teams that need CRM/HR/inventory fast with a role-based access model.',
            ],
            [
                'question' => 'How does pricing work?',
                'answer' => 'You pay micropayments for real user actions while pilot customisation is scoped separately.',
            ],
            [
                'question' => 'Can we customise workflows?',
                'answer' => 'Yes, we map your process, configure roles, add integrations, and extend the Web3 ERP builder.',
            ],
            [
                'question' => 'What is included in the pilot?',
                'answer' => 'Process diagnostics, CRM/HR/inventory rollout, ROI metrics, and a roadmap for scaling.',
            ],
            [
                'question' => 'How do we contact the team?',
                'answer' => 'Email pilot@nerp.app or message @nerp_app on Telegram for a same-day response.',
            ],
        ],
    ],
    'nav' => [
        'for' => 'Pilot',
        'why' => 'How it works',
        'pricing' => 'Before vs After',
        'pilots' => 'Apply',
        'toggle' => 'Menu',
    ],
    'hero' => [
        'tags' => ['Web3', 'Encryption', 'Serverless'],
        'badge' => 'nERP pilot program',
        'title' => 'ERP without servers or rollouts. Go live in one day.',
        'subtitle' => 'Web3. Encryption. Pay only for actions.',
        'lead' => 'Web3. Encryption. Pay only for actions.',
        'primary_cta' => 'Join the pilot',
        'secondary_cta' => 'See what is included',
        'points' => [
            'Connect in a day with zero infrastructure to manage.',
            'Keys stay with your team — nodes only see encrypted blocks.',
            'Billing follows real user actions, not seats or tiers.',
        ],
        'feature_cards' => [
            [
                'icon' => 'zap',
                'title' => 'Launch in 24 hours',
                'desc' => 'Activate ready nERP nodes and start measuring impact immediately.',
            ],
            [
                'icon' => 'lock',
                'title' => 'Encryption by design',
                'desc' => 'Your team keeps the keys and controls every access grant.',
            ],
            [
                'icon' => 'wallet',
                'title' => 'Pay per action',
                'desc' => 'No bundles or seats — only pay for the operations that happened.',
            ],
        ],
    ],
    'pilot_program' => [
        'title' => 'nERP pilot program',
        'description' => 'We are selecting only 10 companies to join the pilot.',
        'benefits' => [
            [
                'title' => 'Priority support',
                'description' => 'Direct access to the product team and fast turnaround on feedback.',
            ],
            [
                'title' => 'Custom terms',
                'description' => 'Tailor tokenomics, roles, and processes around your metrics.',
            ],
            [
                'title' => 'Shape the tokenomics',
                'description' => 'Co-create the economic model and lock in pilot incentives.',
            ],
        ],
    ],
    'infographic' => [
        'title' => 'How nERP works',
        'subtitle' => 'Data is encrypted locally and travels through Web3 nodes.',
        'alt' => 'Diagram: data → encryption → node → result',
        'steps' => [
            [
                'title' => 'Data',
                'description' => 'Your team captures and updates operations inside nERP.',
            ],
            [
                'title' => 'Encryption',
                'description' => 'Keys stay with you, nodes receive only encrypted payloads.',
            ],
            [
                'title' => 'Node',
                'description' => 'nERP nodes execute roles, billing, and automations serverlessly.',
            ],
            [
                'title' => 'Result',
                'description' => 'Teams see real-time dashboards and pay only for the actions performed.',
            ],
        ],
    ],
    'comparison' => [
        'title' => 'Before vs After',
        'subtitle' => 'Traditional ERP versus nERP',
        'before_title' => 'Traditional ERP',
        'before_lead' => 'Months of implementation, hardware procurement, and sunk costs.',
        'before' => [
            'Lengthy scoping and custom builds for every department.',
            'Infrastructure, licenses, and ongoing maintenance on your side.',
            'Seat-based pricing regardless of actual utilisation.',
        ],
        'after_title' => 'nERP',
        'after_lead' => 'Connect in a day and scale functionality as the pilot grows.',
        'after' => [
            'Ready Web3 nodes with encryption and granular roles.',
            'Keys and access management stay with your team — no servers required.',
            'Pay strictly for user actions within the workflow.',
        ],
    ],
    'form' => [
        'title' => 'Apply for the pilot',
        'description' => 'Tell us what you want to automate and we will follow up within one business day.',
        'action' => '/api/pilot.php',
        'fields' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'How should we address you?',
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'name@company.com',
            ],
            'company' => [
                'label' => 'Company (optional)',
                'placeholder' => 'Company name or industry',
            ],
            'automation' => [
                'label' => 'What do you want to automate?',
                'placeholder' => 'Sales, inventory, production, or another process',
            ],
        ],
        'checkbox' => 'I want to join the pilot program',
        'consent' => 'By submitting you agree to the nERP data processing policy.',
        'submit' => 'Join the pilot',
        'success' => 'Thank you! We will contact you shortly.',
        'error' => 'Submission failed. Please try again or email pilot@nerp.app.',
    ],
    'urgency' => [
        'deadline' => 'Applications are open until 30 April 2024',
        'note' => 'Only 10 pilot slots are available.',
    ],
    'final_cta' => [
        'title' => 'Ready to be one of the 10 pilot teams?',
        'subtitle' => 'Plug into nERP and launch a Web3 ERP without servers in one day.',
        'primary' => 'Join the pilot',
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
        'integrations_title' => 'What ships in the MVP',
        'integrations_desc' => 'The essentials to launch a pilot — we extend the scope together with your team.',
        'integrations_core' => 'nERP node',
        'integrations_core_desc' => 'Encrypted core ledger with roles, audit, and billing.',
        'integrations' => [
            ['name' => 'Slack webhooks', 'tag' => 'Comms', 'status' => 'Live', 'icon' => 'chat'],
            ['name' => '1C gateway', 'tag' => 'Accounting', 'status' => 'Pilot', 'icon' => 'ledger'],
            ['name' => 'PostgreSQL', 'tag' => 'Database', 'status' => 'Live', 'icon' => 'database'],
        ],
        'footnote' => 'Need something else? We scope it with you at the pilot kick-off.',
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
            'title' => 'Cost comparison with popular ERP/CRM suites',
            'subtitle' => 'Numbers reflect the calculator above — tweak the sliders to see updated totals for your team.',
            'nerp_label' => 'nERP',
            'pros_label' => 'Pros',
            'cons_label' => 'Cons',
            'nerp_tokens_suffix' => 'tokens / month',
            'team_caption' => 'for {count} people',
            'nav_prev' => 'Previous',
            'nav_next' => 'Next',
            'systems' => [
                [
                    'id' => 'google-sheets',
                    'name' => 'Google Sheets',
                    'price_per_user' => 12,
                    'price_period' => 'per user / month (Business Standard)',
                    'nerp' => [
                        'pros' => [
                            'Usage-based spend scales only with real activity.',
                            'Granular roles and audit trail out of the box.',
                        ],
                        'cons' => [
                            'Requires configuration with your process during the pilot.',
                            'Token price is finalised together with you.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Instant start with a familiar interface.',
                            'No complex rollout or onboarding.',
                        ],
                        'cons' => [
                            'No unified audit log or access control.',
                            'Heavy reliance on manual updates increases error risk.',
                        ],
                    ],
                ],
                [
                    'id' => '1c',
                    'name' => '1C',
                    'price_per_user' => 20,
                    'price_period' => 'per user / month (1C:CRM Cloud)',
                    'nerp' => [
                        'pros' => [
                            'Handles complex workflows without custom code.',
                            'Pay-per-action instead of static seat licences.',
                        ],
                        'cons' => [
                            'Smaller catalogue of ready-made modules today.',
                            'Our engineers guide the rollout side by side.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Rich accounting and compliance modules.',
                            'Large ecosystem of implementation partners.',
                        ],
                        'cons' => [
                            'High licence and support costs.',
                            'Change requests move slowly.',
                        ],
                    ],
                ],
                [
                    'id' => 'amocrm',
                    'name' => 'amoCRM',
                    'price_per_user' => 28,
                    'price_period' => 'per user / month (Pro, monthly billing)',
                    'nerp' => [
                        'pros' => [
                            'Covers finance, warehouse, and logistics beyond sales.',
                            'Fine-grained roles with immutable audit.',
                        ],
                        'cons' => [
                            'Interface is less familiar for sales reps.',
                            'Cross-functional teams need onboarding time.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Purpose-built toolkit for sales teams.',
                            'Marketplace packed with integrations.',
                        ],
                        'cons' => [
                            'Pay for every seat even if rarely used.',
                            'Limited automation outside the sales funnel.',
                        ],
                    ],
                ],
                [
                    'id' => 'bitrix24',
                    'name' => 'Bitrix24',
                    'price_per_user' => 22,
                    'price_period' => 'per user / month (Team, monthly billing)',
                    'nerp' => [
                        'pros' => [
                            'Designed for cross-team operational workflows.',
                            'Spend only when people perform actions.',
                        ],
                        'cons' => [
                            'Fewer ready-made marketing templates today.',
                            'Telephony isn’t bundled yet.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Broad catalogue of built-in modules.',
                            'Collaboration and comms tools included.',
                        ],
                        'cons' => [
                            'Maintaining deep customisations is complex.',
                            'Licence tiers become expensive for light users.',
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
                'question' => 'What is nERP?',
                'answer' => 'A Web3 ERP builder with local encryption, micropayments per action, and ready CRM/HR/inventory modules.',
            ],
            [
                'question' => 'How fast can we launch?',
                'answer' => 'A pilot launches in one day on managed nERP nodes with roles, statuses, and dashboards preconfigured.',
            ],
            [
                'question' => 'Where is the data stored?',
                'answer' => 'Data is encrypted locally, keys stay with your team, and nodes only see encrypted blocks and metadata.',
            ],
            [
                'question' => 'Who is nERP for?',
                'answer' => 'SMBs, integrators, and teams that need CRM/HR/inventory fast with a role-based access model.',
            ],
            [
                'question' => 'How does pricing work?',
                'answer' => 'You pay micropayments for real user actions while pilot customisation is scoped separately.',
            ],
            [
                'question' => 'What is included in the pilot?',
                'answer' => 'Process diagnostics, CRM/HR/inventory rollout, ROI metrics, and a roadmap for scaling.',
            ],
            [
                'question' => 'Can we customise workflows?',
                'answer' => 'Yes, we map your process, configure roles, add integrations, and extend the Web3 ERP builder.',
            ],
            [
                'question' => 'How do we contact the team?',
                'answer' => 'Email pilot@nerp.app or message @nerp_app on Telegram for a same-day response.',
            ],
        ],
    ],
    'footer' => [
        'copyright' => '© :year nERP. All rights reserved.',
        'links' => [
            ['label' => 'Privacy', 'href' => '/en/policy/'],
            ['label' => 'Docs', 'href' => 'https://nerp.app/docs'],
            ['label' => 'Contact', 'href' => 'mailto:pilot@nerp.app'],
        ],
    ],
    'language_switcher' => [
        'label' => 'Interface language',
    ],
    'floating_cta' => 'Join the pilot',
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
    'policy' => [
        'meta' => [
            'title' => 'nERP Privacy Policy | nerp.app',
            'description' => 'See how nERP collects and protects personal data during Web3 ERP pilots, covering encryption, retention limits, consent, and how to request access or deletion.',
            'keywords' => 'nERP privacy policy, data processing, personal data nERP',
            'og_title' => 'nERP Data Processing Policy',
            'og_description' => 'A transparent summary of required pilot data, the encryption model, and how to request deletion.',
            'og_image_alt' => 'nERP privacy — secure vault and checklist',
        ],
        'eyebrow' => 'Transparency',
        'title' => 'nERP Personal Data Processing Policy',
        'intro' => 'We rely on data solely to launch and improve pilot projects. This page explains what we collect, how we protect the information, and which rights you can exercise.',
        'updated' => 'Updated: May 2025',
        'contact_title' => 'Talk to us',
        'contact' => 'Drop us a line at pilot@nerp.app or ping @nerp_team on Telegram — we reply within one business day.',
        'sections' => [
            [
                'title' => '1. Who we are',
                'paragraphs' => [
                    'nERP is a Web3 ERP builder that helps teams launch secure operational workflows on our managed nodes and smart contracts.',
                    'Data controller: Daniil Papirny (sole proprietor) operating under the nERP brand.',
                ],
            ],
            [
                'title' => '2. Data we process',
                'paragraphs' => [
                    'We only request the details needed to scope a pilot and keep you informed about progress.',
                ],
                'bullets' => [
                    'Contact details: name, work email, role, company.',
                    'Process description: current tools, pain points, pilot goals, target KPIs.',
                    'Technical telemetry: anonymised demo activity, IP addresses for spam protection.',
                    'Commercial preferences: comfortable token price and desired currency.',
                ],
            ],
            [
                'title' => '3. Why we use the data',
                'paragraphs' => [
                    'We rely on the collected data to size the pilot, configure access, and stay aligned with your team.',
                ],
                'bullets' => [
                    'Provisioning access to nERP nodes and dashboards.',
                    'Preparing a pilot roadmap and commercial proposal.',
                    'Aggregated analytics about pilot efficiency.',
                    'Product updates and marketing emails — only if you opt in.',
                ],
            ],
            [
                'title' => '4. Storage and security',
                'paragraphs' => [
                    'Operational data is encrypted on the client side before it reaches any nERP infrastructure.',
                    'Pilot requests are accessible only to the core team members running your project. We log every access and use multi-factor authentication.',
                    'Raw pilot data is retained for no longer than 18 months after the collaboration unless the law requires otherwise.',
                ],
            ],
            [
                'title' => '5. Your rights',
                'paragraphs' => [
                    'You are in control of your data at all times — just reach out and we will help.',
                ],
                'bullets' => [
                    'Request a copy or transfer of your data.',
                    'Correct or update any information.',
                    'Erase the data when it is no longer needed for the pilot.',
                    'Withdraw consent for communications and marketing updates.',
                ],
            ],
            [
                'title' => '6. Sharing with third parties',
                'paragraphs' => [
                    'We do not sell or share personal data without your permission.',
                    'We may rely on vetted processors (cloud infrastructure, email providers). They act under contract and follow our instructions only.',
                ],
            ],
        ],
    ],
];
