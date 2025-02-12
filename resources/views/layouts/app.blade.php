<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Royal Apps</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add all CSS styles here */
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        .table th, .table td { 
            padding: 12px; 
            border: 1px solid #dee2e6; 
            text-align: left; 
        }
        .table th { 
            background: #f8f9fa; 
        }
        .btn { 
            padding: 8px 16px; 
            border-radius: 4px; 
            cursor: pointer; 
            text-decoration: none; 
        }
        .btn-primary { 
            background: #007bff; 
            color: white; 
            border: none; 
        }
        .btn-danger { 
            background: #dc3545; 
            color: white; 
            border: none; 
        }
        .btn-success { 
            background: #28a745; 
            color: white; 
            border: none; 
        }
        .alert { 
            padding: 12px; 
            margin: 15px 0; 
            border-radius: 4px; 
        }
        .alert-success { 
            background: #d4edda; 
            color: #155724; 
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    @if(session('user_data'))
    <div class="header" style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f8f9fa; border-bottom: 1px solid #ddd;">
    <div class="user-info">
        Welcome, {{ session('user_data')['first_name'] }} {{ session('user_data')['last_name'] }}
    </div>
    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" class="btn" style="background: #007bff; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Logout</button>
    </form>
</div>
    @endif

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>