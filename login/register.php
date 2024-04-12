<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Register</title>
</head>
<body>
    <h1><img class="logo" src="../assests/images/1.svg" alt="Seed for Change logo"></h1>
    <div class="container" id="container">
    <div class="tabs">
                        <div class="tab active" onclick="openTab(event, 'tab1')">Account Info</div>
                        <div class="tab" onclick="openTab(event, 'tab2')">Profile</div>
                        <div class="tab" onclick="openTab(event, 'tab3')">Experience</div>
                        <div class="tab" onclick="openTab(event, 'tab4')">Preferences</div>
                    </div>
        <div class="registration-form" id="registration-form">
                    
                <form action="../action/registration_process.php" method="POST" enctype="multipart/form-data">
                        <div class="cont-header">
                            <h1>Lets plant your first seed!</h1>
                        </div>
                
            <div id="tab1" class="tab-content active">
                <!-- Account Information -->
                <h2 style="color: #32620e";>Account Information</h2>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br>
                <div class="next-button" onclick="validateForm()">Next</div>
                <br>
                        <p>Already have an account? <a href="../login/login.php">Login here</a></p>
            </div>
                
                
            <div id="tab2" class="tab-content">
                <!-- Personal Profile -->
                <h2 style="color: #32620e">Personal Profile</h2>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name"><br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name"><br>
                <label for="biography">Biography:</label>
                <textarea id="biography" name="biography" style="width: 300px; height: 150px;"></textarea><br><br>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country"><br><br>
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number"><br><br>
                <label for="languages_spoken">Languages Spoken:</label>
                <input type="text" id="languages_spoken" name="languages_spoken"><br><br>
                <div class="next-button" onclick="nextTab('tab2')">Next</div>
            </div>
            
        
            <div id="tab3" class="tab-content">
                <!-- Professional Experience -->
                <h2 style="color: #32620e">Professional Experience</h2>
                <div id="professional_experience">
                    <div class="experience_entry">
                        <label for="position1">Position:</label>
                        <input type="text" id="position1" name="position[]"><br>
                        <label for="organization1">Organization/Company:</label>
                        <input type="text" id="organization1" name="organization[]"><br>
                        <label for="from_date1">From:</label>
                        <input type="date" id="from_date1" name="from_date[]"><br>
                        <label for="to_date1">To:</label>
                        <input type="date" id="to_date1" name="to_date[]"><br>
                        <label for="description1">Description:</label>
                        <textarea id="description1" name="description[]" style="width: 300px; height: 150px;"></textarea><br><br>
                    </div>
                </div>
                <button type="button" onclick="addExperience()" style="margin-left: 70px";>Add Another Experience</button>

                <div class="next-button" onclick="validateDates()">Next</div>
            </div>


                
            <div id="tab4" class="tab-content">
                <!-- Project Preferences -->
                <div class="form-adjust">
                                    <h2 style="color: #32620e; margin-bottom: 0px ">Project Preferences</h2>

                                    <!-- Skills Checkbox -->
                                    <h3 style="color: #32620e">Skills</h3>
                            <div class="checkbox-column">
                                            <div class="checkbox-wrapper-43">
                                            <input type="checkbox" id="cbx-43" name="skills[]" value="1">
                                            <label for="cbx-43" class="check">
                                                <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                    <polyline points="1 9 7 14 15 4"></polyline>
                                                </svg>
                                            </label>
                                            <label for="cbx-43">Accounting</label><br>
                                            </div>

                                            <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-2" name="skills[]" value="2">
                                        <label for="cbx-43-2" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-2">Artificial intelligence</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-3" name="skills[]" value="3">
                                        <label for="cbx-43-3" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-3">Branding</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-4" name="skills[]" value="4">
                                        <label for="cbx-43-4" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-4">Business development</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-5" name="skills[]" value="5">
                                        <label for="cbx-43-5" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-5">Coaching</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-6" name="skills[]" value="6">
                                        <label for="cbx-43-6" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-6">Communications</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-7" name="skills[]" value="7">
                                        <label for="cbx-43-7" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-7">Data analysis</label><br>
                                    </div>


                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-8" name="skills[]" value="8">
                                        <label for="cbx-43-8" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-8">Database administration</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-9" name="skills[]" value="9">
                                        <label for="cbx-43-9" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-9">Digital advertising</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-10" name="skills[]" value="10">
                                        <label for="cbx-43-10" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-10">Digital marketing</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-11" name="skills[]" value="11">
                                        <label for="cbx-43-11" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-11">Engineering</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-12" name="skills[]" value="12">
                                        <label for="cbx-43-12" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-12">Entrepreneurship</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-13" name="skills[]" value="13">
                                        <label for="cbx-43-13" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-13">Event planning</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-14" name="skills[]" value="14">
                                        <label for="cbx-43-14" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-14">Executive leadership</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-15" name="skills[]" value="15">
                                        <label for="cbx-43-15" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-15">Finance</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-16" name="skills[]" value="16">
                                        <label for="cbx-43-16" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-16">Fundraising</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-17" name="skills[]" value="17">
                                        <label for="cbx-43-17" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-17">Graphic design</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-18" name="skills[]" value="18">
                                        <label for="cbx-43-18" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-18">Human resources</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-19" name="skills[]" value="19">
                                        <label for="cbx-43-19" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-19">Information technology</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-20" name="skills[]" value="20">
                                        <label for="cbx-43-20" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-20">Management</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-21" name="skills[]" value="21">
                                        <label for="cbx-43-21" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-21">Marketing</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-22" name="skills[]" value="22">
                                        <label for="cbx-43-22" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-22">Organizational design</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-23" name="skills[]" value="23">
                                        <label for="cbx-43-23" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-23">Photography & video</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-24" name="skills[]" value="24">
                                        <label for="cbx-43-24" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-24">Project management</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-25" name="skills[]" value="25">
                                        <label for="cbx-43-25" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-25">Public relations</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-26" name="skills[]" value="26">
                                        <label for="cbx-43-26" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-26">Research</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-27" name="skills[]" value="27">
                                        <label for="cbx-43-27" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-27">Sales</label><br>
                                    </div>



                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-28" name="skills[]" value="28">
                                        <label for="cbx-43-28" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-28">Search engine marketing</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-29" name="skills[]" value="29">
                                        <label for="cbx-43-29" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-29">Social media</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-30" name="skills[]" value="30">
                                        <label for="cbx-43-30" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-30">Sound editing</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-31" name="skills[]" value="31">
                                        <label for="cbx-43-31" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-31">Strategy consulting</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-32" name="skills[]" value="32">
                                        <label for="cbx-43-32" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-32">Talent recruitment</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-33" name="skills[]" value="33">
                                        <label for="cbx-43-33" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-33">Training</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-34" name="skills[]" value="34">
                                        <label for="cbx-43-34" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-34">Web design</label><br>
                                    </div>

                                    <div class="checkbox-wrapper-43">
                                        <input type="checkbox" id="cbx-43-35" name="skills[]" value="35">
                                        <label for="cbx-43-35" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                        <label for="cbx-43-35">Web development</label><br>
                                    </div>
                        </div>

                    </div>
                    

                    <div class="next-button" onclick="nextTab('tab4')">Next</div>
            </div>
        


            <div id="tab5" class="tab-content">
            
                <div class="form-adjust">
                                    <!-- Cause Areas -->
                                    <h3 style="color: #32620e">Cause Areas</h3>
                                    <div class="checkbox-column">
                                                    <label style="display: flex; align-items: center;">
                                                    <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                        <input type="checkbox" id="cbx-43-1" name="cause_area[]" value="1">
                                                        <span class="check">
                                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                                <polyline points="1 9 7 14 15 4"></polyline>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    Animals
                                                </label>
                                                

                                                <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-2" name="cause_area[]" value="2">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Arts & culture
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-3" name="cause_area[]" value="3">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Civil rights
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-5" name="cause_area[]" value="5">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Disaster relief
                                            </label>

                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;"> 
                                                    <input type="checkbox" id="cbx-43-6" name="cause_area[]" value="6">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Disease & medical research
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-7" name="cause_area[]" value="7">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Diversity & inclusion
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-8" name="cause_area[]" value="8">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Education
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-9" name="cause_area[]" value="9">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Employment services
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-10" name="cause_area[]" value="10">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Environment
                                            </label>

                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-11" name="cause_area[]" value="11">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Gender equity & justice
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-12" name="cause_area[]" value="12">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Health & nutrition
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-13" name="cause_area[]" value="13">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Housing & homelessness
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-14" name="cause_area[]" value="14">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Human services
                                            </label>

                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-15" name="cause_area[]" value="15">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                International affairs
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-16" name="cause_area[]" value="16">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Justice & legal services
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-17" name="cause_area[]" value="17">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                LGBTQ+
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-18" name="cause_area[]" value="18">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Maternal health
                                            </label>
                                            <label style="display: flex; align-items: center;">
                                                <div class="checkbox-wrapper-43" style="margin-right: 10px;">
                                                    <input type="checkbox" id="cbx-43-4" name="cause_area[]" value="4">
                                                    <span class="check">
                                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                                            <polyline points="1 9 7 14 15 4"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                Community & economic development
                                            </label>

                                    </div>
                </div>
                <br>
                    <center><button name="register" type="submit" id="loginButton" style="margin-left: 70px";>Register</button><center>
                </form>
                        

                    
            
            </div>


                

    
        </div>
    </div>


