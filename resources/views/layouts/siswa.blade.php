<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMK Telkom Purwokerto')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @yield('styles')
</head>
<body class="@yield('body-class', 'font-sans antialiased')">
    @yield('content')

    @include('components.bk-chatbot')

    <script>
        // Hapus percakapan chatbot saat logout
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForms = document.querySelectorAll('form[action*="logout"]');
            logoutForms.forEach(form => {
                form.addEventListener('submit', function() {
                    // Panggil fungsi clear conversation jika tersedia
                    if (window.clearBkChatConversation) {
                        window.clearBkChatConversation();
                    }
                });
            });
        });
    </script>
</body>
</html>