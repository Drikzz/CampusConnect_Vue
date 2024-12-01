<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME') }}</title>
        @vite(['resources/css/seller.css', 'resources/js/seller.js'])
        <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <title>Add Product</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="wmsu pic.jfif" alt="company img" id="companyimg">
            <span class="text">CampusConnect</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="products.html">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Store</span>
                </a>
            </li>
            <li class="active">
                <a href="add_product.html">
                    <i class='bx bxs-cart-add'></i>
                    <span class="text">Add Product</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
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
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link"></a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
           
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="jose marie.png" alt="Profile Image">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN CONTENT -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Add New Product</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Add Product</a></li>
                    </ul>
                </div>
            </div>

            <!-- Add Product Form -->
            <div class="form-container">
                <form action="#" method="POST" class="add-product-form">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input type="text" id="product-name" name="product-name" placeholder="Enter product name" required>
                    </div>
            
                    <!-- Product Description -->
                    <div class="form-group">
                        <label for="product-description">Product Description</label>
                        <textarea id="product-description" name="product-description" placeholder="Enter product description" required></textarea>
                    </div>
            
                    <!-- Product Category -->
                    <div class="form-group">
                        <label for="product-category">Product Category</label>
                        <input type="text" id="product-category" name="product-category" placeholder="Enter product category" required>
                    </div>
            
                    <!-- Product Type (Sell, Trade, All) -->
                    <div class="form-group">
                        <label for="product-type">Trade Method</label>
                        <select id="product-type" name="product-type" required>
                            <option value="" disabled selected>Select product type</option>
                            <option value="sell">Sell</option>
                            <option value="trade">Trade</option>
                            <option value="all">All</option>
                        </select>
                    </div>
            
                    <!-- Product Price -->
                    <div class="form-group">
                        <label for="product-price">Product Price</label>
                        <input type="number" id="product-price" name="product-price" placeholder="Enter product price" required>
                    </div>

                    <div class="form-group">
                        <label for="product-price">Product Quantity</label>
                        <input type="number" id="product-price" name="product-price" placeholder="Enter product price" required>
                    </div>

                    <!-- Multiple Image Upload -->
                    <div class="form-group">
                        <label for="product-images">Product Images</label>
                        <input type="file" id="product-images" name="product-images" accept="image/*" multiple onchange="previewImages(event)">
                        <div id="image-preview" class="image-preview">
                            <!-- Image preview will be inserted here -->
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">Add Product</button>
                </form>
            </div>
        </main>
        <!-- MAIN CONTENT -->
    </section>
    <!-- CONTENT -->

    <script src="new.js"></script>
</body>
</html>
