<?php function post($url, $postVars) {
        $options = array(
            "http" =>
                array(
                    "method"  => "POST",
                    "header"  => "Content-type: application/json",
                    "content" => $postVars
                )
        );
        $streamContext  = stream_context_create($options);
        $result = file_get_contents($url, false, $streamContext);
        if ($result === false) {
            $error = error_get_last();
            throw new Exception("POST request failed: " . $error['message']);
        }
    return $result;
    }

    $input = <<<EOL
    <form class="form-contact text-primary" action="/static/php/contact.php" method="post">
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-user fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <input type="text" class="form-control rounded-pill mx-1" id="inputFirstName" name="inputFirstName" aria-label="First Name" placeholder="First Name" required>
                <input type="text" class="form-control rounded-pill mx-1" id="inputLastName" name="inputLastName" aria-label="Last Name" placeholder="Last Name" required>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <input type="tel" class="form-control rounded-pill mx-1" id="inputPhone" name="inputPhone" aria-label="Phone" placeholder="Phone" required>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <input type="email" class="form-control rounded-pill mx-1" id="inputEmail" name="inputEmail" aria-label="Email" placeholder="Email" required>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-paper-plane mr-2"></i>Submit</button>
        </div>
    </form>
    EOL;

    $output = <<<EOL
    <form class="form-contact text-primary" action="/static/vcf/romaincaraes.vcf" method="get">
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <a class="form-control btn btn-light rounded-pill mx-1" href="tel:+33123456789">+33 (0)1 23 45 67 89</a>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <a class="form-control btn btn-light rounded-pill mx-1" href="mailto:email@domain.com">email@domain.com</a>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-desktop fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <a class="form-control btn btn-light rounded-pill mx-1" href="//romaincaraes.fr" target="_blank">romaincaraes.fr</a>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-linkedin fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <a class="form-control btn btn-light rounded-pill mx-1" href="//linkedin.com/in/romaincaraes" target="_blank">Romain Caraës</a>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <a class="form-control btn btn-light rounded-pill mx-1" href="//twitter.com/romaincaraes" target="_blank">@romaincaraes</a>
            </div>
        </div>
        <div class="form-label-group mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="fa-stack fa-1x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <a class="form-control  btn btn-light rounded-pill mx-1" href="//github.com/romaincaraes" target="_blank">@romaincaraes</a>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-address-card mr-2"></i>Download</button>
        </div>
    </form>
    EOL;

    $card = $input;

    if (!empty($_POST)) {
        extract($_POST);

        $inputName = $inputFirstName . " " . $inputLastName;

        $data = json_encode(array(
            "records" => array(array(
                "fields" => array(
                    "Name" => $inputName,
                    "Phone" => $inputPhone,
                    "Email" => $inputEmail
                )
            ))
        ));

        $valid = true;
        $br= "\r\n";

        if ($valid) {
            // Send a notification email to email@domain.com
            $to = "email@domain.com";

            $subject = "I just downloaded your vCard";

            $message = "<h3>Here are my contact details :</h3>";
            $message .= "<p>Name : " . $inputName . "</p>";
            $message .= "<p>Email : " . $inputEmail . "</p>";
            $message .= "<p>Phone : " . $inputPhone . "</p>";
            $header = "From: " . $inputName . " <" . $inputEmail . ">" . $br;
            $header .= "Reply-To: " . $to . $br;
            $header .= "Content-Type: text/html; charset=utf-8" . $br;

            $sent = mail($to, $subject, $message, utf8_decode($header));
            if ($sent) {
                $error = "Your message was sent !";
                $card = $output;
            }
            else {
                $error = "An error occured, please start again !";
            }
        }
    }
    else {
        $error = "POST invalid !";
    }?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Romain Caraës</title>

        <link rel="author" type="text/plain" href="/humans.txt"/>
        <link rel="icon" href="/static/img/favicon.ico"/>
        <link rel="apple-touch-icon" href="/static/img/icon.png"/>

        <meta name="description" content="">
        <meta name="author" content="Romain Caraës">

        <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Inter:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="//use.fontawesome.com/releases/v5.15.1/css/all.css">
        <link type="text/css" rel="stylesheet" href="/static/css/style.css">
    </head>
    <body class="bg-dark">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 m-auto">
                    <div class="card bg-dark text-light border-0">
                        <div class="card-body">
                            <h1 class="card-title mb-3">Contact</h1>
                            <?php echo $card; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="//code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="/static/js/script.js"></script>
    </body>
</html>
