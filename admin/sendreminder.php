<?php
require "PHPMailer/PHPMailerAutoload.php";

   include('../includes/connect.php');
   require('../includes/assets.php');

  $query  = "SELECT * FROM domain WHERE flag != 'off'";
          $result = mysqli_query($con,$query);
          while($row = mysqli_fetch_array($result))
                {
                    $userid = $row['user_id'];
                    $domain_name  = $row['domain_name'];
                    $domain_provider_name = $row['domain_provider_name'];
                    $domain_provider_id  = $row['domain_provider_id'];
                    
            /*        
                  $now = time();
                 $your_date = date(strtotime($row['expiry_date']));
                 $datediff = $your_date - $now ;
                 $days = round($datediff / (60 * 60 * 24));
              */
              
              
               $timestamp = strtotime('today midnight');
                $your_date = date(strtotime($row['expiry_date']));
            $days = ceil(abs($your_date - $timestamp) / 86400);
              echo $days;
            
              
                 $query2  = "SELECT * FROM users WHERE id = $userid";
                 $result2 = mysqli_query($con,$query2);
                 while($row2 = mysqli_fetch_array($result2)){
                     ///echo $days;
                     $email = $row2['email'];
                     $f1 = $row2['firstname'];
                     $f2 = $row2['lastname'];
                  
            }
            if($days == 30  || $days == 15 ||  $days <= 7){
   
     $mail = new PHPMailer(true);
  //$mail->SMTPDebug = 2; 
    $mail->isSMTP();
    $mail->Host       = 'mail.justcheck.website';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'admin@justcheck.website';
    $mail->Password   = 'manticlabs@123';
    $mail->SMTPSecure = 'tls'; 
    $mail->Port       = 587;
  
    $mail->setFrom('admin@justcheck.website', 'Admin');
    $mail->addAddress($email,$f1." ".$f2 );
      $mail->addReplyTo('admin@justcheck.website', 'Me');
      

    $mail->isHTML(true);
  

    $mail->Subject ='Mantic Labs. Your Domain '.$domain_name;

   $mail->Body = '<html><body>';
     $mail->Body .= '<img src="http://justcheck.website/domain/images/home.png" alt="image" height="170px" width="250px"/>';
     $mail->Body .=  '<h3>Hey '.$f1." ".$f2.'</h3>';
     $mail->Body .=  ' <h4>Your Remaining Days is' .$days. '</h4>';
     $mail->Body.= ' <h3>Your Domain will be expired at  '.date('d-m-y',$your_date).'</h3>';
     $mail->Body.= '<h3>Please Renew Your Domain</h3>';
     $mail->Body.= '<table rules="all" style="border-color: #666;" cellpadding="10">';
     $mail->Body .= '<tr style="background: #eee;"><td colspan = "2">Domain Details</td></tr>';
     $mail->Body .= '<tr style="background: #eee;"><td><strong>Domain Name:</strong> </td><td>'.$domain_name.'</td></tr>';
     $mail->Body .= '<tr style="background: #eee;"><td><strong>Domain Provider Name:</strong> </td><td>'.$domain_provider_name.'</td></tr>';
     $mail->Body .= '<tr style="background: #eee;"><td><strong>Domain Provider Id:</strong> </td><td>'.$domain_provider_id.'</td></tr>';
     $mail->Body .= '</table>';
     $mail->Body .= '</body></html>';
    
  
    $message = '</body></html>';
    
    
    

    $mail->send();
    echo 'Email has been sent';

    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";

                 }
                
            


}
 ?>
                   
 