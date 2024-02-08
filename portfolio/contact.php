<?php      
// require './asset/config/init.php';


if(isset($_POST['envoie']) && $_POST['envoie']=='Envoyer le message'){
    // var_dump($_POST['envoie']);
    $envoie = $pdo->prepare('INSERT INTO `messages`(`mail`, `message`) VALUES (
        :mail,
        :message
    )');
    $envoie->bindvalue(':mail',$_POST['mail'],PDO::PARAM_STR);
    $envoie->bindvalue(':message',$_POST['msg'],PDO::PARAM_STR);
    $envoie->execute();
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require'./asset/config/phpMailer/src/Exception.php';
require'./asset/config/phpMailer/src/PHPMailer.php';
require'./asset/config/phpMailer/src/SMTP.php';

if(isset($_POST['mail'])){
    $message = $_POST['msg'];
    $email = $_POST['mail'];
    $message = "Email : ".$email."\n"." message : ".$message;


    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noah.mathey@gmail.com';                     //SMTP username
        $mail->Password   = 'kfuj lxwq ynkx sjcj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('from@example.com', 'PORTFOLIO CONTACT');
        $mail->addAddress('noah.mathey@gmail.com');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "";
    }
}
?>
    <section id="bodyForm1" data-aos="zoom-out">
        <div class="boxForm">
            <span class="borderLine"></span>
            <form method="post" action="">
                <h2 id="contact" style="color:white">Contact</h2>
                <div class="inputBox" id="emailForm">
                    <input type="mail" name="mail" value="" required aria-label="Entrer l'email">
                    <span>Votre Email</span>
                    <i></i>
                </div>
                <div class="inputBox" id="inputBoxMsg">
                    <label for="textareaForm" id="invisible"></label>
                    <textarea value="bonjour stage" type="text" placeholder="Cliquer ici pour écrire votre message" id="textareaForm" name="msg" required></textarea>
                    <i></i>
                </div>
                <input type="submit" name='envoie' value='Envoyer le message' aria-label="Envoyer le message" id="contactSubmit">
            </form>
        </div>
    </section>



    


    </body>
    </html>