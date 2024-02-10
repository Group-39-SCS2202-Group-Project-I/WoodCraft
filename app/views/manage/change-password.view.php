<!DOCTYPE html>
<html lang="en">

<?php $this->view('includes/header', $data) ?>

<head>
    <?php $this->view('includes/nav', $data) ?>
    <!-- <?php $this->view('webstore/header-section', $data) ?> -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/manage-account.css">
    <!-- <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/icons.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

    <title>Manage My Account | Wood Craft</title>
</head>

<body>
    <main id="main" class="main">
        <!-- change password -->
        <div class="container">
            <div class="title">
                <h2>Change Password</h2>
            </div>

            <div class="content-change-password">
                <form>
                    <div class="field-change-password">
                        <label class="label-with-eye" for="current-password">
                            Current Password
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Enter your current password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('current-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>
        
                    <div class="field-change-password">
                        <label class="label-with-eye" for="new-password">
                            New Password
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Enter your new password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('new-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="field-change-password">
                        <label class="label-with-eye" for="retype-password">
                            Retype Password
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="retype-password" name="retype-password" placeholder="Retype your password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('retype-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>
        
                    <button type="button" class="save-changes-change-password" onclick="goToMyProfile()">SAVE CHANGES</button>
                    <button type="button" class="cancel-change-password" onclick="goToMyProfile()">CANCEL</button>
                </form>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>