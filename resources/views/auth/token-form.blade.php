<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Tenacious Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .auth-container {
            max-width: 500px;
            width: 100%;
            padding: 40px 20px;
        }
        
        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            text-align: center;
        }
        
        .auth-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
        }
        
        .auth-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .auth-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .auth-form {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3748;
        }
        
        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .form-button {
            width: 100%;
            padding: 15px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .form-button:hover {
            background: #5a6fd8;
        }
        
        .error-message {
            background: #fed7d7;
            color: #c53030;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #feb2b2;
        }
        
        .help-text {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .help-text a {
            color: #667eea;
            text-decoration: none;
        }
        
        .help-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>🎯 Tenacious Products</h1>
                <p>Enter your API token to access the product catalog</p>
            </div>
            
            <div class="auth-form">
                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('auth.authenticate') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="token" class="form-label">API Token</label>
                        <input 
                            type="text" 
                            id="token" 
                            name="token" 
                            class="form-input" 
                            placeholder="Enter your API token"
                            value="{{ old('token') }}"
                            required
                            autofocus
                        >
                    </div>
                    
                    <button type="submit" class="form-button">
                        Access Products
                    </button>
                </form>
                
                <div class="help-text">
                    Need a token? <a href="mailto:contact@tenacioustapes.com.au">Contact us for access</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
