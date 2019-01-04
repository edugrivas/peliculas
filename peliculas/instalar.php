<?php
include_once './config/config.php';


//Conectar con la BD

$link=  mysqli_connect($host, $user, $password, $DB);

$consultas['usuarios']="CREATE TABLE `usuarios` (
  `login` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(256) NOT NULL,
  `rol` set('administrador','registrado') NOT NULL,
  `email` varchar(256) NOT NULL,
  `estado` set('activado','desactivado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$consultas['llave primaria usuario']="ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`);";

$consultas['peliculas']="CREATE TABLE `peliculas` (
  `id` int(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `sinopsis` varchar(3000) NOT NULL,
  `ruta` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$consultas['llave primaria peliculas']="ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);";

$consultas['autoincrementar en peliculas']="ALTER TABLE `peliculas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;";



$consultas['series']="CREATE TABLE `series` (
  `id` int(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `sinopsis` varchar(3000) NOT NULL,
  `ruta` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$consultas['llave primaria series']="ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);";

$consultas['autoincrementar en series']="ALTER TABLE `series`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;";

$consultas['usuarioPeliculas']="CREATE TABLE `usuariopeliculas` (
  `login` varchar(25) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$consultas['llave primaria y foranea usuarioPeliculas']="ALTER TABLE `usuariopeliculas`
  ADD PRIMARY KEY (`login`,`id`),
  ADD KEY `id` (`id`);";

$consultas['usuarioSeries']="CREATE TABLE `usuarioseries` (
  `id` int(255) NOT NULL,
  `login` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$consultas['llave primaria y foranea usuarioSeries']="ALTER TABLE `usuarioseries`
  ADD PRIMARY KEY (`id`,`login`),
  ADD KEY `login` (`login`);";

$consultas['relaciones con usuarioPeliculas']="ALTER TABLE `usuariopeliculas`
  ADD CONSTRAINT `usuariopeliculas_ibfk_1` FOREIGN KEY (`login`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariopeliculas_ibfk_2` FOREIGN KEY (`id`) REFERENCES `peliculas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";

$consultas['relaciones con usuarioSeries']="ALTER TABLE `usuarioseries`
  ADD CONSTRAINT `usuarioseries_ibfk_1` FOREIGN KEY (`login`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioseries_ibfk_2` FOREIGN KEY (`id`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";


$consultas['usuario admin']="INSERT INTO `usuarios` (`login`, `password`, `nombre`, `apellidos`, `rol`, `email`,`estado`) VALUES
('admin', PASSWORD('admin'), 'administrador', '', 'administrador', '','activado');";

$consultas['insercion en peliculas']="INSERT INTO `peliculas` (`id`, `nombre`, `sinopsis`, `ruta`) VALUES
(41, 'Dirty Grandpa', 'Un hombre, recientemente viudo y con muchas ganas de vivir, convence a su nieto para realizar un viaje por carretera a Florida. El nieto que, según su abuelo está a punto de casarse con la chica equivocada, descubrirá para su asombro, que el anciano está más loco de lo que pensaba y que a diferencia de él, no tiene ningún reparo a la hora de ligar con las chicas.  John Phillips, hasta el momento compositor de bandas sonoras (Forrest Gump, La Roca), escribirá el guión de la comedia que, por el momento, cuenta con la participación del actor Jeff Bridges (Iron Man, El gran Lebowski) y la producción de Barry Josephon, productor ejecutivo de muchos de los capítulos de Bones y la película Wild Wild West.', '../fotosPeliculas/Dirty Grandpa1'),
(42, 'Un espía y medio', 'Un letal agente del la CIA (Johnson), víctima de acoso escolar en su adolescencia, vuelve a casa para asistir a una reunión de antiguos alumnos. Con la excusa de estar trabajando en un caso secreto, consigue la ayuda del que fuera el chico más popular del Instituto (Hart), que ahora es un aburrido contable y vive añorando sus años de gloria. Cuando el pobre hombre se da cuenta del embrollo en el que se está metiendo, es ya demasiado tarde, pues su nuevo amigo lo implica en tiroteos, traiciones y espionaje, lo que le obligará a jugarse el cuello en incontables ocasiones.', '../fotosPeliculas/Un espía y medio2'),
(43, 'Gorrión rojo', 'Dominika Egorova (Jennifer Lawrence) es reclutada contra su voluntad para ser un “gorrión”, una seductora adiestrada del servicio de seguridad ruso. Dominika aprende a utilizar su cuerpo como arma, pero lucha por conservar su sentido de la identidad durante el deshumanizador proceso de entrenamiento. Hallando su fuerza en un sistema injusto, se revela como uno de los activos más sólidos del programa. Su primer objetivo es Nate Nash (Joel Edgerton), un funcionario de la CIA que dirige la infiltración más confidencial de la agencia en la inteligencia rusa. Los dos jóvenes agentes caen en una espiral de atracción y engaño que amenaza sus carreras, sus lealtades y la seguridad de sus respectivos países.', '../fotosPeliculas/Gorrión rojo3'),
(44, 'Los vengadores', 'Cuando un enemigo inesperado surge como una gran amenaza para la seguridad mundial, Nick Fury, director de la Agencia SHIELD, decide reclutar a un equipo para salvar al mundo de un desastre casi seguro. Adaptación del cómic de Marvel \"Los Vengadores\", el legendario grupo de superhéroes formado por Ironman, Hulk, Thor y el Capitán América entre otros.', '../fotosPeliculas/Los vengadores4'),
(45, 'La forma del agua', 'En un inquietante laboratorio de alta seguridad, durante la Guerra Fría, se produce una conexión insólita entre dos mundos aparentemente alejados. La vida de la solitaria Elisa (Sally Hawkins), que trabaja como limpiadora en el laboratorio, cambia por completo cuando descubre un experimento clasificado como secreto: un hombre anfibio (Doug Jones) que se encuentra ahí recluido.', '../fotosPeliculas/La forma del agua5'),
(46, 'La chaqueta metálica', 'Un grupo de reclutas se prepara en Parris Island, centro de entrenamiento de la marina norteamericana. Allí está el sargento Hartman, duro e implacable, cuya única misión en la vida es endurecer el cuerpo y el alma de los novatos, para que puedan defenderse del enemigo. Pero no todos los jóvenes están preparados para soportar sus métodos.', '../fotosPeliculas/La chaqueta metálica6'),
(47, 'La naranja mecánica', 'Gran Bretaña, en un futuro indeterminado. Alex (Malcolm McDowell) es un joven muy agresivo que tiene dos pasiones: la violencia desaforada y Beethoven. Es el jefe de la banda de los drugos, que dan rienda suelta a sus instintos más salvajes apaleando, violando y aterrorizando a la población. Cuando esa escalada de terror llega hasta el asesinato, Alex es detenido y, en prisión, se someterá voluntariamente a una innovadora experiencia de reeducación que pretende anular drásticamente cualquier atisbo de conducta antisocial.', '../fotosPeliculas/La naranja mecánica7'),
(48, 'El viaje de Chihiro', 'Chihiro es una niña de diez años que viaja en coche con sus padres. Después de atravesar un túnel, llegan a un mundo fantástico, en el que no hay lugar para los seres humanos, sólo para los dioses de primera y segunda clase. Cuando descubre que sus padres han sido convertidos en cerdos, Chihiro se siente muy sola y asustada.', '../fotosPeliculas/El viaje de Chihiro8'),
(49, 'X-Men', 'En un futuro cercano, la humanidad comienza a ver aparecer una nueva raza; los mutantes. Dotados de extraños y variados poderes, están agrupados en dos bandos: los que abogan por la integración y el entendimiento con la humanidad, encabezados por el doctor Charles Xavier, y los que buscan el enfrentamiento con una raza que consideran inferior y que les odia, dirigidos por Magnus, alias Magneto, un peligroso mutante con extraordinarios poderes.', '../fotosPeliculas/X-Men9'),
(50, 'Predestination', 'Un agente especial (Ethan Hawke) de un departamento secreto del gobierno, una agencia creada en los años 80 que permite realizar viajes en el tiempo, tendrá que realizar una compleja serie de \"saltos\" hacia atrás en el tiempo con el fin de detener al conocido como \"el terrorista fallido\" (The Fizzle Bomber), un individuo que está poniendo bombas por todo el país con miles de víctimas. En uno de sus viajes a los 70, el agente, que trabaja encubierto como camarero de un bar, conoce a un hombre que le narra una historia extraordinaria...', '../fotosPeliculas/Predestination10');";

$consultas['insercion en series']="INSERT INTO `series` (`id`, `nombre`, `sinopsis`, `ruta`) VALUES
(1, 'Gotham', 'Precuela de los cómics de Batman, centrada en la adolescencia de Bruce Wayne. Definida por sus responsables como una especie de Smallville, desarrollará además la vida de Jim Gordon como policía, y la enlazará con el origen del mito de Batman y de otros villanos como El Pingüino.', '../fotosSeries/Gotham1'),
(2, 'Juego de tronos', 'La historia se desarrolla en un mundo ficticio de carácter medieval donde hay Siete Reinos. Hay tres líneas argumentales principales: la crónica de la guerra civil dinástica por el control de Poniente entre varias familias nobles que aspiran al Trono de Hierro, la creciente amenaza de los Otros, seres desconocidos que viven al otro lado de un inmenso muro de hielo que protege el Norte de Poniente, y el viaje de Daenerys Targaryen, la hija exiliada del rey que fue asesinado en una guerra civil anterior, y que pretende regresar a Poniente para reclamar sus derechos. Tras un largo verano de varios años, el temible invierno se acerca a los Siete Reinos. Lord Eddard \'Ned\' Stark, señor de Invernalia, deja sus dominios para ir a la corte de su amigo, el rey Robert Baratheon en Desembarco del Rey, la capital de los Siete Reinos. Stark se convierte en la Mano del Rey e intenta desentrañar una maraña de intrigas que pondrá en peligro su vida y la de todos los suyos. Mientras tanto diversas facciones conspiran con un solo objetivo: apoderarse del trono.', '../fotosSeries/Juego de tronos2'),
(3, 'Stranger Things', 'Homenaje a los clásicos misterios sobrenaturales de los años 80, \"Stranger Things\" es la historia de un niño que desaparece en el pequeño pueblo de Hawkins, Indiana, sin dejar rastro en 1983. En su búsqueda desesperada, tanto sus amigos y familiares como el sheriff local se ven envueltos en un enigma extraordinario: experimentos ultrasecretos, fuerzas paranormales terroríficas y una niña muy, muy rara...', '../fotosSeries/Stranger Things3'),
(4, 'Vikingos', 'Narra las aventuras del héroe Ragnar Lothbrok, de sus hermanos vikingos y su familia, cuando él se subleva para convertirse en el rey de las tribus vikingas. Además de ser un guerrero valiente, Ragnar encarna las tradiciones nórdicas de la devoción a los dioses. Según la leyenda era descendiente directo del dios Odín.', '../fotosSeries/Vikingos4'),
(5, 'Breaking Bad', 'Tras cumplir 50 años, Walter White (Bryan Cranston), un profesor de química de un instituto de Albuquerque, Nuevo México, se entera de que tiene un cáncer de pulmón incurable. Casado con Skyler (Anna Gunn) y con un hijo discapacitado (RJ Mitte), la brutal noticia lo impulsa a dar un drástico cambio a su vida: decide, con la ayuda de un antiguo alumno (Aaron Paul), fabricar anfetaminas y ponerlas a la venta. Lo que pretende es liberar a su familia de problemas económicos cuando se produzca el fatal desenlace. ', '../fotosSeries/Breaking Bad5'),
(6, 'Black Mirror', 'Serie antológica creada por Charlie Brooker (\"Dead Set\") que muestra el lado oscuro de la tecnología y cómo esta afecta y puede alterar nuestra vida, a veces con consecuencias tan impredecibles como aterradoras. \"Black Mirror\" comenzó su emisión en 2011 en el canal británico Channel 4 con dos temporadas de tres episodios cada una, y tras producirse un especial de Navidad la serie fue comprada y renovada por Netflix, con doce episodios extra emitidos entre 2016 y 2017. En marzo de 2018, se confirmó que habría quinta temporada.', '../fotosSeries/Black Mirror6'),
(7, 'Better Call Saul', 'Precuela de la serie \"Breaking Bad\", centrada en el personaje del abogado Saul Goodman (Bob Odenkirk), seis años antes de conocer a Walter White. La serie cuenta cómo un picapleitos de poca monta llamado Jimmy McGill, con problemas para llegar a fin de mes, se convierte en el abogado criminalista Saul Goodman.', '../fotosSeries/Better Call Saul7'),
(8, 'Arrow', 'Adaptación libre de un personaje de DC Comics, playboy de día, que, durante la noche, usa su arco y sus flechas contra el crimen. Tras haber desaparecido y haber sido dado por muerto en un violento naufragio, el multimillonario playboy Oliver Queen es rescatado con vida cinco años después en una isla del Pacífico. Una vez en casa, su madre, su hermana y su mejor amigo notan que la terrible experiencia sufrida lo ha cambiado profundamente. Él, por su parte, trata de ocultar la verdad sobre sí mismo, pero se propone enmendar los errores que cometió en el pasado. Con la ayuda de su fiel chófer y guardaespaldas, vuelve a su antigua vida de mujeriego despreocupado, pero, en secreto, crea el personaje de un justiciero encapuchado que lucha contra el mal.', '../fotosSeries/Arrow8'),
(9, 'Prison Break', 'Michael Scofield (Wentworth Miller) es un hombre desesperado en un situación desesperada. Su hermano Lincoln Burrows (Dominic Purcell), condenado a la pena capital está a la espera de ser ejecutado. A pesar de todas las evidencias, Michael cree en su inocencia, por lo que decide robar un banco para dejarse atrapar y ser encarcelado en la misma prisión que su hermano. Su objetivo: escapar juntos.', '../fotosSeries/Prison Break9'),
(10, 'Suits (La clave del éxito)', ' Michael Ross se gana la vida bordeando los límites de la legalidad. Es un joven muy inteligente, pero las malas compañías de la universidad lo llevaron a creer que para triunfar en la vida hay que saltarse las reglas. Así, por ejemplo, vive de presentarse en nombre de otros a los exámenes de Derecho. Por azar conoce a Harvey Specter, uno de los abogados más jóvenes y brillantes de Manhattan. La inteligencia y las dotes de Michael lo deslumbrarán tanto que lo contrata a pesar de que aún no ha terminado la carrera.', '../fotosSeries/Suits (La clave del éxito)10');";

$consultas['insercion en usuariopeliculas']="INSERT INTO `usuariopeliculas` (`login`, `id`) VALUES
('admin', 41),
('admin', 42),
('admin', 43),
('admin', 44),
('admin', 45),
('admin', 46),
('admin', 47),
('admin', 48),
('admin', 49),
('admin', 50);";

$consultas['insercion en usuarioseries']="INSERT INTO `usuarioseries` (`id`, `login`) VALUES
(1, 'admin'),
(2, 'admin'),
(3, 'admin'),
(4, 'admin'),
(5, 'admin'),
(6, 'admin'),
(7, 'admin'),
(8, 'admin'),
(10, 'admin');";





foreach ($consultas as $clave => $consulta){
    echo "Creando $clave <br>";
    mysqli_query($link, $consulta) or die(mysqli_error($link));
    
}
echo "<br>Infraestructura Instalada y usuario admin creado password admin";
