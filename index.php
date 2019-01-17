<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/secret-path/phpmailer_active_set.php';
	$recieverName = 'Юрій Павлович';
	$recieverEmail = 'toki731@gmail.com';
	$letterTheme = 'Мені потрібна консультація!';

if ($_GET['sendmail']==1)
{
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])&&$_POST['action']!='') 
	{
	 	$secret_key = '6LcIingUAAAAANQPPEkd4lVGvD06Rxe-rnJDMVDp';	 	
	 	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
	 	$responseData = json_decode($verifyResponse);
	 	if ($responseData->success==true&&$responseData->score>=0.5)
	 	{	
				  if ($_POST['client-name']!='' and $_POST['email']!='' and $_POST['phone']!='' and $_POST['details']!='') {
				 	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {				 		
				 		$client_phone = ClearPhone($_POST['phone']);
				 		if ($GLOBALS['use_phpmailer']!=0)
				 		{
				 			SendMailByPHPMailer($recieverName, $recieverEmail, $_POST['client-name'], $_POST['email'], $client_phone, $letterTheme, $_POST['details'], $GLOBALS['smtpMode'], $GLOBALS['host'], $GLOBALS['useSmtpAuth'], $GLOBALS['server_login'], $GLOBALS['server_password'], $GLOBALS['encryption'], $GLOBALS['port'], $GLOBALS['sender_email'], $GLOBALS['sender_name'], $GLOBALS['isHtml'], $_POST['use_smtp']);
				 		} else {				 				
				 			SendMail($letterTheme, $recieverName, $recieverEmail, $GLOBALS['sender_name'], $GLOBALS['sender_email'], $_POST['client-name'], $_POST['email'], $client_phone, $_POST['details']);		 				
				 		}
				 		if ($GLOBALS['SendMailError']=='No errors' && $GLOBALS['SettingsError']=='') {
				 			$successCaption = 'Ваш лист успішно відправлено!';
				 			$successText = 'Очікуйте, будь ласка, з вами зв\'яжуться найближчим часом';
				 		}
				 	} 
				 	else {
				 		echo 'Введіть корректну поштову адресу!';
				 	}
				 }			
	 	}

	}

} 
 ?>
<!DOCTYPE html>
<html lang="uk">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.google-analytics.com/analytics.js?id=UA-128045709-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128045709-1');
</script>
<script src='https://www.google.com/recaptcha/api.js?hl=uk&render=6LcIingUAAAAAEwAP7bWOnx1hVSfpaBuBKyAIgQ1'></script>
	<meta charset="UTF-8">
	<title>ProBudDim - Консультації з будівництва</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="ProBudDim, будівельні консультації, строительные консультации, стройка, будівництво, проекти, проекты, смета, ціна, вартість, помилки, кошторис, строительство" />
