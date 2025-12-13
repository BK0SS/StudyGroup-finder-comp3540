<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        #layout-title {
            position: absolute;
            width: 100%; height: 80px;
            top: 0; left: 0;
            text-align: center;
            background-color: Beige;
            padding-top: 10px; 
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
        }
        #nav-buttons {
            position: absolute;
            width: 80px;
            top: 15px; left: calc(50% - 40px);
        }
        #nav-buttons > button {
            display: inline-block;
            width: 80px;
            margin-bottom: 10px; 
        }
        #blanket {
            display: none;
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: LightGrey;
            opacity: 0.5;
            z-index: 998;
        }
        .modal-window {
            display: none;
            position: absolute;
            width: 400px; height: 300px;
            top: calc(50% - 150px); left: calc(50% - 200px);
            border: 1px solid black;
            background-color: White;
            z-index: 999;
            padding: 15px;
        }
        .modal-window label {
            display: inline-block; 
            width: 80px;
            position: relative;
            left: 5px;
            font-weight: bold;
        }
        #cancel-signin, #cancel-signup {
            position: absolute;
            left: 5px; bottom: 5px;
        }
        #submit-signin, #submit-signup {
            position: absolute;
            right: 5px; bottom: 5px;
        }
    </style>
</head>
<body>
    <div id='layout-title'>
        <h1>TRU Study Groups</h1>
    </div>
    
    <div id='layout-left'>
        <div id='nav-buttons'>
            <button class='btn btn-primary btn-sm' id='button-signin'>Sign In</button>
            <button class='btn btn-success btn-sm' id='button-signup'>Sign Up</button>
        </div>
    </div>
    
    <div id='layout-right'>
        <div id='blanket'></div>
        
        <!-- Sign In Modal -->
        <div class='modal-window' id='modal-signin'>
            <h2 class='text-center'>Sign In</h2>
            <hr>
            <br>
            <form method='post' action='controller.php'>
                <input type='hidden' name='page' value='StartPage'>
                <input type='hidden' name='command' value='SignIn'>
                
                <label for='signin-username'>Username:</label>
                <input type='text' name='Username' id='signin-username' required><br><br>
                
                <label for='signin-password'>Password:</label>
                <input type='password' name='Password' id='signin-password' required><br>
                
                <input id='cancel-signin' type='button' class='btn btn-secondary' value='Cancel'>
                <input id='submit-signin' type='submit' class='btn btn-primary' value='Submit'>
            </form>
        </div>

        <!-- Sign Up Modal -->
        <div class='modal-window' id='modal-signup'>
            <h2 class='text-center'>Sign Up</h2>
            <hr>
            <br>
            <form method='post' action='controller.php'>
                <input type='hidden' name='page' value='StartPage'>
                <input type='hidden' name='command' value='SignUp'>
                
                <label for='signup-email'>Email:</label>
                <input type='text' name='Email' id='signup-email' required><br><br>
                
                <label for='signup-username'>Username:</label>
                <input type='text' name='Username' id='signup-username' required><br><br>
                
                <label for='signup-password'>Password:</label>
                <input type='password' name='Password' id='signup-password' required><br>
                
                <input id='cancel-signup' type='button' class='btn btn-secondary' value='Cancel'>
                <input id='submit-signup' type='submit' class='btn btn-success' value='Submit'>
            </form>
        </div>
    </div>

    <script>
        $(function() {
            $('#button-signin').click(function() {
                show_signin_modal_window();
            });

            $('#cancel-signin').click(function() {
                hide_all_modals();
            });

            $('#button-signup').click(function() {
                show_signup_modal_window();
            });

            $('#cancel-signup').click(function() {
                hide_all_modals();
            });

            $('#blanket').click(function() {
                hide_all_modals();
            });
        });

        function show_signin_modal_window() {
            $('#blanket').show();
            $('#modal-signin').show();
        }

        function show_signup_modal_window() {
            $('#blanket').show();
            $('#modal-signup').show();
        }

        function hide_all_modals() {
            $('#blanket').hide();
            $('#modal-signin').hide();
            $('#modal-signup').hide();
        }

        function show_signup_error() {
            alert("User already exists");
        }

        function show_signin_error(){
            alert("Invalid data");
        }

        <?php
            if (!empty($display_modal_window) && $display_modal_window == 'signin')
                echo 'show_signin_modal_window();';
            
            if(!empty($display_modal_window) && $display_modal_window == 'signup')
                echo 'show_signup_modal_window();';
            
            if(isset($error_msg) && $error_msg == 'user already exists') {
                echo 'show_signup_error();';
        
            }
            
            if(isset($error_msg) && $error_msg == 'invalid data') {
                echo 'show_signin_error();';
            }
        ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>