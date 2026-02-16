@include('layouts.head')
<style>
        :root {
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-gradient-start: #f8fafc;
            --bg-gradient-end: #f1f5f9;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08), 
                        0 4px 20px rgba(0, 0, 0, 0.04),
                        inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 420px;
            padding: 48px 40px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.12), 
                        0 8px 25px rgba(0, 0, 0, 0.06),
                        inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        
        .logo-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            margin-top: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-control {
            padding: 14px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s ease;
            background: #ffffff;
        }
        
        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #9ca3af;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group .form-control {
            padding-right: 50px;
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s ease;
        }
        
        .toggle-password:hover {
            color: var(--primary-color);
        }
        
        .btn-login {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }
        
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.2);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 24px;
        }
        
        .forgot-password a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0;
            color: var(--text-secondary);
            font-size: 14px;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
        }
        
        .divider-text {
            padding: 0 16px;
        }
        
        .alternative-login {
            text-align: center;
        }
        
        .alt-login-btn {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            color: var(--text-primary);
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        
        .alt-login-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 32px;
            font-size: 14px;
            color: var(--text-secondary);
        }
        
        .signup-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            margin-left: 4px;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }
        
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .login-card {
                padding: 36px 24px;
                margin: 0 16px;
            }
            
            .logo {
                font-size: 28px;
            }
            
            .form-control {
                padding: 12px 14px;
            }
        }
        
        @media (max-width: 360px) {
            .login-card {
                padding: 32px 20px;
            }
            
            .logo {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <div class="logo">LOGIN</div>
                <div class="logo-subtitle">Silakan isi Email dan Password</div>
            </div>
            
            <form id="loginForm">
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        placeholder="you@example.com" 
                        required
                    >
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password" 
                            placeholder="Enter your password" 
                            required
                        >
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </button>
                        <div class="invalid-feedback">Password is required.</div>
                    </div>
                </div>
                
                
                <button type="submit" class="btn-login">
                    Sign In
                </button>
            </form>
            
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let isValid = true;
            
            // Reset validation states
            email.classList.remove('is-invalid');
            password.classList.remove('is-invalid');
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value || !emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            
            // Password validation
            if (!password.value) {
                password.classList.add('is-invalid');
                isValid = false;
            }
            
            if (isValid) {
                // Show loading state on button
                const submitBtn = this.querySelector('.btn-login');
                const originalText = submitBtn.textContent;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Signing In...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // Reset button state
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    
                    // Show success message (in a real app, you would redirect)
                    alert('Login successful! Welcome back.');
                    
                    // Reset form
                    this.reset();
                }, 1500);
            }
        });
        
        // Alternative login button handlers
        document.querySelectorAll('.alt-login-btn').forEach(button => {
            button.addEventListener('click', function() {
                const provider = this.textContent.trim().replace('Continue with ', '');
                
                // Show loading state
                const originalText = this.textContent;
                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Connecting...';
                this.disabled = true;
                
                // Simulate OAuth flow
                setTimeout(() => {
                    this.textContent = originalText;
                    this.disabled = false;
                    alert(`Redirecting to ${provider} authentication...`);
                }, 1000);
            });
        });
        
    </script>
</body>