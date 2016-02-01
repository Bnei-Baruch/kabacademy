<?php 
$basePath = get_stylesheet_directory_uri () . '/landingPage/'. get_post_meta(get_the_ID(), 'folder_name')[0] . '/';
?>
<link rel="stylesheet" type="text/css" href="<?php echo $basePath.'style.css' ?>">
<div id="container" onload="ODKL.init();">
	<a href="<?php echo site_url ();?>/login" target="_blank"
		style="position: absolute; top: -30px; right: 30px; z-index: 10; color: #0080ca; font-size: 100%; font-weight: 600;">
		Уже есть login? </a>
	<div id="header">
		<h1>ОСНОВЫ КАББАЛЫ</h1>
		<span id="subtitle">Бесплатный онлайн-курс - новый опыт в Вашей жизни
			от САМОЙ ПРИРОДЫ</span>

	</div>
	<div class="divider"></div>
	<div class="divider"></div>
	<div id="tabs">
		<div id="navigation">
			<ul>
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'home'])"
					id="nav-home" href="#home"><span>Главная</span></a></li>
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'what-you-will-get'])"
					id="nav-topics" href="#topics"><span>Что даст вам этот курс</span></a></li>
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'whats-in-the-course'])"
					id="nav-desc" href="#course-description"><span>Содержание курса</span></a></li>
				<!-- <li><a onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'free-authentic-books'])" id="nav-books" href="#books"><span>Первоисточники и учебная литература</span></a></li> -->
				<li><a
					onClick="_gaq.push(['_trackEvent', 'Pages','inbound', 'what-others-say'])"
					id="nav-testim" href="#testimonials"><span>Отзывы об этом курсе</span></a></li>
			</ul>
		</div>
		<div id="mainContent">
			<div id="home">
				<div id="fall-sticker">
					<a
						onClick="_gaq.push(['_trackEvent', 'registration','buttons', 'home-sticker'])"
						class="reg-button" href="#signup"><img
						src="<?php echo $basePath.'images'; ?>/winter_2016_sticker.png"
						alt="Зима 2016" /></a>
				</div>
				<h2>Начало обучения 17 января</h2>
				<h3>Запись продлится до 31 января</h3>
				<div class="divider"></div>
				<h1>СЕЙЧАС ЗНАЧИТЕЛЬНЫЙ МОМЕНТ В ТВОЕЙ ЖИЗНИ. ВЫБОР ЗА ТОБОЙ!</h1>
				<div id="signup">
					<a
						onClick="_gaq.push(['_trackEvent', 'registration','buttons', 'home-signup'])"
						class="reg-button" href="#register"><img
						alt="Зарегистрироваться на курс"
						src="<?php echo $basePath.'images'; ?>/signup.png" /></a>
				</div>
				<div class="divider"></div>
			</div>
			<div class="subpage">
				<iframe width="580" height="435"
					src="http://www.youtube.com/embed/Jt7kJfn9Z2c?rel=0"
					frameborder="0" allowfullscreen></iframe>

				<h2>Этот курс вам позволит:</h2>
				<ul>
					<li>раскрыть фундаментальные законы природы, законы развития
						человека смысл всей его жизни</li>
					<li>способы восприятия истинной реальности, находящейся за
						пределами 5 органов восприятия материального мира.
					
					<li>выйти за границы наших ощущений и постичь общий закон
						мироздания, находясь в этом мире, здесь и сейчас.
				
				</ul>

				<div class="divider"></div>

			</div>

			<div id="topics" class="subpage">
				<h1>ЧТО ДАСТ ВАМ ЭТОТ КУРС</h1>
				<div class="slideshow">
					<img alt="ЧТО ДАСТ ВАМ ЭТОТ КУРС"
						src="<?php echo $basePath.'images'; ?>/lc-1.jpg"
						width="225" height="166" /> <img alt="ЧТО ДАСТ ВАМ ЭТОТ КУРС"
						src="<?php echo $basePath.'images'; ?>/lc-2.jpg"
						width="225" height="166" /> <img alt="ЧТО ДАСТ ВАМ ЭТОТ КУРС"
						src="<?php echo $basePath.'images'; ?>/lc-3.jpg"
						width="225" height="166" />
				</div>
				<ul>
					<li>Твердую основу истинной каббалистической методики</li>
					<li>Глубокое понимание природы, мира и места Человека в нем</li>
					<li>Ключи к развитию более высоких состояний восприятия</li>
					<li>Уникальные переживания, доступные только через истинные
						каббалистические источники</li>
					<li>Необходимую базу для изучения книги Зоар</li>
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
					<h1>СОДЕРЖАНИЕ КУРСА</h1>
					<div class="slideshow">
						<img alt="ЧТО ДАСТ ВАМ ЭТОТ КУРС"
							src="<?php echo $basePath.'images'; ?>/lc-4.jpg"
							width="225" height="166" /> <img alt="ЧТО ДАСТ ВАМ ЭТОТ КУРС"
							src="<?php echo $basePath.'images'; ?>/lc-5.jpg"
							width="225" height="166" /> <img alt="ЧТО ДАСТ ВАМ ЭТОТ КУРС"
							src="<?php echo $basePath.'images'; ?>/lc-6.jpg"
							width="225" height="166" />
					</div>
					<ul>
						<li>Самостоятельное обучение можно начать в любой момент</li>
						<li>Бесплатный доступ к оригинальным текстам</li>
						<li>Возможность участия в онлайн-сообществе</li>
						<li>Базовое обучение - 12 недель <br />(24 занятия, 2 занятия в
							неделю), полный курс обучения 36 недель (основы науки каббала =
							12 недель, основы продвижения = 12 недель, практическая каббала =
							12 недель)
						</li>
						<li>Если вы пропустили занятие, запись урока доступна для
							свободного скачивания</li>
					</ul>

					<div class="divider"></div>
				</div>
			</div>
			<div id="register" class="subpage">
				<h1>Регистрация</h1>
				<?php echo do_shortcode ( '[registerForm enrollto=5505]' );?>
				<div class="divider"></div>
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
							Дмитрий Смирнов<br />(Москва, менеджер, 39 лет)
						</h2>
						<p>
							Мудрость, заложенная в книгах по каббале, <b>поражает своей
								глубиной и простотой одновременно</b>. Она раскрывает человеку
							законы, заложенные в основе развития мира, в основе развития
							природы человека. И что самое главное, - рассказывает о причине и
							цели этого развития.<br /> Сколько неприятных ситуаций в жизни
							можно было бы избежать, знай я об этом раньше. Знание основ
							каббалы <b>даёт человеку осознание происходящего с ним и с миром</b>.
							Это удивительная методика. Она подарила мне новых друзей, новый
							мир, новую жизнь.
						</p>
					</div>

					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/tokarenko1.jpg"
							alt="Ольга Токаренко" />
						<h2>
							Ольга Токаренко<br />(Одесса, художник, 30 лет)
						</h2>
						<p>
							Я долго искала ответы на вопросы о смысле моей жизни; это были
							религии, учения, тренинги и прочее, но ни одна из этих методик не
							удовлетворяла моего любопытства, ни одной из них я не верила. И
							тут я узнала о каббале и сразу почувствовала, что <b>это -
								настоящее, тут мне скажут правду</b>. Так и произошло - мне
							открылись знания об устройстве окружающего меня мира, <b>жизнь
								приобрела новые смыслы и заиграла новыми красками</b>.
						</p>
					</div>

					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/volkova1.jpg"
							alt="Волкова Юлия" />
						<h2>
							Волкова Юлия<br />(Москва, педагог-психолог (раннего возраста) в
							детском саду, 25 лет)
						</h2>
						<p>
							С удовольствием присутствую на курсах науки каббала. На многие
							вопросы нахожу ответы. Каждый раз раскрываю что-то новое для себя
							и для других.</b>
						</p>
					</div>

					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/tkachenko1.jpg"
							alt="Артём Ткаченко" />
						<h2>
							Артём Ткаченко <br />(Киев, менеджер малого бизнеса, 25 лет)
						</h2>
						<p>
							Каждому человеку каббала даёт возможность постичь скрытую часть
							мироздания. Увидеть мир от края до края и <b>узнать своё истинное
								предназначение</b>.
						</p>
					</div>


					<div class="tesimonial">
						<img
							src="<?php echo $basePath.'images'; ?>/nedelyaeva1.jpg"
							alt="Неделяева Ирина" />
						<h2>
							Неделяева Ирина <br />(Москва, 23 года)
						</h2>
						<p>
							Каббала, как наука очень и очень интересна. Ее изучение не просто
							интересно для собственного развития, но лично мне она <b>помогает
								выживать в наше нелегкое и эгоистичное время</b>. Я интересуюсь
							ею с 2004 года, но он-лайн курсы начала слушать совсем недавно и
							они только подогревают меня изучить всё досконально, открыть в
							себе "творца" или как я говорю "открыть тайну природы" или даже
							моего бытия. <b>Для всего есть причина</b> и понять ее могут
							помочь лучшие преподаватели, для меня это МАК!
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
						alt="Зарегистрироваться на курс"
						src="<?php echo $basePath.'images'; ?>/signup.png" /></a>
				</div>
				<br /> <br /> <span
					style="font-size: 16px; text-align: center; display: block;"> <a
					href="<?php echo site_url ();?>/login" target="_blank"
					style="font-size: 14px; color: #5b595f; font-family: Arial, Helvetica, sans-serif;">
						<u>вход для зарегистрированных пользователей</u>
				</a>
				</span>
				<div class="divider"></div>
			</div>
		</div>

	</div>
</div>