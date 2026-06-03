<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signing in with Google</title>
</head>
<body>
    <script>
        try {
            const authData = {
                authToken: @json($token),
                userData: @json($user),
            };
            localStorage.setItem('auth', JSON.stringify(authData));
        } catch (error) {
            console.error('Unable to persist auth data:', error);
        }
        window.location.href = '/dashboard';
    </script>
</body>
</html>