<script>
    var experienceCount = 1; // Initialize the count of experiences

    function addExperience() {
        experienceCount++; // Increment the count
        var newExperience = document.createElement('div'); // Create a new div for the experience
        newExperience.classList.add('experience_entry'); // Add a class for styling
        newExperience.innerHTML = `
            <label for="position${experienceCount}">Position:</label>
            <input type="text" id="position${experienceCount}" name="position[]"><br><br>
            <label for="organization${experienceCount}">Organization/Company:</label>
            <input type="text" id="organization${experienceCount}" name="organization[]"><br><br>
            <label for="from_date${experienceCount}">From:</label>
            <input type="date" id="from_date${experienceCount}" name="from_date[]"><br><br>
            <label for="to_date${experienceCount}">To:</label>
            <input type="date" id="to_date${experienceCount}" name="to_date[]"><br><br>
            <label for="description${experienceCount}">Description:</label>
            <textarea id="description${experienceCount}" name="description[]" style="width: 300px; height: 150px;"></textarea><br><br>
        `;
        document.getElementById('professional_experience').appendChild(newExperience); // Append the new experience to the container
    }

    function openTab(evt, tabName) {
    // Get all elements with class "tab-content" and hide them
    var tabContent = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }
    
    // Get all elements with class "tab" and remove the "active" class
    var tabs = document.getElementsByClassName("tab");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }
    
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");

    // Scroll to the top of the container
    document.querySelector('.registration-form').scrollIntoView({
        behavior: 'smooth'
    });
    }

    function nextTab(currentTab) {
    // Find the index of the current tab
    var currentIndex = parseInt(currentTab.slice(-1));
    
    // Get the next tab index
    var nextIndex = currentIndex + 1;
    
    // Open the next tab
    openTab(event, 'tab' + nextIndex);
    
    // Get all tab buttons and remove the "active" class
    var tabs = document.getElementsByClassName("tab");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }
    
    // Add the "active" class to the next tab button
    tabs[nextIndex - 1].classList.add("active");

    document.querySelector('.container').scrollIntoView({
        behavior: 'smooth'
    });
    }

function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    // Email regex pattern
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return;
    }

    // Password regex pattern (at least 8 characters, at least one uppercase letter, one lowercase letter, and one number)
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.");
        return;
    }

    // Check if password and confirm password match
    if (password !== confirm_password) {
        alert("Passwords do not match.");
        return;
    }

    // If all validations pass, proceed to the next tab or form submission
    nextTab('tab1'); // Assuming nextTab function exists for switching tabs
}

function validateDates() {
        var fromDateInputs = document.getElementsByName("from_date[]");
        var toDateInputs = document.getElementsByName("to_date[]");

        for (var i = 0; i < fromDateInputs.length; i++) {
            var fromDate = new Date(fromDateInputs[i].value);
            var toDate = new Date(toDateInputs[i].value);

            // Check if the from date is ahead of the to date
            if (fromDate > toDate) {
                alert("From date cannot be ahead of the to date.");
                return false;
            }

            // Check if the to date is in the future
            var today = new Date();
            if (toDate > today) {
                alert("To date cannot be in the future.");
                return false;
            }
        }

        // If all date validations pass, proceed to the next tab
        nextTab('tab3');
    }

</script>

</body>

</html>

