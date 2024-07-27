<!-- resources/views/legal.blade.php -->
<!-- PHP code -->
<?php
// function to return page's title given the subsection part of the URL
function pageName($subsection)
{
    if ($subsection === 'tou') {
        return 'Terms of Use';
    } else {
        // $ss === 'privacy'
        return 'Privacy Policy';
    }
}
?>

<!-- HTML code -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- call function to return page's title given the subsection part of the URL -->
    <title>{{ pageName($subsection) }}</title>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- link to the main CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <!-- cookie notice -->
    <x-alert type="info" :message="__(
        'Welcome to our cookie jar! By using our site, you\'re agreeing to indulge in a well-baked browsing experience.',
    )">
    </x-alert>

    <nav class="tabNav">
        <ul>
            <!-- home webpage tab -->
            <li><a href="{{ url('/') }}">HOME</a></li>
            <!-- about webpage tab -->
            <li><a href="{{ url('/about') }}">ABOUT</a></li>
            <!-- user role selection tab -->
            <li><a href="{{ url('/auth/login') }}">LOGIN</a></li>
        </ul>
    </nav>

    <main>
        <!-- call function to return page's subsection view -->
        <h1>Legal: {{ pageName($subsection) }}</h1>
        <!-- blade template conditional -->
        @if ($subsection === 'tou')
            <p>Welcome to Cool Tech.
                <br />
                By accessing and using this website, you agree to comply with the following terms
                and conditions of use:
            </p>
            <ol>
                <li>
                    <h3>Acceptance of Terms</h3>
                    <p>By accessing and using our website, you accept and agree to be bound by the terms and conditions
                        of
                        this agreement. If you do not agree to these terms, please do not use our website.</p>
                </li>
                <li>
                    <h3>Changes to Terms</h3>
                    <p>We reserve the right to change these terms at any time. Your continued use of the website
                        following
                        any changes will be deemed your acceptance of those changes.</p>
                </li>
                <li>
                    <h3>Use of the Website</h3>
                    <p>You agree to use the website only for lawful purposes and in a way that does not infringe the
                        rights
                        of, restrict or inhibit anyone else's use of the website.</p>
                </li>
                <li>
                    <h3>Intellectual Property</h3>
                    <p>All content on this website, including text, graphics, logos and images, is the property of Cool
                        Tech or its content suppliers and is protected by copyright laws. Unauthorised use of this
                        content
                        is prohibited.</p>
                </li>
                <li>
                    <h3>Limitation of Liability</h3>
                    <p>Cool Tech will not be liable for any damages arising from the use of this website. This includes
                        (but
                        is not limited to) direct, indirect, incidental, punitive and consequential damages.</p>
                </li>
                <li>
                    <h3>Governing Law</h3>
                    <p>These terms are governed by and construed in accordance with the laws of the jurisdiction in
                        which
                        Cool Tech operates.</p>
                </li>
                <li>
                    <h3>Contact Information</h3>
                    <p>
                        If you have any questions about these Terms of Use, please contact us at
                        <a href="mailto:cooltech@gmail.com">cooltech@gmail.com</a>.
                    </p>
                </li>
            </ol>
        @else
            <p>Cool Tech is committed to protecting your privacy.
                <br />
                This policy explains how we collect, use and disclose personal information:
            </p>
            <ol>
                <li>
                    <h3>Information Collection</h3>
                    <p>We collect personal information when you use our website, such as your name, email address and
                        other
                        contact details you provide voluntarily.</p>
                </li>
                <li>
                    <h3>Use of Information</h3>
                    <p>We use the information we collect to provide, maintain and improve our services, as well as to
                        communicate with you.</p>
                </li>
                <li>
                    <h3>Information Sharing</h3>
                    <p>We do not share your personal information with third parties, except as required by law or to
                        protect
                        our rights.</p>
                </li>
                <li>
                    <h3>Data Security</h3>
                    <p>We take reasonable measures to protect your personal information from unauthorised access, use or
                        disclosure.</p>
                </li>
                <li>
                    <h3>Cookies</h3>
                    <p>We use cookies to improve your experience on our website. You can choose to disable cookies
                        through
                        your browser settings.</p>
                </li>
                <li>
                    <h3>Third-Party Links</h3>
                    <p>Our website may contain links to other websites. We are not responsible for the privacy practices
                        of
                        those websites.</p>
                </li>
                <li>
                    <h3>Changes to this Policy</h3>
                    <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page.</p>
                </li>
                <li>
                    <h3>Contact Information</h3>
                    <p>
                        If you have any questions about this Privacy Policy, please contact us at
                        <a href="mailto:cooltech@gmail.com">cooltech@gmail.com</a>.
                    </p>
                </li>
            </ol>
        @endif
    </main>

    <footer>
        <hr />
        <!-- link to search page -->
        <a href="{{ url('/search') }}">🔎 Search articles</a>
        <hr />
        <br /><br />
        <!-- terms of use link -->
        <a href="{{ url('/legal/tou') }}">Terms of Use •</a>
        <!-- privacy policy link -->
        <a href="{{ url('/legal/privacy') }}">Privacy Policy</a>
        <br />
        <!-- author -->
        <h4>Created by <a href="https://jediahjireh.wordpress.com">Jediah Jireh Naicker</a></h4>
        <!-- copyright -->
        &copy; 2024 Cool Tech
    </footer>
</body>

</html>
