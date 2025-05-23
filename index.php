<?
    require_once 'model\json_reader.php';
    session_start();
    if(!isset($_SESSION['start'])) {
        $settings = json_reader::read_file("./test/settings.json");
        $_SESSION['start'] = $settings["start"];
    }
    if(isset($_GET['step'])) {
        $step = $_GET['step'];
    }
    $start = $_SESSION['start'];
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Хто ти в світі ХНУРЕ?</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="./style/site.css">

</head>
<body>
<header>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo center"><img src="https://nure.ua/wp-content/themes/nure/images/logo.png?v=2.0"></a>
    </div>
</nav>
</header>
<main class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center blue-text">Хто ти в світі <a href="nure.ua">ХНУРЕ</a>?</h1>
        <?
        if(!isset($step)){
        ?>

        <div class="row center">
            <h5 class="header col s12 light">Думаєш над майбутньою професією? Бажаєш знайти краще майбутнє для себе? Проходь тест, та дізнавайся, яка спеціальність тобі ближче!</h5>

        </div>
        <div class="row center">
            <a href="<? echo $url."?step=$start" ?>" id="start-button" class="btn-large waves-effect waves-light orange">Розпочати</a>
        </div>
        <br><br>
        <?
        }
        else
        {
            $question = json_reader::read_file("./test/$step.json");
        ?>
            <div class="row center">
                <h5 class="header col s12 light">
                    <?
                        echo $question["text"]
                    ?>
                </h5>
            </div>
            <div class="row center">
                <?
                    foreach($question['answers'] as $answer) {
                        $answerText = $answer["answer"];
                        $answerNextId = $answer["nextId"];

                ?>
                    <a href="<? echo $url."?step=$answerNextId" ?>" id="answer-button" class="btn-large waves-effect waves-light orange"><? echo $answerText ?></a>
                <?
                    }
                ?>
                <br /><br />
                <a href="<? echo $url."?step=$start" ?>" id="start-button" class="btn waves-effect waves-light grey">Розпочати наново</a>
            </div>
        <?
        }
        ?>
    </div>
</main>

<footer class="page-footer blue">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">ХНУРЕ</h5>
                <p class="grey-text text-lighten-4">Перший серед кращих!</p>
            </div>
            <div class="col l6 s12">
                <h5 class="white-text">Контакти приймальної комісії</h5>
                <ul>
                    <li><i class="material-icons tiny">place</i><a class="white-text" href="https://maps.app.goo.gl/XqnzXmndxi9fjmHD9">пр. Науки, 14, м. Харків, 61166, Україна</a></li>
                    <li><i class="material-icons tiny">email</i><a class="white-text" href="mailto:abitur@nure.ua">abitur@nure.ua</a></li>
                    <li><i class="material-icons tiny">phone</i><a class="white-text" href="tel:+380577021720">+38(057)7021720</a></li>
                    <li><i class="material-icons tiny">phone</i><a class="white-text" href="tel:+380974189953">+38(097)4189953</a></li>
                    <li><i class="material-icons tiny">phone</i><a class="white-text" href="tel:+380954201113">+38(095)4201113</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Зроблено в <a class="orange-text text-lighten-3" href="https://nure.ua">ХНУРЕ</a> - 2025
        </div>
    </div>
</footer>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
