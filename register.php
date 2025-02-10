<?php
include("controllers/Login.php");
include("lib/functions.php");
$obj = new LoginController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $password = $_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];
    
    if($password===$confirmpassword){
        // Insert the database record using your controller's method
        $dat = $obj->addUsers($username,$nama,$password);
        $msg = getJSON($dat);
    } else {
        $msg="no";
    }
}
$theme=setTheme();
getHeaderLogin($theme);
?>

				
				<div class="container-fluid">
					<h4>Register</h4>
					<div class="col col-md-3 panel panel-default" style="padding-top:10px; padding-bottom:10px">	
                            <?php 
                                if($msg===true){ 
                                    echo '<div class="alert alert-success" style="display: block" id="message_success">Register Success</div>';
                                    echo '<meta http-equiv="refresh" content="1;url='.base_url().'index.php">';
                                } elseif($msg===false) {
                                    echo '<div class="alert alert-danger" style="display: block" id="message_error">Register Gagal</div>'; 
                                } elseif($msg==="no") {
                                    echo '<div class="alert alert-danger" style="display: block" id="message_error">Password dan Confirm password hrs sama</div>';
                                } else {

                                }
                            ?>		
                        <form id="login-form" method="POST">
						<div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control mt-1" id="username" name="username" required>
                        </div>                            
                        <div class="form-group mt-2">
                            <label for="nrp">Nama:</label>
                            <input type="text" class="form-control mt-1" id="nama" name="nama" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="password">password:</label>
                            <input type="password" class="form-control mt-1" id="password" name="password" required>
                        </div>
						<div class="form-group mt-2">
                            <label for="confirmpassword">Confirm Password:</label>
                            <input type="password" class="form-control mt-1" id="confirmpassword" name="confirmpassword" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3">Register</button>
                            <a href="<?php echo base_url(); ?>" class="btn btn-large btn-danger mt-3 mx-3">Cancel</a>
                        </form>
					</div>
					<div class="col col-md-9">
						<div class="row">
                            <div class="col-md-4">
                                
                                
                            </div>
							<div class="col col-md-5">
								
							</div>
						</div>
					</div>
				</div>	

<?php
getFooterLogin($theme,'');
?>
