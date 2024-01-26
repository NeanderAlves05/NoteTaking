CREATE TABLE users(
	id INT AUTO_INCREMENT,
	nome VARCHAR(30),
	cognome VARCHAR(70),
	email VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE notes(
	id INT AUTO_INCREMENT,
	id_user INT NOT NULL,
	id_category INT,
	title VARCHAR(128),
	content TEXT,
	last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (id_user) REFERENCES users(id),
	FOREIGN KEY (id_category) REFERENCES categories(id)
);

CREATE TABLE categories(
	id INT AUTO_INCREMENT,
	descriz VARCHAR(30) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE folders(
	id INT AUTO_INCREMENT,
	id_user INT NOT NULL,
	name VARCHAR(30),
	PRIMARY KEY (id),
	FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE note_folder(
	id_note INT NOT NULL,
	id_folder INT NOT NULL,
	FOREIGN KEY (id_note) REFERENCES notes(id),
	FOREIGN KEY (id_folder) REFERENCES folders(id),
	PRIMARY KEY (id_note, id_folder)
);
