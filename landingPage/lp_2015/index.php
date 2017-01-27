<?php 
$basePath = get_stylesheet_directory_uri () . '/landingPage/'. get_post_meta(get_the_ID(), 'folder_name')[0] . '/';
?>
<link rel="stylesheet" type="text/css" href="<?php echo $basePath.'style.css' ?>">
<div id="container" onload="ODKL.init();">
	<a href="<?php echo site_url ();?>/login" target="_blank"
		style="position: absolute; top: -30px; right: 30px; z-index: 10; color: #0080ca; font-size: 100%; font-weight: 600;">
		Уже е�?ть login? </a>
	<div id="header">
		<h1>ОС�?ОВЫ К�?ББ�?ЛЫ</h1>
		<span id="subtitle">Бе�?платный онлайн-кур�? - новый опыт в Вашей жизни
			от С�?МОЙ ПРИРОДЫ</span>

	</div>
	<div class="divider"></div>
	<div class="divider"></div>
	<div id="tabs">
		<div id="navigation">
			<ul>
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'home'])"
					id="nav-home" href="#home"><span>Главна�?</span></a></li>
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'what-you-will-get'])"
					id="nav-topics" href="#topics"><span>Что да�?т вам �?тот кур�?</span></a></li>
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'whats-in-the-course'])"
					id="nav-desc" href="#course-description"><span>Содержание кур�?а</span></a></li>
				<!-- <li><a onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'free-authentic-books'])" id="nav-books" href="#books"><span>Первои�?точники и учебна�? литература</span></a></li> -->
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'what-others-say'])"
					id="nav-testim" href="#testimonials"><span>Отзывы об �?том кур�?е</span></a></li>
			</ul>
		</div>
		<div id="mainContent">
			<div id="home">
				<!-- <div id="fall-sticker">
					<a
						onClick="_gaq.push(['_trackEvent', 'registration','buttons', 'home-sticker'])"
						class="reg-button" href="#signup"><img
						src="<?php echo $basePath.'images'; ?>/spring_2016_sticker.png"
						alt="Зима 2016" /></a>
				</div>
				<h2>�?ачало зан�?тий 11 ма�?</h2>
				<h2>Запи�?ь продлит�?�? до 12 июн�?</h2>-->
				<h1>.</h1>
				<div class="divider"></div>
				<div class="divider"></div>
				<h1>Реги�?траци�? продлит�?�? до 31 �?нвар�?<br />СЕЙЧ�?С З�?�?ЧИТЕЛЬ�?ЫЙ МОМЕ�?Т В ТВОЕЙ ЖИЗ�?И. ВЫБОР З�? ТОБОЙ!</h1>
				<div id="signup">
					<a
						onClick="_gaq.push(['_trackEvent', 'registration','buttons', 'home-signup'])"
						class="reg-button" href="#register"><img
						alt="Зареги�?трировать�?�? на кур�?"
						src="<?php echo $basePath.'images'; ?>/signup.png" /></a>
				</div>
				<div class="divider"></div>
			</div>
			<div class="subpage">
				    <iframe width="580" height="435"
					src="http://www.youtube.com/embed/Jt7kJfn9Z2c?rel=0"
					frameborder="0" allowfullscreen></iframe> 

				<h2>Этот кур�? вам позволит:</h2>
				<ul>
					<li>ра�?крыть фундаментальные законы природы, законы развити�?
						человека �?мы�?л в�?ей его жизни</li>
					<li>�?по�?обы во�?при�?ти�? и�?тинной реально�?ти, наход�?щей�?�? за
						пределами 5 органов во�?при�?ти�? материального мира.
					
					<li>выйти за границы наших ощущений и по�?тичь общий закон
						мироздани�?, наход�?�?ь в �?том мире, зде�?ь и �?ейча�?.
				
				</ul>

				<div class="divider"></div>

			</div>

			<div id="topics" class="subpage">
				<h1>ЧТО Д�?СТ В�?М ЭТОТ КУРС</h1>
				<div class="slideshow">
					<img alt="ЧТО Д�?СТ В�?М ЭТОТ КУРС"
						src="<?php echo $basePath.'images'; ?>/lc-1.jpg"
						width="225" height="166" /> <img alt="ЧТО Д�?СТ В�?М ЭТОТ КУРС"
						src="<?php echo $basePath.'images'; ?>/lc-2.jpg"
						width="225" height="166" /> <img alt="ЧТО Д�?СТ В�?М ЭТОТ КУРС"
						src="<?php echo $basePath.'images'; ?>/lc-3.jpg"
						width="225" height="166" />
				</div>
				<ul>
					<li>Твердую о�?нову и�?тинной каббали�?тиче�?кой методики</li>
					<li>Глубокое понимание природы, мира и ме�?та Человека в нем</li>
					<li>Ключи к развитию более вы�?оких �?о�?то�?ний во�?при�?ти�?</li>
					<li>Уникальные переживани�?, до�?тупные только через и�?тинные
						каббали�?тиче�?кие и�?точники</li>
					<li>�?еобходимую базу дл�? изучени�? книги Зоар</li>
				</ul>
				<div class="divider"></div>
				<!-- <h2>3 Kabbalistic principles in relation to the course:</h2>
				<ol id="3principles">
					<li><h3>There is no coercion in spirituality</h3><span>You advance at your own pace.</span></li>
					<li><h3>One's soul shall teach one</h3><span>Your own desire will guide you toward finding the fulfillment it seeks.</span></li>
					<li><h3>The purpose of creation is on the shoulders of the whole of the human race</h3><span>This study is open to everyone, regardless of any of the seeming differences among people (age, race, gender, culture, faith, etc.).</span></li>
				</ol> -->
				<div style="width: 600px; margin: 0 auto 0 30px;">

					<img alt="3 Kabbalistic Principles"
						src="<?php echo $basePath.'images'; ?>/3-kabbalistic-principles.jpg" />
				</div>

				<div class="divider"></div>
			</div>
			<div id="course-description" class="subpage">
				<div id="what-in-course">
					<div class="divider"></div>
					<h1>О кур�?е</h1>
					<div class="slideshow">
						<img alt="ЧТО Д�?СТ В�?М ЭТОТ КУРС"
							src="<?php echo $basePath.'images'; ?>/lc-4.jpg"
							width="225" height="166" /> <img alt="ЧТО Д�?СТ В�?М ЭТОТ КУРС"
							src="<?php echo $basePath.'images'; ?>/lc-5.jpg"
							width="225" height="166" /> <img alt="ЧТО Д�?СТ В�?М ЭТОТ КУРС"
							src="<?php echo $basePath.'images'; ?>/lc-6.jpg"
							width="225" height="166" />
					</div>
					<ul>
						<li>Продолжительно�?ть 1-го �?еме�?тра базового кур�?а “О�?новы каббалы�? - 10 недель. По четвергам мы вы�?тавл�?ем на �?траницу �?тудента и вы�?ылаем вам урок, включающий лекции, те�?ты, дополнительные материалы и возможно�?ть задать вопро�?ы преподавател�?м. По �?редам проходит вебинар, на котором преподаватели объ�?�?н�?ют трудные а�?пекты темы зан�?ти�? и отвечают на ваши вопро�?ы. Во врем�? вебинара вы можете задавать вопро�?ы. Видеозапи�?ь вебинара вы�?тавл�?ет�?�? в архив.</li>
						<li>Продолжительно�?ть 2-го �?еме�?тра - 10 недель.</li>
						<li>По итогам обучени�? 21 ма�? конференци�? в не�?кольких городах (предположительно в Мо�?кве, Екатеринбурге и Оде�?�?е).</li>
						<li>По завершении обучени�? вы получите диплом выпу�?кника Международной академии каббалы.</li>
					</ul>

					<div class="divider"></div>
				</div>
			</div>
			<div id="register" class="subpage">
				<h1>Реги�?траци�? на кур�? откроет�?�? 11 декабр�?.</h1>
				<!--<h1>Реги�?траци�?</h1>
				<?php echo do_shortcode ( '[registerForm enrollto=57113]' );?>
				<div class="divider"></div> -->
			</div>
			<div id="testimonials" class="subpage">
				<h1>ОТЗЫВЫ ОБ ЭТОМ КУРСЕ</h1>

				<iframe width="580" height="435"
					src="http://www.youtube.com/embed/1QEq6TCtaYc?rel=0"
					frameborder="0" allowfullscreen></iframe>

				<div class="divider"></div>
				<div class="divider"></div>
				<div id="testimonials-list">

					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/smirnov1.jpg"
							alt="Дмитрий Смирнов" />
						<h2>
							Дмитрий Смирнов<br />(Мо�?ква, менеджер, 39 лет)
						</h2>
						<p>
							Мудро�?ть, заложенна�? в книгах по каббале, <b>поражает �?воей
								глубиной и про�?тотой одновременно</b>. Она ра�?крывает человеку
							законы, заложенные в о�?нове развити�? мира, в о�?нове развити�?
							природы человека. И что �?амое главное, - ра�?�?казывает о причине и
							цели �?того развити�?.<br /> Сколько непри�?тных �?итуаций в жизни
							можно было бы избежать, знай �? об �?том раньше. Знание о�?нов
							каббалы <b>даёт человеку о�?ознание прои�?ход�?щего �? ним и �? миром</b>.
							Это удивительна�? методика. Она подарила мне новых друзей, новый
							мир, новую жизнь.
						</p>
					</div>

					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/volkova1.jpg"
							alt="Волкова Юли�?" />
						<h2>
							Волкова Юли�?<br />(Мо�?ква, педагог-п�?ихолог (раннего возра�?та) в
							дет�?ком �?аду, 25 лет)
						</h2>
						<p>
							С удоволь�?твием при�?ут�?твую на кур�?ах науки каббала. �?а многие
							вопро�?ы нахожу ответы. Каждый раз ра�?крываю что-то новое дл�? �?еб�?
							и дл�? других.</b>
						</p>
					</div>

					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/tkachenko1.jpg"
							alt="�?ртём Ткаченко" />
						<h2>
							�?ртём Ткаченко <br />(Киев, менеджер малого бизне�?а, 25 лет)
						</h2>
						<p>
							Каждому человеку каббала даёт возможно�?ть по�?тичь �?крытую ча�?ть
							мироздани�?. Увидеть мир от кра�? до кра�? и <b>узнать �?воё и�?тинное
								предназначение</b>.
						</p>
					</div>


					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/nedelyaeva1.jpg"
							alt="�?едел�?ева Ирина" />
						<h2>
							�?едел�?ева Ирина <br />(Мо�?ква, 23 года)
						</h2>
						<p>
							Каббала, как наука очень и очень интере�?на. Ее изучение не про�?то
							интере�?но дл�? �?об�?твенного развити�?, но лично мне она <b>помогает
								выживать в наше нелегкое и �?гои�?тичное врем�?</b>. Я интере�?ую�?ь
							ею �? 2004 года, но он-лайн кур�?ы начала �?лушать �?ов�?ем недавно и
							они только подогревают мен�? изучить в�?ё до�?конально, открыть в
							�?ебе "творца" или как �? говорю "открыть тайну природы" или даже
							моего быти�?. <b>Дл�? в�?его е�?ть причина</b> и пон�?ть ее могут
							помочь лучшие преподаватели, дл�? мен�? �?то М�?К!
						</p>
					</div>
					<div class="tesimonial">
						<p>
							<a id="scrollTop" href="#container">Вверх &raquo;</a>
						</p>
					</div>

				</div>
				<div class="divider"></div>
				<div id="signup">
					<a
						id="registration-online"
						class="reg-button" href="#register"><img
						alt="Зареги�?трировать�?�? на кур�?"
						src="<?php echo $basePath.'images'; ?>/signup.png" /></a>
				</div>
				<br /> <br /> <span
					style="font-size: 16px; text-align: center; display: block;"> <a
					href="<?php echo site_url ();?>/login" target="_blank"
					style="font-size: 14px; color: #5b595f; font-family: Arial, Helvetica, sans-serif;">
						<u>вход дл�? зареги�?трированных пользователей</u>
				</a>
				</span>
				<div class="divider"></div>
			</div>
		</div>

	</div>
</div>
