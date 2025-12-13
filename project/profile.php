<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        #layout-title {
            position: absolute;
            width: 100%; height: 80px;
            top: 0; left: 0;
            text-align: center;
            background-color: Beige;
        }
        #layout-left {
            position: absolute;
            top: 80px; left: 0;
            width: 100px; height: calc(100vh - 80px);
            background-color: AliceBlue;
        }
        #layout-right {
            position: absolute;
            top: 80px; left: 100px;
            width: calc(100vw - 100px); height: calc(100vh - 80px);
            padding: 20px;
        }
        #layout-title h1 {
            margin: 0;
            line-height: 80px;
        }
        #nav-buttons {
            padding-top: 15px;
            text-align: center;
        }
        #nav-buttons form, #nav-buttons button {
            margin-bottom: 10px;
            width: 80px; 
        }
    </style>
</head>
<body>
    <div id='layout-title'>
        <h1>TRU Study Group Board - Profile</h1>
    </div>
    
    <div id='layout-left'>
        <div id='nav-buttons'>
            <form method="post" action="controller.php">
                <input type="hidden" name="page" value="ProfilePage">
                <input type="hidden" name="command" value="MainPage">
                <button type="submit" class="btn btn-primary btn-sm">Main Page</button>
            </form>

            <form method="post" action="controller.php">
                <input type="hidden" name="page" value="ProfilePage">
                <input type="hidden" name="command" value="SignOut">
                <button type="submit" class="btn btn-danger btn-sm">Sign Out</button>
            </form>
        </div>
    </div>
    
    <div id='layout-right'>
        <h3>User Profile</h3>
        <hr>
        
        <?php if(isset($msg)) echo "<p style='color:green'>$msg</p>"; ?>
        
        <div style="border: 1px solid #ccc; padding: 20px; width: 400px; background-color: #f9f9f9;">
            <h4>Edit Info</h4>
            <br>
            <form method="post" action="controller.php">
                <input type="hidden" name="page" value="ProfilePage">
                <input type="hidden" name="command" value="UpdateProfile">
                
                <label>Current Nickname (Username):</label><br>
                <input type="text" value="<?php echo $_SESSION['username']; ?>" disabled><br><br>
                
                <label>New Nickname:</label><br>
                <input type="text" name="NewUsername" required><br><br>
                
                <button type="submit" class="btn btn-success">Update Nickname</button>
            </form>
        </div>
        <br><br>
        
        <div style="border: 1px solid red; padding: 20px; width: 400px; background-color: #fff0f0;">
            <p>Once you delete your account, there is no going back.</p>
            
            <form method="post" action="controller.php" onsubmit="return confirm('Are you sure you want to delete your account?');">
                <input type="hidden" name="page" value="ProfilePage">
                <input type="hidden" name="command" value="DeleteProfile">
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</body>
</html>