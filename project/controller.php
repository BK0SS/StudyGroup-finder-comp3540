<?php
session_start();
include("db_handler.php");

$error_msg = "none";
if (empty($_POST['page'])) {
    if (isset($_SESSION['username'])) {
        $study_groups = getStudyGroups();
        include("mainpage.php");
        exit();
    }
    $display_modal_window = 'no-modal-window';
    $error_msg = "none";
    include("startpage.php");
    exit();
}

if ($_POST['page'] == 'StartPage') {
    $command = $_POST['command'];
    switch ($command) {
        case 'SignIn':
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            if (checkData($username, $password)) {
                $_SESSION['username'] = $username;
                $study_groups = getStudyGroups();
                include('mainpage.php');
            } else {
                $display_modal_window = 'signin';
                $error_msg = 'invalid data';
                include("startpage.php");
            }
            break;

        case 'SignUp':
            $email = $_POST['Email'];
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            if (is_valid_signup($email, $username, $password) && !checkUser($username)) {
                insertUser($username, $password, $email);
                $_SESSION['username'] = $username;
                $display_modal_window = 'signin';
                $error_msg = "none";
                $study_groups = getStudyGroups();
                include("mainpage.php");
            } else {
                $error_msg = "user already exists";
                $display_modal_window = 'signup';
                include("startpage.php");
            }
            break;
    }
    exit();
}

else if ($_POST['page'] == 'MainPage') {
    if (!isset($_SESSION['username'])) {
        $display_modal_window = 'signin';
        $error_msg = "Please sign in first";
        include("startpage.php");
        exit();
    }

    $command = $_POST['command'];
    switch ($command) {
        case 'ViewProfile':
            include("profile.php");
            break;

        case 'SignOut':
            session_unset();
            session_destroy();
            $display_modal_window = "none";
            $error_msg = "none";
            include("startpage.php");
            break;

        case 'CreateGroup':
            $courseID = $_POST['CourseID'];
            $date = $_POST['Date'];
            $time = $_POST['Time'];
            $place = $_POST['Place'];
            $owner = $_SESSION['username'];
            insertStudyGroup($courseID, $owner, $time, $date, $place);
            $study_groups = getStudyGroups();
            include("mainpage.php");
            break;

        case 'EditGroup':
            $id = $_POST['id'];
            $courseID = $_POST['CourseID'];
            $date = $_POST['Date'];
            $time = $_POST['Time'];
            $place = $_POST['Place'];
            updateStudyGroup($id, $courseID, $date, $time, $place);
            $study_groups = getStudyGroups();
            include("mainpage.php");
            break;

        case 'DeleteGroup':
            $id = $_POST['id'];
            deleteStudyGroup($id);
            $study_groups = getStudyGroups();
            include("mainpage.php");
            break;

        case 'JoinGroup':
            $id = $_POST['id'];
            $username = $_SESSION['username'];
            joinStudyGroup($id, $username);
            $study_groups = getStudyGroups();
            include("mainpage.php");
            break;

        // AJAX Search Logic
        case 'SearchGroups':
            $t = $_POST['term'];
            echo json_encode(search_study_groups($t));
            exit();
            break;
    }
    exit();
}

else if ($_POST['page'] == 'ProfilePage') {
    if (!isset($_SESSION['username'])) {
        $display_modal_window = 'signin';
        $error_msg = "Please sign in first";
        include("startpage.php");
        exit();
    }

    $command = $_POST['command'];
    switch ($command) {
        case 'MainPage':
            $study_groups = getStudyGroups();
            include("mainpage.php");
            break;
        case 'UpdateProfile':
            $old_username = $_SESSION['username'];
            $new_username = $_POST['NewUsername'];
            if (updateUser($old_username, $new_username)) {
                $_SESSION['username'] = $new_username;
                $msg = "Nickname updated successfully.";
            } else
                $msg = "Error updating nickname.";
            include("profile.php");
            break;
        case 'DeleteProfile':
            $username = $_SESSION['username'];
            deleteUserAccount($username);
            session_unset();
            session_destroy();
            $display_modal_window = "none";
            $error_msg = "Account deleted.";
            include("startpage.php");
            break;
        case 'SignOut':
            session_unset();
            session_destroy();
            $display_modal_window = "none";
            $error_msg = "none";
            include("startpage.php");
            break;
    }
    exit();
} else {
    echo 'Unknown page error!';
    exit();
}

function is_valid_signup($e, $u, $p)
{
    if (!empty($u) && !empty($p) && !empty($e))
        return true;
    else
        return false;
}
?>