<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registration SIMNU</title>
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
      padding: 1rem 0;
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
      transform: translate3d(0, 0, 0);
      /* Hardware acceleration */
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
      animation: slideIn 0.8s ease-out forwards;
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
      padding: 3rem 2.5rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      max-height: 90vh;
      overflow-y: auto;
      will-change: transform;
      /* Optimize for hardware acceleration */
      backface-visibility: hidden;
      /* Improve rendering performance */
    }

    /* Custom scrollbar */
    .right-panel::-webkit-scrollbar {
      width: 6px;
    }

    .right-panel::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .right-panel::-webkit-scrollbar-thumb {
      background: rgba(161, 46, 46, 0.3);
      border-radius: 10px;
    }

    .right-panel::-webkit-scrollbar-thumb:hover {
      background: rgba(161, 46, 46, 0.5);
    }

    .registration-header {
      margin-bottom: 2rem;
      animation: slideIn 0.8s ease-out 0.4s both;
    }

    .registration-header h2 {
      font-size: 2rem;
      font-weight: 600;
      color: #0c8b00;
      margin-bottom: 0.5rem;
    }

    .registration-header p {
      color: #666;
      font-size: 1rem;
      font-weight: 300;
    }

    .form-container {
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
      padding: 0 13px;
      /* Memberi ruang di sisi kiri dan kanan */
      box-sizing: border-box;
      animation: slideIn 0.8s ease-out 0.6s both;
    }

    .form-row {
      display: flex;
      gap: 15px;
      margin-bottom: 1rem;
      align-items: flex-start;
      width: 100%;
      box-sizing: border-box;
    }

    .form-row .input-group {
      flex: 1;
    }

    .input-group {
      position: relative;
      margin-bottom: 1rem;
    }

    .password-group {
      position: relative;
      display: flex;
      align-items: center;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #666;
      padding: 0;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 !important;
    }

    .password-toggle:hover {
      background: rgba(161, 46, 46, 0.1);
      color: #a12e2e;
    }

    /* Perbaikan khusus untuk eye icon */
    .eye-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) !important;
      width: 20px;
      height: 20px;
      transition: all 0.3s ease;
    }

    .password-toggle:hover .eye-icon {
      transform: scale(1.1);
    }

    .input-group input {
      width: 100%;
      padding: 12px 40px 12px 16px;
      /* Tambah padding kanan untuk icon mata */
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      background: #fff;
      line-height: 1.5;
      box-sizing: border-box;
    }

    .input-group input::placeholder {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
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

    .error-message {
      color: #dc3545;
      font-size: 0.85rem;
      margin-top: 0.25rem;
      padding-left: 5px;
      line-height: 1.3;
      font-weight: 400;
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

    .btn-register {
      background: linear-gradient(135deg, #0c8b00 0%, #0a7a00 100%) !important;
      color: #2c2c2c;
      box-shadow: 0 4px 15px rgba(161, 46, 46, 0.3);
    }

    .btn-register:hover {
      color: #e1e1e1;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(161, 46, 46, 0.4);
    }

    .btn-login {
      background: linear-gradient(135deg, #e2b775 0%, #d0a954 100%);
      color: #2c2c2c;
      box-shadow: 0 4px 15px rgba(226, 183, 117, 0.3);
    }

    .btn-login:hover {
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
      color: #a12e2e;
    }

    /* Flash message styling */
    .flash-message {
      margin-bottom: 1.5rem;
      padding: 1rem;
      border-radius: 8px;
      animation: slideIn 0.5s ease-out;
    }

    .flash-message.success {
      background: rgba(40, 167, 69, 0.1);
      border: 1px solid rgba(40, 167, 69, 0.3);
      color: #155724;
    }

    .flash-message.error {
      background: rgba(220, 53, 69, 0.1);
      border: 1px solid rgba(220, 53, 69, 0.3);
      color: #721c24;
    }

    @media (max-width: 768px) {
      body {
        padding: 0.5rem;
      }

      .container {
        flex-direction: column;
        margin: 0;
        max-width: none;
        width: 100%;
        min-height: 100vh;
      }

      .left-panel {
        padding: 3rem 2rem 4rem;
        min-height: 300px;
      }

      .logo-container {
        top: 20px;
        left: 20px;
        position: static;
        margin-bottom: 2rem;
      }

      .welcome-content {
        margin-top: 30px;
        /* Memberi jarak dari atas */
        margin-bottom: 20px;
        /* Memberi jarak dari bawah */
      }

      .welcome-content h1 {
        font-size: 2rem;
      }

      .welcome-content p {
        font-size: 1rem;
      }

      .right-panel {
        padding: 3rem 2rem;
        max-height: none;
      }

      .registration-header h2 {
        font-size: 1.5rem;
      }

      .form-row {
        flex-direction: column;
        gap: 0;
      }

      .button-group {
        flex-direction: column;
      }

      .input-group input {
        padding: 10px 36px 10px 12px;
      }

    }

    @media (max-width: 480px) {
      .container {
        margin: 0;
        border-radius: 0;
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

    /* Fix untuk tampilan 100% - tidak mengubah kode yang ada */
    @media (min-width: 1025px) {
      .right-panel {
        max-height: 85vh;
        padding-top: 2rem;
        padding-bottom: 2rem;
      }

      .form-container {
        max-height: calc(85vh - 150px);
        overflow-y: auto;
        padding-right: 0.5rem;
      }

      .form-container::-webkit-scrollbar {
        width: 4px;
      }

      .form-container::-webkit-scrollbar-thumb {
        background: rgba(161, 46, 46, 0.3);
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
      <div class="registration-header">
        <h2>Registrasi Akun</h2>
        <p>Silakan isi form untuk membuat akun</p>
      </div>

      <div class="form-container">
        <?php if ($this->session->flashdata('message')): ?>
          <div class="flash-message <?= strpos($this->session->flashdata('message'), 'success') !== false ? 'success' : 'error' ?>">
            <?= $this->session->flashdata('message') ?>
          </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('auth/registration') ?>">
          <div class="input-group">
            <input type="text" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>" required>
            <?= form_error('name', '<div class="error-message">', '</div>'); ?>
          </div>

          <div class="form-row">
            <div class="input-group">
              <input type="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>" required>
              <?= form_error('email', '<div class="error-message">', '</div>'); ?>
            </div>
            <div class="input-group">
              <input type="text" name="username" placeholder="Username" value="<?= set_value('username') ?>" required>
              <?= form_error('username', '<div class="error-message">', '</div>'); ?>
            </div>
          </div>

          <div class="input-group">
            <input type="tel" name="no_telepon" placeholder="Nomor Telepon" value="<?= set_value('no_telepon') ?>" required>
            <?= form_error('no_telepon', '<div class="error-message">', '</div>'); ?>
          </div>

          <div class="form-row">
            <div class="input-group password-group">
              <input type="password" name="password1" id="password1" placeholder="Password" required>
              <button type="button" class="password-toggle" onclick="togglePassword('password1')">
                <svg class="eye-icon" width="20" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path class="eye-open" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle class="eye-open" cx="12" cy="12" r="3"></circle>
                  <path class="eye-closed" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" style="display: none;"></path>
                  <line class="eye-closed" x1="1" y1="1" x2="23" y2="23" style="display: none;"></line>
                </svg>
              </button>
              <?= form_error('password1', '<div class="error-message">', '</div>'); ?>
            </div>
            <div class="input-group password-group">
              <input type="password" name="password2" id="password2" placeholder="Ulangi Password" required>
              <button type="button" class="password-toggle" onclick="togglePassword('password2')">
                <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path class="eye-open" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle class="eye-open" cx="12" cy="12" r="3"></circle>
                  <path class="eye-closed" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" style="display: none;"></path>
                  <line class="eye-closed" x1="1" y1="1" x2="23" y2="23" style="display: none;"></line>
                </svg>
              </button>
            </div>
          </div>

          <div class="button-group">
            <button type="submit" class="btn btn-register">Daftar Akun</button>
            <button type="button" class="btn btn-login" onclick="location.href='<?= base_url('auth') ?>'">Sudah punya akun? Login!</button>
          </div>
        </form>

        <div class="forgot-password">
          <a href="<?= base_url('auth/forgotpassword') ?>">Lupa Password?</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Password toggle functionality
    function togglePassword(inputId) {
      const passwordInput = document.getElementById(inputId);
      const button = passwordInput.nextElementSibling;
      const eyeOpen = button.querySelectorAll('.eye-open');
      const eyeClosed = button.querySelectorAll('.eye-closed');

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

    // Password confirmation validation
    document.getElementById('password2').addEventListener('input', function() {
      const password1 = document.getElementById('password1').value;
      const password2 = this.value;

      if (password2 && password1 !== password2) {
        this.style.borderColor = '#dc3545';
      } else if (password2) {
        this.style.borderColor = '#28a745';
      }
    });

    // Loading state for register button
    document.querySelector('form').addEventListener('submit', function(e) {
      const registerBtn = document.querySelector('.btn-register');
      registerBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⟳</span> Mendaftar...';
      registerBtn.disabled = true;
    });

    // Auto-adjust untuk layar besar
    document.addEventListener('DOMContentLoaded', function() {
      function adjustFormHeight() {
        if (window.innerWidth >= 1025) {
          const rightPanel = document.querySelector('.right-panel');
          const headerHeight = document.querySelector('.registration-header').offsetHeight;
          const availableHeight = window.innerHeight * 0.85 - headerHeight - 50;

          document.querySelector('.form-container').style.maxHeight = `${availableHeight}px`;
        }
      }

      adjustFormHeight();
      window.addEventListener('resize', adjustFormHeight);
    });

    // Perbaikan posisi icon mata
    function adjustEyeIcons() {
      document.querySelectorAll('.eye-icon').forEach(icon => {
        icon.style.position = 'absolute';
        icon.style.top = '50%';
        icon.style.left = '50%';
        icon.style.transform = 'translate(-50%, -50%)';
      });
    }

    // Panggil saat halaman dimuat dan diresize
    window.addEventListener('load', adjustEyeIcons);
    window.addEventListener('resize', adjustEyeIcons);
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