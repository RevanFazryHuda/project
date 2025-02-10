<?php 
include("../lib/auth.php"); 
include("../lib/functions.php");
$theme = setTheme();
getHeader($theme);
?>

<div class="container mt-4">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4">
            <div class="card text-center shadow-lg p-3 mb-5 bg-light rounded">
                <div class="card-body">
                    <img src="../themes/minia/assets/images/profile.jpg" class="rounded-circle mb-3" width="120" height="120" alt="User Avatar">
                    <h4 class="card-title"><?php echo $_SESSION['nama']; ?></h4>
                    <p class="card-text text-muted">@<?php echo $_SESSION['username']; ?></p>
                    <span class="badge bg-primary"><?php echo $_SESSION['role']; ?></span>
                </div>
            </div>
        </div>

        <!-- Today Stats -->
        <div class="col-md-8">
            <div class="card shadow-lg p-4 bg-light rounded">
                <h4 class="mb-3"><i class="fa fa-chart-line"></i> Today Stats</h4>
                <div class="mb-3">
                    <strong>Username:</strong> <span class="float-end"><?php echo $_SESSION['username']; ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 30%">30%</div>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Role:</strong> <span class="float-end"><?php echo $_SESSION['role']; ?></span>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: 8%">8%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Stats -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-lg p-4 bg-light rounded">
                <h4 class="mb-3"><i class="fa fa-chart-bar"></i> This Month Stats</h4>
                <div class="mb-3">
                    <strong>Visits:</strong> <span class="float-end">+45%</span>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 45%">45%</div>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>New Users:</strong> <span class="float-end">+57%</span>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: 57%">57%</div>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Downloads:</strong> <span class="float-end">+25%</span>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: 25%">25%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
getFooter($theme, '');
?>
