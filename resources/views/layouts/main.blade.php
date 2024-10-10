<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @stack('before-styles')
  <link href="{{ asset('output.css') }}" rel="stylesheet">
  @stack('after-styles')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="font-poppins text-[#070625]">
</body>

@yield('content')

@stack('before-scripts')
@stack('after-scripts')

</html>
