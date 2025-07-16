<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password - SIMNU</title>
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
      padding: 1rem;
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
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 18px;
      /* Diperkecil dari 24px */
      overflow: hidden;
      box-shadow:
        0 16px 32px rgba(0, 0, 0, 0.2),
        /* Shadow diperkecil */
        0 0 0 1px rgba(255, 255, 255, 0.2);
      animation: slideIn 0.8s ease-out;
      position: relative;
    }

    .left-panel {
      flex: 1;
      background: linear-gradient(135deg, #0c8b00 0%, #0a7a00 100%) !important;
      position: relative;
      padding: 2rem 1.5rem;
      /* Diperkecil dari 4rem 3rem */
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
      width: 150px;
      /* Diperkecil dari 200px */
      height: 150px;
      /* Diperkecil dari 200px */
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
      font-size: 1.8rem;
      /* Diperkecil dari 2.5rem */
      font-weight: 700;
      margin-bottom: 0.8rem;
      /* Diperkecil dari 1rem */
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      animation: fadeIn 1s ease-out 0.3s both;
    }

    .welcome-content p {
      font-size: 0.9rem;
      /* Diperkecil dari 1.1rem */
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
      /* Diperkecil dari 100px */
      height: 80px;
      /* Diperkecil dari 100px */
      top: 10%;
      right: 10%;
      animation-delay: 0s;
    }

    .circle-2 {
      width: 50px;
      /* Diperkecil dari 60px */
      height: 50px;
      /* Diperkecil dari 60px */
      bottom: 20%;
      left: 15%;
      animation-delay: 2s;
    }

    .circle-3 {
      width: 60px;
      /* Diperkecil dari 80px */
      height: 60px;
      /* Diperkecil dari 80px */
      top: 60%;
      right: 20%;
      animation-delay: 4s;
    }

    .right-panel {
      flex: 1;
      padding: 2rem 1.5rem;
      /* Diperkecil dari 4rem 3rem */
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }

    .reset-header {
      margin-bottom: 1.5rem;
      /* Diperkecil dari 2.5rem */
      animation: slideIn 0.8s ease-out 0.4s both;
      text-align: center;
    }

    .reset-header h2 {
      font-size: 1.5rem;
      /* Diperkecil dari 2rem */
      font-weight: 600;
      color: #0c8b00;
      margin-bottom: 0.3rem;
      /* Diperkecil dari 0.5rem */
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.3rem;
      /* Diperkecil dari 0.5rem */
    }

    .reset-icon {
      font-size: 1.3rem;
      /* Diperkecil dari 1.8rem */
    }

    .reset-header p {
      color: #666;
      font-size: 0.85rem;
      /* Diperkecil dari 1rem */
      font-weight: 300;
      margin-bottom: 0.8rem;
      /* Diperkecil dari 1rem */
    }

    .security-info {
      background: linear-gradient(135deg, rgba(161, 46, 46, 0.05) 0%, rgba(128, 30, 30, 0.05) 100%);
      border: 1px solid rgba(161, 46, 46, 0.1);
      border-radius: 10px;
      /* Diperkecil dari 12px */
      padding: 0.8rem;
      /* Diperkecil dari 1rem */
      margin-bottom: 1rem;
      /* Diperkecil dari 1.5rem */
      animation: slideIn 0.8s ease-out 0.5s both;
    }

    .security-info h4 {
      color: #0c8b00;
      font-size: 0.8rem;
      /* Diperkecil dari 0.9rem */
      font-weight: 600;
      margin-bottom: 0.3rem;
      /* Diperkecil dari 0.5rem */
      display: flex;
      align-items: center;
      gap: 0.3rem;
      /* Diperkecil dari 0.5rem */
    }

    .security-info ul {
      font-size: 0.75rem;
      /* Diperkecil dari 0.85rem */
      color: #666;
      margin-left: 0.8rem;
      /* Diperkecil dari 1rem */
    }

    .security-info li {
      margin-bottom: 0.2rem;
      /* Diperkecil dari 0.3rem */
    }

    .form-container {
      animation: slideIn 0.8s ease-out 0.6s both;
    }

    .input-group {
      position: relative;
      margin-bottom: 1rem;
      /* Diperkecil dari 1.5rem */
    }

    .password-group {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 0.8rem;
      /* Diperkecil dari 1rem */
      top: 22px;
      /* Diperkecil dari 28px */
      bottom: 22px;
      /* Diperkecil dari 28px */
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #666;
      padding: 0.4rem;
      /* Diperkecil dari 0.5rem */
      border-radius: 50%;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10;
      width: 35px;
      /* Diperkecil dari 40px */
      height: 35px;
      /* Diperkecil dari 40px */
    }

    .password-toggle:hover {
      background: rgba(161, 46, 46, 0.1);
      color: #a12e2e;
    }

    .eye-icon {
      transition: all 0.3s ease;
      width: 18px;
      /* Diperkecil dari 20px */
      height: 18px;
      /* Diperkecil dari 20px */
    }

    .password-toggle:hover .eye-icon {
      transform: scale(1.1);
    }

    .input-group input {
      width: 100%;
      padding: 0.8rem 3rem 0.8rem 1rem;
      /* Diperkecil dari 1rem 4rem 1rem 1.2rem */
      border: 2px solid #e1e1e1;
      border-radius: 10px;
      /* Diperkecil dari 12px */
      font-size: 0.9rem;
      /* Diperkecil dari 1rem */
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }

    .input-group input:focus {
      outline: none;
      border-color: #a12e2e;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(161, 46, 46, 0.15);
      /* Diperkecil dari 8px 25px */
    }

    .input-group input::placeholder {
      color: #999;
      font-weight: 300;
      font-size: 0.85rem;
      /* Diperkecil dari default */
    }

    .password-strength {
      margin-top: 0.3rem;
      /* Diperkecil dari 0.5rem */
      font-size: 0.7rem;
      /* Diperkecil dari 0.8rem */
      position: relative;
      z-index: 1;
    }

    .strength-bar {
      width: 100%;
      height: 3px;
      /* Diperkecil dari 4px */
      background: #e1e1e1;
      border-radius: 2px;
      margin: 0.3rem 0;
      /* Diperkecil dari 0.5rem 0 */
      overflow: hidden;
    }

    .strength-fill {
      height: 100%;
      width: 0%;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .strength-weak {
      background: #dc3545;
      width: 25%;
    }

    .strength-fair {
      background: #ffc107;
      width: 50%;
    }

    .strength-good {
      background: #28a745;
      width: 75%;
    }

    .strength-strong {
      background: #007bff;
      width: 100%;
    }

    .error-message {
      color: #dc3545;
      font-size: 0.75rem;
      /* Diperkecil dari 0.85rem */
      margin-top: 0.3rem;
      /* Diperkecil dari 0.5rem */
      font-weight: 400;
    }

    .success-message {
      color: #28a745;
      font-size: 0.75rem;
      /* Diperkecil dari 0.85rem */
      margin-top: 0.3rem;
      /* Diperkecil dari 0.5rem */
      font-weight: 400;
    }

    .button-group {
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      /* Diperkecil dari 1rem */
      margin-bottom: 1.5rem;
      /* Diperkecil dari 2rem */
    }

    .btn {
      padding: 0.8rem 1.5rem;
      /* Diperkecil dari 1rem 2rem */
      border: none;
      border-radius: 10px;
      /* Diperkecil dari 12px */
      font-size: 0.9rem;
      /* Diperkecil dari 1rem */
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

    .btn-reset {
      background: linear-gradient(135deg, #0c8b00 0%, #0a7a00 100%) !important;
      color: #2c2c2c;
      box-shadow: 0 3px 12px rgba(161, 46, 46, 0.3);
      /* Diperkecil dari 4px 15px */
    }

    .btn-reset:hover {
      transform: translateY(-2px);
      color: #e1e1e1;
      box-shadow: 0 6px 20px rgba(161, 46, 46, 0.4);
      /* Diperkecil dari 8px 25px */
    }

    .btn-back {
      background: linear-gradient(135deg, #e2b775 0%, #d0a954 100%);
      color: #2c2c2c;
      box-shadow: 0 3px 12px rgba(108, 117, 125, 0.3);
      /* Diperkecil dari 4px 15px */
    }

    .btn-back:hover {
      transform: translateY(-2px);
      color: #e1e1e1;
      box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
      /* Diperkecil dari 8px 25px */
    }

    .back-to-login {
      text-align: center;
      animation: fadeIn 1s ease-out 0.8s both;
    }

    .back-to-login a {
      color: #0c8b00;
      text-decoration: none;
      font-weight: 400;
      font-size: 0.85rem;
      /* Diperkecil dari default */
      transition: color 0.3s ease;
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      /* Diperkecil dari 0.5rem */
    }

    .back-to-login a::after {
      content: '';
      position: absolute;
      bottom: -1px;
      /* Diperkecil dari -2px */
      left: 0;
      width: 0;
      height: 1px;
      /* Diperkecil dari 2px */
      background: #0c8b00;
      transition: width 0.3s ease;
    }

    .back-to-login a:hover::after {
      width: 100%;
    }

    .back-to-login a:hover {
      color: #0c8b00;
    }

    /* Flash message styling */
    .flash-message {
      margin-bottom: 1rem;
      /* Diperkecil dari 1.5rem */
      padding: 0.8rem;
      /* Diperkecil dari 1rem */
      border-radius: 10px;
      /* Diperkecil dari 12px */
      animation: slideIn 0.5s ease-out;
      display: flex;
      align-items: center;
      gap: 0.3rem;
      /* Diperkecil dari 0.5rem */
      font-size: 0.85rem;
      /* Diperkecil dari default */
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
      .password-toggle {
        right: 0.7rem;
        /* Diperkecil dari 0.8rem */
        width: 30px;
        /* Diperkecil dari 35px */
        height: 30px;
        /* Diperkecil dari 35px */
      }

      .password-group input {
        padding: 0.7rem 3rem 0.7rem 0.8rem;
        /* Diperkecil dari 1rem 3.5rem 1rem 1rem */
      }

      .container {
        flex-direction: column;
        margin: 0.8rem;
        /* Diperkecil dari 1rem */
        max-width: none;
        max-height: 80vh;
        overflow-y: auto;
      }

      .left-panel {
        padding: 3rem 2rem 4rem;
        /* Menambah padding bottom */
        min-height: 250px;
        /* Menambah tinggi minimum */
      }

      .logo-container {
        top: 20px;
        left: 20px;
        position: static;
        margin-bottom: 1.5rem;
        /* Diperkecil dari 2rem */
      }

      .welcome-content h1 {
        font-size: 1.6rem;
        /* Diperkecil dari 2rem */
      }

      .welcome-content {
        margin-top: 30px;
        /* Memberi jarak dari atas */
        margin-bottom: 20px;
        /* Memberi jarak dari bawah */
      }

      .welcome-content p {
        font-size: 0.85rem;
        /* Diperkecil dari 1rem */
      }

      .right-panel {
        padding: 2rem 1.5rem;
        /* Diperkecil dari 3rem 2rem */
      }

      .reset-header h2 {
        font-size: 1.3rem;
        /* Diperkecil dari 1.5rem */
      }

      .button-group {
        flex-direction: column;
      }
    }

    @media (max-width: 480px) {
      .container {
        margin: 0.5rem;
        width: 100%;
      }

      .left-panel,
      .right-panel {
        padding: 2rem 1.5rem 3rem;
        /* Padding lebih besar di bagian bawah */
        min-height: 220px;
      }

      .welcome-content p {
        font-size: 1rem;
      }

      .welcome-content h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
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
        <p>Keamanan Akun SIMNU Anda</p>
      </div>
    </div>

    <div class="right-panel">
      <div class="reset-header">
        <h2>
          <span class="reset-icon">🔒</span>
          Buat Password Baru
        </h2>
        <p>Masukkan password baru yang aman untuk akun Anda</p>
      </div>

      <div class="security-info">
        <h4>
          <span>🛡️</span>
          Tips Password Yang Aman:
        </h4>
        <ul>
          <li>Minimal 8 karakter</li>
          <li>Kombinasi huruf besar, kecil, angka dan simbol</li>
          <li>Hindari informasi pribadi yang mudah ditebak</li>
          <li>Gunakan password yang unik</li>
        </ul>
      </div>

      <div class="form-container">
        <?php if ($this->session->flashdata('message')): ?>
          <div class="flash-message <?= strpos($this->session->flashdata('message'), 'success') !== false ? 'success' : 'error' ?>">
            <span><?= strpos($this->session->flashdata('message'), 'success') !== false ? '✅' : '❌' ?></span>
            <?= $this->session->flashdata('message') ?>
          </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('auth/resetpassword?email=' . $this->input->get('email') . '&token=' . $this->input->get('token')) ?>">
          <div class="input-group password-group">
            <input type="password" name="password1" id="password1" placeholder="Password baru" autofocus required>
            <button type="button" class="password-toggle" onclick="togglePassword('password1')">
              <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path class="eye-open" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle class="eye-open" cx="12" cy="12" r="3"></circle>
                <path class="eye-closed" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" style="display: none;"></path>
                <line class="eye-closed" x1="1" y1="1" x2="23" y2="23" style="display: none;"></line>
              </svg>
            </button>
            <div class="password-strength">
              <div class="strength-bar">
                <div class="strength-fill" id="strengthBar"></div>
              </div>
              <span id="strengthText">Kekuatan password</span>
            </div>
            <?= form_error('password1', '<div class="error-message">', '</div>'); ?>
          </div>

          <div class="input-group password-group">
            <input type="password" name="password2" id="password2" placeholder="Konfirmasi password baru" required>
            <button type="button" class="password-toggle" onclick="togglePassword('password2')">
              <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path class="eye-open" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle class="eye-open" cx="12" cy="12" r="3"></circle>
                <path class="eye-closed" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" style="display: none;"></path>
                <line class="eye-closed" x1="1" y1="1" x2="23" y2="23" style="display: none;"></line>
              </svg>
            </button>
            <div id="matchStatus"></div>
            <?= form_error('password2', '<div class="error-message">', '</div>'); ?>
          </div>

          <div class="button-group">
            <button type="submit" class="btn btn-reset" id="resetBtn">
              <span>🔐</span> Simpan Password Baru
            </button>
            <button type="button" class="btn btn-back" onclick="location.href='<?= base_url('auth') ?>'">
              <span>← </span> Kembali ke Login
            </button>
          </div>
        </form>

        <div class="back-to-login">
          <a href="<?= base_url('auth'); ?>">
            <span>←</span>
            Kembali ke halaman login
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Password toggle functionality
    function togglePassword(inputId) {
      const passwordInput = document.getElementById(inputId);
      const button = passwordInput.nextElementSibling; // Ambil tombol toggle
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

    // Password strength checker
    function checkPasswordStrength(password) {
      let strength = 0;
      let text = '';

      if (password.length >= 8) strength += 1;
      if (password.match(/[a-z]/)) strength += 1;
      if (password.match(/[A-Z]/)) strength += 1;
      if (password.match(/[0-9]/)) strength += 1;
      if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

      const strengthBar = document.getElementById('strengthBar');
      const strengthText = document.getElementById('strengthText');

      strengthBar.className = 'strength-fill';

      switch (strength) {
        case 0:
        case 1:
          strengthBar.classList.add('strength-weak');
          text = 'Lemah';
          break;
        case 2:
        case 3:
          strengthBar.classList.add('strength-fair');
          text = 'Cukup';
          break;
        case 4:
          strengthBar.classList.add('strength-good');
          text = 'Baik';
          break;
        case 5:
          strengthBar.classList.add('strength-strong');
          text = 'Sangat Kuat';
          break;
      }

      strengthText.textContent = `Kekuatan password: ${text}`;
    }

    // Password match checker
    function checkPasswordMatch() {
      const password1 = document.getElementById('password1').value;
      const password2 = document.getElementById('password2').value;
      const matchStatus = document.getElementById('matchStatus');

      if (password2.length > 0) {
        if (password1 === password2) {
          matchStatus.innerHTML = '<div class="success-message">✅ Password cocok</div>';
        } else {
          matchStatus.innerHTML = '<div class="error-message">❌ Password tidak cocok</div>';
        }
      } else {
        matchStatus.innerHTML = '';
      }
    }

    // Event listeners
    document.getElementById('password1').addEventListener('input', function() {
      checkPasswordStrength(this.value);
      checkPasswordMatch();
    });

    document.getElementById('password2').addEventListener('input', checkPasswordMatch);

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

    // Loading state for reset button
    document.querySelector('form').addEventListener('submit', function(e) {
      const resetBtn = document.getElementById('resetBtn');
      resetBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⟳</span> Menyimpan...';
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