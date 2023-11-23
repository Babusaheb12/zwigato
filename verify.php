<?php
include('config/constants.php');

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];
    $query = "SELECT * FROM `register_user` WHERE email = '$email' AND verification_code = '$v_code'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['is_verified'] == 0) {
                $update = "UPDATE `register_user` SET is_verified = '1' WHERE email = '$email'";

                if (mysqli_query($conn, $update)) {
                    echo "
                    <script>
                    alert('Email verification successfully');
                    window.location.href = 'index.php';
                    </script>
                    ";
                }
            } else {
                echo "
                <script>
                alert('Email already registered');
                window.location.href = 'index.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
            alert('Cannot run query');
            window.location.href = 'index.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('Cannot run query');
        window.location.href = 'index.php';
        </script>
        ";
    }
}
?>