<meta name="description" content="ProBudDim — консультації з будівництва: 40 років досвіду з будівництва та проектування будівель. Понад 200 задоволених клієнтів" />
	 <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<link rel="stylesheet" href="styles.css"/>	
	<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,500,600,700,900|Open+Sans:400,700,800&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
	<div class="page">
		<div class="nav">
			<div class="container">
				<a class="logo" href="https://<?php echo $_SERVER['HTTP_HOST']; ?>">					
					<ul class="logo-list">
						<li>Проект.</li>
						<li>Будівництво.</li>
						<li>Дім.</li>
					</ul>
				</a>	
				<div class="curtain">
					<ul class="menu-list">
						<li><a href="#company"><span>Про нас</span><i class="null-width"></i></a></li>
						<li><a href="#services"><span>Послуги</span><i class="null-width"></i></a></li>
						<li><a href="#projects"><span>Проекти</span><i class="null-width"></i></a></li>
						<li><a href="#reviews"><span>Відгуки</span><i class="null-width"></i></a></li>
						<li><a href="#feedback"><span>Зв'язок</span><i class="null-width"></i></a></li>
					</ul>
				</div>
				<i class="material-icons main-menu">menu</i>
				<i class="material-icons close-menu">close</i>
			</div>
		</div>
		<div id="company">
			<div class="container">
				<h3>Про нас</h3>
				<p class="text">
					Доброго дня,
				</p>
				<p class="text">
					Мене звати Юрій Павлович і я можу допомогти, якщо Ви знаходитеся на етапі будівництва оселі своєї мрії.
					Я – будівельник із профільною освітою (Київський національний університет будівництва та архітектури) та майже 40-річним досвідом у цій сфері.					
				</p>
				<p class="text">
					Як саме я можу допомогти Вам?
				</p>
				<p class="text">
					Доступно та ефективно проконсультую Вас за помірну ціну. Грамотні рішення при плануванні, будівництві та ремонті дозволять зекономити Вам час, гроші та нерви.
				</p>
				<p class="text">					
					Однією з найважливіших складових будівництва є проект. Я розбираюся у проектуванні і мій досвід підказує, що вже на етапі проектування інженери можуть допускати низку помилок, які пізніше можуть Вам дорого коштувати. Тому перевірю та виправлю помилки в документації.
				</p>
				<p class="text">За необхідності складу кошторис (смету), підібравши оптимальні за ціною та якістю матеріали.</p>
				<p class="text">Отже, якщо Ви плануєте побудувати будинок, або плануєте ремонт придбаної нерухомості і Вам необхідна консультація досвідченого сцеціаліста - Ви звернулися за адресою.</p>
				<p class="text">Вартість консультації залежить від Ваших побажань та об’ємів робіт. Все це можна уточнювати заповнивши форму внизу сторінки</p>
				<p class="text"><strong>Мій досвід - Ваш комфорт та затишок!</strong></p>
			</div>
		</div>
		<div id="services">
			<div class="container">
				<h3>Послуги</h3>				
					<h4><span>Доопрацювання існуючого проекту</span></h4>
					<p>Якщо у вас вже є проектна документація і ви хочете його переробити, покращити або доробити.</p>
					<h4><span>Консультації по існуючому проекту</span></h4>
					<p>Якщо виникли сумніви щодо оптимальності рішення або певні питання з технічного надзору.</p>
					<h4><span>Підбір матеріалів</span></h4>
					<p>Допомога в підборі оптимальних матеріалів для будівництва, розрахунок кошторису та довговічності.</p>
					<h4><span>Рекомендації професіоналів для певних типів робіт</span></h4> 
					<p>Пораджу кращих спеціалістів в тих галузях, які вас цікавлять.</p>
					<div class="clearfix"></div>
			</div>
		</div>
		<div id="projects">
			<div class="container">
				<h3>Проекти</h3>
				<div class="project">
					<div class="project-pic"><img src="img/mersedes.jpg" alt="ЖК Мерседес"></div>
					<div class="project-disc"><p>ЖК Мерседес, Одеса Лідерсівський бульвар, 5. Багатосекційний житловий будинок, з двох поверховим підземним паркінгом, розташований на схилах Чорного моря (пляжний ланжерон). Керував бригадою, яка виконувала монолітні роботи.</p></div>
				</div>
				<div class="project">
					<div class="project-pic"><img src="img/maslozhyrcombinat.jpg" alt="Масложиркомбінат"></div>
					<div class="project-disc"><p>Масложиркомбінат друга черга, Одеса. Побудований для переробки тропічних масел. Керував бригадою яка виконувала монолітні роботи, фасадні роботи</p></div>
				</div>
				<div class="project">
					<div class="project-pic"><img src="img/chudo.jpg" alt="ЖК Чудо Город"></div>
					<div class="project-disc"><p>ЖК Чудо Город, Одеса. Виконував роботи по зведенню монолітного каркаса будівлі. Фундамент, кладка, роботи з утеплення.</p></div>
				</div>
				<div class="project">
					<div class="project-pic"><img src="img/parkovy.jpg" alt="ЖК Парковий"></div>
					<div class="project-disc"><p>ЖК Парковий, Ірпінь Київська область. Участь у доопрацюванні документації по будівлі. Керування бригадою монолітників/фасадників. Індивідуальні вхідні групи до існуючих будинків.</p></div>
				</div>	
				<div class="clearfix"></div>		
			</div>		
		</div>
		<div id="reviews">
			<div class="container">
				<h3>Вдячні клієнти</h3>
				<div class="reviews-slider single-item slick-slider">
					<div class="review">
						<!-- <div class="img-box"><img src="img/port1.jpg" alt=""></div> -->
						<h4>Ірина, 35 років</h4>
						<p>Відкрила приватну стоматологію постало питання робити ремонт у приміщенні, так як знала Юрія Павловича, як відповідальну і серйозну людину, попросила його. Він порадив чудову бригаду, яка за 2 тижні зробила ремонт у приміщенні. Також розробив проект та зробили чудові бетоновані сходи.</p>
					</div>
