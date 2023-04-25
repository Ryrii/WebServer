DROP TABLE users ;
DROP TABLE posts ;
DROP TABLE token ;
CREATE TABLE users (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

CREATE TABLE posts (
    post_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    content TEXT NOT NULL,
    FOREIGN KEY (user_id)
       REFERENCES users (user_id) 
);
CREATE TABLE token (
    user_id INTEGER PRIMARY KEY,
    token VARCHAR(20),
    validity DATE,
    FOREIGN KEY (user_id)
       REFERENCES users (user_id) 
);
--users
INSERT INTO users (username,password)
VALUES ('user1', 'mdp');
INSERT INTO users (username,password)
VALUES ('user2', 'mdp');