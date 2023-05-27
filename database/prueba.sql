id	nombre	apellido	identificacion	carrera	correo	telefono

CREATE TABLE colaboradores(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR (35) NOT NULL,
    apellido VARCHAR (35) NOT NULL,
    documento VARCHAR (11) NOT NULL UNIQUE,
    cargo VARCHAR (25) NOT NULL,
    telefono VARCHAR(25) NOT NULL
);

INSERT INTO estudiante (nombre, apellido, identificacion, carrera, correo, telefono) VALUES
('juan esteban','mena mena','1078912328','ing sistemas','jemena@miuniclaretian.edu.co','3225432345'),
('juan camilo','aguirre cortes','1189023439','ing sistemas','jcaguirre@miuniclaretian.edu.co','3218928990'),
('maria camila','mena urrego','1092876288','ing sistemas','mcmena@miuniclaretian.edu.co','3145678902'),
('esteban','urrego mena','1890897223','ing sistemas','esurrego@miuniclaretian.edu.co','3156728909'),
('paola ','cortes velasques','1567890213','ing sistemas','pacortes@miuniclaretian.edu.co','3146752890'),
('esperanza ','gomez mena','1234567890','ing industrial','esgomez@miuniclaretian.edu.co','3124567890'),
('juan ','perez cortes','1342541230','ing industrial','juperez@miuniclaretian.edu.co','3167893212'),
('camila fernanda','inestrosa guebara','1045678980','ing industrial','cfinestrosa@miuniclaretian.edu.co','3224567890'),
('miguel','cataño perez','1987654321','ing industrial','micataño@miuniclaretian.edu.co','3008792134'),
('nathaly yineth ','cortes mena','1209098910','ing industrial','nycortes@miuniclaretian.edu.co','3136662200'),
('judith ','gomez mena','1982323112','psicologia','jugomez@miuniclaretian.edu.co','3009876534'),
('milena ster ','muñoz cortes','1022678902','psicologia','msmuñoz@miuniclaretian.edu.co','3042139033'),
('fernanda','sepulveda guebara','1067878980','psicologia','fesepulveda@miuniclaretian.edu.co','3224567891'),
('miguel angel','cataño suarez','1977654321','psicologia','micataño@miuniclaretian.edu.co','3008792136'),
('paolo ','zuñiga mena','1309098910','psicologia','pasuñiga@miuniclaretian.edu.co','3136662201');



INSERT INTO colaboradores (nombre, apellido, documento, cargo, telefono) VALUES
('juan','ortiz mena','1278912328','administrativo','3225432346'),
('felipe','mendoza aguilar','1268912328','administrativo','3215430346'),
('esteven','mendez mena','1208962328','administrativo','3226430341'),
('juan','ortiz mena','1278912329','profesor','3235662346'),
('gimena','herrera mena','1278912307','profesor','3135662346'),
('laura','perez hinestrosa','1273912320','profesor','3245662340');