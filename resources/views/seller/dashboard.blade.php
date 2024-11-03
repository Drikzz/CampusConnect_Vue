<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/seller.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header">
        <h1 class="company-name">{{ env('APP_NAME') }}</h1>
        <div class="profile">
            <img src="path/to/your/profile-pic.jpg" alt="Profile Picture" class="profile-pic">
        </div>
    </header>

    <div class="container">
        <div class="sidebar">
            <nav>
                <a href="#">Dashboard</a>
                <a href="#">Products</a>
                <a href="#">Insights</a>
                <a href="#">Trade Offers</a>
                <a href="#">Wallet</a>
            </nav>
        </div>

        <div class="main-content">
            <h2>Welcome to the Dashboard!</h2>
            <p>This is where you can manage your settings and view your profile.</p>
            <div class="insights">
                <div class="insight-box">Listed Products</div>
                <div class="insight-box">Orders</div>
                <div class="insight-box">Stocks</div>
                <div class="insight-box">Revenue</div>
            </div>
        </div>
    </div>
</body>
</html>
