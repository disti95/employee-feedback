<link rel="stylesheet" href="style.css">
<svg style="display: none"><symbol id="star" viewBox="0 0 1024 1024"><polygon points="512 0 627 354 999 354 698 572 813 926 512 708 211 926 326 572 25 354 397 354 512 0"/></symbol></svg>

<div id="head_container">
    <img id="logo" src="logo.svg">
</div>

<div id="feedback_container">
<?php
    include 'utils.php';
    session_start();

    if(!isset($_POST["sub"])) {
?>
        <div id="feedback_form">
            <h1 id="feedback__title" class="feedback__title">Bewerten Sie uns!</h1>
            <p id="feedback__description" class="feedback__description">und lassen Sie uns wissen wie zufrieden sie mit unseren Reinigungen
                sind!</p>
            <form class="feedback__form" method="post">
                
                <fieldset class="feedback feedback__userInput">
                    <legend>Kommentar</legend>
                    <div class="flex-container">
                        <textarea id="userInput" name="userInputName" maxlength="500" rows="4" cols="50" placeholder="Schreiben Sie einen Kommentar"></textarea>
                    </div>
                </fieldset>

                <input class="feedback__submit" type="submit" name="sub" value="Feedback senden"/>
            </form>
        </div>

<?php
}
else if(isset($_POST["sub"])) {

    $userInput = htmlspecialchars($_POST["userInputName"], ENT_QUOTES, 'UTF-8');

    // get connection
    $conn = getConnection();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed!");
    }

    // insert (secured Injection)
    $stmt = $conn->prepare("INSERT INTO FEEDBACK (USER_INPUT) VALUES (?)");

    $input = mysqli_real_escape_string($conn, $userInput);
    mysqli_stmt_bind_param($stmt, "s", $input);

    if (mysqli_stmt_execute($stmt) === TRUE) {

        if (!isset($_SESSION['voted'])) {
            $_SESSION['voted'] = true;
        }

        $empfaenger = "tdi@reiwag.at";
        $betreff = "Neue Anonyme Mitarbeiternachricht";
        $from = "From: Mitarbeiternachricht Reiwag";
        $text = "Es wurde eine neue anonyme Mitarbeiternachricht gesendet";

        mail($empfaenger, $betreff, $text, $from, "-f kundenbetreuung@www5.world4you.com.at");

        header("Location: http://employee-feedback.td1.at/voted.php");
        exit();
    } else {
        echo "Ein Fehler ist aufgetreten bitte wenden Sie sich an einen Administrator!";
        //echo "Error: " . $sql . "<br>" . $conn->error;
   }

}
// todo change db relevant things + excel export

?>
</div>