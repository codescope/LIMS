<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NTRC Testing Request Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
       
    </head>
    
    <body>  
        <header>
            <h1>LIMS</h1>
            <nav style="padding-left:220px">
              <a href="home.php">Home</a>
              <a href="faq.php#barchart">Help</a>
              <a href="reception.php">Reception</a>
              <a href="reception.php">Records Panel</a>    
              <a class="logoutbtn" href="logout.php" style="float:right; margin-right:25px;">log out</a>    
            </nav>
        </header>
        <form action="" class="register">
            <h1 id="first-heading">Commercial Testing Request Form</h1>
            <fieldset class="row1">
<!--
                <legend>Details
                </legend>
-->
                <p>
                    <label>Date *
                    </label>
                    <input type="date" required/>
                    <label>Expected Date *
                    </label>
                    <input type="text" required/>
                </p>
                <p>
                    <label>No. of tests*
                    </label>
                    <input type="number"/ required>
                    <label class="obinfo">* obligatory fields
                    </label>
                </p>
            </fieldset>
            <fieldset class="row2">
                <legend>Personal Details
                </legend>
                <p>
                    <label>Name *
                    </label>
                    <input type="text" class="long" required/>
                </p>
                <p>
                    <label>City *
                    </label>
                    <input type="text" maxlength="10" required/>
                </p>
                <p>
                    <label>Designation *
                    </label>
                    <select required>
                        <option disabled selected>Choose...
                        </option>
                        <option value="1">CEO
                        </option>
                        <option value="2">GM
                        </option>
                        <option value="3">Manager
                        </option>
                        <option value="4">Lecturar
                        </option>
                        <option value="5">Professor
                        </option>
                        <option value="6">QS
                        </option>
                        <option value="7">Student
                        </option>
                    </select>
                </p>
                <p>
                    <label>Organization *
                    </label>
                    <input type="text" class="long"/ required>
                </p>
                <p>
                    <label>Phone *
                    </label>
                    <input type="text" class="long"/ required>
                </p>
                <p>
                    <label>Email *
                    </label>
                    <input class="long" type="email" required/>

                </p>
            </fieldset>
            <fieldset class="row3">
                <legend>Sample Information
                </legend>
<!--
                <p>
                    <label>Gender *</label>
                    <input type="radio" value="radio"/>
                    <label class="gender">Male</label>
                    <input type="radio" value="radio"/>
                    <label class="gender">Female</label>
                </p>
-->
                 <p>
                    <label class="left">Concerned Lab *
                    </label>
                    <input type="checkbox" value="" />
                    <label class="labs">Physical</label>
                    <input type="checkbox" value="" />
                    <label class="labs">Chemical</label>
                   
                </p>
                <p class="chk"> <input type="checkbox" value="" required/>
                    <label class="labs">Product dev</label>
                    <input type="checkbox" value="" />
                    <label class="labs">Analytical</label>
                </p>
                
                <p>
                    <label>No. of samples *
                    </label>
                    <input type="number" required/>  
                </p>
                <p>
                    <label class="left-allign">Sample Types*
                    </label>
                    <select required>
                        <option disabled selected="selected">Choose...
                        </option>
                        <option value="1">Fabric
                        </option>
                        <option value="1">Fibre
                        </option>
                        <option value="1">Film
                        </option>
                        <option value="1">Liquid
                        </option>
                        <option value="1">Powder
                        </option>
                        <option value="1">Non-wooven
                        </option>
                        <option value="1">Nano-Fibres
                        </option>
                        <option value="1">Yarn
                        </option>
                        <option value="1">Coating
                        </option>
                    </select>
                </p>
                <p>
                    <label>Lab *
                    </label>
                    <select>
                    <option disabled selected>Choose...</option>
                        <option value="1">Mechanical
                        </option>
                        <option value="2">Spectroscopy
                        </option>
                        <option value="3">Comfort
                        </option>
                    </select>
                    
                </p>
                <p> <label>Tests*
                    </label>
                    <select id="last" required>
                    <option disabled selected>Choose...</option>
                        <option value="1">Steam Strength of Jute bag
                        </option>
                        <option value="2">Breaking Strength by Strip method
                        </option>
                        <option value="3">Color Fastness to light
                        </option>
                        <option value="4">Color Fastness to Dry Cleaning
                        </option>
                        <option value="5">Color Fastness to Crocking
                        </option>
                    </select>
                </p>
                <p> <label style="font-weight:600;">Payment *
                    </label>
                    <input type="text" required/>
                    <button style="width:80px;height:22px;border-radius:15px;border: 1px solid #555;">Calculate</button>
                </p>
            </fieldset>
            <fieldset class="row4">
                <legend>Terms and Mailing
                </legend>
                <p class="agreement">
                    <input type="checkbox" value=""/>
                    <label>Send an email to customer</label>
                </p>
                <p class="agreement">
                    <input type="checkbox" value=""/>
                    <label>Send SMS to customer</label>
                </p>
                
            </fieldset>
            <div><button class="button">Cancel &raquo;</button></div>
            <div><button class="button submitbtn" type="submit">Submit &raquo;</button></div>
            
        </form>
        <div id="footer">
  <p>&copy; <a href="http://www.ntu.edu.com" title="National textile University" target="_blank">NTU</a> | follow us on Twitter! <a href="https://twitter.com/NTUOfficial" title="Follow us on Twitter">@NTUOfficial</a> 
  <br>For additional information. please visit the main or about page</p>
  </div>
    </body>
</html>





