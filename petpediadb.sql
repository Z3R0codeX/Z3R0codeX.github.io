drop database petpedia;

CREATE DATABASE petpedia;

USE petpedia;

-- Tabla users
CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    level TINYINT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_img VARCHAR(100),
    PRIMARY KEY (user_id)
);

INSERT INTO users (username, email, password, level, user_img) 
VALUES 

	('luis3', 'luis3@mail.com', '1234567A', 2, '');

    ('luis', 'luis@mail.com', '1234567A', 1, ''),
    ('luis2', 'luis2@mail.com', '1234567A', 2, '');
   
INSERT INTO users ( username, email, password, level) VALUES
	('Ana López', 'ana.lopez@example.com', 'hashed_password_1',1),
	('Carlos Méndez', 'carlos.mendez@example.com', 'hashed_password_2',1),
	('Juan Pérez', 'juan.perez@example.com', 'hashed_password_3',1),
	('María González', 'maria.gonzalez@example.com', 'hashed_password_4',1),
	('Luis Herrera', 'luis.herrera@example.com', 'hashed_password_5',1);

   

-- Tabla statuses
CREATE TABLE statuses (
    status_id INT NOT NULL AUTO_INCREMENT,
    status VARCHAR(10),
    PRIMARY KEY (status_id)
);

INSERT INTO statuses (status) VALUES ('available'), ('pending'), ('completed'), ('canceled');

-- Tabla pets
CREATE TABLE pets (
    pet_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    img VARCHAR(100),
    species VARCHAR(50),
    breed VARCHAR(50),
    birth_date DATE,
    main_image_id INT,
    status_id INT,
    PRIMARY KEY (pet_id),
    FOREIGN KEY (status_id) REFERENCES statuses(status_id)
);

INSERT INTO pets (name, img, species, breed, birth_date, main_image_id, status_id) 
VALUES
    ('Max', 'max.jpg', 'Dog', 'Labrador', '2020-04-15', NULL, 1),
    ('Bella', 'bella.jpg', 'Cat', 'Siamese', '2019-07-30', NULL, 1),
    ('Rocky', 'rocky.jpg', 'Dog', 'Bulldog', '2021-09-05', NULL, 1),
    ('Luna', 'luna.jpg', 'Cat', 'Persian', '2018-03-22', NULL, 1);
   
   INSERT INTO pets (name, img, species, breed, birth_date, main_image_id, status_id) 
   VALUES 
   ('pepe', 'default.jpg', 'Gato', 'persa', '2024-11-12', NULL, 1);
  
  
   select * from pets;

-- Tabla pet_images
CREATE TABLE pet_images (
    image_id INT NOT NULL AUTO_INCREMENT,
    pet_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (image_id),
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id) ON DELETE CASCADE
);

-- Tabla professionals
CREATE TABLE professionals (
    professional_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    professional_name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100),
    contact_info TEXT,
    PRIMARY KEY (professional_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO professionals (professional_id, user_id, professional_name, specialty, contact_info) VALUES
(2,3, 'Dra. Ana López', 'Veterinaria', 'ana.lopez@example.com'),
(3,4, 'Dr. Carlos Méndez', 'Veterinario', 'carlos.mendez@example.com'),
(4,5, 'Juan Pérez', 'Estilista Canino', 'juan.perez@example.com'),
(5,6, 'María González', 'Estilista Canina', 'maria.gonzalez@example.com'),
(6,7, 'Luis Herrera', 'Entrenador Canino', 'luis.herrera@example.com');


-- Tabla services
CREATE TABLE services (
    service_id INT NOT NULL AUTO_INCREMENT,
    service_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    PRIMARY KEY (service_id)
);

INSERT INTO services (service_name, description) 
VALUES 
    ('Consulta Médica', 'Servicios médicos para mascotas incluyendo chequeos generales, vacunas y tratamientos.'), 
    ('Consulta Estética', 'Servicios estéticos para mascotas como baño, corte de pelo y otras consultas de belleza.'), 
    ('Adiestramiento', 'Sesiones de adiestramiento para mejorar el comportamiento y habilidades de las mascotas.');

-- Tabla testimonials
CREATE TABLE testimonials (
    testimonial_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    content TEXT NOT NULL,
    rating TINYINT CHECK (rating BETWEEN 1 AND 5),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (testimonial_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id)
);

-- Tabla adoptions
CREATE TABLE adoptions (
    adoption_id INT NOT NULL AUTO_INCREMENT,
    pet_id INT NOT NULL,
    user_id INT,
    adoption_date DATE,
    status_id INT,
    PRIMARY KEY (adoption_id),
    FOREIGN KEY (status_id) REFERENCES statuses(status_id),
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO adoptions (pet_id, user_id, adoption_date, status_id) VALUES
(1, 3, '2024-12-01 14:30:00',2),
(2, 5, '2024-12-02 10:00:00',2),
(3, 4, '2024-12-03 16:00:00',3);


-- Tabla appointments
CREATE TABLE appointments (
    appointment_id INT NOT NULL AUTO_INCREMENT,
    pet_id INT,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    professional_id INT,
    appointment_date DATETIME NOT NULL,
    price DECIMAL(10, 2),
    notes TEXT,
    status_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (appointment_id),
    FOREIGN KEY (status_id) REFERENCES statuses(status_id),
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id),
    FOREIGN KEY (professional_id) REFERENCES professionals(professional_id)
);

INSERT INTO appointments (pet_id, user_id, service_id, professional_id, appointment_date, price, notes, status_id) VALUES
-- Consultas Médicas
(1, 1, 1, 2, '2024-12-01 10:00:00', 50.00, 'Chequeo general', 2),
(2, 2, 1, 3, '2024-12-02 14:00:00', 60.00, 'Vacunación anual', 3),
(3, 1, 1, 2, '2024-12-03 09:30:00', 45.00, 'Revisión por cojera', 4),

-- Consultas Estéticas
(4, 2, 2, 4, '2024-12-08 10:00:00', 30.00, 'Corte de pelo y baño', 3),
(1, 3, 2, 4, '2024-12-09 13:00:00', 25.00, 'Baño y corte de uñas', 2),
(2, 1, 2, 5, '2024-12-10 17:00:00', 40.00, 'Baño medicado', 2),

-- Sesiones de Adiestramiento
(3, 3, 3, 6, '2024-12-05 15:00:00', 100.00, 'Obediencia básica', 2),
(4, 1, 3, 6, '2024-12-06 11:00:00', 150.00, 'Control de ladridos', 3),
(1, 2, 3, 6, '2024-12-07 16:30:00', 200.00, 'Entrenamiento avanzado', 2);

INSERT INTO appointments (pet_id, user_id, service_id, professional_id, appointment_date, price, notes, status_id)
VALUES (1,1,3,6, '2024-12-05 10:00:00', 100.00, 'Sesión inicial de adiestramiento básico.', 2);


select * from appointments;

TRUNCATE TABLE appointments;