<!-- 					<div class="review">
						<div class="img-box"><img src="img/port2.jpg" alt=""></div>
						<h4>Василь, 41 рік</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error velit reiciendis tempore officia cupiditate hic itaque molestiae animi facilis iure! Repudiandae reiciendis, sit. Cum, totam vero aut explicabo natus voluptatum.</p>
					</div>
					<div class="review">
						<div class="img-box"><img src="img/port3.jpg" alt=""></div>
						<h4>Василь, 41 рік</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis doloremque sed illo assumenda, facilis delectus enim debitis animi quae aperiam laborum provident temporibus cupiditate, adipisci voluptates ducimus beatae vel sunt.</p>
					</div>
					<div class="review">
						<div class="img-box"><img src="img/port4.jpg" alt=""></div>
						<h4>Василь, 41 рік</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit et obcaecati impedit. Nihil quaerat, ullam sed explicabo? Sed dolore officia itaque ea animi. Necessitatibus, enim impedit! Incidunt ex, quae expedita.</p>
					</div>
					<div class="review">
						<div class="img-box"><img src="img/port5.jpg" alt=""></div>
						<h4>Василь, 41 рік</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti, exercitationem a nisi quae cupiditate praesentium laudantium recusandae, consequuntur tempore? Velit corrupti nesciunt deserunt excepturi inventore magni, accusamus quas quasi?</p>
					</div> -->
				</div>
			</div>
		</div>
		<div id="feedback">
			<iframe class="bg-map" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d77910.7080004308!2d30.529558279381938!3d50.44846688152404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1suk!2sua!4v1540421621609" frameborder="0" allowfullscreen></iframe>
			<div class="container">				
				<form action="?sendmail=1" method="POST">
					<input type="text" class="name" name="client-name" required placeholder="Ваше ім'я">
					<input type="phone" class="tel" name="phone" required placeholder="Контактний телефон">
					<input type="email" class="email" name="email" required placeholder="Email">
					<textarea name="details" required placeholder="Напишіть ваше питання..."></textarea>
					<div class="button-box">
						<button class="btn btn-bg" type="submit">Відправити</button>
						<button class="btn btn-bg" type="reset">Очистити</button>					
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="footer">
			<div class="container">
				<p>Створено T.W. &copy 2018-2018</p>
				<h4>Долучайтесь до нас на facebook</h4>
				<!-- <a href="#" target="_blank" class="fb"></a> -->
<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/Probuddim/&layout=standard&action=recommend&size=large&show_faces=true&share=true&height=80&appId" height="80" style="border:none;overflow:hidden;float:right;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="success-curtain">
		<div class="send-success">
			<p><?php echo $successCaption; ?></p>
			<p><?php echo $successText; ?></p>
		</div>
	</div>
</body>
  <script type="text/javascript" src="jquery-3.1.0.js"></script>
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script type="text/javascript" src="maskinput.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript" src="secret-path/javascript/main.js"></script>
  <script>
    $('form').submit(function() { 
        // we stoped it
        event.preventDefault();
        // needs for recaptacha ready
        grecaptcha.ready(function() {
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('6LcIingUAAAAAEwAP7bWOnx1hVSfpaBuBKyAIgQ1', {action: 'send_letter'}).then(function(token) {
                // add token to form
                $('form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $('form').prepend('<input type="hidden" name="action" value="send_letter">');
                // submit form now
                $('form').unbind('submit').submit();
            });;
        });
    });
</script>
</html>