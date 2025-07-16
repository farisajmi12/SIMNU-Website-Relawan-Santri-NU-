<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lupa Password - SIMNU</title>
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
      padding: 20px;
      /* Tambahkan padding untuk mobile */
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
      /* Diperkecil dari 1200px */
      min-height: auto;
      /* Diubah dari height tetap */
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
      padding: 3rem 2rem;
      /* Diperkecil */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      overflow: hidden;
      min-height: 400px;
      /* Ditambahkan untuk konsistensi tinggi */
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
      width: 150px;
      /* Diperkecil */
      height: 150px;
      /* Diperkecil */
      opacity: 0.1;
      z-index: 1;
      animation: float 15s ease-in-out infinite reverse;
    }

    .welcome-content {
      position: relative;
      z-index: 2;
      color: white;
      padding: 0 1rem;
      /* Ditambahkan untuk spacing di mobile */
    }

    .welcome-content h1 {
      font-size: 2rem;
      /* Diperkecil */
      font-weight: 700;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      animation: fadeIn 1s ease-out 0.3s both;
    }

    .welcome-content p {
      font-size: 1rem;
      /* Diperkecil */
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
      width: 80px;
      /* Diperkecil */
      height: 80px;
      /* Diperkecil */
      top: 10%;
      right: 10%;
      animation-delay: 0s;
    }

    .circle-2 {
      width: 50px;
      /* Diperkecil */
      height: 50px;
      /* Diperkecil */
      bottom: 20%;
      left: 15%;
      animation-delay: 2s;
    }

    .circle-3 {
      width: 60px;
      /* Diperkecil */
      height: 60px;
      /* Diperkecil */
      top: 60%;
      right: 20%;
      animation-delay: 4s;
    }

    .right-panel {
      flex: 1;
      padding: 3rem 2rem;
      /* Diperkecil */
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }

    .forgot-header {
      margin-bottom: 2rem;
      /* Diperkecil */
      animation: slideIn 0.8s ease-out 0.4s both;
    }

    .forgot-header h2 {
      font-size: 1.8rem;
      /* Diperkecil */
      font-weight: 600;
      color: #0c8b00;
      margin-bottom: 0.5rem;
    }

    .forgot-header p {
      color: #666;
      font-size: 0.9rem;
      /* Diperkecil */
      font-weight: 300;
      line-height: 1.5;
    }

    .form-container {
      animation: slideIn 0.8s ease-out 0.6s both;
    }

    .input-group {
      position: relative;
      margin-bottom: 1.2rem;
      /* Diperkecil */
    }

    .input-group input {
      width: 100%;
      padding: 0.9rem 1.1rem;
      /* Diperkecil */
      border: 2px solid #e1e1e1;
      border-radius: 12px;
      font-size: 0.95rem;
      /* Diperkecil */
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }

    .input-group input:focus {
      outline: none;
      border-color: #a12e2e;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(161, 46, 46, 0.15);
    }

    .input-group input::placeholder {
      color: #999;
      font-weight: 300;
    }

    .error-message {
      color: #dc3545;
      font-size: 0.8rem;
      /* Diperkecil */
      margin-top: 0.4rem;
      /* Diperkecil */
      font-weight: 400;
    }

    .button-group {
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      /* Diperkecil */
      margin-bottom: 1.5rem;
      /* Diperkecil */
    }

    .btn {
      padding: 0.9rem 1.8rem;
      /* Diperkecil */
      border: none;
      border-radius: 12px;
      font-size: 0.95rem;
      /* Diperkecil */
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      text-decoration: none;
      display: inline-block;
      text-align: center;
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

    .btn-reset {
      background: linear-gradient(135deg, #0c8b00 0%, #0a7a00 100%) !important;
      color: #2c2c2c;
      box-shadow: 0 4px 15px rgba(161, 46, 46, 0.3);
    }

    .btn-reset:hover {
      transform: translateY(-2px);
      color: white;
      box-shadow: 0 8px 25px rgba(161, 46, 46, 0.4);
    }

    .btn-back {
      background: linear-gradient(135deg, #e2b775 0%, #d0a954 100%);
      color: #2c2c2c;
      box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }

    .btn-back:hover {
      transform: translateY(-2px);
      color: white;
      box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
    }

    .info-box {
      background: rgba(161, 46, 46, 0.1);
      border: 1px solid rgba(161, 46, 46, 0.2);
      border-radius: 12px;
      padding: 1.2rem;
      /* Diperkecil */
      margin-bottom: 1.5rem;
      /* Diperkecil */
      animation: fadeIn 1s ease-out 0.8s both;
    }

    .info-box .icon {
      font-size: 1.8rem;
      /* Diperkecil */
      color: #a12e2e;
      margin-bottom: 0.8rem;
      /* Diperkecil */
      display: block;
      text-align: center;
    }

    .info-box h3 {
      color: #801e1e;
      font-size: 1rem;
      /* Diperkecil */
      font-weight: 600;
      margin-bottom: 0.4rem;
      /* Diperkecil */
      text-align: center;
    }

    .info-box p {
      color: #666;
      font-size: 0.85rem;
      /* Diperkecil */
      line-height: 1.5;
      text-align: center;
    }

    /* Flash message styling */
    .flash-message {
      margin-bottom: 1.2rem;
      /* Diperkecil */
      padding: 0.9rem;
      /* Diperkecil */
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
        padding: 15px;
      }

      .container {
        flex-direction: column;
        max-width: 500px;
        /* Lebih kecil di mobile */
      }

      .left-panel {
        padding: 3rem 2rem 4rem;
        min-height: 300px;
      }

      .logo-container {
        top: 20px;
        left: 20px;
        position: static;
        margin-bottom: 1.5rem;
      }

      .welcome-content {
        margin-top: 30px;
        /* Memberi jarak dari atas */
        margin-bottom: 20px;
        /* Memberi jarak dari bawah */
      }

      .welcome-content h1 {
        font-size: 1.8rem;
      }

      .welcome-content p {
        font-size: 0.95rem;
      }

      .right-panel {
        padding: 2.5rem 1.5rem;
      }

      .forgot-header h2 {
        font-size: 1.5rem;
      }

      .button-group {
        flex-direction: column;
      }
    }

    @media (max-width: 480px) {
      .container {
        margin: 0;
        width: 100%;
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

      .btn {
        padding: 0.8rem 1.5rem;
        font-size: 0.9rem;
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
        padding: 1.5rem;
        /* Diperkecil dari 2rem */
        min-height: 180px;
        /* Diperkecil dari 200px */
      }

      .right-panel {
        padding: 1.5rem;
        /* Diperkecil dari 2rem */
      }

      .logo-container {
        position: absolute;
        top: 15px;
        /* Diperkecil dari 20px */
        left: 15px;
        /* Diperkecil dari 20px */
      }

      .welcome-content h1 {
        font-size: 1.6rem;
        /* Diperkecil dari 2rem */
        margin-top: 30px;
        /* Diperkecil dari 40px */
      }
    }

    @media (max-width: 640px) {
      .container {
        border-radius: 14px;
        /* Diperkecil dari 16px */
      }

      .left-panel,
      .right-panel {
        padding: 1.2rem;
        /* Diperkecil dari 1.5rem */
      }

      .welcome-content h1 {
        font-size: 1.4rem;
        /* Diperkecil dari 1.8rem */
      }

      .login-header h2 {
        font-size: 1.2rem;
        /* Diperkecil dari 1.5rem */
      }

      .btn {
        padding: 0.7rem 1.2rem;
        /* Diperkecil dari 0.8rem 1.5rem */
      }
    }

    @media (max-width: 400px) {
      .container {
        margin: 0.5rem;
        width: 100%;
      }

      .welcome-content h1 {
        font-size: 1.3rem;
        /* Diperkecil dari 1.5rem */
      }

      .welcome-content p {
        font-size: 0.8rem;
        /* Diperkecil dari 0.9rem */
      }

      .input-group input {
        padding: 0.7rem;
        /* Diperkecil dari 0.8rem */
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

    /* Ukuran lebih kecil - Mobile Extreme */
    @media (max-width: 360px) {
      .container {
        border-radius: 10px;
        margin: 0.3rem;
      }

      .left-panel,
      .right-panel {
        padding: 1rem 0.8rem;
      }

      .logo-small {
        width: 40px;
        height: 40px;
      }

      .welcome-content h1 {
        font-size: 1.2rem;
        margin-top: 20px;
      }

      .welcome-content p {
        font-size: 0.7rem;
      }

      .reset-header h2 {
        font-size: 1.1rem;
      }

      .reset-header p {
        font-size: 0.7rem;
      }

      .security-info {
        padding: 0.6rem;
      }

      .security-info h4 {
        font-size: 0.7rem;
      }

      .security-info ul {
        font-size: 0.65rem;
      }

      .input-group input {
        padding: 0.6rem;
        font-size: 0.8rem;
      }

      .btn {
        padding: 0.6rem 1rem;
        font-size: 0.8rem;
      }

      .password-toggle {
        width: 28px;
        height: 28px;
        top: 18px;
      }

      .eye-icon {
        width: 16px;
        height: 16px;
      }

      .strength-bar {
        height: 2px;
      }

      .error-message,
      .success-message {
        font-size: 0.65rem;
      }
    }

    /* Penyesuaian spacing untuk layar sangat kecil */
    @media (max-width: 320px) {
      .container {
        margin: 0.2rem;
      }

      .left-panel {
        min-height: 100px;
      }

      .button-group {
        gap: 0.5rem;
      }

      .back-to-login a {
        font-size: 0.7rem;
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
        <h1>Reset Password</h1>
        <p>Pulihkan akses Anda ke SIMNU</p>
      </div>
    </div>

    <div class="right-panel">
      <div class="forgot-header">
        <h2>Lupa Password</h2>
        <p>Masukkan email atau username Anda untuk menerima link reset password</p>
      </div>

      <div class="form-container">
        <?php if ($this->session->flashdata('message')): ?>
          <div class="flash-message <?= strpos($this->session->flashdata('message'), 'success') !== false ? 'success' : 'error' ?>">
            <?= $this->session->flashdata('message') ?>
          </div>
        <?php endif; ?>

        <div class="info-box">
          <span class="icon">🔐</span>
          <h3>Cara Reset Password</h3>
          <p>Setelah Anda memasukkan email/username, kami akan mengirimkan link untuk reset password ke email yang terdaftar.</p>
        </div>

        <form method="post" action="<?= base_url('auth/forgotpassword') ?>">
          <div class="input-group">
            <input type="text" name="login" placeholder="Email atau Username" value="<?= set_value('login'); ?>" required>
            <?= form_error('login', '<div class="error-message">', '</div>'); ?>
          </div>

          <div class="button-group">
            <button type="submit" class="btn btn-reset">Reset Password</button>
            <a href="<?= base_url('auth') ?>" class="btn btn-back">Kembali ke Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Add smooth interactions
    document.querySelectorAll('.btn').forEach(button => {
      button.addEventListener('click', function(e) {
        if (this.tagName === 'BUTTON') {
          let ripple = document.createElement('span');
          ripple.classList.add('ripple');
          this.appendChild(ripple);

          setTimeout(() => {
            ripple.remove();
          }, 300);
        }
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

    // Loading state for reset button
    document.querySelector('form').addEventListener('submit', function(e) {
      const resetBtn = document.querySelector('.btn-reset');
      resetBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⟳</span> Mengirim...';
      resetBtn.disabled = true;
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