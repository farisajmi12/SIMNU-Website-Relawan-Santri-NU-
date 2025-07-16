<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login SIMNU</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #E6E6E6;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    /* Animated background elements */
    body::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background:
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
      animation: float 20s ease-in-out infinite;
      pointer-events: none;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }
    }

    .container {
      display: flex;
      width: 95%;
      max-width: 1200px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      overflow: hidden;
      box-shadow:
        0 32px 64px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.2);
      animation: slideIn 0.8s ease-out;
      position: relative;
    }

    .left-panel {
      flex: 1;
      background: linear-gradient(135deg, #0c8b00 0%, #0a7a00 100%) !important;
      position: relative;
      padding: 4rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      overflow: hidden;
    }

    .left-panel::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background:
        radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
      pointer-events: none;
    }

    .logo-container {
      position: absolute;
      top: 30px;
      left: 30px;
      z-index: 10;
      width: 70px;
      height: 70px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .logo-background {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: white;
      border-radius: 50%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: -1;
    }

    .logo-small {
      width: 60px;
      height: 60px;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
      animation: pulse 3s ease-in-out infinite;
    }

    .background-pattern {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 200px;
      height: 200px;
      opacity: 0.1;
      z-index: 1;
      animation: float 15s ease-in-out infinite reverse;
    }

    .welcome-content {
      position: relative;
      z-index: 2;
      color: white;
    }

    .welcome-content h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      animation: fadeIn 1s ease-out 0.3s both;
    }

    .welcome-content p {
      font-size: 1.1rem;
      font-weight: 300;
      opacity: 0.9;
      animation: fadeIn 1s ease-out 0.6s both;
    }

    .decorative-elements {
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .circle {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      animation: float 10s ease-in-out infinite;
    }

    .circle-1 {
      width: 100px;
      height: 100px;
      top: 10%;
      right: 10%;
      animation-delay: 0s;
    }

    .circle-2 {
      width: 60px;
      height: 60px;
      bottom: 20%;
      left: 15%;
      animation-delay: 2s;
    }

    .circle-3 {
      width: 80px;
      height: 80px;
      top: 60%;
      right: 20%;
      animation-delay: 4s;
    }

    .right-panel {
      flex: 1;
      padding: 4rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }

    .login-header {
      margin-bottom: 2.5rem;
      animation: slideIn 0.8s ease-out 0.4s both;
    }

    .login-header h2 {
      font-size: 2rem;
      font-weight: 600;
      color: #0c8b00;
      margin-bottom: 0.5rem;
    }

    .login-header p {
      color: #666;
      font-size: 1rem;
      font-weight: 300;
    }

    .form-container {
      animation: slideIn 0.8s ease-out 0.6s both;
    }

    .input-group {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .password-group {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #666;
      padding: 0.5rem;
      border-radius: 50%;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .password-toggle:hover {
      background: rgba(161, 46, 46, 0.1);
      color: #a12e2e;
    }

    .eye-icon {
      transition: all 0.3s ease;
    }

    .password-toggle:hover .eye-icon {
      transform: scale(1.1);
    }

    .input-group input {
      width: 100%;
      padding: 1rem 1.2rem;
      border: 2px solid #e1e1e1;
      border-radius: 12px;
      font-size: 1rem;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }

    .input-group input:focus {
      outline: none;
      border-color: #0c8b00 !important;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(12, 139, 0, 0.15) !important;
    }

    .input-group input::placeholder {
      color: #999;
      font-weight: 300;
    }

    /* Styling untuk flash message - ukuran normal */
    .error-message {
      font-size: 0.9rem !important;
      font-weight: 400;
      line-height: 1.4;
      padding: 1rem !important;
      border-radius: 12px !important;
      background-color: rgba(220, 53, 69, 0.1) !important;
      color: #b02a37 !important;
      border: 1px solid rgba(220, 53, 69, 0.3) !important;
      max-width: 100% !important;
      width: 100% !important;
      margin: 0 auto 1.5rem auto !important;
      display: block;
      text-align: center !important;
      animation: fadeIn 0.3s ease-in-out !important;
    }

    /* TAMBAHKAN STYLE BARU INI */
    .success-message {
      font-size: 0.9rem !important;
      font-weight: 400;
      line-height: 1.4;
      padding: 1rem !important;
      border-radius: 12px !important;
      background-color: rgba(12, 139, 0, 0.1) !important;
      color: #0c8b00 !important;
      border: 1px solid rgba(12, 139, 0, 0.3) !important;
      width: 100% !important;
      margin: 0 auto 1.5rem auto !important;
      display: block;
      text-align: center !important;
      animation: fadeIn 0.3s ease-in-out !important;
    }


    /* SUPER IMPORTANT: Form validation error styling - RESPONSIF */
    .form-validation-error,
    div.form-validation-error,
    .input-group .form-validation-error,
    .form-container .form-validation-error,
    .right-panel .form-validation-error,
    .container .form-validation-error,
    body .form-validation-error,
    html .form-validation-error {
      all: unset !important;
      font-family: 'Poppins', sans-serif !important;
      font-size: 12px !important;
      font-weight: 400 !important;
      color: #dc3545 !important;
      background: none !important;
      border: none !important;
      padding: 2px 0 !important;
      margin: 4px 0 0 5px !important;
      display: block !important;
      line-height: 1.2 !important;
      text-align: left !important;
      width: auto !important;
      max-width: none !important;
      box-shadow: none !important;
      border-radius: 0 !important;
      backdrop-filter: none !important;
      transform: none !important;
      animation: none !important;
      position: static !important;
    }

    /* Override Bootstrap alert classes if they exist */
    .alert-danger.form-validation-error,
    .alert.form-validation-error,
    div.alert-danger.form-validation-error,
    div.alert.form-validation-error {
      all: unset !important;
      font-family: 'Poppins', sans-serif !important;
      font-size: 12px !important;
      font-weight: 400 !important;
      color: #dc3545 !important;
      background: none !important;
      border: none !important;
      padding: 2px 0 !important;
      margin: 4px 0 0 5px !important;
      display: block !important;
      line-height: 1.2 !important;
      text-align: left !important;
      width: auto !important;
      max-width: none !important;
      box-shadow: none !important;
      border-radius: 0 !important;
      backdrop-filter: none !important;
      transform: none !important;
      animation: none !important;
      position: static !important;
    }

    .button-group {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .btn {
      padding: 1rem 2rem;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn-login {
      background: linear-gradient(135deg, #0c8b00 0%, #0a7a00 100%) !important;
      color: #2c2c2c;
      box-shadow: 0 4px 15px rgba(254, 255, 254, 0.3) !important;
    }

    .btn-login:hover {
      color: #e1e1e1;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 255, 255, 0.4) !important;
    }

    .btn-signup {
      background: linear-gradient(135deg, #e2b775 0%, #d0a954 100%);
      color: #2c2c2c;
      box-shadow: 0 4px 15px rgba(226, 183, 117, 0.3);
    }

    .btn-signup:hover {
      transform: translateY(-2px);
      color: #e1e1e1;
      box-shadow: 0 8px 25px rgba(226, 183, 117, 0.4);
    }

    .forgot-password {
      text-align: center;
      animation: fadeIn 1s ease-out 0.8s both;
    }

    .forgot-password a {
      color: #0c8b00 !important;
      text-decoration: none;
      font-weight: 400;
      transition: color 0.3s ease;
      position: relative;
    }

    .forgot-password a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: #0c8b00;
      transition: width 0.3s ease;
    }

    .forgot-password a:hover::after {
      width: 100%;
    }

    .forgot-password a:hover {
      color: #0c8b00;
    }

    .flash-message {
      width: 100% !important;
      padding: 1.2rem !important;
      margin-bottom: 1.5rem !important;
      border-radius: 12px !important;
      animation: fadeIn 0.5s ease-out !important;
      text-align: center !important;
      font-size: 0.9rem !important;
      font-weight: 400 !important;
      line-height: 1.4 !important;
    }

    /* WARNA UNTUK SUKSES */
    .flash-message.success,
    .success-message {
      background: rgba(12, 139, 0, 0.15) !important;
      border: 1px solid rgba(12, 139, 0, 0.3) !important;
      color: #0c8b00 !important;
    }

    /* WARNA UNTUK ERROR */
    .flash-message.error,
    .error-message {
      background: rgba(220, 53, 69, 0.15) !important;
      border: 1px solid rgba(220, 53, 69, 0.3) !important;
      color: #b02a37 !important;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        margin: 1rem;
        max-width: none;
      }

      .left-panel {
        padding: 3rem 2rem 4rem;
        /* Menambah padding bottom */
        min-height: 250px;
        /* Menambah tinggi minimum */
      }

      .welcome-content {
        margin-top: 30px;
        /* Memberi jarak dari atas */
        margin-bottom: 20px;
        /* Memberi jarak dari bawah */
      }

      .logo-container {
        top: 20px;
        left: 20px;
        position: static;
        margin-bottom: 2rem;
      }

      .welcome-content h1 {
        font-size: 2rem;
      }

      .welcome-content p {
        font-size: 1rem;
      }

      .right-panel {
        padding: 3rem 2rem;
      }

      .login-header h2 {
        font-size: 1.5rem;
      }

      .button-group {
        flex-direction: column;
      }

      /* Validation error styling for tablet */
      .form-validation-error,
      div.form-validation-error,
      .input-group .form-validation-error,
      .form-container .form-validation-error,
      .right-panel .form-validation-error,
      .container .form-validation-error,
      body .form-validation-error,
      html .form-validation-error {
        font-size: 13px !important;
        padding: 3px 0 !important;
        margin: 5px 0 0 8px !important;
      }

      .alert-danger.form-validation-error,
      .alert.form-validation-error,
      div.alert-danger.form-validation-error,
      div.alert.form-validation-error {
        font-size: 13px !important;
        padding: 3px 0 !important;
        margin: 5px 0 0 8px !important;
      }
    }

    @media (max-width: 480px) {
      .container {
        margin: 0.5rem;
      }

      .left-panel,
      .right-panel {
        padding: 2rem 1.5rem 3rem;
        /* Padding lebih besar di bagian bawah */
        min-height: 220px;
      }

      .welcome-content h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
      }

      .welcome-content p {
        font-size: 1rem;
      }

      /* Validation error styling for mobile */
      .form-validation-error,
      div.form-validation-error,
      .input-group .form-validation-error,
      .form-container .form-validation-error,
      .right-panel .form-validation-error,
      .container .form-validation-error,
      body .form-validation-error,
      html .form-validation-error {
        font-size: 14px !important;
        padding: 4px 0 !important;
        margin: 6px 0 0 10px !important;
        line-height: 1.3 !important;
      }

      .alert-danger.form-validation-error,
      .alert.form-validation-error,
      div.alert-danger.form-validation-error,
      div.alert.form-validation-error {
        font-size: 14px !important;
        padding: 4px 0 !important;
        margin: 6px 0 0 10px !important;
        line-height: 1.3 !important;
      }

      /* Input styling for mobile */
      .input-group input {
        padding: 1.2rem 1rem;
        font-size: 16px;
        /* Prevent zoom on iOS */
      }

      .login-header h2 {
        font-size: 1.3rem;
      }

      .login-header p {
        font-size: 0.9rem;
      }

      .btn {
        padding: 1.2rem 2rem;
        font-size: 1rem;
      }
    }

    /* Auto-layout enhancements - Tidak mengubah kode yang ada */
    @media (max-width: 1024px) {
      .container {
        flex-direction: column;
        max-height: 90vh;
        overflow-y: auto;
      }

      .left-panel,
      .right-panel {
        flex: none;
        width: 100%;
      }

      .left-panel {
        padding: 2rem;
        min-height: 200px;
      }

      .right-panel {
        padding: 2rem;
      }

      .logo-container {
        position: absolute;
        top: 20px;
        left: 20px;
      }

      .welcome-content h1 {
        font-size: 2rem;
        margin-top: 40px;
      }
    }

    @media (max-width: 640px) {
      .container {
        border-radius: 16px;
      }

      .left-panel,
      .right-panel {
        padding: 1.5rem;
      }

      .welcome-content h1 {
        font-size: 1.8rem;
      }

      .login-header h2 {
        font-size: 1.5rem;
      }

      .btn {
        padding: 0.8rem 1.5rem;
      }
    }

    @media (max-width: 400px) {
      .container {
        margin: 0.5rem;
        width: 100%;
      }

      .welcome-content h1 {
        font-size: 1.5rem;
      }

      .welcome-content p {
        font-size: 0.9rem;
      }

      .input-group input {
        padding: 0.8rem;
      }
    }

    /* Auto-height adjustment for very tall content */
    @media (min-height: 800px) {
      .container {
        min-height: auto;
        height: auto;
      }
    }

    /* Landscape orientation adjustments */
    @media (max-width: 768px) and (orientation: landscape) {
      .container {
        max-height: 80vh;
        overflow-y: auto;
      }

      .left-panel {
        min-height: 180px;
        padding-bottom: 2rem;
      }
    }

    @media (max-width: 768px) and (max-height: 600px) {
      .left-panel {
        padding: 2rem 1.5rem;
        min-height: auto;
      }

      .welcome-content h1 {
        font-size: 1.5rem;
        margin-top: 10px;
      }

      .welcome-content p {
        font-size: 0.9rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="left-panel">
      <div class="decorative-elements">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
      </div>

      <div class="logo-container">
        <div class="logo-background"></div>
        <img src="<?= base_url('assets/img/logo/nahdlatul_ulama_logo.svg') ?>" alt="Logo NU" class="logo-small" />
      </div>

      <div class="background-pattern">
        <img src="<?= base_url('assets/img/background-welcome.png') ?>" alt="Background Welcome" style="width: 100%; height: 100%; object-fit: contain;" />
      </div>

      <div class="welcome-content">
        <h1>Selamat Datang di SIMNU</h1>
        <p>Relawan Santri NU Banten</p>
      </div>
    </div>

    <div class="right-panel">
      <div class="login-header">
        <h2>Login SIMNU</h2>
        <p>Silakan masuk untuk melanjutkan</p>
      </div>

      <div class="form-container">
        <?php if ($this->session->flashdata('message')): ?>
          <div class="flash-message <?= strpos($this->session->flashdata('message'), 'success') !== false ? 'success' : 'error' ?>">
            <?= $this->session->flashdata('message') ?>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="flash-message error">
            <?= $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('auth') ?>">
          <div class="input-group">
            <input type="text" name="login" placeholder="Email atau Username" value="<?= set_value('login'); ?>" required>
            <?= form_error('login', '<div class="form-validation-error">', '</div>'); ?>
          </div>

          <div class="input-group password-group">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="button" class="password-toggle" onclick="togglePassword()">
              <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path class="eye-open" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle class="eye-open" cx="12" cy="12" r="3"></circle>
                <path class="eye-closed" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" style="display: none;"></path>
                <line class="eye-closed" x1="1" y1="1" x2="23" y2="23" style="display: none;"></line>
              </svg>
            </button>
            <?= form_error('password', '<div class="form-validation-error">', '</div>'); ?>
          </div>

          <div class="button-group">
            <button type="submit" class="btn btn-login">Login</button>
            <button type="button" class="btn btn-signup" onclick="location.href='<?= base_url('auth/registration') ?>'">Sign Up</button>
          </div>
        </form>

        <div class="forgot-password">
          <a href="<?= base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Password toggle functionality
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeOpen = document.querySelectorAll('.eye-open');
      const eyeClosed = document.querySelectorAll('.eye-closed');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.forEach(el => el.style.display = 'none');
        eyeClosed.forEach(el => el.style.display = 'block');
      } else {
        passwordInput.type = 'password';
        eyeOpen.forEach(el => el.style.display = 'block');
        eyeClosed.forEach(el => el.style.display = 'none');
      }
    }

    // Add smooth interactions
    document.querySelectorAll('.btn').forEach(button => {
      button.addEventListener('click', function(e) {
        let ripple = document.createElement('span');
        ripple.classList.add('ripple');
        this.appendChild(ripple);

        setTimeout(() => {
          ripple.remove();
        }, 300);
      });
    });

    // Form validation enhancement
    document.querySelectorAll('input').forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value.trim() === '') {
          this.style.borderColor = '#dc3545';
        } else {
          this.style.borderColor = '#28a745';
        }
      });

      input.addEventListener('focus', function() {
        this.style.borderColor = '#a12e2e';
      });
    });

    // Loading state for login button
    document.querySelector('form').addEventListener('submit', function(e) {
      const loginBtn = document.querySelector('.btn-login');
      loginBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⟳</span> Masuk...';
      loginBtn.disabled = true;
    });

    // Enhanced fix for validation error styling
    document.addEventListener('DOMContentLoaded', function() {
      // Enhanced fix for validation error styling with responsive support
      function forceFixValidationErrors() {
        // Find all possible validation error elements
        const selectors = [
          '.form-validation-error',
          'div.form-validation-error',
          '[class*="form-validation-error"]',
          '.alert-danger',
          '.alert',
          'div[class*="alert"]'
        ];

        selectors.forEach(selector => {
          const elements = document.querySelectorAll(selector);
          elements.forEach(function(el) {
            // Check if this is actually a validation error (not flash message)
            if (el.closest('.input-group') || el.textContent.length < 100) {
              // Get screen width for responsive sizing
              const screenWidth = window.innerWidth;
              let fontSize, padding, margin;

              if (screenWidth <= 480) {
                // Mobile
                fontSize = '14px';
                padding = '4px 0';
                margin = '6px 0 0 10px';
              } else if (screenWidth <= 768) {
                // Tablet
                fontSize = '13px';
                padding = '3px 0';
                margin = '5px 0 0 8px';
              } else {
                // Desktop
                fontSize = '12px';
                padding = '2px 0';
                margin = '4px 0 0 5px';
              }

              // Apply responsive styling
              const styles = {
                'all': 'unset',
                'font-family': "'Poppins', sans-serif",
                'font-size': fontSize,
                'font-weight': '400',
                'background': 'none',
                'border': 'none',
                'padding': padding,
                'margin': margin,
                'display': 'block',
                'line-height': screenWidth <= 480 ? '1.3' : '1.2',
                'text-align': 'left',
                'width': 'auto',
                'max-width': 'none',
                'box-shadow': 'none',
                'border-radius': '0',
                'backdrop-filter': 'none',
                'transform': 'none',
                'animation': 'none',
                'position': 'static'
              };

              Object.keys(styles).forEach(prop => {
                el.style.setProperty(prop, styles[prop], 'important');
              });
            }
          });
        });
      }

      // Run immediately
      forceFixValidationErrors();

      // Run after a small delay to catch dynamically added elements
      setTimeout(forceFixValidationErrors, 100);

      // Watch for changes in the DOM
      const observer = new MutationObserver(function(mutations) {
        let shouldCheck = false;
        mutations.forEach(function(mutation) {
          if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
            shouldCheck = true;
          }
        });
        if (shouldCheck) {
          setTimeout(forceFixValidationErrors, 10);
        }
      });

      observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['class']
      });

      // Re-apply styles on window resize for responsive behavior
      window.addEventListener('resize', function() {
        setTimeout(forceFixValidationErrors, 100);
      });
    });
  </script>

  <style>
    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .ripple {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.6);
      transform: scale(0);
      animation: ripple-animation 0.3s linear;
      pointer-events: none;
    }

    @keyframes ripple-animation {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
  </style>
</body>

</html>