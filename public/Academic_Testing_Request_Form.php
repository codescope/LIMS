<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>CSS Registration Form</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
    </head>
    <body>  
        <header>
			<h1>National Textile Research Centre</h1>
		</header>
        <form action="" class="register" style="height: 600px;">
            <h1 id="first-heading">Academic Testing Request Form</h1>
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
                    <label>Registration Number
                    </label>
                    <input type="text" class="long"/ required>
                </p>
                <p>
                    <label>Department *
                    </label>
                    <input type="text" class="long" required/>
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
                    <label>Institute *
                    </label>
                    <input type="text" class="long"/ required>
                </p>
                <p>
                    <label>Topic of Study
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
                    <label>Tests *
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
                <div class="infobox"><h4>Declaration</h4>
                    <p>It is certified that the above mentioned research work to be conducted at NTRC would be properly acknowledged in the thesis/project; and if any research publication&#40;s&#41; were made from it would include the name&#40;s&#41; of concerned NTRC person</p>
                </div>
            </fieldset>
            <fieldset class="row4" style="margin-top:-20px;">
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
            <div><button class="button">Register&raquo;</button></div>
        </form>
        <div id="footer">
  <p>&copy; <a href="http://www.ntu.edu.com" title="National textile University" target="_blank">NTU</a> | follow us on Twitter! <a href="https://twitter.com/NTUOfficial" title="Follow us on Twitter">@NTUOfficial</a> 
  <br>For additional information. please visit the main or about page</p>
  </div>
    </body>
</html>





