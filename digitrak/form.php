<?php 
if(isset($_POST['register'])){  
    
  if(!empty($_POST['email']) && !empty($_POST['password']) ){
   $fname = $_POST['fname'];
   $mname = $_POST['mname'];
   $lname = $_POST['lname'];
   $birthdate = trim($_POST['birthdate']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);
   $hash_password = md5($password);
   
   $address1 = $_POST['address1'];
   if (!empty($_POST['address11'])){
       $address11 = NULL;
   }
   else{ $address11 = $_POST['address11'];
       }      
   $postcode11= $_POST['postcode11'];
   $city11= $_POST['city11'];
   $country11= $_POST['country11'];
   $billing = "billing";
      
   $address2 = $_POST['address2'];
   $address21 = $_POST['address21'];
   if (!empty($_POST['address21'])){
       $address21 = NULL;
   }
   else{ $address21 = $_POST['address21'];
       }
   $postcode21= $_POST['postcode21'];
   $city21= $_POST['city21'];
   $country21= $_POST['country21'];
   $delivery = "delivery";
      
   $address3 = $_POST['address3'];
   if (!empty($_POST['address31'])){
       $address31 = NULL;
   }
   else{ $address31 = $_POST['address31'];
       }
   $postcode31= $_POST['postcode31'];
   $city31= $_POST['city31'];
   $country31= $_POST['country31'];
   $payment = "payment";
      
      
   $homephone = $_POST['homephone'];
   $workphone =  $_POST['workphone'];
   $mobile =  $_POST['mobile'];
      
   $homedes = "home phone";
   $workdes = "work phone";
   $mobiledes = "mobile";
      
   $homecurr = 0;
   $workcurr = 0;
   $mobilecurr = 0;
      
   $check_exist = mysqli_query($con,"select * from cust_details where email = '$email'");
   
   $email_count = mysqli_num_rows($check_exist);
   
   $row_register = mysqli_fetch_array($check_exist);
   
   if($email_count > 0){
   echo "<script>alert('Sorry, your email $email address already exist in our database !')</script>";
   
   }elseif($row_register['email'] !=$email ){
   
	
    $run_insert = mysqli_query($con,"insert into cust_details (fname, lname, mname, birthdate email,login,password) values ('$fname','$lname','$mname','$birthdate','$email','$login','$hash_password') ");
       
    $adress1_insert = mysqli_query($con,"insert into address (cust_id, address_line1, address_line2, postcode, curr_address, type, city, country, description) 
    values((SELECT cust_id FROM cust_details where login = $login), '$address1','$address11','$postcode11','$city11','$country11')");
       
    $adress2_insert = mysqli_query($con,"insert into address (cust_id, address_line1, address_line2, postcode, curr_address, type, city, country, description) 
    values((SELECT cust_id FROM cust_details where login = $login), '$address2','$address21','$postcode21','$city21','$country21')");
       
    $adress3_insert = mysqli_query($con,"insert into address (cust_id, address_line1, address_line2, postcode, curr_address, type, city, country, description) 
    values((SELECT cust_id FROM cust_details where login = $login), '$address3','$address31','$postcode31','$city31','$country31')");
    
    if (!empty($homephone)){
        $home_phone_insert = mysqli_query($con,"insert into phone (cust_id, number, description, cur_phone) values ((SELECT cust_id FROM cust_details where login = $login), $homephone, $homedes, $homecur) ");
    }   
       
    if (!empty($workphone)){
        $work_phone_insert = mysqli_query($con,"insert into phone (cust_id, number, description, cur_phone) values ((SELECT cust_id FROM cust_details where login = $login), $workphone, $workdes, $workcur) ");
    }   
       
     if (!empty($mobile)){
        $mobile_insert = mysqli_query($con,"insert into phone (cust_id, number, description, cur_phone) values ((SELECT cust_id FROM cust_details where login = $login), $mobile, $mobiledes, $mobilecur) ");
    }  
    
	if($run_insert){
	$sel_user = mysqli_query($con,"select * from cust_details where email='$email' ");
	$row_user = mysqli_fetch_array($sel_user);
	
	$_SESSION['user_id'] = $row_user['cust_id'] ."<br>";
	$_SESSION['role'] = $row_user['role'];	
	}
	
	$run_cart = mysqli_query($conn,"select * from shopping_cart where cust_id='$cust_id'");
	
	$check_cart = mysqli_num_rows($run_cart);
	
	if($check_cart == 0){
	
	$_SESSION['email'] = $email;
	
	echo "<script>alert('Account has been created successfully!')</script>";
	
	echo "<script>window.open('customer/my_account.php','_self')</script>";
	
	}else{
	
	$_SESSION['email'] = $email;
	
	echo "<script>alert('Account has been created successfully!')</script>";
	
	echo "<script>window.open('checkout.php','_self')</script>";
	
	}
	
   }
   
  }
  
}

?>

   <form method = "post" action="">
    
	<table align="left" width="70%">
	
	  <tr align="left">	   
	   <td colspan="4">
	   <span>
	     Already have account? <a href="login.php?action=login">Login Now.</a><br /><br />
	   </span>
	   </td>	   
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>First Name:</b></td>
	   <td colspan="3"><input type="text" name="fname" required placeholder="First Name" /></td>
	  </tr>
	  <tr>
	   <td width="15%"><b>Middle Name:</b></td>
	   <td colspan="3"><input type="text" name="mname" placeholder="Middle Name" /></td>
	  </tr>
	  <tr>
	   <td width="15%"><b>Last Name:</b></td>
	   <td colspan="3"><input type="text" name="lname" required placeholder="Last Name" /></td>
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>Birthdate:</b></td>
	   <td colspan="3"><input type="date" name="birthdate" required placeholder="Birthdate" /></td>
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>Email:</b></td>
	   <td colspan="3"><input type="text" name="email" required placeholder="Email" /></td>
	  </tr>
	  
	   <tr>
	   <td width="15%"><b>Username:</b></td>
	   <td colspan="3"><input type="text" id="username" name="username" required placeholder="Username" /></td>
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>Password:</b></td>
	   <td colspan="3"><input type="password" id="password_confirm1" name="password" required placeholder="Password" /></td>
	  </tr>
	  
<th ><h1>Billing Address</h1></th>
   <th colspan="5"><h1>Delivery Address</h1></th>
	  <th colspan="3"><h1>Payment Address</h1></th>
	  
	  <tr>
	   <td width="15%"><b>Address1:</b></td>
	   <td colspan="3"><input type="text" name="address1" required placeholder="Address" /></td>
	   <td width="15%"><b>Address1:</b></td>
	   <td colspan="3"><input type="text" name="address2" required placeholder="Address" /></td>
	    <td width="15%"><b>Address1:</b></td>
	   <td colspan="3"><input type="text" name="address3" required placeholder="Address" /></td>
	  </tr>
	  
	   <tr>
	   <td width="15%"><b>Address2:</b></td>
	   <td colspan="3"><input type="text" name="address11" placeholder="Address" /></td>
	    <td width="15%"><b>Address2:</b></td>
	   <td colspan="3"><input type="text" name="address21" placeholder="Address" /></td>
	    <td width="15%"><b>Address2:</b></td>
	   <td colspan="3"><input type="text" name="address31"  placeholder="Address" /></td>
	  </tr>
	  
	   <tr>
	   <td width="15%"><b>Postcode:</b></td>
	   <td colspan="3"><input type="int" name="postcode11" required placeholder="postcode" /></td>
	   <td width="15%"><b>Postcode:</b></td>
	   <td colspan="3"><input type="int" name="postcode21" required placeholder="postcode" /></td>
	      <td width="15%"><b>Postcode:</b></td>
	   <td colspan="3"><input type="int" name="postcode31" required placeholder="postcode" /></td>
	   
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>City:</b></td>
	   <td colspan="3"><input type="text" name="city11" required placeholder="City" /></td>
	   <td width="15%"><b>City:</b></td>
	   <td colspan="3"><input type="text" name="city21" required placeholder="City" /></td>
	   <td width="15%"><b>City:</b></td>
	   <td colspan="3"><input type="text" name="city31" required placeholder="City" /></td>
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>Country:</b></td>
	   <td colspan="3"><input type="text" name="country11" required placeholder="Country" /></td>
	   <td width="15%"><b>Country:</b></td>
	   <td colspan="3"><input type="text" name="country21" required placeholder="Country" /></td>
	   <td width="15%"><b>Country:</b></td>
	   <td colspan="3"><input type="text" name="country31" required placeholder="Country"/></td>
	  </tr>
	  
	  
	   <tr>
	   <td>
	  <fieldset>
          <legend>Current Residence</legend>
          <p>
             <label>Select list</label>
             <select id = "myList">
               <option value = "1">Billing Address</option>
               <option value = "2">Delivery Address</option>
               <option value = "3">Payment Address</option>
               </select>
          </p>
       </fieldset>
       </td>
        </tr>
	  
	        
       <th><h1>Contact</h1></th>
       
        <tr>
	   <td width="15%"><b>Work Phone:</b></td>
	   <td colspan="3"><input type="int" name="workphone"  placeholder="Work Phone" /></td>
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>Home Phone:</b></td>
	   <td colspan="3"><input type="int" name="homephone"  placeholder="Home Phone" /></td>
	  </tr>
	  
	  <tr>
	   <td width="15%"><b>Mobile:</b></td>
	   <td colspan="3"><input type="int" name="mobile"  placeholder="Mobile" /></td>
	  </tr>
	  
	  
	  	   <tr>
	   <td>
	  <fieldset>
          <legend>Current contact</legend>
          <p>
             <label>Select list</label>
             <select id = "myList">
               <option value = "1">Work Phone</option>
               <option value = "2">Home Phone</option>
               <option value = "3">Mobile</option>
               </select>
          </p>
       </fieldset>
       </td>
        </tr>
	  
	  <tr align="left">
	   <td></td>
	   <td colspan="4">
	   <input type="submit" name="register" value="Register" />
	   </td>
	  </tr>
      </table>
  </form>