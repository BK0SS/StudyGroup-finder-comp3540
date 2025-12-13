<?php
$conn = mysqli_connect("localhost", "#####", "#####", "C354_f3bkosulin");
if (mysqli_connect_errno())
    echo 'Failed to connect: ' . mysqli_connect_error();

function checkUser($username)
{
    global $conn;
    $sql = "select * from Users where Username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function insertUser($username, $password, $email)
{
    global $conn;
    $cur_date = date("Ymd");
    $sql = "insert into Users values (null, '$username','$password','$email','$cur_date')";
    if (mysqli_query($conn, $sql))
        return true;
    else
        return false;
}

function checkData($username, $password)
{
    global $conn;
    $sql = "select * from Users where Username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user['Username'] == $username && $user['Password'] == $password)
        return true;
    else
        return false;
}

function getStudyGroups()
{
    global $conn;
    $sql = "select * from StudyGroups";
    $result = mysqli_query($conn, $sql);
    $groups = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $groups[] = $row;
        }
    }
    return $groups;
}


function search_study_groups($search_term)
{
    global $conn;
    $sql = "SELECT * FROM StudyGroups WHERE CourseID LIKE '%" . $search_term . "%'";
    $result = mysqli_query($conn, $sql);

    $data = array();  
    $i = 0;
    while ($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;  
    return $data;
}

function insertStudyGroup($courseID, $owner, $time, $date, $place)
{
    global $conn;
    $sql = "insert into StudyGroups values (null, '$courseID', '$owner', '$time', '$date', '$place', '')";
    if (mysqli_query($conn, $sql))
        return true;
    else
        return false;
}

function updateStudyGroup($id, $courseID, $date, $time, $place)
{
    global $conn;
    $sql = "UPDATE StudyGroups SET CourseID='$courseID', Date='$date', Time='$time', Place='$place' WHERE ID=$id";
    if (mysqli_query($conn, $sql))
        return true;
    else
        return false;
}

function deleteStudyGroup($id)
{
    global $conn;
    $sql = "DELETE FROM StudyGroups WHERE ID = $id";
    if (mysqli_query($conn, $sql))
        return true;
    else
        return false;
}

function joinStudyGroup($id, $username)
{
    global $conn;
    $sql_get = "SELECT Members FROM StudyGroups WHERE ID = $id";
    $result = mysqli_query($conn, $sql_get);
    $row = mysqli_fetch_assoc($result);
    $current_members = $row['Members'];

    if (strpos($current_members, $username) !== false)
        return true;

    if ($current_members == "")
        $new_members = $username;
    else
        $new_members = $current_members . ", " . $username;

    $sql_update = "UPDATE StudyGroups SET Members = '$new_members' WHERE ID = $id";
    if (mysqli_query($conn, $sql_update))
        return true;
    else
        return false;
}

function updateUser($old_username, $new_username)
{
    global $conn;
    $sql = "UPDATE Users SET Username='$new_username' WHERE Username='$old_username'";
    if (mysqli_query($conn, $sql)) {
        $sql2 = "UPDATE StudyGroups SET Owner='$new_username' WHERE Owner='$old_username'";
        mysqli_query($conn, $sql2);
        return true;
    } else
        return false;
}

function deleteUserAccount($username)
{
    global $conn;
    $sql = "DELETE FROM Users WHERE Username='$username'";
    if (mysqli_query($conn, $sql)) {
        $sql2 = "DELETE FROM StudyGroups WHERE Owner='$username'";
        mysqli_query($conn, $sql2);
        return true;
    } else
        return false;
}
?>