<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        #layout-title {
            position: absolute;
            width: 100%;
            height: 80px;
            top: 0;
            left: 0;
            text-align: center;
            background-color: Beige;
        }

        #layout-left {
            position: absolute;
            top: 80px;
            left: 0;
            width: 100px;
            height: calc(100vh - 80px);
            background-color: AliceBlue;
        }

        #layout-right {
            position: absolute;
            top: 80px;
            left: 100px;
            width: calc(100vw - 100px);
            height: calc(100vh - 80px);
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

        #nav-buttons form,
        #nav-buttons button {
            margin-bottom: 10px;
            width: 80px;
        }

        .modal-window {
            border: 1px solid black;
            width: 300px;
            background-color: white;
            position: absolute;
            top: 100px;
            left: 150px;
            padding: 20px;
            display: none;
            z-index: 10;
            box-shadow: 2px 2px 5px grey;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div id='layout-title'>
        <h1>TRU Study Group Board - MainPage</h1>
    </div>

    <div id='layout-left'>
        <div id='nav-buttons'>
            <button id='btn-create' class="btn btn-success btn-sm">Create</button>
            <form method="post" action="controller.php">
                <input type="hidden" name="page" value="MainPage">
                <input type="hidden" name="command" value="ViewProfile">
                <button type="submit" class="btn btn-primary btn-sm">Profile</button>
            </form>
            <form method="post" action="controller.php">
                <input type="hidden" name="page" value="MainPage">
                <input type="hidden" name="command" value="SignOut">
                <button type="submit" class="btn btn-danger btn-sm">Sign Out</button>
            </form>
        </div>
    </div>

    <div id='layout-right'>
        <?php if (isset($_SESSION['username']))
            echo "<h3>Welcome, " . $_SESSION['username'] . "</h3>"; ?>
        <hr>

        <label>Search Course ID: </label>
        <input type="text" id="search-term">
        <button id="button-search-groups" class="btn btn-info btn-sm">Search</button>
        <button id="btn-reset" class="btn btn-secondary btn-sm" onclick="location.reload()">Reset</button>
        <br><br>

        <div id='result-pane'>
            <h3>All Study Groups</h3>
            <table>
                <caption>List of Groups</caption>
                <tr>
                    <th>CourseID</th>
                    <th>Owner</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Place</th>
                    <th>Members</th>
                    <th>Action</th>
                </tr>
                <?php
                if (isset($study_groups)) {
                    foreach ($study_groups as $group) {
                        echo "<tr>";
                        echo "<td>" . $group['CourseID'] . "</td>";
                        echo "<td>" . $group['Owner'] . "</td>";
                        echo "<td>" . $group['Date'] . "</td>";
                        echo "<td>" . $group['Time'] . "</td>";
                        echo "<td>" . $group['Place'] . "</td>";
                        echo "<td>" . $group['Members'] . "</td>";
                        echo "<td>";
                        if ($group['Owner'] == $_SESSION['username']) {
                            echo "<button class='btn-edit' data-id='" . $group['ID'] . "' data-course='" . $group['CourseID'] . "' data-date='" . $group['Date'] . "' data-time='" . $group['Time'] . "' data-place='" . $group['Place'] . "'>Edit</button> ";
                            echo "<form method='post' action='controller.php' style='display:inline;'><input type='hidden' name='page' value='MainPage'><input type='hidden' name='command' value='DeleteGroup'><input type='hidden' name='id' value='" . $group['ID'] . "'><button>Delete</button></form>";
                        } else {
                            echo "<form method='post' action='controller.php' style='display:inline;'><input type='hidden' name='page' value='MainPage'><input type='hidden' name='command' value='JoinGroup'><input type='hidden' name='id' value='" . $group['ID'] . "'><button>Join</button></form>";
                        }
                        echo "</td></tr>";
                    }
                }
                ?>
            </table>
        </div>

        <div id='modal-create' class='modal-window'>
            <form method="post" action="controller.php">
                <h4>Create Study Group</h4>
                <hr>
                <input type="hidden" name="page" value="MainPage">
                <input type="hidden" name="command" value="CreateGroup">
                <label>Course ID:</label><br><input type="text" name="CourseID" required><br><br>
                <label>Date:</label><br><input type="text" name="Date" required><br><br>
                <label>Time:</label><br><input type="text" name="Time" required><br><br>
                <label>Place:</label><br><input type="text" name="Place" required><br><br>
                <button type="button" id="btn-cancel-create">Cancel</button> <button type="submit">Submit</button>
            </form>
        </div>

        <div id='modal-edit' class='modal-window'>
            <form method="post" action="controller.php">
                <h4>Edit Study Group</h4>
                <hr>
                <input type="hidden" name="page" value="MainPage">
                <input type="hidden" name="command" value="EditGroup">
                <input type="hidden" id="edit-id" name="id">
                <label>Course ID:</label><br><input type="text" id="edit-course" name="CourseID" required><br><br>
                <label>Date:</label><br><input type="text" id="edit-date" name="Date" required><br><br>
                <label>Time:</label><br><input type="text" id="edit-time" name="Time" required><br><br>
                <label>Place:</label><br><input type="text" id="edit-place" name="Place" required><br><br>
                <button type="button" id="btn-cancel-edit">Cancel</button> <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <script> var currentUser = "<?php echo $_SESSION['username']; ?>"; </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#btn-create').on('click', function () { $('#modal-create').show(); $('#modal-edit').hide(); });
        $('#btn-cancel-create').on('click', function () { $('#modal-create').hide(); });
        $('#btn-cancel-edit').on('click', function () { $('#modal-edit').hide(); });

        $(document).on('click', '.btn-edit', function () {
            $('#edit-id').val($(this).data('id'));
            $('#edit-course').val($(this).data('course'));
            $('#edit-date').val($(this).data('date'));
            $('#edit-time').val($(this).data('time'));
            $('#edit-place').val($(this).data('place'));
            $('#modal-edit').show();
            $('#modal-create').hide();
        });

        // AJAX Search
        $('#button-search-groups').click(function () {
            let search_terms = $('#search-term').val();
            $.post('controller.php',
                { page: 'MainPage', command: 'SearchGroups', term: search_terms },
                function (result) {
                    $('#result-pane').html('<h3>Searched Groups</h3>' + construct_table('List of Groups', result));
                });
        });

        function construct_table(caption, data) {
            let obj = JSON.parse(data);
            let table = '<table>';
            table += '<caption>' + caption + '</caption>';
            table += '<tr><th>CourseID</th><th>Owner</th><th>Date</th><th>Time</th><th>Place</th><th>Members</th><th>Action</th></tr>';

            for (let i = 0; i < obj.length; i++) {
                table += '<tr>';
                table += '<td>' + obj[i].CourseID + '</td>';
                table += '<td>' + obj[i].Owner + '</td>';
                table += '<td>' + obj[i].Date + '</td>';
                table += '<td>' + obj[i].Time + '</td>';
                table += '<td>' + obj[i].Place + '</td>';
                table += '<td>' + (obj[i].Members || '') + '</td>';
                table += '<td>';
                if (obj[i].Owner == currentUser) {
                    table += "<button class='btn-edit' data-id='" + obj[i].ID + "' data-course='" + obj[i].CourseID + "' data-date='" + obj[i].Date + "' data-time='" + obj[i].Time + "' data-place='" + obj[i].Place + "'>Edit</button> ";
                    table += "<form method='post' action='controller.php' style='display:inline;'><input type='hidden' name='page' value='MainPage'><input type='hidden' name='command' value='DeleteGroup'><input type='hidden' name='id' value='" + obj[i].ID + "'><button>Delete</button></form>";
                } else {
                    table += "<form method='post' action='controller.php' style='display:inline;'><input type='hidden' name='page' value='MainPage'><input type='hidden' name='command' value='JoinGroup'><input type='hidden' name='id' value='" + obj[i].ID + "'><button>Join</button></form>";
                }
                table += '</td></tr>';
            }
            table += '</table>';
            return table;
        }
    </script>
</body>

</html>