-- Crear la base de datos
CREATE DATABASE petpedia;

USE petpedia;

-- Tabla users (Usuarios)
CREATE TABLE users (
    user_id INTEGER not null auto_increment,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    level TINYINT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    primary key (user_id)
);

insert into users values (0,'luis','luis@mail.com','1234567A',1,'');

select * from users where email='luis@mail.com'and password ='1234567A';




-- Tabla professionals (Profesionales)
CREATE TABLE professionals (
    professional_id INT auto_increment,
    user_id INT NOT NULL,
    professional_name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100),
    contact_info TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tabla pets (Mascotas)
CREATE TABLE pets (
    pet_id INT IDENTITY PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    species VARCHAR(50),
    breed VARCHAR(50),
    birth_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tabla pet_images (Im�genes de Mascotas)
CREATE TABLE pet_images (
    image_id INT IDENTITY PRIMARY KEY,
    pet_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id)
);

-- Tabla services (Servicios)
CREATE TABLE services (
    service_id INT IDENTITY PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
);

-- Insertar servicios 
INSERT INTO services (service_name, description) 
	VALUES 
		('Consulta Medica', 'Servicios medicos para mascotas incluyendo chequeos generales, vacunas y tratamientos.'), 
		('Consulta Estetica', 'Servicios esteticos para mascotas como baño, corte de pelo y otras consultas de belleza.'), 
		('Adiestramiento', 'Sesiones de adiestramiento para mejorar el comportamiento y habilidades de las mascotas.');

-- Tabla testimonials (Opiniones de Clientes)
CREATE TABLE testimonials (
    testimonial_id INT IDENTITY PRIMARY KEY,
    user_id INT,
    service_id INT,
    content TEXT NOT NULL,
    rating TINYINT CHECK (rating BETWEEN 1 AND 5),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id)
);

-- Tabla statuses (Estatus)
CREATE TABLE statuses (
    status VARCHAR(10) PRIMARY KEY
);

INSERT INTO statuses (status) VALUES ('available'), ('pending'), ('completed'), ('canceled');

-- Tabla adoptions (Adopciones)
CREATE TABLE adoptions (
    adoption_id INT IDENTITY PRIMARY KEY,
    pet_id INT NOT NULL,
    user_id INT,
    adoption_date DATE,
    status VARCHAR(10) DEFAULT 'available',
    FOREIGN KEY (status) REFERENCES statuses(status),
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tabla appointments (Citas)
CREATE TABLE appointments (
    appointment_id INT IDENTITY PRIMARY KEY,
    pet_id INT,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    professional_id INT,
    appointment_date DATETIME NOT NULL,
    price DECIMAL(10, 2),
    notes TEXT,
    status VARCHAR(10) DEFAULT 'available',
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (status) REFERENCES statuses(status),
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id),
    FOREIGN KEY (professional_id) REFERENCES professionals(professional_id)
);

