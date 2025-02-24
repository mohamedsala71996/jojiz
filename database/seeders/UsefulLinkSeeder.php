<?php

namespace Database\Seeders;

use App\Models\UsefulLink;
use Illuminate\Database\Seeder;

class UsefulLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $usefullLinks = [
            [
                'type' => 'page',
                'title' => 'Privacy & Policy',
                'slug' => 'privacy-policy',
                'url' => 'https://example.com',
                'content' => '<h1>Privacy Policy</h1>
<p>Your privacy is critically important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website. Please read this policy carefully. If you do not agree with the terms of this policy, please do not access the website.</p>

<h2>Information We Collect</h2>
<p>We may collect information about you in a variety of ways. The information we may collect includes:</p>
<ul>
    <li><strong>Personal Data:</strong> Personally identifiable information, such as your name, email address, and contact details, that you voluntarily give to us when you register on the website or when you choose to participate in various activities related to the website.</li>
    <li><strong>Usage Data:</strong> Information automatically collected when accessing our site, including your IP address, browser type, operating system, access times, and pages viewed directly before and after accessing the website.</li>
</ul>

<h2>How We Use Your Information</h2>
<p>We use the information we collect or receive for the following purposes:</p>
<ul>
    <li>To operate and improve our website and services.</li>
    <li>To process transactions and send you confirmations.</li>
    <li>To respond to your inquiries and provide customer support.</li>
    <li>To send promotional communications if you have opted in to receive them.</li>
</ul>

<h2>Sharing Your Information</h2>
<p>We do not sell, rent, or trade your personal data to third parties. However, we may share your information with:</p>
<ul>
    <li><strong>Service Providers:</strong> Trusted third parties that perform services on our behalf, such as payment processing, data analysis, email delivery, and hosting services.</li>
    <li><strong>Legal Obligations:</strong> When required by law or to protect your rights and safety, or the rights and safety of others.</li>
</ul>

<h2>Cookies and Tracking Technologies</h2>
<p>We may use cookies, web beacons, and other tracking technologies to help customize the website and improve your experience. You can adjust your browser settings to decline cookies if you prefer.</p>

<h2>Data Security</h2>
<p>We implement appropriate technical and organizational measures to protect your personal data from unauthorized access, use, or disclosure. However, no data transmission over the Internet or storage technology can be guaranteed to be 100% secure.</p>

<h2>Your Rights</h2>
<p>You have the right to access, correct, or delete your personal information. To exercise these rights, please contact us at <a href="mailto:support@example.com">support@example.com</a>.</p>

<h2>Changes to This Policy</h2>
<p>We reserve the right to update this privacy policy at any time. Any changes will be posted on this page with an updated effective date.</p>

<h2>Contact Us</h2>
<p>If you have questions or concerns about this Privacy Policy, please contact us at:</p>
<p><strong>Email:</strong> <a href="mailto:support@example.com">support@example.com</a><br>
<strong>Phone:</strong> +1 (123) 456-7890</p>',
                'status' => true,
                'is_deletable' => false,
            ],
            [
                'type' => 'page',
                'title' => 'Return Policy',
                'slug' => 'return-policy',
                'url' => 'https://example.com',
                'content' => 'Our return policy allows you to return items within 30 days of purchase. The item must be unused and in the original packaging to qualify for a return. Refunds will be processed within 7-10 business days upon receiving the returned item. Please note that return shipping costs are non-refundable.',
                'status' => true,
                'is_deletable' => false,
            ]

         ];

         UsefulLink::insert($usefullLinks);
    }
}
