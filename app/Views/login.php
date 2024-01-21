<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Bootstrap 5 Login Page</title>
    <link rel="stylesheet" href="all.css">
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">
                    <img src="logo.jpg" alt="logo" width="100">
                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>

                        <?php if (isset($validation)): ?>
                            <div style="color: #404040;">
                                <?= $validation->listErrors(); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('error')) {  ?>
                        <div class="fw-bold" style="color: lightcoral">
                            <?php echo session()->getFlashdata('error') ?>

                        </div>
                    <?php } ?>

                        <?= form_open('login',['method'=>'POST']); ?>
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                            <?= form_input(['type' => 'email', 'name' => 'email', 'required' => 'required', 'class' => 'form-control']); ?>


                        </div>

                        <div class="mb-3">

                            <label class="mb-2 text-muted" for="password">Passsword</label>
                            <?= form_password(['name' => 'password', 'required' => 'required', 'class' => 'form-control', 'id' => 'password']); ?>


                        </div>

                        <div class="d-flex align-items-center">

                            <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary ms-auto'], "Login") ?>
                        </div>
                        <?= form_close(); ?>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Don't have an account? <a href="<?= site_url('register') ?>" class="text-dark">Create
                                One</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright &copy; 2012-2024 &mdash; Your Company
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/login.js"></script>
</body>
</html>