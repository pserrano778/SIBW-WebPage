-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2020 a las 17:35:30
-- Versión del servidor: 10.4.11-MariaDB-log
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sibw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `fechaComentario` timestamp NOT NULL DEFAULT current_timestamp(),
  `autorComentario` varchar(100) DEFAULT NULL,
  `textoComentario` text DEFAULT NULL,
  `idEvento` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `modificadoPorMod` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `fechaComentario`, `autorComentario`, `textoComentario`, `idEvento`, `email`, `modificadoPorMod`) VALUES
(1, '2020-05-12 11:29:38', 'Pedro', 'Prueba comentarios.', 1, 'pedro@prueba.se', 1),
(15, '2020-05-13 15:26:11', 'Pedro', '****..', 3, 'pedro@prueba.se', 1),
(16, '2020-05-13 23:10:22', 'Usuario2', '12345', 2, 'user@try.es', 1),
(17, '2020-05-14 02:50:32', 'Pedro', 'prueba', 2, 'pedro@prueba.se', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlacesevento`
--

CREATE TABLE `enlacesevento` (
  `idEnlace` int(11) NOT NULL,
  `enlace` text CHARACTER SET utf8 DEFAULT NULL,
  `textoEnlace` varchar(100) DEFAULT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enlacesevento`
--

INSERT INTO `enlacesevento` (`idEnlace`, `enlace`, `textoEnlace`, `idEvento`) VALUES
(1, 'https://www.eurorounders.com/', 'Página del organizador', 1),
(2, 'https://circuitonacionaldepoker.es/el-cnp-es-familia-eurorounders/', 'Información adicional', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetaseventos`
--

CREATE TABLE `etiquetaseventos` (
  `etiqueta` varchar(20) NOT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etiquetaseventos`
--

INSERT INTO `etiquetaseventos` (`etiqueta`, `idEvento`) VALUES
('Azar', 2),
('Cartas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `organizador` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `rutaImagenPortada` varchar(100) DEFAULT NULL,
  `textoImagenPortada` varchar(100) DEFAULT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `lugar`, `descripcion`, `organizador`, `fecha`, `rutaImagenPortada`, `textoImagenPortada`, `publicado`) VALUES
(1, 'Euro Poker Million', 'Casino&Hotel Perla en Nova Gorica - Eslovenia', 'Del 20 de julio al 4 de Agosto se celebra en la localidad eslovena de Nova Gorica uno de los eventos más grandes en el sector del Póker, el Euro Poker Million, tal y como su nombre indica, garantiza un millón de euros, donde además ,como mínimo, 250.000€ irán destinados para el campeón.\r\nLa estructura diseñada por la organización garantiza una gran jugabilidad: Los jugadores suelen buscar un buen stack inicial (60.000 puntos de inicio) y una duración progresiva de los niveles, que irán desde los 40 minutos el primer día, 50 y 60 minutos en las etapas intermedias y, 75 minutos en la mesa final. La mesa final, como es costumbre en los eventos organizados por EuroRounders, será retransmitida en directo.\r\nSe incluye el bono de Chip leader, con el que los tres primeros clasificados en los vuelos del C al L recibirán un premio de 2.000€, hasta un total de 50.000€ distribuidos como bonificación a los chip leader de cada día. El calendario de EuroPokerMillion incluye una amplia variedad de torneos paralelos para que todos los jugadores disfruten del póker al máximo.', 'EuroRounders', '2020-07-20', 'imagenes/poker.jfif', 'Póker', 0),
(2, 'Neque porro quisquam', 'Qui dolorem', 'La ruleta es un juego de azar típico de los casinos, cuyo nombre viene del término francés roulette, que significa \"ruedita\" o \"rueda pequeña\". Su uso como elemento de juego de azar, aún en configuraciones distintas de la actual, no está documentado hasta bien entrada la Edad Media. Es de suponer que su referencia más antigua es la llamada Rueda de la Fortuna, de la que hay noticias a lo largo de toda la historia, prácticamente en todos los campos del saber humano.\r\n\r\nLa “magia” del movimiento de las ruedas tuvo que impactar a todas las generaciones. La aparente quietud del centro, el aumento de velocidad conforme nos alejamos de él, la posibilidad de que se detenga en un punto al azar; todo esto tuvo que influir en el desarrollo de distintos juegos que tienen la rueda como base.\r\n\r\nLas ruedas, y por extensión las ruletas, siempre han tenido conexión con el mundo mágico y esotérico. Así, una de ellas forma parte del tarot, más precisamente de los que se conocen como arcanos mayores.\r\n\r\nSegún los indicios, la creación de una ruleta y sus normas de juego, muy similares a las que conocemos hoy en día, se debe a Blaise Pascal, matemático francés, quien ideó una ruleta con treinta y seis números (sin el cero), en la que se halla un extremado equilibrio en la posición en que está colocado cada número. La elección de 36 números da un alcance aún más vinculado a la magia (la suma de los primeros 36 números da el número mágico por excelencia: seiscientos sesenta y seis).\r\n\r\nEsta ruleta podía usarse como entretenimiento en círculos de amistades. Sin embargo, a nivel de empresa que pone los medios y el personal para el entretenimiento de sus clientes, no era rentable, ya que estadísticamente todo lo que se apostaba se repartía en premios (probabilidad de 1/36 de acertar el número y ganar 36 veces lo apostado).\r\n\r\nEn 1842, los hermanos Blanc modificaron la ruleta añadiéndole un nuevo número, el 0, y la introdujeron inicialmente en el Casino de Montecarlo. Ésta es la ruleta que se conoce hoy en día, con una probabilidad de acertar de 1/37 y ganar 36 veces lo apostado, consiguiendo un margen para la casa del 2,7% (1/37).\r\n\r\nMás adelante, en algunas ruletas (sobre todo las que se usan en países anglosajones) se añadió un nuevo número (el doble cero), con lo cual el beneficio para el casino resultó ser doble (2/38 o 5,26%).', 'Fusce 2.', '2020-04-23', 'imagenes/ruleta.jfif', 'Ruleta', 1),
(3, 'Maecenas risus', 'Varius eget', 'La veintiuna es un juego de origen desconocido, es el precursor del Blackjack. La primera referencia escrita sobre este juego está contenida en la obra picaresca de Miguel de Cervantes, Rinconete y Cortadillo. En ella se presenta a dos fulleros que malviven en la ciudad española de Sevilla jugando a la veintiuna. El texto describe que el objetivo del juego es sumar veintiún puntos sin pasarse, y que el as vale uno u once puntos. Puesto que este cuento fue escrito entre 1601 y 1602, se deduce que se jugaba en Castilla a la veintiuna desde principios del siglo XVII o incluso antes. El juego en Estados Unidos, fue popularizado por los colonos franceses, quienes hacia 1820 se asentaron en el sureste del país en la ciudad de Nueva Orleans en donde el juego era legal. Hacia 1849, con la fiebre del oro, el juego se incorporó en los salones del oeste americano, algunos casinos se inventaron una apuesta especial, el “black jack”, consistente en pagar a diez veces lo apostado por el jugador si se ganaba con la J (Jack) de trébol o picas (los palos negros), imponiéndose el nombre de la mano blackjack al del juego veintiuno.1​ Ya en el siglo XX, en los casinos americanos, el juego adquirió su actual formato en el que se incluyen premios especiales (bonus también llamados apuestas independientes ).2​\r\n\r\nEn el blackjack actual, la ventaja del casino reside en que el jugador pide primero, teniendo la posibilidad de pasarse. En el caso de que se pase, automáticamente pierde la apuesta, eliminando la posibilidad de empate. Aunque el crupier se pasara también, el jugador ya habría perdido anteriormente, con lo que el casino ya habría cobrado la apuesta.\r\n\r\nLa ventaja para el casino queda reducida por la posibilidad que tiene el jugador de ver una de las cartas del crupier y tomar decisiones con respecto a ella. Así un jugador puede plantarse con 16 o menos, esperando que el crupier se pase, algo que no le está permitido al crupier. Igualmente puede duplicar la apuesta cuando crea que sus cartas son favorables con respecto a la carta visible del crupier, o puede desdoblar las cartas cuando tenga dos iguales y jugar por tanto varias manos contra el crupier en una mano que considere desfavorable para este. Con una estrategia de juego adecuada, se aumenta significamente las posibilidades de ganar al crupier. No obstante los estudios muestran que aun jugando siempre el jugador de la manera más favorable, el casino sigue teniendo una pequeña ventaja en cuanto a que el jugador se termine pasando o quede por debajo del crupier, perdiendo por tanto su apuesta.\r\n\r\nUna técnica utilizada por algunos jugadores consiste en el conteo de cartas. La técnica más sencilla consiste en sumar +1 por cada carta baja (2 a 6) que llegue a la mesa, lo que beneficia al jugador para las siguientes rondas al haber más posibilidades de obtener cartas y puntuaciones altas, o restar -1 por cada As o carta con valor de 10 que llegue a la mesa, lo cual perjudica al jugador para las siguientes rondas. Las cartas intermedias (7 a 9) no suman ni restan. Cuando se está en puntuación positiva, hay más posibilidades de que el jugador obtenga una buena jugada, por lo que se puede apostar más fuerte. En cambio con puntuación negativa las posibilidades de obtener una buena mano son peores, por lo que las apuestas deberían ser menores.\r\n\r\nHa habido contadores de cartas míticos, que obtuvieron grandes fortunas con esta técnica en los casinos, pero este juego es más beneficioso con juego en equipo que con juego individual. Aunque todos los jugadores en la mesa solo tienen competencia contra el crupier, la distribución de cartas puede ser suficientemente al azar e impredecible jugando solo contra el crupier. Ken Uston ha sido considerado por muchos expertos como el mejor punteador del juego de ventaja de la historia.\r\n\r\nLos punteadores de cartas no están bien vistos en los casinos, y si el casino detecta, o simplemente sospecha que un jugador está contando, le invitarán a cambiar de juego, o sencillamente lo expulsarán del casino amparándose en el derecho de admisión.\r\n\r\nSin embargo este juego no dejará de ser determinista contra generadores de números, simulaciones computarizadas y barajadoras continuas porque es inevitable que el jugador tenga 55 manos iniciales posibles con dos cartas: 10 manos duras, 10 manos suaves, 10 pares, 10 manos con carta diez posibles, 553 combinaciones posibles versus carta visible del dealer, y el dealer siempre tendrá inevitablemente 10 cartas iniciales visibles por mano y 45 totales finales posibles por mano.', 'Nullam', '2020-06-04', 'imagenes/blackjack.jfif', 'Blackjack', 1),
(4, 'Habitasse', 'Tristique', 'El Craps, también llamado pase inglés, es un juego de azar que consiste en realizar distintas apuestas al resultado que se obtendrá al lanzar dos dados en el tiro siguiente o en toda una ronda. Aunque el juego es especialmente famoso en la mayoría de casinos alrededor del mundo en una modalidad en la que se apuesta contra «la casa» o «banca», existen otras versiones en las que los jugadores apuestan unos contra otros, como en el caso del craps callejero.\r\nEl juego de Craps se desarrolló como una simplificación del juego inglés llamado Hazard. Sus orígenes son difíciles de rastrear y se pueden remontar hasta las Cruzadas, recibiendo posteriormente la influencia de jugadores franceses. Lo que se convertiría en la versión moderna americana del juego fue llevado a Nueva Orleans por Bernardo de Marigny, un político y jugador descendiente de una familia de terratenientes adinerados de Luisiana.​ Sin embargo existía un fallo en la versión del juego de Bernardo, donde los jugadores podían sacarle ventaja al casino utilizando dados cargados y apostando a favor o en contra de la persona que lanzaba los dados. Un hombre llamado John H. Winn introdujo la opción de apostar \"en contra\" con la barra de no pase, que consiste en la versión del juego que permanece hasta ahora.\r\n\r\nEl juego, conocido originalmente como crapaud (una palabra en francés que significa «sapo», en referencia al estilo original de las personas de jugarlo de cuclillas sobre el suelo o en las banquetas) se considera que debe su popularidad actual al Craps callejero. La versión callejera se hizo muy famosa entre los soldados de la Segunda Guerra Mundial.\r\nCuando se juega en un casino contra la banca, o casa, uno o varios jugadores realizan diversas apuestas al resultado que se obtendrá en los dados que lance alguno de los jugadores, el cual es designado «tirador» o «shooter» por su nombre en inglés. Para comenzar el juego, durante lo que se conoce como «tiro de salida», el jugador necesita realizar una apuesta que se conoce como «línea de pase», en la que se busca obtener un siete (conocido como «siete natural» o «siete ganador») o un once en la combinación de dados para ganar la apuesta, que paga uno a uno. Si por el contrario obtiene un dos, tres o doce (números conocidos como «craps») pierde automáticamente su apuesta y necesitará colocar de nuevo una apuesta para seguir tirando. Si durante el primer lanzamiento no obtiene un siete u once (con que gana), o un dos, tres o doce (con que pierde), el juego entrará en una segunda etapa, en la que se marcará el «punto» en el número que se obtenga en dicho lanzamiento (cuatro, cinco, seis, ocho, nueve o diez). En esta etapa, el tirador buscará volver a obtener ese número en los dados, con lo que ganará el «roll» o «ronda», antes de obtener un siete, llamado «siete fuera» o «seven out». Si logra repetir el número del punto, el jugador ganará su apuesta y se le pagará uno a uno el monto. Si por el contrario si aparece un siete, perderá su apuesta. En ambos casos se considera que la ronda ha terminado y el juego vuelve a comenzar, aunque si la ronda culminó debido a un siete fuera se designará un nuevo tirador de entre los distintos jugadores.', 'Sed vehicula', '2020-04-03', 'imagenes/craps.jfif', 'Craps', 1),
(5, 'Vestibulum', 'Quisque', 'En el bacará sencillo, la casa es el banco. En el modo llamado chemin de fer (una variante avanzada de bacará), el banco pasa de un jugador a otro. En el punto banco (versión norteamericana), se ve cómo el banco pasa de jugador en jugador, pero realmente bajo el control de la casa. En el juego de casino se manejan tres o seis barajas de 52 cartas, barajadas en conjunto y repartidas a partir de un \"sabot\" o \"shoe\", nombre que se le da en inglés a una caja diseñada para contener varios mazos de naipes, y poder ir tomando éstos de uno en uno. Las cartas se diferencian en palos y figuras, con numeraciones de 10 y 0. El fin del juego es que el jugador sume con sus cartas un valor lo más cercano posible al 9 y mayor que el que tenga la banca. Este juego fue popularizado por Ian Fleming (2015), entre otros autores, desde la primera novela del agente 007.\r\nEl bacarrá, bacará o baccarat suele disputarse entre un jugador contra la banca, aunque pueden ser más. Al contrario de la mayoría de los juegos de casino, la ventaja de la casa se reduce a conocer la tercera carta recibida por el jugador, caso de haberla. El escritor Ian Fleming (2015) explica el reglamento de la siguiente manera:\r\n\r\nSe reparten, una a una, cuatro cartas, dos para el jugador y dos para el banquero, sin embargo hay ocasiones en que se extrae una tercera. El juego comienza colocando una apuesta al jugador, al banquero o al empate, en caso de participar varios jugadores estos pueden pasarse, pero si todos se pasan la apuesta se divide.nota 1​ La mano que consiga o más se acerque al 9 gana. Cuando el jugador y el banquero totalizan el mismo puntaje, la mano es declarada en empate.\r\n\r\nLas figuras, J, Q y K más los dieces, valen cero, los ases valen 1, las restantes cartas conservan su valor. En el bacarrá no es posible superar el nueve porque solo se contabiliza la última cifra. Ejemplo: El jugador recibe un 4 y un 8. El total es 12, como únicamente se toma la última cifra, la mano vale 2. Ninguna mano tendrá más de 3 cartas.', 'Pulvinar', '2020-07-31', 'imagenes/bacara.jfif', 'Bacara', 1),
(6, 'Morbi', 'Facilisis', 'El bingo (del inglés bingo) es un juego de azar que consiste en un bombo con un número determinado de bolas numeradas en su interior. Los jugadores juegan con cartones con números aleatorios escritos en ellos, dentro del rango correspondiente. Un locutor va sacando bolas del bombo, anunciando los números en voz alta. Si un jugador tiene dicho número en su cartón lo tacha, y el juego continúa así hasta que alguien consigue marcar todos los números de su cartón.\r\n\r\nExisten varias teorías sobre cuando empezó esta actividad, pero la mayoría de ellas la datan del siglo XVI. Se trata de un juego muy popular en todo el mundo del que existen dos variedades típicas, que son la de 90 bolas y la de 75 bolas.\r\nAlgunas teorías remontan el origen de este popular juego de azar al tiempo de la cultura romana. Otras lo relacionan a la antigua Italia en el siglo XVI, pero lo realmente cierto es que constituye una de las primeras formas de juego popular.\r\n\r\nLa historia conocida de este juego (no aceptada por todos los historiadores) se remonta a la época de los bárbaros y los potentados que cobraban los famosos impuestos a diferentes aldeas, villas, entre otros estamentos de la sociedad en épocas remotas.\r\n\r\nEl juego en general consistía en integrar en un recipiente varias bolas con números que representaban a diferentes aldeas de las diferentes potencias y sobre la base de los aciertos los caballeros y soldados hacían los cobros en oro, plata, minerales, joyas y otros objetos de valor como compensación y retribución de su suerte en ser elegidos, en varias ocasiones los valores adquiridos eran para el uso de construcciones y en otras ocasiones los utilizaban para la alimentación de grandes masas de ejércitos y entre otros para combatir conflictos y conquistas.\r\n\r\nCon el transcurso de los años y debido a nuevas normas asociadas a la sociedad y leyes que promulgaron grandes potentados como es el caso de los romanos, estos juegos que anteriormente se utilizaban para el recaudo de dinero y riquezas, empezaron a ser utilizadas para brindar diversión a los diferentes visitantes y exploradores del mundo en busca de negocios y sobre la base de esto las ideas que se crearon fueron basadas en brindar diversión con juegos, bailes, mujeres y estamentos de prestigio con otras disciplinas como fueron los dados, las barajas, y otros juegos que ahora divierten a millones de jugadores y apasionados apostadores en el mundo.\r\n\r\nEn cambio, numerosos historiadores y especialistas afirman que el origen de esta costumbre es la lotería italiana, cuando se unieron los reinos de Italia en 1530. La hipótesis de gran aceptación afirma que el antecesor del popular juego es “Il Giocco del Lotto d`Italia”, una lotería nacional que era jugada semanalmente y se ha extendido en el tiempo hasta la fecha actual. Hoy en día, es un componente esencial del presupuesto del país, que genera más de 75 millones de dólares en ingresos actuales. “Lo Giuoco del Lotto d’Italia” se juega cada sábado en este país.\r\n\r\nLa cercanía operativa de ambos juegos se manifiesta en los elementos que intervienen para el desarrollo de los mismos. En los dos casos, el organizador debe contar con bolas numeradas, un bolillero o tómbola y cartones numerados. El social juego de bingo parece ser una evolución de este juego que se ha extendido por siglos en la región de Italia.\r\n\r\nEn 1770, este juego llamó la atención a los franceses, quienes lo denominaron Le Lotto, y se estableció con las reglas que se siguen aún en la actualidad. Fueron los primeros en jugar con las tarjetas de bingo, fichas y en cantar en voz alta los números. En esta época, sólo fue jugado por la gente de la alta aristocracia. Los premios no eran organizados de la manera actual sino que se extendían en numerosas posibilidades de reconocimiento por ganar. Distintos elementos típicos de los años mencionados constituían los premios.\r\n\r\nEn los años 1800 el bingo se propagó rápidamente por toda Europa. Los juegos de bingo educativos se hicieron populares. En 1850 fue diseñado un juego de bingo en Alemania para enseñarle a los niños las tablas de multiplicar, además de otros juegos de bingo educativo como “bingo para deletrear”, “bingo animal”, “bingo histórico”. Estos bingos fueron diseñados para proporcionarles a los niños de 3 a 6 años de edad un poco de diversión y al mismo tiempo, enseñarles a cantar y a reconocer los números.\r\n\r\nDespués de extenderse por toda Europa el juego comenzó a presentarse en Norteamérica. En un principio el juego se hizo popular en las ferias de los pueblos y festivales. Consistía en un organizador que sacaba discos enumerados de una caja de cigarros mientras los jugadores marcaban los números en sus tarjetas colocando alubias (frijoles) sobre ellas y se gritaba “beano” si ganaban.\r\n\r\nDurante una visita al carnaval de Atlanta en 1929, Edwin Lowe, un vendedor de juguetes de Nueva York, descubrió el Beano. Lowe notó la gran emoción que sentían los jugadores. Intentó participar en un juego de Beano esa misma noche, pero no consiguió un sitio. Los jugadores estaban muy enganchados, y cuando el hombre que llevaba el juego de Beano intentó cerrar el chiringuito, los jugadores simplemente rechazaron dejar de jugar. Finalmente, a las 3 de la mañana, según cuenta la historia, el organizador dejó paso a Lowe. Al regresar a Nueva York, Lowe compró algunas alubias, y todo el resto de cosas necesarias para poder realizar el juego. Invitó a algunos amigos a su apartamento para poner a prueba su nuevo juego. Antes de lo que se imaginaba, sus amigos estaban jugando al Beano con la misma emoción y fervor que los que había visto en el carnaval. Durante un juego, Lowe estudió el comportamiento de un jugador que estaba a punto de ganar. Sólo necesitaba un número más para completar su tarjeta, pero se ponía más y más nervioso cuando veía que su número no salía. Finalmente, cuando consiguió tapar todos sus números, de la emoción gritó:” B-B-B-BINGO!” en vez de Beano. Esto es lo que explica su nombre de hoy en día.\r\n\r\nUna vez dado a conocer en Norteamérica, rápidamente se extendió en el resto del mundo.\r\n\r\nUn cura de Wilkes-Barre, Pensilvania, es el hombre responsable de introducir por primera vez el bingo como forma de recaudar fondos para la iglesia. Un miembro de la congregación sugirió utilizar el juego para poder obtener dinero para mantenimiento. Fue entonces, cuando el juego del bingo, original, que solo ofrecía 24 variantes únicas de tarjetas, se fue expandiendo. Dado que cada vez eran más los miembros de la iglesia que tomaban parte en el juego del bingo, se repartían más cartones. Los curas pronto se dieron cuenta de que muchos jugadores ganaban el mismo juego, por lo tanto buscaron nuevas formas para hacer que las combinaciones de números fueran únicas.\r\n\r\nPara ello, pidieron ayuda a Lowe, quien contrató a un profesor de matemáticas de la universidad de Columbia, llamado Carl Leffler, para que lo ayudase a incrementar la cantidad de combinaciones en las tarjetas de bingo. Para 1930, Leffler ya había creado más de 6000 tarjetas de bingo con combinaciones únicas (se dice que después de esto Leffler se volvió loco).\r\n\r\nEsta nueva forma de bingo hizo que este juego se consolidara como forma para recaudar fondos. Para 1934, ya había más de 10000 bingos semanales operativos en toda América del Norte. Desde las iglesias hasta las reservas de indios americanos, todos ellos eran jugadores de bingo que gastaban semanalmente 90 millones de dólares en bingo solamente en el norte de América.\r\n\r\nEn 1977 se autorizó el bingo en España. Se inventó un nuevo sistema de bingo diferente al que imperaba por entonces: el bingo de 90 números. En la década de los ochenta se vivió una auténtica fiebre del “bingo moderno” cuando las máquinas y los salones de juego entraron en escena.\r\n\r\nEn 1992 había 604 salas de bingo en España, según los primeros datos oficiales conocidos. Hoy en día existen diversidad juegos de internet.', 'Donec', '2020-11-27', 'imagenes/bingo.jfif', 'Bingo!', 1),
(24, 'Evento', 'Lugar', 'La ruleta es un juego de azar típico de los casinos, cuyo nombre viene del término francés roulette, que significa \"ruedita\" o \"rueda pequeña\". Su uso como elemento de juego de azar, aún en configuraciones distintas de la actual, no está documentado hasta bien entrada la Edad Media. Es de suponer que su referencia más antigua es la llamada Rueda de la Fortuna, de la que hay noticias a lo largo de toda la historia, prácticamente en todos los campos del saber humano. La “magia” del movimiento de las ruedas tuvo que impactar a todas las generaciones. La aparente quietud del centro, el aumento de velocidad conforme nos alejamos de él, la posibilidad de que se detenga en un punto al azar; todo esto tuvo que influir en el desarrollo de distintos juegos que tienen la rueda como base. Las ruedas, y por extensión las ruletas, siempre han tenido conexión con el mundo mágico y esotérico. Así, una de ellas forma parte del tarot, más precisamente de los que se conocen como arcanos mayores. Según los indicios, la creación de una ruleta y sus normas de juego, muy similares a las que conocemos hoy en día, se debe a Blaise Pascal, matemático francés, quien ideó una ruleta con treinta y seis números (sin el cero), en la que se halla un extremado equilibrio en la posición en que está colocado cada número. La elección de 36 números da un alcance aún más vinculado a la magia (la suma de los primeros 36 números da el número mágico por excelencia: seiscientos sesenta y seis). Esta ruleta podía usarse como entretenimiento en círculos de amistades. Sin embargo, a nivel de empresa que pone los medios y el personal para el entretenimiento de sus clientes, no era rentable, ya que estadísticamente todo lo que se apostaba se repartía en premios (probabilidad de 1/36 de acertar el número y ganar 36 veces lo apostado). En 1842, los hermanos Blanc modificaron la ruleta añadiéndole un nuevo número, el 0, y la introdujeron inicialmente en el Casino de Montecarlo. Ésta es la ruleta que se conoce hoy en día, con una probabilidad de acertar de 1/37 y ganar 36 veces lo apostado, consiguiendo un margen para la casa del 2,7% (1/37). Más adelante, en algunas ruletas (sobre todo las que se usan en países anglosajones) se añadió un nuevo número (el doble cero), con lo cual el beneficio para el casino resultó ser doble (2/38 o 5,26%).', 'Organizador', '2020-12-11', 'imagenes/ruleta.jfif', 'OtroEvento', 1),
(25, 'Euro Poker Million', 'Casino&Hotel Perla en Nova Gorica - Eslovenia', 'Del 20 de julio al 4 de Agosto se celebra en la localidad eslovena de Nova Gorica uno de los eventos más grandes en el sector del Póker, el Euro Poker Million, tal y como su nombre indica, garantiza un millón de euros, donde además ,como mínimo, 250.000€ irán destinados para el campeón.\r\nLa estructura diseñada por la organización garantiza una gran jugabilidad: Los jugadores suelen buscar un buen stack inicial (60.000 puntos de inicio) y una duración progresiva de los niveles, que irán desde los 40 minutos el primer día, 50 y 60 minutos en las etapas intermedias y, 75 minutos en la mesa final. La mesa final, como es costumbre en los eventos organizados por EuroRounders, será retransmitida en directo.\r\nSe incluye el bono de Chip leader, con el que los tres primeros clasificados en los vuelos del C al L recibirán un premio de 2.000€, hasta un total de 50.000€ distribuidos como bonificación a los chip leader de cada día. El calendario de EuroPokerMillion incluye una amplia variedad de torneos paralelos para que todos los jugadores disfruten del póker al máximo.', 'EuroRounders', '2020-07-20', 'imagenes/poker.jfif', 'Póker2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagen` int(11) NOT NULL,
  `rutaImagen` varchar(100) DEFAULT NULL,
  `idEvento` int(11) NOT NULL,
  `textImagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagen`, `rutaImagen`, `idEvento`, `textImagen`) VALUES
(1, 'imagenes/casinoPerla.jpg', 25, 'Casino&Hotel Perla, MedialveCasino'),
(2, 'imagenes/pokerRoom.jpg', 25, 'Sala de Póker Casino Perla, TripAdvisor'),
(3, 'imagenes/casino1.jfif', 2, 'Pellentesque'),
(4, 'imagenes/casino2.jfif', 2, 'Elementum felis'),
(5, 'imagenes/casino3.jfif', 3, 'dictum'),
(6, 'imagenes/casino4.jfif', 3, 'Etiam'),
(7, 'imagenes/casino5.jfif', 4, 'Vestibulum'),
(8, 'imagenes/casino6.jfif', 4, 'eleifend'),
(9, 'imagenes/casino7.jfif', 5, 'Nam accumsan'),
(10, 'imagenes/casino8.jfif', 5, 'Pellentesque'),
(11, 'imagenes/casino9.jfif', 6, 'Fusce mi orci'),
(12, 'imagenes/casino10.jfif', 6, 'eleifend nulla'),
(13, 'imagenes/casino11.jfif', 6, 'bibendum'),
(18, 'imagenes/casino12.jfif', 24, 'Imagen de prueba'),
(19, 'imagenes/casino7.jfif', 24, 'Imagen de prueba 2'),
(20, 'imagenes/casino3.jfif', 24, 'Imagen de prueba 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabrasprohibidas`
--

CREATE TABLE `palabrasprohibidas` (
  `palabra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `palabrasprohibidas`
--

INSERT INTO `palabrasprohibidas` (`palabra`) VALUES
('armario'),
('cama'),
('cuadro'),
('escritorio'),
('lampara'),
('mesa'),
('reloj'),
('silla'),
('taza'),
('ventilador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(50) NOT NULL,
  `nombreUsuario` varchar(15) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `tipo` enum('normal','moderador','gestor','super') NOT NULL DEFAULT 'normal',
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `nombreUsuario`, `password`, `tipo`, `descripcion`) VALUES
('gestor@gestor.gest', 'gestor', '$2y$10$cZEQFRTNz3ewl12gZzyTned3Y10XaKKvGPoonCuFsqmwIZijR7kWS', 'gestor', NULL),
('hola@ggf.es', 'Prueba1', '$2y$10$HWQm6b4Y19G6k/sjSCylQeGy2M9LQ3Nk89cqpxQMQYkcmCAGN5iry', 'moderador', 'Mi descripción'),
('mod@mod.mod', 'Mod', '$2y$10$dHQVz6edHgJdpQ8.uJGGROi3ZOJ5eZpsWSxIu0Mz6PvA7zB/eSc8u', 'moderador', NULL),
('pedro@prueba.se', 'Pedro', '$2y$10$WQ.ukLdgTcAByI9vKv1pjuNL1cgcqDv0oGsFp9YR16GcoYkG4ioPW', 'super', 'Prueba\r\nDescripción'),
('test@test.test', 'Prueba', '$2y$10$xAFH9Q/O3.linf2LtbtrZu690SF5UDiolhyrG6J3hm6f.KaqdOucO', 'gestor', NULL),
('user@try.es', 'Usuario2', '$2y$10$1L7RnDAIyHymzu5qzS2uOOoEhojwIFRKP3JX.FJV/vATnxoEAVnT.', 'normal', 'HOla'),
('user@user.es', 'Usuario', '$2y$10$44t.0.L9871r3RnlOClj2ePNQcrZNyAdAtZU9oUDa4IYqXbXJ9h2K', 'normal', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `comentarios_ibfk_1` (`idEvento`),
  ADD KEY `email` (`email`),
  ADD KEY `autorComentario` (`autorComentario`);

--
-- Indices de la tabla `enlacesevento`
--
ALTER TABLE `enlacesevento`
  ADD PRIMARY KEY (`idEnlace`),
  ADD KEY `idEvento` (`idEvento`);

--
-- Indices de la tabla `etiquetaseventos`
--
ALTER TABLE `etiquetaseventos`
  ADD PRIMARY KEY (`etiqueta`,`idEvento`),
  ADD KEY `idEvento` (`idEvento`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `textoImagenPortada` (`textoImagenPortada`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `imagenes_ibfk_1` (`idEvento`);

--
-- Indices de la tabla `palabrasprohibidas`
--
ALTER TABLE `palabrasprohibidas`
  ADD PRIMARY KEY (`palabra`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `enlacesevento`
--
ALTER TABLE `enlacesevento`
  MODIFY `idEnlace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`autorComentario`) REFERENCES `usuarios` (`nombreUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `enlacesevento`
--
ALTER TABLE `enlacesevento`
  ADD CONSTRAINT `enlacesevento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`id`);

--
-- Filtros para la tabla `etiquetaseventos`
--
ALTER TABLE `etiquetaseventos`
  ADD CONSTRAINT `etiquetaseventos_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
