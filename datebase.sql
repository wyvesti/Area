-- Active: 1748246685493@@127.0.0.1@3306@area
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    picture VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    category_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE post_like (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    reaction ENUM('like', 'dislike') DEFAULT 'like',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO category (name) VALUES ('News'), ('Healh'), ('Climate'), ('Testimony');

INSERT INTO user (username, email, password) VALUES
('admin', 'admin@area.com', 'password');

INSERT INTO post (title, content, image, user_id, category_id) VALUES
('Bienvenue dans la Zone', 'Première chronique sur les anomalies.', NULL, 1, 1);




INSERT INTO user (username, email, password) VALUES
('cecil', 'cecil@nightvale.com', '$2y$10$wImn2N0/Ep6doCrvi4M9EuD13MVJXcTnUZ/FfozEXAD1CH0JgWcbC'),
('old_woman_josie', 'josie@nightvale.com', 'mystery');

INSERT INTO category (name) VALUES
('Mysterious'), ('Supernatural'), ('Science');

INSERT INTO post (title, content, image, user_id, category_id) VALUES
('Le monstre dans la bibliothèque accepte désormais les prêts de livres',
 'Le monstre silencieux, connu pour ses apparitions étranges, a décidé aujourd\'hui de contribuer à la communauté en offrant un service de prêt. Les résidents sont invités à lui confier leurs livres perdus dans l\'espace-temps.', NULL, 2, 4),

('Les arbres parlent, mais ils chuchotent seulement',
 'Des scientifiques locaux ont confirmé que les arbres de Night Vale échangent des secrets qu\'aucun humain ne devrait entendre. Le conseil municipal recommande de ne pas tendre l\'oreille.', NULL, 3, 3),

('Une bourrasque a balayé la réalité, on ne sait pas où elle est allée',
 'Ce matin, une bourrasque inhabituelle a traversé la ville, emportant avec elle la notion même de réalité. Les experts sont perplexes et conseillent de vérifier deux fois la présence de vos rêves.', NULL, 2, 1),

('Le Conseil des Ombres organise une réunion secrète, tous les citoyens sont... attendus',
 'Une convocation étrange a été envoyée à tous les habitants, leur demandant d\'assister à une réunion dont personne ne connaît l\'objet. La participation semble obligatoire.', NULL, 2, 2);



