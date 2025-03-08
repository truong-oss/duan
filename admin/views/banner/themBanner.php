<!-- header -->
<!-- header -->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lí thêm banner</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm banner</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=post-them-banner' ?>" method="POST" enctype="multipart/form-data">
                            <div class="row card-body">
                                <div class="form-group col-12">
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" value="" name="mo_ta" placeholder="Nhập tiêu đề banner">
                                    <?php 
                      if(isset($errors['mo_ta'])){ ?>
                        <p class="text-danger"><?=$errors['mo_ta']?></p>
                     <?php }
                    ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" value="" name="link_anh">
                                    <?php 
                      if(isset($errors['link_anh'])){ ?>
                        <p class="text-danger"><?=$errors['link_anh']?></p>
                     <?php }
                    ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Ngày update</label>
                                    <input type="date" class="form-control" value="" name="ngay_dang" placeholder="Nhập ngày thêm">
                                    <?php 
                      if(isset($errors['ngay_dang'])){ ?>
                        <p class="text-danger"><?=$errors['ngay_dang']?></p>
                     <?php }
                    ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php'; ?>