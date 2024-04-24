        <style>
            /* -- change password -- */
            .content-change-password {
                padding: 30px;
                background-color: var(--bg2);
                border-radius: 20px;
            }

            .field-change-password {
                margin-bottom: 10px;
            }

            .info-label {
                width: 20%;
                margin-top: 10px;
            }

            .label-with-eye {
                display: flex;
                margin-bottom: 10px;
            }

            .label-with-eye .eye-icon {
                cursor: pointer;
                margin-left: 5px;
                display: flex;
                align-items: center;
            }

            .input-wrapper {
                width: 70%;
                border-radius: 10px;
                display: flex;

            }

            .form-control {
                border: 1px solid #ccc;
                transition: border-color 0.3s ease;
                border-radius: 10px;
                padding: 10px;
            }

            .form-control:focus {
                border-color: #007bff;
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }

            .eye-icon {
                cursor: pointer;
            }

            .eye-icon .material-icons {
                font-size: 20px;
                color: #ccc;
            }

            .save-changes-edit-profile, .cancel-edit-profile {
                background-color: var(--coal_black);
                color: var(--white);
                border: none;
                border-radius: 10px;
                padding: 8px 12px;
                cursor: pointer;
                transition: background-color 0.3s;
                width: 250px;
                font-size: 1em;
                margin-bottom: 10px;
            }

            .save-changes-edit-profile:hover, .cancel-edit-profile:hover {
                background-color: var(--green1);
            }

            .bottom-profile {
                display: flex;
                flex-direction: column;
                align-items:flex-end; 
                margin-top: 60px;
            }
        </style>
        
        <?php $this->view('customers/acc-header', $data) ?>
        <br><br>  
        <?php $this->view('customers/acc-sidebar', $data) ?> 

        <div class="main-container"> 

        <!-- change password -->
        <div class="container">
            <div class="title">
                <h2>Change Password</h2>
            </div>

            <div class="content-change-password">
                <form method="post" action="<?= ROOT ?>/profile/editPW">
                    <div class="field-change-password">
                        <label class="label-with-eye" for="current-password">
                            <span class="info-label">Current Password</span>
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
                            <span class="info-label">New Password</span>
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
                            <span class="info-label">retype Password</span>
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="retype-password" name="retype-password" placeholder="Retype your password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('retype-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="bottom-profile">
                        <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                        <a href="<?=ROOT?>/profile/myProfile"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>