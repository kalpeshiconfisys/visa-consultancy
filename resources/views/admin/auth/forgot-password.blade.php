<!DOCTYPE html>
<html lang="en">

<head>
    <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">

</head>

<body class="app app-reset-password p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="#"><img class="logo-icon me-2"
                                src="{{ asset('assets/images/visa-logo.webp') }}" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-4">Password Reset</h2>
                    <div class="auth-intro mb-4 text-center">Enter your email address below. We'll email you a link to a page where you can easily create a new password.</div>
                    <div class="auth-form-container text-left">
                        <form class="auth-form resetpass-form">
                            <div class="email mb-3">
                                <label class="sr-only" for="reg-email">Your Email</label>
                                <input id="reg-email" name="reg-email" type="email" class="form-control login-email"
                                    placeholder="Your Email" required="required">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Reset  Password</button>
                            </div>
                        </form>
                        <div class="auth-option text-center pt-5"><a class="app-link"  href="{{ url('admin/login') }}">Log in</a> <span class="px-2">|</span> <a class="app-link" href="{{ url('admin/register') }}">Sign up</a></div>
                    </div>
                </div>
                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                                style="color: #fb866a;"></i> by <a class="app-link"
                                href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for
                            developers</small>
                    </div>
                </footer>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder"
                style="background:url('{{ asset('assets/images/background/hire-visa-consultant.jpg') }}') center/cover no-repeat;">
            </div>
        </div>
    </div>
</body>

</html>
