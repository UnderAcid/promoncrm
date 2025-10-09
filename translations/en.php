<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'nERP',
        'tagline' => 'Web3 ERP Builder',
        'locale_code' => 'en-US',
        'language_label' => 'Language',
        'theme' => [
            'toggle' => 'Toggle theme',
            'label' => 'Theme',
            'light' => 'Light',
            'dark' => 'Dark',
        ],
        'noscript' => 'JavaScript is disabled. Some features may be limited.',
    ],
    'meta' => [
        'title' => 'nERP — launch CRM/HR/Warehouse fast, no servers needed',
        'description' => 'Optimize sales, warehouse, and HR. Start on ready-made nodes with no infrastructure: local encryption, pay-per-action, clear KPIs and reports.',
        'keywords' => 'nERP, quick start, process optimization, CRM, HR, warehouse, Web3 ERP, encryption, pay per action',
        'og_title' => 'nERP — fast start for your business',
        'og_description' => 'Less routine, more control: roles, statuses, reports. Launch in weeks on ready-made nodes.',
        'og_image_alt' => 'How nERP works: nodes, roles, and processes',
    ],
    'schema' => [
        'webpage_name' => 'nERP — Web3 ERP Builder',
        'webpage_description' => 'Assemble CRM, HR, and warehouse with local encryption, micropayments, and role-based access — without your own servers.',
        'faq' => [
            [
                'question' => 'What is nERP?',
                'answer' => 'A business process builder (CRM/HR/Warehouse) with local encryption and pay-per-action by real user activity.',
            ],
            [
                'question' => 'How fast can we start?',
                'answer' => 'The first working flow typically launches in 2–4 weeks on nERP nodes — no in-house infrastructure.',
            ],
            [
                'question' => 'Where is data stored?',
                'answer' => 'Data is encrypted client-side; your team keeps the keys. Nodes see only encrypted blocks and metadata.',
            ],
            [
                'question' => 'Who is nERP for?',
                'answer' => 'Owners, directors, ops and HR teams who want transparent processes, roles, and reports without a “zoo” of tools.',
            ],
            [
                'question' => 'How does billing work?',
                'answer' => 'You pay for completed actions (micropayments). Extra work is quoted separately.',
            ],
            [
                'question' => 'Can we customize processes?',
                'answer' => 'Yes. We map your flow, configure roles and integrations, and extend the builder for your tasks.',
            ],
            [
                'question' => 'What’s included in the initial launch?',
                'answer' => 'A short audit, starting the needed contours (CRM/HR/Warehouse), effect metrics, and a scale-up plan.',
            ],
            [
                'question' => 'How to contact the team?',
                'answer' => 'Email pilotnerp@slmax.by or message Telegram @devslm — we reply within one business day.',
            ],
        ],
    ],
    'nav' => [
        'for' => 'Who it’s for',
        'why' => 'Benefits',
        'pricing' => 'Pricing',
        'pilots' => 'Launch',
        'toggle' => 'Menu',
    ],
    'hero' => [
        'tags' => ['Fast start', 'Encryption', 'No servers'],
        'title' => "nERP — CRM/HR/Warehouse in weeks",
        'lead' => 'Bring order to sales, warehouse, and HR. Start on ready-made nodes — no infrastructure. You control keys and access. We agree on KPIs, calculate savings, and move step-by-step.',
        'primary_cta' => 'Request a process audit',
        'secondary_cta' => 'Get a savings estimate',
        'feature_cards' => [
            [
                'icon' => 'zap',
                'title' => 'Fast start',
                'desc' => 'Connect to ready nodes and get first reports — without a year-long “implementation”.',
            ],
            [
                'icon' => 'lock',
                'title' => 'You stay in control',
                'desc' => 'Local encryption, roles, and an action log. Transparent access rights.',
            ],
            [
                'icon' => 'wallet',
                'title' => 'Pay per action',
                'desc' => 'No bundles or seat fees — only real operations are billed.',
            ],
        ],
    ],
    'audience' => [
        'title' => 'Who nERP is for',
        'subtitle' => 'Owners, executives, HR and ops — when you need less routine and visible numbers fast.',
        'options' => [
            'business' => [
                'icon' => 'building',
                'title' => 'Owners & CEOs',
                'desc' => 'Transparent processes and reports without a tool zoo.',
            ],
            'integrator' => [
                'icon' => 'plug',
                'title' => 'Operations leaders',
                'desc' => 'Roles, statuses, approvals, and deadline control.',
            ],
            'dev' => [
                'icon' => 'code',
                'title' => 'HR & Sales teams',
                'desc' => 'Fewer manual steps, clear tasks and statuses.',
            ],
        ],
        'pitches' => [
            'business' => [
                'icon' => 'shield',
                'title' => 'No servers to start',
                'desc' => 'We connect to nERP nodes and configure roles and reports.',
            ],
            'integrator' => [
                'icon' => 'coins',
                'title' => 'Put processes under control',
                'desc' => 'Approvals, notifications, and an action log — all in one place.',
            ],
            'dev' => [
                'icon' => 'boxes',
                'title' => 'Visible impact',
                'desc' => 'Routine down and task discipline up — in weeks.',
            ],
        ],
        'cta' => 'Request a process audit',
    ],
    'why' => [
        'title' => 'Why teams choose nERP',
        'blocks' => [
            [
                'icon' => 'layers',
                'title' => 'Ready to work',
                'desc' => 'We assemble a working contour: roles, statuses, notifications, and summaries.',
            ],
            [
                'icon' => 'shield',
                'title' => 'Security by default',
                'desc' => 'You hold the keys. Nodes see only encrypted blocks and metadata.',
            ],
            [
                'icon' => 'cpu',
                'title' => 'Transparent economics',
                'desc' => 'Micropayments per action instead of seat fees and idle licenses.',
            ],
        ],
    ],
    'how' => [
        'title' => 'How it works',
        'items' => [
            [
                'title' => 'Connect to nERP nodes',
                'desc' => 'Relay and storage are already deployed — start without your own infrastructure.',
            ],
            [
                'title' => 'Describe your process',
                'desc' => 'We align goals and metrics, configure roles, rights, statuses, and reports.',
            ],
            [
                'title' => 'Grow together',
                'desc' => 'We add the functions you need, lock in the effect, and prepare a scale-up plan.',
            ],
        ],
    ],
    'stack' => [
        'title' => 'nERP architecture & security',
        'subtitle' => 'Start on our nodes, then scale on your own terms.',
        'highlights' => [
            [
                'icon' => 'nodes',
                'title' => 'Ready nodes',
                'desc' => 'No server to spin up. We connect you to nERP infrastructure and grant access.',
            ],
            [
                'icon' => 'ledger',
                'title' => 'Encryption & audit',
                'desc' => 'Granular roles, action logs, and revoking rights without rewriting data.',
            ],
            [
                'icon' => 'workflow',
                'title' => 'Working contours',
                'desc' => 'Records, statuses, summaries, and alerts for day-to-day ops.',
            ],
            [
                'icon' => 'api',
                'title' => 'Integrations on demand',
                'desc' => 'We connect required services during the launch. Your tasks come first.',
            ],
        ],
        'integrations_title' => 'What’s ready in MVP',
        'integrations_desc' => 'The minimum set to start. We add other scenarios for your case.',
        'integrations_core' => 'nERP Node',
        'integrations_core_desc' => 'Encrypted core with roles, audit, and billing.',
        'integrations' => [
            ['name' => 'Action logging', 'tag' => 'MVP', 'status' => 'Ready', 'icon' => 'check'],
            ['name' => 'Roles & access', 'tag' => 'MVP', 'status' => 'Ready', 'icon' => 'shield'],
            ['name' => 'Summaries & reports', 'tag' => 'MVP', 'status' => 'Ready', 'icon' => 'bar-chart'],
        ],
        'footnote' => 'Need extra integrations? We’ll align them at kick-off.',
    ],
    'outcomes' => [
        'title' => 'Results you can defend',
        'subtitle' => 'We speak results: time saved and clear reports.',
        'metrics' => [
            [
                'value' => '2–4 weeks',
                'title' => 'To first process',
                'desc' => 'We map the flow, set up access and dashboards — to the launch report.',
            ],
            [
                'value' => '↓ 30–40%',
                'title' => 'Fewer manual actions',
                'desc' => 'Approvals, statuses, and contract bots reduce routine work.',
            ],
            [
                'value' => '24/7',
                'title' => 'Support',
                'desc' => 'Core engineers are on call, join meetings, and help with escalations.',
            ],
        ],
        'footnote' => 'Estimates based on recent launches. Exact KPIs depend on your industry.',
    ],
    'enablement' => [
        'title' => 'Co-launch program',
        'subtitle' => 'Marketing, ops, and IT follow one playbook — the launch doesn’t stall.',
        'stages' => [
            [
                'title' => 'Kick-off & brief',
                'desc' => 'We define scenarios, access levels, and KPIs with your team in one meeting.',
            ],
            [
                'title' => 'Solution architecture',
                'desc' => 'We configure integrations, reports, and alerts for your stack and processes.',
            ],
            [
                'title' => 'Go-live & coaching',
                'desc' => 'Weekly iterations, case logging, and metrics. We prepare the scale-up plan.',
            ],
        ],
        'cta' => 'Get a consultation',
    ],
    'pricing' => [
        'title' => 'How much nERP costs',
        'subtitle' => 'You pay for real user actions. We’ll finalize token price at kick-off.',
        'notice' => 'For estimates we use 1 NTP ≈ $1 (may vary). Tell us what’s comfortable — we’ll calculate for your process.',
        'team_size' => 'Team size',
        'actions_per_day' => 'Actions per person per day',
        'monthly_actions' => 'Actions per month',
        'nerp_total' => 'NTP spend (tokens)',
        'fiat_equivalent' => 'RUB equivalent',
        'hint' => 'Approximate — depends on activity and selected features.',
        'locale' => 'en-US',
        'currency' => 'RUB',
        'micro_fee' => 'Pay only for completed actions.',
        'primary_cta' => 'Get a savings estimate',
        'token_price_label' => 'Token price',
        'token_price_prefix' => '1 NTP =',
        'token_price_suffix' => '₽',
        'token_price_presets_label' => 'Quick presets',
        'token_price_presets_currency' => '$',
        'token_price_hint' => 'We use 1 NTP ≈ $1 for calculations. The actual price will be market-driven.',
        'token_price_preview_prefix' => '1 NTP ≈',
        'token_price_usd' => 1.0,
        'token_price_min_usd' => 0.1,
        'token_price_max_usd' => 2.0,
        'token_price_step_usd' => 0.1,
        'token_price_decimals' => 2,
        'token_decimals' => 6,
        'fiat_per_usd' => 93.0,
        'operations_title' => 'Base operations (estimate)',
        'operations_suffix' => 'NTP',
        'operations' => [
            ['title' => 'Read block', 'cost' => 0.000010],
            ['title' => 'Write block', 'cost' => 0.000100],
            ['title' => 'Store block', 'cost' => 0.000010, 'postfix' => '· day⁻¹'],
        ],
        'operation_fiat_prefix' => '≈',
        'comparison' => [
            'title' => 'Cost comparison vs popular ERP/CRM',
            'subtitle' => 'Numbers recalc with the calculator above — compare budgets quickly.',
            'nerp_label' => 'nERP',
            'pros_label' => 'Pros',
            'cons_label' => 'Cons',
            'nerp_tokens_suffix' => 'tokens per month',
            'team_caption' => 'for {count} people',
            'nav_prev' => 'Back',
            'nav_next' => 'Next',
            'systems' => [
                [
                    'id' => 'google-sheets',
                    'name' => 'Google Sheets (Workspace)',
                    'price_per_user' => 1100,
                    'price_period' => 'per user / month (Business Standard, USD pricing → converter)',
                    'nerp' => [
                        'pros' => [
                            'Pay only for actions — no idle licenses.',
                            'Built-in audit and access segregation.',
                        ],
                        'cons' => [
                            'Needs integration with your process.',
                            'Token price finalized before launch.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Fast start and familiar UI.',
                            'No heavy deployment or training.',
                        ],
                        'cons' => [
                            'No single action log & permissions model.',
                            'Lots of manual work and error risk.',
                        ],
                    ],
                ],
                [
                    'id' => '1c',
                    'name' => '1C (cloud)',
                    'price_per_user' => 1800,
                    'price_period' => 'per user / month (example reseller pricing)',
                    'nerp' => [
                        'pros' => [
                            'Complex processes without long custom dev.',
                            'Transparent pay-per-action instead of licenses.',
                        ],
                        'cons' => [
                            'Smaller ready-made ecosystem.',
                            'Launch configured together with nERP team.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Ready accounting & ops modules.',
                            'Large integrator network.',
                        ],
                        'cons' => [
                            'High license & support costs.',
                            'Long change cycles.',
                        ],
                    ],
                ],
                [
                    'id' => 'amocrm',
                    'name' => 'amoCRM',
                    'price_per_user' => 1699,
                    'price_period' => 'per user / month (“Professional”, billed for 6+ months)',
                    'nerp' => [
                        'pros' => [
                            'Covers processes beyond sales.',
                            'Fine-grained rights and immutable audit.',
                        ],
                        'cons' => [
                            'Sales-team UI may feel less familiar.',
                            'Team needs some training time.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Polished sales tools.',
                            'Marketplace with integrations.',
                        ],
                        'cons' => [
                            'Per-user billing.',
                            'Limited scenarios outside CRM.',
                        ],
                    ],
                ],
                [
                    'id' => 'bitrix24',
                    'name' => 'Bitrix24 (cloud)',
                    'price_per_user' => 1990,
                    'price_period' => 'plans are per company / year (users included by plan)',
                    'nerp' => [
                        'pros' => [
                            'Focus on cross-functional ops.',
                            'Pay for activity, not seats.',
                        ],
                        'cons' => [
                            'Fewer ready marketing templates.',
                            'No bundled telephony yet.',
                        ],
                    ],
                    'system' => [
                        'pros' => [
                            'Large set of built-in modules.',
                            'Tools for comms & collaboration.',
                        ],
                        'cons' => [
                            'Customizations are harder to maintain.',
                            'Licenses are costly when underused.',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'partners' => [
        'title' => 'For partners & authors',
        'cards' => [
            [
                'icon' => 'percent',
                'title' => 'Pilot-friendly terms',
                'desc' => 'Custom work for your processes at below-market rates.',
            ],
            [
                'icon' => 'boxes',
                'title' => 'Shared roadmap',
                'desc' => 'What matters to the launch goes first.',
            ],
            [
                'icon' => 'plug',
                'title' => 'Fast rollouts',
                'desc' => 'Start on ready nodes, then scale.',
            ],
        ],
    ],
    'logos' => [
        'eyebrow' => 'Launch cases',
        'intro' => 'We’re building a cohort. Bring your process — we’ll show value and back it with metrics.',
        'default' => 'pilot-generic',
        'pilots' => [
            [
                'id' => 'pilot-generic',
                'label' => 'Your launch',
                'company' => 'Your company',
                'quote' => 'Started on ready nodes, fixed the metrics, and kept developing on our own terms.',
                'role' => 'Launch sponsor',
                'metric' => 'From start to report → 2–4 weeks*',
            ],
        ],
    ],
    'cta' => [
        'title' => 'Ready to try?',
        'subtitle' => 'Start on ready nodes, align goals & KPIs, then extend functionality.',
        'primary_cta' => 'Request a process audit',
        'secondary_cta' => 'Watch demo',
    ],
    'faq' => [
        'title' => 'FAQ',
        'items' => [
            [
                'question' => 'What is nERP?',
                'answer' => 'A Web3 ERP builder with local encryption and pay-per-action. Ready blocks: CRM/HR/Warehouse.',
            ],
            [
                'question' => 'How fast can we launch?',
                'answer' => 'Typically 2–4 weeks to the first working contour on nERP nodes.',
            ],
            [
                'question' => 'Where is data stored?',
                'answer' => 'Client-side encryption; you keep the keys. nERP nodes see only encrypted blocks and metadata.',
            ],
            [
                'question' => 'Who is it for?',
                'answer' => 'Owners, executives, HR and ops teams who need transparent processes and reports.',
            ],
            [
                'question' => 'How does billing work?',
                'answer' => 'Micropayments for real user actions. Extra work is estimated separately.',
            ],
            [
                'question' => 'What’s included in the initial launch?',
                'answer' => 'Process audit, launching CRM/HR/Warehouse contours, effect metrics, and a scale-up plan.',
            ],
            [
                'question' => 'Can we customize processes?',
                'answer' => 'Yes. We describe the flow and configure roles, integrations, and reports for your case.',
            ],
            [
                'question' => 'How to contact the team?',
                'answer' => 'Email pilotnerp@slmax.by or message Telegram @devslm — we reply within one business day.',
            ],
        ],
    ],
    'footer' => [
        'copyright' => '© :year nERP. All rights reserved.',
        'links' => [
            ['label' => 'Policy', 'href' => '/policy/'],
            ['label' => 'Docs', 'href' => 'https://novij.tech'],
            ['label' => 'Contacts', 'href' => 'mailto:pilotnerp@slmax.by'],
        ],
    ],
    'language_switcher' => [
        'label' => 'Interface language',
    ],
    'floating_cta' => 'Request a process audit',
    'pilots' => [
        'eyebrow' => 'Fast launch',
        'title' => 'Go live in weeks — no infrastructure',
        'subtitle' => 'Align goals, lock in the effect, and plan the next steps.',
        'points' => [
            'Start: connect to nERP nodes and grant team access.',
            'Co-define the process and target metrics.',
            'Configure roles, reports, alerts, and integrations if needed.',
            'Billing — per action; extra work — on agreed terms.',
            'Prepare a launch report and a growth plan.',
            'Timelines may exceed a month — we move in stages and track results transparently.',
        ],
        'form' => [
            'title' => 'Request a process audit',
            'subtitle' => 'Describe your task and current tools — we’ll prepare a launch plan.',
            'action' => 'https://nerp.app/api/pilot-request',
            'name' => 'Full name',
            'name_placeholder' => 'John Smith',
            'email' => 'Work email',
            'email_placeholder' => 'you@company.com',
            'company' => 'Company',
            'company_placeholder' => 'Example LLC',
            'role' => 'Role / responsibility',
            'role_placeholder' => 'COO',
            'rate' => 'Comfortable price per 1 token',
            'rate_placeholder' => 'e.g., $0.7',
            'message' => 'Which process should we move first?',
            'message_placeholder' => 'Briefly describe current tools, pains, and desired outcome…',
            'consent' => 'By submitting the form you agree to data processing and to receive launch updates from nerp.app.',
            'submit' => 'Send request',
            'success' => 'Thanks! We’ll reply within 24 hours.',
            'error' => 'Submission failed. Please email pilotnerp@slmax.by.',
        ],
    ],
    'policy' => [
        'meta' => [
            'title' => 'nERP Privacy Policy | nerp.app',
            'description' => 'What data nERP collects during launches, how client-side encryption works, retention periods, and how to request deletion or access.',
            'keywords' => 'nERP privacy policy, data processing, personal data nERP',
            'og_title' => 'nERP Data Processing Policy',
            'og_description' => 'We explain what data is needed for launch, how encryption works, and how to request deletion.',
            'og_image_alt' => 'nERP privacy: secure storage and checklist',
        ],
        'eyebrow' => 'Transparency',
        'title' => 'nERP Personal Data Processing Policy',
        'intro' => 'We use data only to launch and improve processes. This document explains what we collect, how we protect information, and your team’s rights.',
        'updated' => 'Updated: May 2025',
        'contact_title' => 'Contact us',
        'contact' => 'Email pilotnerp@slmax.by or message Telegram @devslm — we reply within one business day and help with any data questions.',
        'sections' => [
            [
                'title' => '1. Who we are and what we do',
                'paragraphs' => [
                    'nERP is a Web3 ERP builder. We help teams launch accounting and automation contours using our secure nodes and smart contracts.',
                    'Data controller: Sole proprietor Daniil Papirny, operating under the nERP brand.',
                ],
            ],
            [
                'title' => '2. What data we process',
                'paragraphs' => [
                    'We collect only what’s needed to prepare the launch and gather product feedback.',
                ],
                'bullets' => [
                    'Contact data: name, work email, role, company.',
                    'Process description: current software, pains, launch tasks, target metrics.',
                    'Technical logs: anonymized events in demo/test nodes, IPs for anti-spam.',
                    'Payment preferences: comfortable token price and currency.',
                ],
            ],
            [
                'title' => '3. How we use data',
                'paragraphs' => [
                    'We need data to align scope, configure roles, prepare a commercial offer, and stay in touch during the project.',
                ],
                'bullets' => [
                    'Access to nERP nodes and dashboards.',
                    'Preparing a launch plan and economics.',
                    'Effect analytics — only in aggregate.',
                    'Product updates by email — only with your explicit consent.',
                ],
            ],
            [
                'title' => '4. Storage & security',
                'paragraphs' => [
                    'All working data is encrypted client-side before being sent to nERP nodes.',
                    'Access to requests is restricted to team members preparing the launch.',
                ],
            ],
            [
                'title' => '5. Your rights',
                'paragraphs' => [
                    'You can manage your data anytime — just contact us.',
                ],
                'bullets' => [
                    'Request a copy or data portability.',
                    'Correct or add information.',
                    'Delete data if it’s no longer needed.',
                    'Withdraw consent to communications and analytics emails.',
                ],
            ],
            [
                'title' => '6. Sharing with third parties',
                'paragraphs' => [
                    'We don’t sell or share personal data without your permission.',
                    'We may use trusted processors (cloud infra, email services) — they work under contract and process data only per our instructions.',
                ],
            ],
        ],
    ],
];
