<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>OneShirt</title>
    @vite('resources/js/app.js') <!-- Utilisez Vite pour charger app.js -->
</head>
<body>
    <div id="app"></div> <!-- Le conteneur où Vue.js sera monté -->
    
</body>
</html>

