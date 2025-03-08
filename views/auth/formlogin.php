<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Andev Web</title>
</head>

<body>
    <!-- thông báo tạo tk thành công -->
    <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị ?>
<?php endif; ?>
<!-- end tb -->
    <div class="container" id="container">
        <div class="form-container sign-in">
<!-- form đăng nhập  -->
            <form action="<?= BASE_URL . '?act=login'?>" method="post">
                <h1>Sign In</h1>
              
                <div class="social-icons">
                    <a href="<?=BASE_URL ?>" class="icon"><i class="fa-solid fa-house"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <?php if (isset($_SESSION['error'])): ?>
                    <?php if (is_array($_SESSION['error'])): ?>
                        <?php foreach ($_SESSION['error'] as $error): ?>
                            <p class="text-danger login-box-msg text-center"><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-danger login-box-msg text-center"><?= htmlspecialchars($_SESSION['error']) ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="login-box-msg text-center">Vui lòng đăng nhập</p>
                <?php endif; ?>

                <input type="text" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="mat_khau">
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
            </form>

        </div>

        <div class="toggle-container">

            <div class="toggle">
                
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>

                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <a href="<?= BASE_URL .'?act=formregiter'?>"><button class="hidden" id="register">Sign Up</button></a>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
