<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Library App' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        :root {
            --ink: #1b2636;
            --muted: #6a7481;
            --brand: #153952;
            --accent: #b98048;
            --cream: #fff9f1;
            --danger: #b64747;
            --danger-soft: rgba(182, 71, 71, .08);
            --warning: #a36a1f;
            --warning-soft: rgba(185, 128, 72, .12);
        }

        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Manrope', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 20%, rgba(185, 128, 72, .18), transparent 30%),
                radial-gradient(circle at 85% 10%, rgba(21, 57, 82, .2), transparent 25%),
                linear-gradient(135deg, #fbf4ea 0%, #efe3d1 100%);
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            align-items: stretch;
        }

        .auth-poster {
            position: relative;
            overflow: hidden;
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background:
                linear-gradient(180deg, rgba(15, 31, 47, .88), rgba(20, 57, 82, .82)),
                linear-gradient(135deg, rgba(185, 128, 72, .22), transparent 45%);
            color: #fff8ef;
        }

        .auth-poster::before,
        .auth-poster::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-poster::before {
            width: 380px;
            height: 380px;
            right: -120px;
            top: -80px;
            background: radial-gradient(circle, rgba(255,255,255,.12), transparent 68%);
        }

        .auth-poster::after {
            width: 300px;
            height: 300px;
            left: -70px;
            bottom: -90px;
            background: radial-gradient(circle, rgba(185,128,72,.22), transparent 70%);
        }

        .poster-brand {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .poster-symbol {
            width: 58px;
            height: 58px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(185,128,72,.95), rgba(255,223,188,.75));
            color: #122738;
            font-size: 1.3rem;
        }

        .poster-brand small {
            display: block;
            text-transform: uppercase;
            letter-spacing: .22em;
            font-size: .74rem;
            opacity: .66;
        }

        .poster-brand strong {
            display: block;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.35rem;
            line-height: .9;
        }

        .poster-copy {
            position: relative;
            z-index: 1;
            max-width: 560px;
        }

        .poster-copy h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3.6rem, 5vw, 6rem);
            line-height: .9;
            margin-bottom: 1rem;
        }

        .poster-copy p {
            max-width: 490px;
            color: rgba(255,248,239,.8);
            font-size: 1.02rem;
            line-height: 1.8;
            margin-bottom: 0;
        }

        .poster-notes {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            max-width: 520px;
        }

        .poster-note {
            padding: 1rem 1.1rem;
            border-radius: 18px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(8px);
        }

        .poster-note strong {
            display: block;
            margin-bottom: .45rem;
            font-size: .78rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: #ffdbb7;
        }

        .poster-note span {
            font-size: .92rem;
            color: rgba(255,248,239,.78);
            line-height: 1.6;
        }

        .auth-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-box {
            width: 100%;
            max-width: 480px;
        }

        .auth-card {
            position: relative;
            overflow: hidden;
            border-radius: 30px;
            border: 1px solid rgba(255,255,255,.65);
            background: rgba(255,250,242,.78);
            box-shadow: 0 24px 60px rgba(24, 36, 51, .14);
            backdrop-filter: blur(12px);
        }

        .auth-card::after {
            content: '';
            position: absolute;
            inset: -80px -100px auto auto;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(185,128,72,.18), transparent 65%);
            pointer-events: none;
        }

        .auth-card .card-header,
        .auth-card .card-body {
            position: relative;
            z-index: 1;
        }

        .auth-card .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(24,36,51,.08);
            padding: 1.5rem 1.6rem 1rem;
        }

        .auth-card .card-body {
            padding: 1.4rem 1.6rem 1.7rem;
        }

        .auth-card h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.8rem;
            line-height: .95;
            margin-bottom: .45rem;
        }

        .auth-subtitle,
        .auth-card p,
        .auth-card .text-muted {
            color: var(--muted) !important;
        }

        .form-group label {
            font-size: .8rem;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
            color: var(--brand);
            margin-bottom: .55rem;
        }

        .form-control {
            height: auto;
            padding: .88rem 1rem;
            border-radius: 16px;
            border: 1px solid rgba(21,57,82,.12);
            background: rgba(255,255,255,.8);
            transition: border-color .18s ease, box-shadow .18s ease, background-color .18s ease;
        }

        .form-control:focus {
            border-color: rgba(21,57,82,.28);
            box-shadow: 0 0 0 .2rem rgba(21,57,82,.08);
        }

        .form-control.is-invalid {
            border-color: rgba(182, 71, 71, .42);
            background: rgba(255, 247, 247, .95);
            box-shadow: 0 0 0 .18rem rgba(182, 71, 71, .1);
        }

        .field-hint {
            margin-top: .45rem;
            color: var(--muted);
            font-size: .86rem;
            line-height: 1.55;
        }

        .invalid-feedback {
            display: block;
            margin-top: .5rem;
            font-size: .86rem;
            font-weight: 700;
            color: var(--danger);
        }

        .auth-alert {
            display: flex;
            align-items: flex-start;
            gap: .8rem;
            border-radius: 18px;
            padding: .95rem 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(21,57,82,.08);
            background: rgba(21,57,82,.05);
            color: var(--ink);
        }

        .auth-alert i {
            margin-top: .2rem;
        }

        .auth-alert strong {
            display: block;
            margin-bottom: .2rem;
            font-size: .9rem;
        }

        .auth-alert p {
            margin: 0;
            font-size: .9rem;
            line-height: 1.6;
        }

        .auth-alert-danger {
            background: var(--danger-soft);
            border-color: rgba(182, 71, 71, .16);
            color: #7d2f2f;
        }

        .auth-alert-warning {
            background: var(--warning-soft);
            border-color: rgba(185, 128, 72, .18);
            color: #774d12;
        }

        .input-shell {
            position: relative;
        }

        .input-action {
            position: absolute;
            top: 50%;
            right: .65rem;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.35rem;
            height: 2.35rem;
            border: 0;
            border-radius: 12px;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            transition: background-color .18s ease, color .18s ease;
        }

        .input-action:hover,
        .input-action:focus {
            background: rgba(21,57,82,.08);
            color: var(--brand);
            outline: none;
        }

        .input-shell .form-control.has-action {
            padding-right: 3.35rem;
        }

        .caps-warning {
            display: none;
            margin-top: .55rem;
            font-size: .83rem;
            font-weight: 700;
            color: var(--warning);
        }

        .caps-warning.is-visible {
            display: block;
        }

        .submit-feedback {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
        }

        .submit-feedback .spinner-border {
            width: 1rem;
            height: 1rem;
            border-width: .14em;
        }

        .auth-modal .modal-content {
            border: 0;
            border-radius: 26px;
            background: rgba(255,250,242,.98);
            box-shadow: 0 30px 70px rgba(24, 36, 51, .2);
            overflow: hidden;
        }

        .auth-modal .modal-header,
        .auth-modal .modal-body,
        .auth-modal .modal-footer {
            padding-left: 1.35rem;
            padding-right: 1.35rem;
        }

        .auth-modal .modal-header {
            border-bottom: 1px solid rgba(24,36,51,.08);
            padding-top: 1.2rem;
            padding-bottom: 1rem;
        }

        .auth-modal .modal-title {
            font-weight: 800;
            color: var(--brand);
        }

        .auth-modal .modal-body {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .auth-modal .modal-footer {
            border-top: 1px solid rgba(24,36,51,.08);
            padding-top: .9rem;
            padding-bottom: 1.15rem;
        }

        .auth-modal-icon {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            margin-bottom: .9rem;
            font-size: 1.1rem;
            background: var(--warning-soft);
            color: var(--warning);
        }

        .auth-modal.is-danger .auth-modal-icon {
            background: var(--danger-soft);
            color: var(--danger);
        }

        .auth-modal-copy {
            margin: 0;
            font-size: .95rem;
            line-height: 1.7;
            color: var(--muted);
        }

        .btn {
            border: 0;
            border-radius: 16px;
            font-weight: 800;
            padding: .9rem 1rem;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: linear-gradient(135deg, var(--brand), #2c5670); box-shadow: 0 12px 28px rgba(21,57,82,.22); }
        .btn-success { background: linear-gradient(135deg, #2f6c5f, #4c8a7b); box-shadow: 0 12px 28px rgba(47,108,95,.18); }
        .btn-auth-option {
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--ink);
            background: rgba(255,255,255,.72);
            border: 1px solid rgba(21,57,82,.08);
            margin-bottom: .8rem;
        }
        .btn-auth-option span {
            display: flex;
            align-items: center;
            gap: .85rem;
        }
        .btn-auth-option i:first-child {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(21,57,82,.08);
            color: var(--brand);
        }

        .demo-box {
            border-radius: 18px;
            padding: 1rem 1.1rem;
            background: rgba(21,57,82,.05);
            border: 1px solid rgba(21,57,82,.07);
            margin-bottom: 1rem;
        }

        .demo-box strong {
            display: block;
            color: var(--brand);
            font-size: .78rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            margin-bottom: .35rem;
        }

        .auth-link {
            color: var(--brand);
            font-weight: 700;
        }

        @media (max-width: 767.98px) {
            .auth-poster {
                min-height: 340px;
                padding: 1.6rem 1.15rem;
            }

            .poster-brand {
                gap: .8rem;
                margin-bottom: 1.25rem;
            }

            .poster-symbol {
                width: 50px;
                height: 50px;
                border-radius: 16px;
            }

            .poster-brand strong {
                font-size: 2rem;
            }

            .poster-copy h1 {
                font-size: clamp(2.4rem, 12vw, 3.5rem);
                margin-bottom: .8rem;
            }

            .poster-copy p,
            .poster-note span {
                font-size: .93rem;
                line-height: 1.65;
            }

            .poster-notes {
                gap: .75rem;
            }

            .poster-note {
                padding: .9rem 1rem;
                border-radius: 16px;
            }

            .auth-panel {
                padding: 1.15rem;
            }

            .auth-card {
                border-radius: 24px;
            }

            .auth-card h1 {
                font-size: 2.35rem;
            }

            .auth-card .card-header,
            .auth-card .card-body {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            .form-control,
            .btn {
                min-height: 3.15rem;
            }
        }

        @media (max-width: 991.98px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-poster {
                min-height: 420px;
                padding: 2rem 1.5rem;
            }

            .poster-copy h1 {
                font-size: 3.6rem;
            }

            .poster-notes {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 575.98px) {
            .auth-panel {
                padding: 1rem;
            }

            .login-box {
                max-width: none;
            }

            .auth-card .card-header,
            .auth-card .card-body {
                padding-left: 1.2rem;
                padding-right: 1.2rem;
            }

            .poster-copy h1 {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-poster">
            <div class="poster-brand">
                <span class="poster-symbol"><i class="fas fa-book-open"></i></span>
                <div>
                    <small>Empore Library</small>
                    <strong>Archive</strong>
                </div>
            </div>
            <div class="poster-copy">
                <h1>Borrowing books should feel curated, not clerical.</h1>
                <p>Satu workspace untuk katalog, anggota, dan pengajuan peminjaman dengan tampilan yang lebih terarah, lebih mudah dipresentasikan, dan lebih nyaman dipakai.</p>
            </div>
            <div class="poster-notes">
                <div class="poster-note">
                    <strong>Admin Area</strong>
                    <span>Kelola buku, anggota, dan seluruh daftar pengajuan dari satu panel kerja.</span>
                </div>
                <div class="poster-note">
                    <strong>Member Area</strong>
                    <span>Ajukan peminjaman buku dengan proses singkat dan alur yang jelas.</span>
                </div>
            </div>
        </section>
        <section class="auth-panel">
            <div class="login-box">
                @yield('content')
            </div>
        </section>
    </div>
    <div class="modal fade auth-modal" id="authFeedbackModal" tabindex="-1" aria-labelledby="authFeedbackTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authFeedbackTitle">Perlu dicek lagi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="auth-modal-icon" id="authFeedbackIcon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <p class="auth-modal-copy" id="authFeedbackMessage">Periksa kembali data yang dimasukkan lalu coba lagi.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Saya cek lagi</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const serverFeedback = @json(session('auth_feedback'));
            const serverErrors = @json($errors->all());
            const modalElement = document.getElementById('authFeedbackModal');
            const modalTitle = document.getElementById('authFeedbackTitle');
            const modalMessage = document.getElementById('authFeedbackMessage');
            const modalRoot = document.getElementById('authFeedbackModal');

            function showFeedbackModal(options) {
                if (! modalElement || ! options?.message) {
                    return;
                }

                modalTitle.textContent = options.title || 'Perlu dicek lagi';
                modalMessage.textContent = options.message;
                modalRoot.classList.toggle('is-danger', options.type === 'danger');

                $(modalElement).modal('show');
            }

            function setFieldError(field, message) {
                if (! field) {
                    return;
                }

                field.classList.add('is-invalid');

                const feedbackId = field.getAttribute('aria-describedby');

                if (! feedbackId) {
                    return;
                }

                const feedback = document.getElementById(feedbackId);

                if (feedback) {
                    feedback.textContent = message;
                    feedback.hidden = false;
                }
            }

            function clearFieldError(field) {
                if (! field) {
                    return;
                }

                field.classList.remove('is-invalid');

                const feedbackId = field.getAttribute('aria-describedby');

                if (! feedbackId) {
                    return;
                }

                const feedback = document.getElementById(feedbackId);

                if (feedback) {
                    feedback.hidden = true;
                    feedback.textContent = '';
                }
            }

            document.querySelectorAll('[data-auth-guard]').forEach(function (form) {
                const submitButton = form.querySelector('[type="submit"]');
                const submitLabel = submitButton ? submitButton.innerHTML : '';

                form.querySelectorAll('input').forEach(function (field) {
                    ['input', 'change'].forEach(function (eventName) {
                        field.addEventListener(eventName, function () {
                            clearFieldError(field);
                        });
                    });
                });

                const passwordField = form.querySelector('input[name="password"]');
                const capsWarning = form.querySelector('[data-caps-warning]');

                if (passwordField && capsWarning) {
                    ['keydown', 'keyup'].forEach(function (eventName) {
                        passwordField.addEventListener(eventName, function (event) {
                            capsWarning.classList.toggle('is-visible', Boolean(event.getModifierState && event.getModifierState('CapsLock')));
                        });
                    });

                    passwordField.addEventListener('blur', function () {
                        capsWarning.classList.remove('is-visible');
                    });
                }

                form.querySelectorAll('[data-password-toggle]').forEach(function (toggleButton) {
                    toggleButton.addEventListener('click', function () {
                        const targetId = toggleButton.getAttribute('data-password-toggle');
                        const targetField = document.getElementById(targetId);

                        if (! targetField) {
                            return;
                        }

                        const isHidden = targetField.type === 'password';
                        targetField.type = isHidden ? 'text' : 'password';
                        toggleButton.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
                        toggleButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');

                        const icon = toggleButton.querySelector('i');
                        if (icon) {
                            icon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
                        }
                    });
                });

                form.addEventListener('submit', function (event) {
                    let firstInvalidField = null;
                    let modalMessage = '';

                    const emailField = form.querySelector('input[name="email"]');
                    const passwordField = form.querySelector('input[name="password"]');

                    if (emailField) {
                        const emailValue = emailField.value.trim();
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                        if (! emailValue) {
                            setFieldError(emailField, 'Email wajib diisi.');
                            firstInvalidField = firstInvalidField || emailField;
                            modalMessage = modalMessage || 'Email belum diisi. Lengkapi dulu sebelum lanjut login.';
                        } else if (! emailPattern.test(emailValue)) {
                            setFieldError(emailField, 'Format email belum valid.');
                            firstInvalidField = firstInvalidField || emailField;
                            modalMessage = modalMessage || 'Format email belum benar. Gunakan format seperti nama@domain.com.';
                        }
                    }

                    if (passwordField && ! passwordField.value) {
                        setFieldError(passwordField, 'Password wajib diisi.');
                        firstInvalidField = firstInvalidField || passwordField;
                        modalMessage = modalMessage || 'Password belum diisi. Masukkan password lalu coba lagi.';
                    }

                    if (firstInvalidField) {
                        event.preventDefault();
                        firstInvalidField.focus();
                        showFeedbackModal({
                            type: 'warning',
                            title: 'Input belum lengkap',
                            message: modalMessage,
                        });
                        return;
                    }

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerHTML = '<span class="submit-feedback"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Memproses...</span></span>';
                    }
                });

                form.addEventListener('invalid', function () {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = submitLabel;
                    }
                }, true);
            });

            if (serverFeedback?.message) {
                showFeedbackModal(serverFeedback);
                return;
            }

            if (Array.isArray(serverErrors) && serverErrors.length > 0) {
                showFeedbackModal({
                    type: 'warning',
                    title: 'Form perlu diperbaiki',
                    message: serverErrors[0],
                });
            }
        });
    </script>
</body>
</html>
