<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Enhanced Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <style>
      .active {
        background-color: #6366f1; /* indigo-600 */
        color: white;
        transform: translateY(-0.25rem); /* -translate-y-1 */
      }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen text-gray-800">
    {{ $slot }}
    <script>
      function setActive(element) {
        const buttons = document.querySelectorAll('.sidebar div');
        buttons.forEach(button => button.classList.remove('active'));
        element.classList.add('active');
      }
    </script>
  </body>
</html>