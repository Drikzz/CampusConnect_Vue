<!-- rename to resources/views/components/seller-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ env('APP_NAME') }}</title>
	@vite(['resources/css/seller.css', 'resources/js/seller.js'])
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->

	<title>CC</title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="{{ asset('assets/seller-img/campconnect.jpg') }}" alt="company img" id="companyimg">
			<span class="text">CampusConnect</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="{{ route('dashboard') }}">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="{{ route('myproduct') }}">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Analytics</span>
				</a>
			</li>
			<li class="active">
			<a href="{{ route('wallet') }}">
				<i class='bx bx-wallet'></i>
				<span class="text">Wallet</span>
			</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots'></i>
					<span class="text">Message</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

    <!-- Main content -->
    <main>
        {{ $slot }}
    </main>
</section>
<!-- CONTENT -->

<script src="new.js"></script>
</body>
</html>

