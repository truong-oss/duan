<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/dangky.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Andev Web</title>
</head>

<body>
    <!-- Thêm class 'active' -->
    <div class="container active" id="container">
        <div class="form-container sign-up">
            <!-- form đăng ký -->
            <form action="<?= BASE_URL . '?act=add-khach-hang'?>" method="post">
                <h1>Create Account</h1>
                
                            
                            <!-- Name input -->
                <div class="form-group mb-3">
                    <input type="text" placeholder="Name" name="ho_ten">
                    <?php if (isset($_SESSION['error']['ho_ten'])): ?>
                        <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email input -->
                <div class="form-group mb-3">
                    <input type="text" placeholder="Email" name="email">
                    <?php if (isset($_SESSION['error']['email'])): ?>
                        <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                    <?php endif; ?>
                    
                </div>
                <div class="form-group mb-3">
                    <input type="text" placeholder="Nhập số điện thoại" name="so_dien_thoai">
                    <?php if (isset($_SESSION['error']['so_dien_thoai'])): ?>
                        <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                    <?php endif; ?>
                </div>
                <!-- Password input -->
                <div class="form-group mb-3">
                    <input type="password" placeholder="Password" name="mat_khau" class="form-control">
                    <?php if (isset($_SESSION['error']['mat_khau'])): ?>
                        <p class="text-danger d-block w-100"><?= $_SESSION['error']['mat_khau'] ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" >Sign Up</button>
            </form>
        </div>

       

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <div class="social-icons">
                    <a href="<?=BASE_URL ?>" class="icon"><i class="fa-solid fa-house"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                    <p>Enter your personal details to use all of site features</p>
                    <a href="<?= BASE_URL . '?act=formlogin'?>"><button class="hidden" id="login">Sign In</button></a>
                </div>
                
            </div>
        </div>
    </div>


</body>

</html>
