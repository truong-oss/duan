<!-- header -->
<?php include './views/layout/header.php';?>
  <!-- Navbar -->
<?php include './views/layout/navbar.php';?>
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php';?>
  

  <!-- Content Wrapper. Contains page content -->
  <<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Báo cáo thống kê</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Total Orders -->
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền thu</h5>
                        <p class="card-text h4"><?= number_format($data['totalOrders']); ?></p>
                    </div>
                </div>
            </div>
            <!-- Total Categories -->
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Số danh mục</h5>
                        <p class="card-text h4"><?= $data['totalCategories']; ?></p>
                    </div>
                </div>
            </div>
            <!-- Total Products -->
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Số sản phẩm</h5>
                        <p class="card-text h4"><?= $data['totalProducts']; ?></p>
                    </div>
                </div>
            </div>
            <!-- Total Users -->
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Số tài khoản</h5>
                        <p class="card-text h4"><?= $data['totalUsers']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
    <!-- Biểu đồ -->
    <div class="col-md-6">
        <h2 class="text-center">Biểu đồ Doanh thu</h2>
        <div style="background-color: #ffffff; padding: 15px; border-radius: 5px;"> <!-- Thêm div bao quanh với nền trắng -->
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Bảng thống kê đơn hàng theo danh mục -->
    <div class="col-md-6">
        <h2 class="text-center">Báo cáo thống kê đơn hàng theo danh mục</h2>
        <div style="background-color: #ffffff; padding: 15px; border-radius: 5px; height: 100%;"> <!-- Thêm chiều cao 100% -->
            <table class="table table-bordered table-sm mb-0"> <!-- Đặt mb-0 để giảm khoảng cách dưới -->
                <thead>
                    <tr>
                        <th>Danh Mục</th>
                        <th>Tổng Đơn Hàng</th>
                        <th>Tổng Doanh Thu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statistics as $stat): ?>
                        <tr>
                            <td><?= htmlspecialchars($stat['danh_muc']) ?></td>
                            <td><?= htmlspecialchars($stat['tong_don_hang']) ?></td>
                            <td><?= formatPrice($stat['tong_doanh_thu']) ?> VNĐ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($data1['labels']); ?>, // Dữ liệu nhãn
                datasets: [{
                    label: 'Doanh thu',
                    data: <?php echo json_encode($data1['data']); ?>, // Dữ liệu doanh thu
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
<?php include './views/layout/footer.php';?>
<!-- end footer -->
<!-- Page specific script -->

</body>
</html>
