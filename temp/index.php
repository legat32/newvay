
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Пример формы обработной связи с подсказками DaData.ru">
    <meta name="author" content="algenon">

    <title>Обращение в правительство Москвы</title>

    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap-3.1.1.min.css">
    <link rel="stylesheet" href="css/suggestions.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- CORS fallback for IE 8 & 9-->
    <!--[if lt IE 10]>
        <script src="js/jquery.xdomainrequest-1.0.1.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">

        <div class="page-header">
            <h1>Обращение в правительство Москвы</h1>
            <p class="lead">Пожалуйста, укажите ваши контактные данные и суть вопроса</p>
        </div>

        <form role="form" id="feedback-form">

            <div class="row">
                <div class="col-xs-12 col-md-6">

                    <!-- ФИО -->
                    <div class="form-group">
                        <label for="fullname">ФИО</label><span class="required">&nbsp;∗</span>
                        <input type="text" class="form-control" id="fullname" placeholder="Введите ФИО в свободной форме" autofocus>
                    </div>
                    <div class="suggestion">
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="fullname-surname">Фамилия</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="fullname-surname" required>
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="fullname-name">Имя</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="fullname-name" required>
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="fullname-patronymic">Отчество</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="fullname-patronymic">
                            </div>
                        </div>
                    </div>

                    <!-- Телефон -->
                    <div class="form-group">
                        <label for="phone">Контактный телефон</label>
                        <input type="tel" class="form-control" id="phone" placeholder="+7 916 123-45-67">
                    </div>

                    <!-- Email-->
                    <div class="form-group">
                        <label for="email">E-mail</label><span class="required">&nbsp;∗</span>
                        <input type="email" class="form-control" id="email" placeholder="me@example.com" required>
                    </div>

                </div>
                <div class="col-xs-12 col-md-6">

                    <!-- Адрес -->
                    <div class="form-group">
                        <label for="address">Адрес</label><span class="required">&nbsp;</span>
                        <input type="text" class="form-control" id="address" placeholder="Введите адрес в свободной форме">
                    </div>
                    <div id="address-suggestion" class="suggestion">
                    </div>
                    <div class="suggestion">
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="address-postal_code">Индекс</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="address-postal_code">
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="address-region">Регион</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="address-region" readonly tabindex="-1">
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="address-city">Город</label>
                            </div>
                            <div class="col-sm-10 col-md-10 ">
                                <input type="text" class="form-control suggestion-editable" id="address-city">
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="address-street">Улица</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="address-street">
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="address-house">Дом</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="address-house">
                            </div>
                        </div>
                        <div class="row suggestion-item">
                            <div class="col-sm-2 col-md-2">
                                <label for="address-flat">Квартира</label>
                            </div>
                            <div class="col-sm-10 col-md-10">
                                <input type="text" class="form-control suggestion-editable" id="address-flat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Обращение -->
            <div class="form-group">
                <label for="message">Содержание обращения</label><span class="required">&nbsp;∗</span>
                <textarea class="form-control" id="message" rows="5" required></textarea>
            </div>

            <div class="progress" style="display: none;">
                <div id="feedback-progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                <span class="sr-only"></span>
                </div>
            </div>

            <div id="feedback-message" class="alert alert-danger fade in" style="display: none;">
                <h4></h4>
                <p data-message></p>
                <p>
                    <button type="button" class="btn btn-default" data-action="ok">Хорошо, я понял</button>
                </p>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg">Отправить обращение</button>
            </div>

        </form>

    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <!--[if lt IE 10]>
    <script src="js/jquery.xdomainrequest-1.0.1.min.js"></script>
    <![endif]-->
    <script src="js/jquery.suggestions-4.3.min.js"></script>
    <script src="js/dadata.js"></script>
    <script src="js/suggest.js"></script>
    <script src="js/main.js"></script>
</body>

</html>